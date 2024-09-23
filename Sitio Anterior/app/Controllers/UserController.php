<?php namespace MyApp\Controllers
{
	use MyApp\Models\User;
	use MyApp\Utils\Message;
	use MyApp\Languages\Spanish;
    use MyApp\Languages\English;
	class UserController
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
		public function index($login)
		{
			$message = $this->message;
			$lang    = $this->lang;
			$this->userModel = new User($this->config);
			$collection = $this->userModel->getUserById($login['id']);
			return view("/users/index.php", compact("collection", "lang", "message"));
		}
		public function language()
		{
			$language = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es';

			if($language == 'es')
			{
				$_SESSION['lang'] = 'en';
			}
			else
			{
				$_SESSION['lang'] = 'es';
			}
			header("Location: /index.php");
		}
		public function sendEmail()
		{
			$nombre         = $_POST['name'];
			$email          = $_POST['email'];
			$subject        = $_POST['subject'];
			$message_text   = $_POST['message'];
			
			if($subject == 1)
			{
				$subject = "Básico";
			}
			else if($subject == 2)
			{
				$subject = "Intermedio";
			}
			else if($subject == 3)
			{
				$subject = "Premium";
			}
			else if($subject == 4)
			{
				$subject = "Empresarial";
			}
			else if($subject == 5)
			{
				$subject = "Otro";
			}
	
			$this->userModel = new User($this->config);
			$this->userModel->sendEmailContact($nombre, $email, $subject, $message_text);
			if(!$this->userModel->getError())
			{
				echo "true";
			}
			else
			{			
				echo $this->userModel->msgError();
			}
		}
	}
}