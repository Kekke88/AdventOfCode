<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\OceanFloorReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$oceanFloor = $parser->read(new OceanFloorReader);

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Overlaps={$oceanFloor->map()->overlaps()}" . PHP_EOL;
echo "Part 2: Overlaps={$oceanFloor->map(true)->overlaps()}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
