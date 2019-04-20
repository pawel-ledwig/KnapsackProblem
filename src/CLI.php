<?php


class CLI
{
    private $filename;
    private $capacity;
    private $algorithm;

    private $params;

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

    public function __construct()
    {
        $this->algorithm = 0;
    }

    public function init($argv)
    {
        $this->params = $argv;

        if ($this->parseParams()) {
            $this->printMessage("Arguments has been parsed successfully.");
            return true;
        } else {
            $this->printMessage("An error(s) occurred during parsing arguments. Re-run is required.");
            return false;
        }
    }

    public function getController()
    {
        return new Controller($this->filename, $this->capacity, $this->algorithm);
    }

    private function parseParams()
    {
        // starting from $i = 1 because argv[0] is current path
        for ($i = 1; $i < sizeof($this->params); $i++) {
            $arg = $this->params[$i];

            // check if argument is an option
            if ($arg[0] == '-') {
                $arg_name = substr($arg, 1);

                // check if an option is supported
                if ($this->isOptionSupported($arg_name)) {
                    $option_name = $this->getOptionName($arg_name);

                    try {
                        $this->parseOption($this->params, $option_name, $i);
                    } catch (MissingArgumentException $e) {
                        $this->printMessage($e->errorMessage());
                        return false;
                    }
                } else {
                    // TODO: Command does not exists
                }
            }
        }
        return $this->validateParams();
    }

    private function isOptionSupported(string $arg_name): bool
    {
        return array_key_exists($arg_name, $this->options) || array_key_exists($arg_name, $this->shortcuts);
    }

    private function getOptionName(string $arg_name): string
    {
        return strlen($arg_name) == 1 ? $this->shortcuts[$arg_name] : $arg_name;
    }

    private function parseOption(array $params, string $option_name, int $i): void
    {
        // if there is no more arguments but option value is required
        if ($i + 1 >= sizeof($params) && $this->options[$option_name]) {
            throw new MissingArgumentException($option_name);
        }

        $value = $params[$i + 1];

        // if there is an option in place of value of previous option, but value of previous option is required
        if ($value[0] == '-' && $this->options[$option_name]) {
            throw new MissingArgumentException($option_name);
        }

        switch ($option_name) {
            case "file":
                $this->filename = strval($value);
                break;
            case "capacity":
                $this->capacity = floatval($value);
                break;
            case "algorithm":
                $this->algorithm = intval($value);
                break;
        }
    }

    public function printMessage($message): void
    {
        echo $message . "\n";
    }

    private function validateParams(): bool
    {
        return (isset($this->filename) === $this->options['file']) &&
            (isset($this->capacity) === $this->options['capacity']);
    }
}