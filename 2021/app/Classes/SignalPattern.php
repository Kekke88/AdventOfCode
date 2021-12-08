<?php

declare(strict_types=1);

namespace App\Classes;

class SignalPattern
{
    private $patterns = [];
    private $values = [];

    public function add($pattern, $value)
    {
        $this->patterns[] = $pattern;
        $this->values[] = $value;
    }

    public function contains($pattern, $letters)
    {
        foreach (str_split($letters) as $letter) {
            if (!str_contains($pattern, $letter)) {
                return false;
            }
        }

        return true;
    }

    public function getOutput()
    {
        $digits = [];
        $total = 0;
        for ($i = 0; $i < sizeof($this->patterns); $i++) {
            // First iteration - get the easy numbers (1, 4, 7, 8)
            foreach ($this->patterns[$i] as $pattern) {

                $knownNumber = match (strlen($pattern)) {
                    2 => 1,
                    3 => 7,
                    4 => 4,
                    7 => 8,
                    default => false
                };

                if ($knownNumber)
                    $digits[$knownNumber] = $pattern;
            }

            // Second iteration - get the other numbers we can know from the previous numbers (9, 0, 6, 3)
            foreach ($this->patterns[$i] as $pattern) {
                if (strlen($pattern) == 6 && $this->contains($pattern, $digits[1]) && $this->contains($pattern, $digits[4])) {
                    $digits[9] = $pattern;
                } else if (strlen($pattern) == 6 && $this->contains($pattern, $digits[1]) && !$this->contains($pattern, $digits[4])) {
                    $digits[0] = $pattern;
                } else if (strlen($pattern) == 6) {
                    $digits[6] = $pattern;
                }

                if (strlen($pattern) == 5 && $this->contains($pattern, $digits[1])) {
                    $digits[3] = $pattern;
                }
            }

            // Third iteration - get the remaining 2 numbers (2, 5)
            $uniqueSixCharacter = '';
            foreach (str_split($digits[6]) as $character) {
                if (!str_contains($digits[9], $character)) {
                    $uniqueSixCharacter = $character;
                    break;
                }
            }
            foreach ($this->patterns[$i] as $pattern) {
                if (strlen($pattern) == 5 && !$this->contains($pattern, $digits[1]) && str_contains($pattern, $uniqueSixCharacter)) {
                    $digits[2] = $pattern;
                } else if (strlen($pattern) == 5 && !$this->contains($pattern, $digits[1])) {
                    $digits[5] = $pattern;
                }
            }

            // Get one digit output at a time as a strong and then get the intval of this number and add it to the total
            $currentNumber = '';
            foreach ($this->values[$i] as $value) {
                $valueArray = str_split($value);
                sort($valueArray);
                $test = implode($valueArray);

                foreach ($digits as $number => $digitPattern) {
                    $dpArray = str_split($digitPattern);
                    sort($dpArray);
                    $digitPattern = implode($dpArray);

                    if ($test == $digitPattern) {
                        $currentNumber .= $number;
                        break;
                    }
                }
            }
            $total += intval($currentNumber);
        }

        return $total;
    }

    public function countOutput()
    {
        $digits = array_fill(0, 10, 0);

        foreach ($this->values as $values) {
            foreach ($values as $value) {
                $digit = match (sizeof(str_split($value))) {
                    2 => 1,
                    3 => 7,
                    4 => 4,
                    7 => 8,
                    default => false
                };

                if ($digit) {
                    $digits[$digit]++;
                }
            }
        }

        return array_sum($digits);
    }
}
