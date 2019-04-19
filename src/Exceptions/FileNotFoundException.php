<?php


class FileNotFoundException extends Exception
{
    protected $filepath;

    public function __construct($filepath = "", $message = "", $code = 0, Throwable $previous = null)
    {
        $this->filepath = $filepath;

        parent::__construct($message, $code, $previous);
    }

    public function errorMessage(){
        return "An error occurred: file '$this->filepath' not found.";
    }
}