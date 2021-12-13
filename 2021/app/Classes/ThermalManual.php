<?php

declare(strict_types=1);

namespace App\Classes;

class ThermalManual
{
    private $folds = [];
    private $dots = [];

    public function addDot($y, $x)
    {
        $this->dots[$y][$x] = 1;
    }

    public function addFold($coordinate, $position)
    {
        $this->folds[] = [$coordinate, $position];
    }

    public function countDots(): int
    {
        $count = 0;
        foreach ($this->dots as $y) {
            foreach ($y as $x) {
                $count++;
            }
        }

        return $count;
    }

    public function fold($maxFolds = -1)
    {
        $folds = 0;

        foreach ($this->folds as $fold) {
            if ($fold[0] == 'y') {
                $max = max(array_keys($this->dots));
                for ($i = $max; $i > $fold[1]; $i--) {
                    if (isset($this->dots[$i])) {
                        foreach ($this->dots[$i] as $x => $value) {
                            $this->dots[$fold[1] - ($i - $fold[1])][$x] = 1;
                        }

                        unset($this->dots[$i]);
                    }
                }
            } else {
                $max = max(array_keys($this->dots));
                $maxX = 0;
                foreach ($this->dots as $y) {
                    if (max(array_keys($y)) > $maxX) $maxX = max(array_keys($y));
                }
                for ($i = $max; $i >= 0; $i--) {
                    if (isset($this->dots[$i])) {
                        for ($x = $maxX; $x > $fold[1]; $x--) {
                            if (isset($this->dots[$i][$x])) {
                                $this->dots[$i][$fold[1] - ($x - $fold[1])] = 1;

                                unset($this->dots[$i][$x]);
                            }
                        }
                    }
                }
            }

            $folds++;

            if ($maxFolds != -1) {
                if ($folds >= $maxFolds) break;
            }
        }
    }

    public function debug()
    {
        $maxX = 0;
        foreach ($this->dots as $y) {
            if (max(array_keys($y)) > $maxX) $maxX = max(array_keys($y));
        }

        for ($y = 0; $y < max(array_keys($this->dots)) + 1; $y++) {
            for ($x = 0; $x < $maxX + 1; $x++) {
                echo isset($this->dots[$y][$x]) ? '#' : '.';
            }
            echo "\n";
        }
    }
}
