<?php

require_once 'vendor/autoload.php';

use App\Classes\DiagnosticComputer;
use App\Classes\DiagnosticReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$commands = $parser->read(new DiagnosticReader);
$computer = new DiagnosticComputer($commands);

$parser->close();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Power Consumption={$computer->calculatePowerConsumption()}" . PHP_EOL;
echo "Part 2: Life Support Rating={$computer->calculateLifeSupportRating()}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
