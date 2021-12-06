<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\FishSchoolReader;

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$fishSchool = $parser->read(new FishSchoolReader);

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Fish={$fishSchool->days(80)}" . PHP_EOL;
echo "Part 2: Fish={$fishSchool->days(256)}" . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;
