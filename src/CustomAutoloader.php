<?php


spl_autoload_register('CustomAutoloader::loadStartupClasses');
spl_autoload_register('CustomAutoloader::loadAlgorithms');
spl_autoload_register('CustomAutoloader::loadExceptions');

class CustomAutoloader
{
    public static function loadAlgorithms($class_name): void {
        $path = 'Algorithms/';

        spl_autoload($path . '/' . $class_name);
    }

    public static function loadStartupClasses($class_name): void {
        spl_autoload($class_name);
    }

    public static function loadExceptions($class_name): void {
        $path = 'Exceptions/';

        spl_autoload($path . '/' . $class_name);
    }
}