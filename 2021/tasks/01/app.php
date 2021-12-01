<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\MeasurementReader;

/*
Part 1
*/

$timeStart = microtime(true);
$parser = new Parser(dirname(__FILE__) . '/data.in');

$measurements = $parser->read(new MeasurementReader);
$increases = 0;

function array_windows($arr, $num)
{
	$retArr = [];

	for ($i = 0; $i < sizeof($arr) - ($num - 1); $i++) {
		$retArr[] = [$arr[$i], $arr[$i + 1], $arr[$i + 2]];
	}

	return $retArr;
}

$i = $j = 0;
$prev = PHP_INT_MAX;
foreach (array_windows($measurements, 3) as $measurement) {
	if ($measurement[0] < $measurement[1] || ($i == 0 && $measurement[1] < $measurement[2])) {
		$i++;
	}

	$val = $measurement[0]->value + $measurement[1]->value + $measurement[2]->value;
	if ($prev < $val) {
		$j++;
	}
	$prev = $val;
}

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Part 1: Number of increases is {$i}." . PHP_EOL;
echo "Part 2: Number of increases is {$j}." . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;

die();

for ($i = 1; $i < sizeof($measurements); $i++) {
	$increases = $measurements[$i] > $measurements[$i - 1] ? $increases + 1 : $increases;
}

echo "Day 1 Part 1: Number of increases is {$increases}." . PHP_EOL;

$parser->close();

/*
Part 2
*/
$parser = new Parser(dirname(__FILE__) . '/data.in');

$increases = 0;
$measurements = $parser->read(new MeasurementReader);

// 3 first measurements
$previousMeasurement = $measurements[0]->value + $measurements[1]->value + $measurements[2]->value;

for ($i = 1; $i < sizeof($measurements) - 2; $i++) {
	$measurement = $measurements[$i]->value + $measurements[$i + 1]->value + $measurements[$i + 2]->value;

	$increases = $measurement > $previousMeasurement ? $increases + 1 : $increases;

	$previousMeasurement = $measurement;
}

$timeEnd = microtime(true);
$executionTime = ($timeEnd - $timeStart) * 1000;

echo "Day 1 Part 2: Number of increases is {$increases}." . PHP_EOL . PHP_EOL;
echo "Execution time (ms): {$executionTime}" . PHP_EOL;

$parser->close();
