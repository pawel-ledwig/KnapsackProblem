<?php


spl_autoload_register('CustomAutoloader::loadAlgorithms');

class CustomAutoloader
{
    public static function loadAlgorithms($class_name){
        $path = 'Algorithms/';

        spl_autoload($path . '/' . $class_name);
    }
}