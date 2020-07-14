<?php 

	if(!isset($_SESSION))
		session_start();

	$config       = include __DIR__ . '/config/app.php';
	$login        = $_SESSION['login'] ?? null; //Si no hay nada le asigna un null
	$hostname     = $_SERVER['HTTP_HOST'];
	$scriptName   = $_SERVER['SCRIPT_NAME'];

	define("DEBUG_ENABLE", $config['debug']);
	define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
	define("APP", __DIR__);
	define("FRAMEWORK", APP . '/../framework');
	define("VIEWS", APP . '/Views');
	define("CONTROLLERS", APP . '/Controllers');
	define("MODELS", APP . '/Models');
	define("UTILS", APP . '/Utils');
	define("MEDIA", APP . '/../public_html/assets/media');
	define("LANGUAGES", APP . '/Languages');

	if(DEBUG_ENABLE && ($_GET['format'] != 'json')){
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(-1);
		echo '<div class="alert alert-warning text-right" role="alert">';
		echo '<b>ScriptName: </b>' . $scriptName;
		echo '</div><hr>';
	}

	//Cargar clases del microframework
	include_once FRAMEWORK . '/View/ViewFactory.php';
	include_once FRAMEWORK . '/Foundation/helpers.php';
	include_once FRAMEWORK . '/Database/DBAbstract.php';
	include_once FRAMEWORK . '/Database/DBMySQL.php';
	include_once UTILS . '/Message.php';
	