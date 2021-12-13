<?php

require_once 'vendor/autoload.php';

use App\Classes\ThermalManualReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$manual = $parser->read(new ThermalManualReader);
//$manual->debug();
$manual->fold();
echo PHP_EOL;
$manual->debug();
$dots = $manual->countDots();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Dots={$dots}" . PHP_EOL;
//echo "Part 2: Paths={$numberOfAdvancedPaths}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 904.52790260315