<?php

require_once 'vendor/autoload.php';

use App\Classes\ThermalManualReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$manual = $parser->read(new ThermalManualReader);

$manual->fold(1);
$dots = $manual->countDots();

$manual->fold();
$dots2 = $manual->countDots();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Dots={$dots}" . PHP_EOL;
echo "Part 2: Dots={$dots2}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 19.383907318115