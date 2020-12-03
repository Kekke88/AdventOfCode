<?php
declare(strict_types = 1);

$dataFile = fopen('day1.txt', 'r') or die('Data file does not exist.');

$data = [];

while(!feof($dataFile)) {
	// Line without newline
        $line = substr(fgets($dataFile), 0, -1);

        if($line !== false) {
                $data[] = $line;
        }
}

// Magic

fclose($dataFile);
