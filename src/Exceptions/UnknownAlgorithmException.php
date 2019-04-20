<?php


class UnknownAlgorithmException extends Exception
{
    protected $arg;

    public function __construct($arg = "", $message = "", $code = 0, Throwable $previous = null)
    {
        $this->arg = $arg;

        parent::__construct($message, $code, $previous);
    }

    public function errorMessage(){
        return "Unknown algorithm number: -$this->arg";
    }
}