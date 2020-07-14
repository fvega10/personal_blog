<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/../app/init.php';
	
	include_once MODELS . "/Post.php";
    include_once MODELS . "/Category.php";
	include_once CONTROLLERS . "/PostController.php"; //Dispatcher
	
	include_once LANGUAGES . "/Spanish.php";
	include_once LANGUAGES . "/English.php";
	use MyApp\Languages\Spanish;
	use MyApp\Languages\English;
	use MyApp\Controllers\PostController;

	$login = isset($_SESSION['login']) ? $_SESSION['login'] : null; 
	$lang  = isset($_SESSION['lang']) ? $_SESSION['lang'] : 'es'; 
	
	
	if($lang == 'es')
	{
		$lang = new Spanish();
	}
	else
	{
		$lang = new English();
	}

	$controller = new PostController($config);
    if (isset($_GET['action'])) 
    {
      switch ($_GET['action'])
      {
        case 'index':
          $controller->information();
		break;
		
        default:
        case 'index':
          $controller->information();
        break;
      }
   }else{
      $controller->information();
   }
?>