<?php namespace MyApp\Controllers
{
	use MyApp\Models\Contact;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class ContactController
	{
		private $config     = null;
		private $userModel  = null;
		private $message    = null;
		private $createBack = null;
		private $lang       = null;
		public function __construct($config)
		{
			$this->config  = $config;
			$this->message = new Message();
			$this->lang    = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';	
			$this->setLanguage();
		}
		private function setLanguage()
		{
			if($this->lang == 'es')
		    {
		      $this->lang = new Spanish();
		    }
		    else
		    {
		      $this->lang = new English();
		    }
		}
		public function index()
        {
            $lang             = $this->lang;
			$message          = $this->message;
			$this->userModel  = new Contact($this->config);
			$collection       = $this->userModel->getAllMessages();
			if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
				return view("/contact/index.php", compact("collection", "message", "lang"));
			else :
				$message = $this->message->setDangerMessage(null, "Ocurrió un error inesperado. Favor contactar al administrador.", null);
				return view("/posts/index.php", compact("message"));
			endif;
        }
		public function create()
		{
			$createBack = $this->createBack;
			$message = $this->message;
			$lang = $this->lang;
			return view("/contact/create.php", compact("lang", "message", "createBack"));
		}
		public function sendEmail()
		{
			$a = isset($_POST['a']) ? $_POST['a'] : null;
			$b = isset($_POST['b']) ? $_POST['b'] : null;
			$email = isset($_POST['email']) ? $_POST['email'] : null;
			$response = isset($_POST['response']) ? $_POST['response'] : null;
			$message = isset($_POST['message']) ? $_POST['message'] : null;

			$this->createBack = [
                'email' => $email,
                'message' => $message,
                'a' => '',
                'b' => '',
                'response' => ''
			];
			
            if($response != ($a + $b))
            {
                $this->message->setDangerMessage(null, "Suma incorrecta. ¡Eres un robot!", null);
                $this->create();
                return;
            }

			if($this->correctFormat($email, $message))
			{
				if(!is_null($email) && !is_null($message))
				{
					
					$this->userModel  = new Contact($this->config);
					$collection       = $this->userModel->store($email, $message);
					if(!$this->userModel->isError()) : //Si el método isError es falso continue, en caso contrario retorne vista de error;
						$this->message->setSuccessMessage(null, "¡Mensaje enviado exitosamente!", null);
						$this->createBack = [
							'email' => '',
							'message' => '',
							'a' => '',
							'b' => '',
							'response' => ''
						];
						$this->create();
						
					else :
						$this->message->setWarningMessage(null, "El registro no se pudo agregar. Intente nuevamente", null);
						$this->createBack = [
							'email' => '',
							'message' => '',
							'a' => '',
							'b' => '',
							'response' => ''
						];
						$this->create();
					endif;
				}
				else
				{
					$this->createBack = [
						'email' => '',
						'message' => '',
						'a' => '',
						'b' => '',
						'response' => ''
					];
					$this->message->setWarningMessage(null, "Algún campo se encuentra vacío", null);
					$this->create();
				}
			}
			else
			{
				$this->create();
			}
		}
		private function correctFormat($email, $message)
		{
			$continue  = true;
			$flagError = "";
			if(strlen($email) > 255)
			{
				$continue = false;
				$flagError = $flagError . $email . " " . strlen($email) . " de 255." . "\n";  
			}

			if(strlen($message) > 2500)
			{
				$continue = false;	
				$flagError = $flagError . $message . " " . strlen($long_description) . " de 2500." . "\n";
			}

			if(!$continue)
			{
				$msg = "Los siguiente registros contienen más carácteres de los permitidos: \n" . $flagError;
				$this->message->setWarningMessage(null, $msg, null);
				return false;
			}
			else
			{
				return true;
			}
		}
	}
}