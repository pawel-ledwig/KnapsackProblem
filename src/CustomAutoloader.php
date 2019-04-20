<?php


spl_autoload_register('CustomAutoloader::loadStartupClasses');
spl_autoload_register('CustomAutoloader::loadAlgorithms');
spl_autoload_register('CustomAutoloader::loadControllers');
spl_autoload_register('CustomAutoloader::loadExceptions');

class CustomAutoloader
{

    public static function loadStartupClasses($class_name): void
    {
        $filename = $class_name . ".php";
        if (file_exists($filename)){
            include $filename;
        }
    }

    public static function loadAlgorithms($class_name): void
    {
        $path = 'Algorithms/';

        $filename = $path . $class_name . ".php";
        if (file_exists($filename)){
            include $filename;
        }
    }

    public static function loadControllers($class_name): void
    {
        $path = 'Controllers/';

        $filename = $path . $class_name . ".php";
        if (file_exists($filename)){
            include $filename;
        }
    }

    public static function loadExceptions($class_name): void
    {
        $path = 'Exceptions/';

        $filename = $path . $class_name . ".php";
        if (file_exists($filename)){
            include $filename;
        }
    }
}