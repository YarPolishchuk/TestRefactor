<?php

require 'vendor/autoload.php';

use src\Comission;
use src\FileParser;


$fileName = $argv[1];

$fileParser = new FileParser($fileName);
$parseData = $fileParser->parse();

$comission = new Comission();
$comission->calculate($parseData);

