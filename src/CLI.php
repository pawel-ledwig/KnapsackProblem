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

    public function parseParams($argc, $argv)
    {
        // starting from $i = 1 because argv[0] is current path
        for ($i = 1; $i < $argc; $i++) {
            $arg = $argv[$i];

            // check if argument is an option
            if ($arg[0] == '-') {
                $arg_name = substr($arg, 1);

                // check if an option is supported
                if ($this->isOptionSupported($arg_name)) {
                    $option_name = $this->getOptionName($arg_name);

                    $this->parseOption($argc, $argv, $option_name, $i);
                } else {
                    // TODO: Command does not exists
                }
            }
        }
    }

    private function isOptionSupported(string $arg_name): bool
    {
        return array_key_exists($arg_name, $this->options) || array_key_exists($arg_name, $this->shortcuts);
    }

    private function getOptionName(string $arg_name): string
    {
        return strlen($arg_name) == 1 ? $this->shortcuts[$arg_name] : $arg_name;
    }

    private function parseOption(int $argc, array $argv, string $option_name, int $i): void
    {
        // if there is no more arguments but option value is required
        if ($i + 1 >= $argc && $this->options[$option_name]) {
            // TODO: Missing argument for option $option_name
            return;
        }

        $value = $argv[$i + 1];

        // if there is an option in place of value of previous option, but value of previous option is required
        if ($value[0] == '-' && $this->options[$option_name]) {
            // TODO: Missing argument for option $option_name
            return;
        }

        switch ($value) {
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
}