<?php
declare(strict_types = 1);

$dataFile = fopen('day1.txt', 'r') or die('Data file does not exist.');

$data = [];

while(!feof($dataFile)) {
	// Remove newline
	$line = fgets($dataFile);

	if($line !== false) {
		$parsedValue = intval(substr($line, 0, -1));

		$data[intval(substr($line, 0, -1))] = true;
	}
}

// Part 1

$targetValue = 2020;

foreach($data as $key => $val) {
	// Cast to int
	$currentValue = $key;
	$findValue = $targetValue - $currentValue;

	if(isset($data[$findValue])) {
		// Found value we are looking for in our hash map
		echo "Day 1 Part 1 Result: " . $currentValue * $findValue . PHP_EOL;
		break;
	}
}

// Part 2

$foundValue = false;
foreach($data as $key => $val) {
	foreach($data as $key2 => $val2) {
		if($key !== $key2) {
			$currentValue = $key + $key2;
			$findValue = $targetValue - $currentValue;

			if(isset($data[$findValue])) {
				echo "Day 1 Part 2 Result: " . $key * $key2 * $findValue . PHP_EOL;
				$foundValue = true;
				break;
			}
		}
	}
	if($foundValue) break;
}

fclose($dataFile);
