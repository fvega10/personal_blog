<?php
    // Esta es el "dispatcher" de usuarios

    // En cada script hay que cargar el init.php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/../app/init.php";

    // Se cargan las clases que se ocupan
    include_once MODELS . "/User.php";
    include_once CONTROLLERS . "/UserController.php";
    include_once LANGUAGES . "/Spanish.php";
    include_once LANGUAGES . "/English.php";

    // Se hace el "use" de las clases que se utilizaran en este script
    use MyApp\Controllers\UserController;
    $controller = new UserController($config);
    if (isset($_GET['action'])) 
    {
        switch ($_GET['action'])
        {
        case 'view':
            $controller->view($login);
        break;

        case 'update':
            $controller->update($login);
        break;

        case 'destroy':
            $controller->destroy($login);
        break;
        
        case 'contact':
            $controller->contact();
        break;

        case 'sendEmail':
            $controller->sendEmail();
        break;

        default:
            $controller->index($login);
        break;
        
        }
    }else{
        $controller->index($login);
    }

    
