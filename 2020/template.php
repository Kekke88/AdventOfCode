<?php

$dataFile = fopen('data.txt', 'r') or die('Data file does not exist.');

$data = [];

while(!feof($dataFile) {
	$data[] = fgets($dataFile);
}

// Magic

fclose($dataFile);
