<?php


class CLI
{
    private $filename;
    private $capacity;
    private $algorithm;

    private $options = array(
        'file' => true, // filename
        'capacity' => true, // capacity
        'algorithm' => false, // algorithm
        'help' => false, // help
    );

    private $shortcuts = array(
        'f' => 'file',
        'c' => 'capacity',
        'a' => 'algorithm',
        'h' => 'help',
    );
}