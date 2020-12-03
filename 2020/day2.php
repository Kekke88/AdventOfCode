<?php
declare(strict_types = 1);

$dataFile = fopen('day2.txt', 'r') or die('Data file does not exist.');

$data = [];

while(!feof($dataFile)) {
        $line = fgets($dataFile);

        if($line !== false) {
		// remove \n
		$line = substr($line, 0, -1);
                $data[] = $line;
        }
}

// Magic
$numberOfInvalidPasswords = 0;
$numberOfValidPasswords = 0;

foreach($data as $line) {
	$lower = intval(substr($line, 0, strpos($line, "-")));
	$higher = intval(substr($line, strpos($line, "-") + 1, strpos(substr($line, strpos($line, "-") + 1), " ")));
	$character = substr($line, strpos($line, ":") - 1, 1);
	$password = substr($line, strpos($line, ":") + 2);

	$passwordCharacters = str_split($password);
	$passwordHash = [];
	foreach($passwordCharacters as $passwordCharacter) {
		if(!isset($passwordHash[$passwordCharacter])) {
			$passwordHash[$passwordCharacter] = 1;
		} else {
			$passwordHash[$passwordCharacter]++;
		}
	}


	if(!isset($passwordHash[$character]) || $passwordHash[$character] < $lower || $passwordHash[$character] > $higher) {
		// At first I read it as if it wanted invalid passwords, hence why this exists.
		$numberOfInvalidPasswords++;
	} else {
		$numberOfValidPasswords++;
	}
}

echo "Day 2 Part 1 Result: {$numberOfValidPasswords}" . PHP_EOL;

fclose($dataFile);
