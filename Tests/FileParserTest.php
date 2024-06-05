<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use RuntimeException;
use src\FileParser;

class FileParserTest extends TestCase
{
    public function testParseValidFile()
    {
        $fileName = 'valid_file.txt';
        file_put_contents($fileName, '{"bin":"45717360","amount":"100.00","currency":"EUR"}' . PHP_EOL);

        $fileParser = new FileParser($fileName);
        $result = $fileParser->parse();

        $this->assertCount(1, $result);
        $this->assertEquals('45717360', $result[0]->bin);
        $this->assertEquals('100.00', $result[0]->amount);
        $this->assertEquals('EUR', $result[0]->currency);

        unlink($fileName);
    }

    public function testParseFileNotExist()
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ERROR: File non_existent_file.txt does not exist!' . PHP_EOL);

        $fileParser = new FileParser('non_existent_file.txt');
        $fileParser->parse();
    }

    public function testParseInvalidFile()
    {
        $fileName = 'invalid_file.txt';
        file_put_contents($fileName, 'invalid content');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('ERROR: File invalid_file.txt not valid!' . PHP_EOL);

        $fileParser = new FileParser($fileName);
        $fileParser->parse();

        unlink($fileName);
    }
}
