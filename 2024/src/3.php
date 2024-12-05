<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$dataFile = fopen('3.input', 'r') or die('Data file does not exist.');

$partOneSolution = 0;
$partTwoSolution = 0;

while(!feof($dataFile)) {
	$line = fgets($dataFile);
    $skip = false;

	if($line !== false) {
        $statements = null;
        preg_match_all("/mul\(([0-9]+),([0-9]+)\)|do\(\)|don't\(\)/", $line, $statements);

        $leftNumbers = $statements[1];
        $rightNumbers = $statements[2];

        foreach($statements[0] as $index => $statement) {
            if ($statement == 'don\'t()') {
                $skip = true;
                continue;
            } else if ($statement == 'do()') {
                $skip = false;
                continue;
            }

            if (! $skip) {
                $partTwoSolution += $leftNumbers[$index] * $rightNumbers[$index];
            }
            $partOneSolution += $leftNumbers[$index] * $rightNumbers[$index];
        }
	}
}

echo "Part one: {$partOneSolution}" . PHP_EOL;
echo "Part two: {$partTwoSolution}" . PHP_EOL;