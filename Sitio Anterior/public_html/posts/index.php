<?php
    // Esta es el "dispatcher" de usuarios

    // En cada script hay que cargar el init.php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/../app/init.php";
    include_once MODELS . "/Post.php";
    include_once MODELS . "/Category.php";
    include_once CONTROLLERS . "/PostController.php"; //Dispatcher
    include_once LANGUAGES . "/Spanish.php";
    include_once LANGUAGES . "/English.php";
    use MyApp\Controllers\PostController;

    $controller = new PostController($config);
   if (isset($_GET['action'])) 
   {
      switch ($_GET['action'])
      {
        case 'index':
          $controller->index();
        break;
        
        case 'create':
            $controller->create();
        break;
        
        case 'show':
            $controller->show();
        break;

        case 'store':
            $controller->store();
        break;

        case 'edit':
            $controller->edit();
        break;

        case 'update':
            $controller->update();
        break;

        case 'destroy':
            $controller->destroy();
        break;

        case 'like':
            $controller->like();
          break;

        default:
        case 'index':
          $controller->index();
        break;
      }
   }else{
      $controller->index();
   }

