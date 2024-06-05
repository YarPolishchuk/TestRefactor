<?php

namespace src;

use RuntimeException;

class FileParser
{
    private string $fileName = '';

    public function __construct($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return array
     */
    public function parse(): array
    {
        if (!file_exists($this->fileName)) {
            throw new RuntimeException('ERROR: File ' . $this->fileName . ' does not exist!' . PHP_EOL);
        }

        $file = file_get_contents($this->fileName);
        $inputData = $this->parseInput($file);

        if ($inputData === NULL || count($inputData) === 0) {
            throw new RuntimeException('ERROR: File ' . $this->fileName . ' not valid!' . PHP_EOL);
        }

        return $inputData;
    }

    /**
     * @param $file
     * @return array
     */
    private function parseInput($file)
    {
        $inputData = [];
        $inputArray = explode("\n", $file);
        foreach ($inputArray as $row) {
            if (!empty(trim($row))) {
                $decodedRow = json_decode($row);
                if ($decodedRow === null && json_last_error() !== JSON_ERROR_NONE) {
                    continue;
                }
                $inputData[] = $decodedRow;
            }
        }
        return $inputData;
    }
}