<?php


class MissingArgumentException extends Exception
{
    protected $arg;

    public function __construct($arg = "", $message = "", $code = 0, Throwable $previous = null)
    {
        $this->arg = $arg;

        parent::__construct($message, $code, $previous);
    }

    public function errorMessage(){
        return "Missing required value for parameter: -$this->arg";
    }
}