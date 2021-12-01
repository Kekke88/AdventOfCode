<?php

require_once 'vendor/autoload.php';

use App\Classes\Parser;

$parser = new Parser(dirname(__FILE__) . '/data.in');

$previousMeasurement = $parser->readLine();
$increases = 0;

while (!$parser->eof()) {
	$measurement = $parser->readLine();

	if ($measurement > $previousMeasurement) {
		$increases++;
	}

	$previousMeasurement = $measurement;
}

$parser->close();

echo "Day 1 Part 1: Number of increases is {$increases}." . PHP_EOL;

$parser = new Parser(dirname(__FILE__) . '/data.in');

$increases = 0;
$measurements = [];

while (!$parser->eof()) {
	$measurements[] = $parser->readLine();
}

// 3 first measurements
$previousMeasurement = $measurements[0] + $measurements[1] + $measurements[2];

for ($i = 1; $i < sizeof($measurements) - 2; $i++) {
	$measurement = $measurements[$i] + $measurements[$i + 1] + $measurements[$i + 2];

	if($measurement > $previousMeasurement) {
		$increases++;
	}

	$previousMeasurement = $measurement;
}

echo "Day 1 Part 2: Number of increases is {$increases}." . PHP_EOL;

$parser->close();
