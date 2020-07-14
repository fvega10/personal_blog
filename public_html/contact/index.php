<?php
    // Esta es el "dispatcher" de usuarios

    // En cada script hay que cargar el init.php
    include_once $_SERVER['DOCUMENT_ROOT'] . "/../app/init.php";

    // Se cargan las clases que se ocupan
    include_once MODELS . "/Contact.php";
    include_once CONTROLLERS . "/ContactController.php";
    include_once LANGUAGES . "/Spanish.php";
    include_once LANGUAGES . "/English.php";

    // Se hace el "use" de las clases que se utilizaran en este script
    use MyApp\Controllers\ContactController;
    $controller = new ContactController($config);
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

        case 'sendEmail':
            $controller->sendEmail();
        break;

        default:
            $controller->index();
        break;
        
        }
    }else{
        $controller->index();
    }

    
