<?php


class FileLoader
{
    private $filepath;
    private $items_data;

    public function __construct($filepath)
    {
        $this->filepath = $filepath;
    }

    /**
     * Used to load data from file and put them into an array.
     * @throws FileNotFoundException
     */
    public function loadDataFromFile(): void
    {
        if (!file_exists($this->filepath)) {
            throw new FileNotFoundException($this->filepath);
        }

        $file_handler = fopen($this->filepath, "r");

        // Skip first line of a file (header with column names)
        fgets($file_handler);

        // For each next line of a file
        while (!feof($file_handler)) {
            $line = fgets($file_handler);
            $array = explode(";", $line);

            // Check if CSV line has all required columns
            if (sizeof($array) === CSV_COLUMNS) {
                $this->items_data[$array[0]] = array(
                    'weight' => intval($array[1]),
                    'value' => intval($array[2]),
                );
            } else {
                echo "Malformed csv line: $line\nProceeding with next line.\n";
            }
        }
    }
}