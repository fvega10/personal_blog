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
	}
}