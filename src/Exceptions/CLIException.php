<?php


class CLIException extends Exception
{
    protected $msg;

    public function __construct($arg = "", $message = "", $code = 0, Throwable $previous = null)
    {
        $this->msg = $arg;

        parent::__construct($message, $code, $previous);
    }

    public function errorMessage(){
        return "Unknown algorithm number: $this->msg";
    }
}