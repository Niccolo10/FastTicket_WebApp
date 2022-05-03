<?php 
session_start();
define('ENV', "dev");
define('DIR_CONTROLLERS', 'controllers');
define('DIR_VIEWS', 'views');
define('LINK_BASE', '');
ini_set('display_errors', 'On');
// Set encode and timezone
if(function_exists("mb_internal_encoding")){
	mb_internal_encoding('UTF-8');
}
date_default_timezone_set('Europe/Rome');

require_once 'lib\vendor\autoload.php';

$router = new AltoRouter();

// Set our base
$router->setBasePath(LINK_BASE);

$router->map('GET','/', array('controller' => 'ControlBus', 'action' => 'index', 'view' =>'HomePage'), 'index');
$router->map('GET','/ciao', array('controller' => 'ControlBus', 'action' => 'doSomething', 'view' =>'page2'), 'doSomething');

$match = $router->match();
$controller = (isset($match['target']['controller']))?$match['target']['controller']:'404';
$action = (isset($match['target']['action']))?$match['target']['action']:'default';
$view = (isset($match['target']['view']))?$match['target']['view']:'404';
$parameters = $match['params'];


include (DIR_CONTROLLERS."\\$controller.php");	
if(file_exists(DIR_VIEWS . "\\$controller\\$view.php")) {
	include (DIR_VIEWS . "\\$controller\\$view.php");
}

?>