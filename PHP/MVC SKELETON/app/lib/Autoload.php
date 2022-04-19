<?php
namespace PHPMVC;

class Autoload
{
    public static function autoload ($className)
    {
        $className = str_replace('PHPMVC', '', $className);
        // echo $className."=====";
        $className = str_replace('\\\\', DS, $className);
        //echo $className."=====";
        $className = strtolower($className);
        //echo $className."=====";
        $className = $className.'.php';
        //echo $className, APP_PATH.$className;;
        if(file_exists(APP_PATH.$className)) {
           require_once APP_PATH.$className;
        }

    }
}

spl_autoload_register(__NAMESPACE__.'\Autoload::autoload');