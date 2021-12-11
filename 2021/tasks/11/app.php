<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\CavernReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$cavern = $parser->read(new CavernReader);

$flashes = $cavern->step(100);
$step = $cavern->findSimultaneouslyFlashing() + 101; // Add offset from previous call

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Flashes={$flashes}" . PHP_EOL;
echo "Part 2: Step={$step}" . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
// Execution time (ms): 0.32997131347656