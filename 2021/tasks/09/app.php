<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\HeightMapReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$heightMap = $parser->read(new HeightMapReader);
$risk = $heightMap->risk();
$basinSizes = $heightMap->basinSizes();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Risk={$risk}" . PHP_EOL;
echo "Part 2: BasinSizes={$basinSizes}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 3.1919479370117