<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;
use App\Classes\MeasurementReader;

/*
Part 1
*/

$parser = new Parser(dirname(__FILE__) . '/data.in');

$measurements = $parser->read(new MeasurementReader);
$increases = 0;

for($i = 1; $i < sizeof($measurements); $i++) {
	$increases = $measurements[$i] > $measurements[$i-1] ? $increases + 1 : $increases;
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

echo "Day 1 Part 2: Number of increases is {$increases}." . PHP_EOL;

$parser->close();
