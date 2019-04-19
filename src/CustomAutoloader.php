<?php


spl_autoload_register('CustomAutoloader::loadAlgorithms');

class CustomAutoloader
{
    public static function loadAlgorithms($class_name): void {
        $path = 'Algorithms/';

        spl_autoload($path . '/' . $class_name);
    }

    public static function loadStartupClasses($class_name): void {
        spl_autoload($class_name);
    }
}