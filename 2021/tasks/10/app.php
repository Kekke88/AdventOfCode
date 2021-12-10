<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\NavigationSystemReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$navigation = $parser->read(new NavigationSystemReader);

$points = $navigation->getInvalidPoints();
$corruptPoints = $navigation->getCorruptedPoints();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Points={$points}" . PHP_EOL;
echo "Part 2: Points={$corruptPoints}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 3.1919479370117