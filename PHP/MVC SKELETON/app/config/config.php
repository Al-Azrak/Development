<?php

if(!defined('DS')){
    define('DS', DIRECTORY_SEPARATOR);
}

define('APP_PATH', str_replace(DS.'config','', realpath(dirname(__FILE__))));
define('CONFIG_PATH', realpath(dirname(__FILE__)));
//echo APP_PATH;
define('VIEWS_PATH', APP_PATH.DS.'Views'.DS);
//echo VIEWS_PATH;
define('TEMPLATE_PATH', APP_PATH.DS.'Template'.DS);
define('CSS', str_replace(DS.'app'.DS.'config','', realpath(dirname(__FILE__))).DS.'public'.DS.'css');
//echo CSS;
define('JS', str_replace(DS.'app'.DS.'config','', realpath(dirname(__FILE__))).DS.'public'.DS.'js');
//echo JS;