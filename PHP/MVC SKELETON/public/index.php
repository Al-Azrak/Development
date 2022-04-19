<?php
namespace PHPMVC;
use PHPMVC\LIB\FrontController;
use PHPMVC\LIB\Template;
if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}
require '..'.DS.'app'.DS.'config'.DS.'config.php';
require '..'.DS.'app'.DS.'lib'.DS.'Autoload.php';
$template_parts = require_once CONFIG_PATH.DS.'templateConfig.php';

//var_dump($template_parts);

//echo dirname(__FILE__);
$template = new Template($template_parts);
$frontController = new FrontController($template);
$frontController->dispatch();
//echo $_SERVER['REQUEST_URI'];
//$url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
 //       var_dump($url);