<?php

require_once 'vendor/autoload.php';

use App\Classes\CavernMapReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$cavernMap = $parser->read(new CavernMapReader);
$numberOfPaths = $cavernMap->paths();
$numberOfAdvancedPaths = $cavernMap->paths(2);

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Paths={$numberOfPaths}" . PHP_EOL;
echo "Part 2: Paths={$numberOfAdvancedPaths}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 904.52790260315