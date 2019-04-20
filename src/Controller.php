<?php


class Controller
{
    private $filename;
    private $capacity;
    private $algorithm;

    public function __construct($filename, $capacity, $algorithm)
    {
        $this->filename = $filename;
        $this->capacity = $capacity;
        $this->algorithm = $algorithm;
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
}