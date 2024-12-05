<?php

declare(strict_types=1);

require 'vendor/autoload.php';

$dataFile = fopen('2.input', 'r') or die('Data file does not exist.');

$partOneSolution = 0;
$partTwoSolution = 0;

function isSafe(array $values, bool $includeSkip = false): bool
{
    $previousValue = null;
    $isIncreasing = null;

    for($i = 0; $i < sizeof($values); $i++) {
        if (is_null($previousValue)) {
            $previousValue = $values[$i];
            continue;
        }

        if ($previousValue > $values[$i] && is_null($isIncreasing)) {
            $isIncreasing = false;
        } else if($previousValue < $values[$i] && is_null($isIncreasing)) {
            $isIncreasing = true;
        }

        if ($previousValue === $values[$i] || abs($previousValue - $values[$i]) > 3 || ($isIncreasing && $previousValue > $values[$i]) || (!$isIncreasing && $previousValue < $values[$i])) {
            if ($includeSkip) {
                $clone = $values;
                unset($clone[$i]);
                $clone = array_values($clone);

                $clone2 = $values;
                if (isset($clone2[$i-1])) {
                    unset($clone2[$i-1]);
                    $clone2 = array_values($clone2);
                }

                $clone3 = $values;
                if (isset($clone3[$i-2])) {
                    unset($clone3[$i-2]);
                    $clone3 = array_values($clone3);
                }
                
                if (isSafe($clone) || isSafe($clone2) || isSafe($clone3)) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        $previousValue = $values[$i];
    }

    return true;
}

while(!feof($dataFile)) {
	$line = fgets($dataFile);

	if($line !== false) {
        $line = trim($line);
		$values = explode(" ", $line);
        $partOneSolution++;
        $partTwoSolution++;

        if (!isSafe($values)) {
            $partOneSolution--;
        }
        if (!isSafe($values, true)) {
            $partTwoSolution--;
        }
	}
}

echo "Part one: {$partOneSolution}" . PHP_EOL;
echo "Part two: {$partTwoSolution}" . PHP_EOL;