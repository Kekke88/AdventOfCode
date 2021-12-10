<?php

require_once 'vendor/autoload.php';

use App\Classes\CrabFuelReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$crabFuel = $parser->read(new CrabFuelReader);
$cheapestRoute = $crabFuel->calculateOptimalRoute();
$cheapestRealRoute = $crabFuel = $crabFuel->calculateRealOptimalRoute();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Fuel={$cheapestRoute}" . PHP_EOL;
echo "Part 2: Fuel={$cheapestRealRoute}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 282.71007537842