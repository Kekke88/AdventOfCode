<?php

declare(strict_types=1);

namespace App\Classes;

class NavigationSystem
{
    private $instructions = [];

    public function addInstruction($instruction)
    {
        $this->instructions[] = $instruction;
    }

    public function getCorruptedPoints()
    {
        $instructions = $this->getCorruptedInstructions();
        $points = [];
        $pointsMap = [
            ')' => 1,
            ']' => 2,
            '}' => 3,
            '>' => 4
        ];

        $i = 0;
        foreach($instructions as $instruction) {
            $points[$i] = 0;
            foreach($instruction as $brace) {
                $points[$i] = $points[$i] * 5;
                $points[$i] += $pointsMap[$brace];
            }
            $i++;
        }
        
        sort($points);

        return $points[floor(sizeof($points)/2)];
    }

    public function getInvalidPoints()
    {
        $invalidInstructions = $this->getInvalidInstructions();

        $pointsMap = [
            ')' => 3,
            ']' => 57,
            '}' => 1197,
            '>' => 25137
        ];

        $points = 0;

        foreach ($invalidInstructions as $invalidInstruction) {
            $points += $pointsMap[$invalidInstruction];
        }

        return $points;
    }

    private function getCorruptedInstructions()
    {
        $bracesMap = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
            '>' => '<'
        ];

        $closingBracesMap = [
            '(' => ')',
            '[' => ']',
            '{' => '}',
            '<' => '>'
        ];

        $corruptInstructions = [];

        $j = 0;
        foreach ($this->instructions as $instruction) {
            $openBraces = [];
            $isInvalid = false;

            foreach (str_split($instruction) as $brace) {
                if (!isset($bracesMap[$brace])) {
                    // We know its an opening brace
                    $openBraces[] = $brace;
                } else {
                    if (array_pop($openBraces) !== $bracesMap[$brace]) {
                        $isInvalid = true;
                        break;
                    }
                }
            }

            if (!$isInvalid) {
                for($i = sizeof($openBraces) - 1; $i >= 0; $i--) {
                    $corruptInstructions[$j][] = $closingBracesMap[$openBraces[$i]];
                }
                $j++;
            }
        }

        return $corruptInstructions;
    }

    private function getInvalidInstructions()
    {
        $bracesMap = [
            ')' => '(',
            ']' => '[',
            '}' => '{',
            '>' => '<'
        ];

        $invalidInstructions = [];

        foreach ($this->instructions as $instruction) {
            $openBraces = [];

            foreach (str_split($instruction) as $brace) {
                if (!isset($bracesMap[$brace])) {
                    // We know its an opening brace
                    $openBraces[] = $brace;
                } else {
                    if (array_pop($openBraces) !== $bracesMap[$brace]) {
                        $invalidInstructions[] = $brace;
                        break;
                    }
                }
            }
        }

        return $invalidInstructions;
    }
}
