<?php

declare(strict_types=1);

namespace App\Classes;

class HeightMap
{
    private $map = [];

    public function addRow()
    {
        $this->map[sizeof($this->map)] = [];
    }

    public function addCol($height)
    {
        $this->map[sizeof($this->map) - 1][] = $height;
    }

    public function basinSize($y, $x, &$points = [])
    {
        if (!isset($this->map[$y][$x])) return $points;
        if (isset($points[$y][$x])) return $points;

        $points[$y][$x] = true;
        // Up flow
        if (!isset($points[$y - 1][$x]) && isset($this->map[$y - 1][$x]) && $this->map[$y - 1][$x] != '9') {
            $this->basinSize($y - 1, $x, $points);
        }

        // Down flow
        if (!isset($points[$y + 1][$x]) && isset($this->map[$y + 1][$x]) && $this->map[$y + 1][$x] != '9') {
            $this->basinSize($y + 1, $x, $points);
        }

        // Left flow
        if (!isset($points[$y][$x - 1]) && isset($this->map[$y][$x - 1]) && $this->map[$y][$x - 1] != '9') {
            $this->basinSize($y, $x - 1, $points);
        }

        // Right flow
        if (!isset($points[$y][$x + 1]) && isset($this->map[$y][$x + 1]) && $this->map[$y][$x + 1] != '9') {
            $this->basinSize($y, $x + 1, $points);
        }

        return $points;
    }

    public function basinSizes()
    {
        $basins = [];
        $sizes = [];
        for ($y = 0; $y < sizeof($this->map); $y++) {
            for ($x = 0; $x < sizeof($this->map[$y]); $x++) {
                $hasLowerNeighbour = false;

                if (isset($this->map[$y - 1][$x]) && $this->map[$y - 1][$x] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y + 1][$x]) && $this->map[$y + 1][$x] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y][$x - 1]) && $this->map[$y][$x - 1] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y][$x + 1]) && $this->map[$y][$x + 1] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                }

                if (!$hasLowerNeighbour) {
                    $basins[] = $this->basinSize($y, $x);
                }
            }
        }

        foreach($basins as $basin) {
            $sizes[] = array_sum(array_map('count', $basin));
        }

        sort($sizes);
        $topSizes = array_slice($sizes, -3, 3);

        return array_product($topSizes);
    }

    public function risk()
    {
        $risk = 0;

        for ($y = 0; $y < sizeof($this->map); $y++) {
            for ($x = 0; $x < sizeof($this->map[$y]); $x++) {
                $hasLowerNeighbour = false;

                if (isset($this->map[$y - 1][$x]) && $this->map[$y - 1][$x] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y + 1][$x]) && $this->map[$y + 1][$x] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y][$x - 1]) && $this->map[$y][$x - 1] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                } else if (isset($this->map[$y][$x + 1]) && $this->map[$y][$x + 1] <= $this->map[$y][$x]) {
                    $hasLowerNeighbour = true;
                }

                if (!$hasLowerNeighbour) {
                    $risk += $this->map[$y][$x] + 1;
                }
            }
        }

        return $risk;
    }
}
