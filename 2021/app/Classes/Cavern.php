<?php

declare(strict_types=1);

namespace App\Classes;

define('ROW', 0);
define('COL', 1);
define('ROW_COUNT', 10);
define('COL_COUNT', 10);

class Cavern
{
    private $octopuses = [];

    public function addRow()
    {
        $this->octopuses[sizeof($this->octopuses)] = [];
    }

    public function addCol($octopus)
    {
        $this->octopuses[sizeof($this->octopuses) - 1][] = $octopus;
    }

    private function countOctopuses()
    {
        $size = 0;

        foreach ($this->octopuses as $octopusRow) {
            $size += sizeof($octopusRow);
        }

        return $size;
    }

    public function flash($y, $x, &$flashes, &$pointsFlashed)
    {
        $flashes++;

        $directions = [
            [0, -1],
            [-1, -1],
            [-1, 0],
            [-1, 1],
            [0, 1],
            [1, 1],
            [1, 0],
            [1, -1]
        ];

        foreach ($directions as $direction) {
            if (!isset($this->octopuses[$y + $direction[ROW]][$x + $direction[COL]])) continue;
            if (isset($pointsFlashed[$y + $direction[ROW]][$x + $direction[COL]])) continue;

            $this->octopuses[$y + $direction[ROW]][$x + $direction[COL]]++;

            if ($this->octopuses[$y + $direction[ROW]][$x + $direction[COL]] > 9) {
                $this->octopuses[$y + $direction[ROW]][$x + $direction[COL]] = 0;
                $pointsFlashed[$y + $direction[ROW]][$x + $direction[COL]] = 1;
                $this->flash($y + $direction[ROW], $x + $direction[COL], $flashes, $pointsFlashed);
            }
        }
    }

    public function findSimultaneouslyFlashing()
    {
        $maxFlashes = $this->countOctopuses();

        for ($i = 0; $i < PHP_INT_MAX; $i++) {
            $flashes = 0;
            $pointsFlashed = [];

            for ($y = 0; $y < ROW_COUNT; $y++) {
                for ($x = 0; $x < COL_COUNT; $x++) {
                    if (!isset($pointsFlashed[$y][$x])) $this->octopuses[$y][$x]++;

                    if ($this->octopuses[$y][$x] > 9) {
                        $this->octopuses[$y][$x] = 0;
                        $pointsFlashed[$y][$x] = 1;
                        $this->flash($y, $x, $flashes, $pointsFlashed);
                    }
                }
            }

            if ($flashes == $maxFlashes) {
                return $i;
            }
        }
    }

    public function step($steps)
    {
        $flashes = 0;

        for ($i = 0; $i < $steps; $i++) {
            $pointsFlashed = [];

            for ($y = 0; $y < ROW_COUNT; $y++) {
                for ($x = 0; $x < COL_COUNT; $x++) {
                    if (!isset($pointsFlashed[$y][$x])) $this->octopuses[$y][$x]++;

                    if ($this->octopuses[$y][$x] > 9) {
                        $this->octopuses[$y][$x] = 0;
                        $pointsFlashed[$y][$x] = 1;
                        $this->flash($y, $x, $flashes, $pointsFlashed);
                    }
                }
            }
        }

        return $flashes;
    }

    public function debug()
    {
        echo "--- DEBUG ---\n";
        for ($y = 0; $y < ROW_COUNT; $y++) {
            for ($x = 0; $x < COL_COUNT; $x++) {
                echo $this->octopuses[$y][$x];
            }

            echo PHP_EOL;
        }
    }
}
