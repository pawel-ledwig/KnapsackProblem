<?php


class Controller
{
    private $filename;
    private $capacity;
    private $algorithm;
    private $knapsack;

    public function __construct($filename, $capacity, $algorithm)
    {
        $this->filename = $filename;
        $this->capacity = $capacity;
        $this->algorithm = $algorithm;
        $this->knapsack = null;
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return float
     */
    public function getCapacity(): float
    {
        return $this->capacity;
    }

    /**
     * @return int
     */
    public function getAlgorithm(): int
    {
        return $this->algorithm;
    }

    /**
     * @return Knapsack | null
     */
    public function getKnapsack()
    {
        return $this->knapsack;
    }

    /**
     * Used to print message into the standard output.
     * @param $message
     */
    public function printMessage($message): void
    {
        echo $message . "\n";
    }

}