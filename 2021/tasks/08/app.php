<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\SignalPatternReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$signalPattern = $parser->read(new SignalPatternReader);
$outputCount = $signalPattern->countOutput();
$output = $signalPattern->getOutput();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Numbers={$outputCount}" . PHP_EOL;
echo "Part 2: Numbers={$output}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 3.1919479370117