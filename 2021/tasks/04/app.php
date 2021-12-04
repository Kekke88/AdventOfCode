<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\BingoReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$bingo = $parser->readStruct(new BingoReader);
$bingo->play();

$parser->close();

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: First Winner Score={$bingo->getFirstWinnerFinalScore()}" . PHP_EOL;
echo "Part 2: Last Winner Score={$bingo->getLastWinnerFinalScore()}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
