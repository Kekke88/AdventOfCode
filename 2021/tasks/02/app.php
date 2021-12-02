<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\SubmarineCommandsReader;
use App\Classes\SubmarineComputer;

/*
Part 1
*/

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$commands = $parser->read(new SubmarineCommandsReader);
$computer = new SubmarineComputer($commands);

$computer->execute();
$solution = $computer->getPosition() * $computer->getDepth();

$parser->close();

echo "Part 1: Depth is {$computer->getDepth()}, Position is {$computer->getPosition()}. Position*Depth={$solution}" . PHP_EOL;

$parser = new Parser(dirname(__FILE__) . '/data.in');

$commands = $parser->read(new SubmarineCommandsReader);
$computer = new SubmarineComputer($commands);

$computer->executeAdvanced();
$solution = $computer->getPosition() * $computer->getDepth();

$parser->close();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 2: Depth is {$computer->getDepth()}, Position is {$computer->getPosition()}. Position*Depth={$solution}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
