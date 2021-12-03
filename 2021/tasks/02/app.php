<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\SubmarineCommandsReader;
use App\Classes\SubmarineComputer;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$commands = $parser->read(new SubmarineCommandsReader);
$computer = new SubmarineComputer($commands);

$firstSolution = $computer->calculate();
$secondSolution = $computer->calculateAdvanced();

$parser->close();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Position*Depth={$firstSolution}" . PHP_EOL;
echo "Part 2: Position*Depth={$secondSolution}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
