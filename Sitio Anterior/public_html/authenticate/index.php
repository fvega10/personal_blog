<?php
    // Esta es el "dispatcher" de usuarios

    // En cada script hay que cargar el init.php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/../app/init.php";

    // Se cargan las clases que se ocupan
    include_once MODELS . "/User.php";
    include_once CONTROLLERS . "/AuthController.php"; //Dispatcher
    include_once LANGUAGES . "/Spanish.php";
    include_once LANGUAGES . "/English.php";
    
    // Se hace el "use" de las clases que se utilizaran en este script
    use MyApp\Controllers\AuthController;
    $controller = new AuthController($config);
   if (isset($_GET['action'])) 
   {
      switch ($_GET['action'])
      {
        case 'login':
          $controller->login();
        break;
        
        case 'auth':
          $controller->auth();
        break;

        default:
        case 'logout':
          $controller->logout();
        break;
      }
   }else{
      $controller->login();
   }

