<?php namespace MyApp\Controllers
{
	use MyApp\Models\User;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class AuthController
	{
		private $config     = null;
		private $userModel  = null;
		private $message    = null;
		private $lang       = null;
		public function __construct($config)
		{
			$this->config  = $config;
			$this->message = new Message();
			$this->lang    = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';	
			$this->setLanguage();
		}
		public function setLanguage()
		{
			if($this->lang == 'es')
		    {
		      $this->lang = new Spanish();
		    }else{
		      $this->lang = new English();
		    }
		}
		public function login()
		{
			$message    = $this->message;
			return view("auth/login.php", compact("message"));
		}
		public function auth()
		{
			$this->userModel = new User ($this->config);
			$email     = isset($_POST['email']) ? $_POST['email'] : null;
			$password  = isset($_POST['password']) ? $_POST['password'] : null;
			if($email != null && $password != null)
			{
				$login = $this->userModel->authenticate($email, $password);
				if(!$this->userModel->getError() && !is_null($login))
				{
					session_start();
					$_SESSION['login'] = $login;
					$_SESSION['lang']  = 'es';
					header("Location: /index.php");
				}
				else
				{
					$this->message->setDangerMessage("Atención", "Usuario y/o contraseña inválidos", null);
					$this->login();
				}
			}
			else
			{
				$this->message->setWarningMessage("Atención", "Algunos campos se encuentran vacíos", null);
				$this->login();
			}
		}
		public function logout()
		{
			session_destroy();
			header ("Location: /index.php");
		}

		private function correctFormat($email, $password)
		{
			$continue  = true;
			$flagError = "";
			if(strlen($email) > 50)
			{
				$continue = false;
				$flagError = $flagError . $email . " " . strlen($email) . " de 50 permitidos." . "\n";  
			}
			if(strlen($password) > 45)
			{
				$continue = false;	
				$flagError = $flagError . $password . " " . strlen($password) . " de 45 permitidos." . "\n";  
			}
			if(!$continue)
			{
				$msg = "Los siguiente registros contienen más carácteres de los permitidos: " . $flagError;
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