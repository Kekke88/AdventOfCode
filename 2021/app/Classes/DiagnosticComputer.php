<?php

declare(strict_types=1);

namespace App\Classes;

class DiagnosticComputer
{
    public $diagnostics;

    public function __construct($diagnostics)
    {
        $this->diagnostics = $diagnostics;
    }

    public function calculatePowerConsumption()
    {
        $bitStack = [];

        // Create an array of all bits in index order
        // We need this to calculate the most common bit
        foreach ($this->diagnostics as $diagnostic) {
            $i = 0;
            foreach (str_split($diagnostic->value) as $bit) {
                if ($bit == '0' || $bit == '1') {
                    $bitStack[$i][] = $bit;
                    $i++;
                }
            }
        }

        // Calculate the most common bit from the indexes created earlier
        $gamma = "";
        $epsilon = "";
        foreach ($bitStack as $bits) {
            if (array_sum($bits) > sizeof($bits) / 2) {
                $gamma .= "1";
                $epsilon .= "0";
            } else {
                $gamma .= "0";
                $epsilon .= "1";
            }
        }

        // Return the power consumption
        return bindec($gamma) * bindec($epsilon);
    }

    private function filterBits($index, $diagnostics, $least = true)
    {
        // Basically the same as power consumption, only difference is we use a recursive function to filter out diagnostics
        $filteredBits = [];
        $filterValue = $least ? "0" : "1";

        foreach ($diagnostics as $diagnostic) {
            $bitStack[] = $diagnostic->value[$index];
        }

        if (array_sum($bitStack) >= sizeof($bitStack) / 2) {
            $filterValue = $least ? "1" : "0";
        }

        foreach ($diagnostics as $diagnostic) {
            if ($diagnostic->value[$index] == $filterValue) {
                $filteredBits[] = $diagnostic;
            }
        }

        // And when we only have one value left - return it
        if (sizeof($filteredBits) == 1) {
            return $filteredBits[0];
        }

        return $this->filterBits($index + 1, $filteredBits, $least);
    }

    public function calculateLifeSupportRating()
    {
        $oxygenRating = $this->filterBits(0, $this->diagnostics);
        $co2Rating = $this->filterBits(0, $this->diagnostics, false);
        
        return bindec($oxygenRating->value) * bindec($co2Rating->value);
    }
}
