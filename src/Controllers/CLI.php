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

    /**
     * @param $argv - parameters given during startup of the program
     * @throws CLIException
     */
    public function init($argv): void
    {
        $this->params = $argv;

        if ($this->parseParams()) {
            $this->printMessage("Arguments has been parsed successfully.");
        } else {
            throw new CLIException("An error(s) occurred during parsing arguments. Re-run is required.");
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return new Controller($this->filename, $this->capacity, $this->algorithm);
    }

    /**
     * Parse all parameters.
     * @return bool - true if successfully completed, false if errors occurred.
     */
    private function parseParams(): bool
    {
        // starting from $i = 1 because argv[0] is current path
        for ($i = 1; $i < sizeof($this->params); $i++) {
            $arg = $this->params[$i];

            // check if argument is an option
            if ($arg[0] == '-') {
                $arg_name = substr($arg, 1);

                // check if an option is supported
                if ($this->isOptionSupported($arg_name)) {
                    try {
                        $this->parseOption($this->params, $arg_name, $i);
                    } catch (MissingArgumentException $e) {
                        $this->printMessage($e->errorMessage());
                        return false;
                    }
                } else {
                    $this->printMessage("Skipping unsupported option: -$arg_name");
                }
            }
        }
        return $this->validateParams();
    }

    /**
     * Check if option is supported in the program.
     * @param string $arg_name
     * @return bool
     */
    private function isOptionSupported(string $arg_name): bool
    {
        return array_key_exists($arg_name, $this->options) || array_key_exists($arg_name, $this->shortcuts);
    }

    /**
     * @param string $arg_name
     * @return string - full name of an option
     */
    private function getOptionName(string $arg_name): string
    {
        return strlen($arg_name) == 1 ? $this->shortcuts[$arg_name] : $arg_name;
    }

    /**
     * Used to parse single argument: read value if given and throw an exception if required value is missing.
     * @param array $params - parameters given during startup of the program
     * @param string $arg_name - name of currently parsing argument
     * @param int $i - index of $arg_name in $params array
     * @throws MissingArgumentException
     */
    private function parseOption(array $params, string $arg_name, int $i): void
    {
        $option_name = $this->getOptionName($arg_name);

        // if there is no more arguments but option value is required
        if ($i + 1 >= sizeof($params) && $this->options[$option_name]) {
            throw new MissingArgumentException($arg_name);
        }

        $value = $params[$i + 1];

        // if there is an option in place of value of previous option, but value of previous option is required
        if ($value[0] == '-' && $this->options[$option_name]) {
            throw new MissingArgumentException($arg_name);
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

    /**
     * Used to print message into the standard output.
     * @param $message
     */
    public function printMessage($message): void
    {
        echo $message . "\n";
    }

    /**
     * Checking if required fields has been set.
     * @return bool
     */
    private function validateParams(): bool
    {
        if (!isset($this->filename)) {
            $this->printMessage("Missing path to the file.");
        }
        if (!isset($this->capacity)) {
            $this->printMessage("Missing knapsack capacity.");
        }

        return (isset($this->filename) === $this->options['file']) &&
            (isset($this->capacity) === $this->options['capacity']);
    }
}