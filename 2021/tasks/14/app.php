<?php

require_once 'vendor/autoload.php';

use App\Classes\PolymerReader;
use App\Classes\Parser;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$manual = $parser->readStruct(new PolymerReader);

$manual->step(10);
$quantity = $manual->getQuantity();

$manual->step(30);
$quantityPart2 = $manual->getQuantity();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Quantity={$quantity}" . PHP_EOL;
echo "Part 2: Quantity={$quantityPart2}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 19.383907318115