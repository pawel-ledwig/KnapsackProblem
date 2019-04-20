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
     * Responsible for process of calculating knapsack problem.
     */
    public function run(): void
    {
        $file_loader = new FileLoader($this->filename);
        try {
            $file_loader->loadDataFromFile();
            $items_data = $file_loader->getItemsData();

            switch ($this->algorithm) {
                case 0:
                    $algorithm = new GreedyValue($this->capacity, $items_data);
                    $this->knapsack = $algorithm->fillKnapsack();
                    break;
                default:
                    throw new UnknownAlgorithmException($this->algorithm);
                    break;
            }

        } catch (FileNotFoundException $e) {
            $this->printMessage($e->errorMessage());
        } catch (UnknownAlgorithmException $e) {
            $this->printMessage($e->errorMessage());
        }
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