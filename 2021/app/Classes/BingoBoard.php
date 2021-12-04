<?php

declare(strict_types=1);

namespace App\Classes;

class BingoBoard
{
    public $value;
    private $MARKED = 100;

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function score($drawing)
    {
        $score = 0;
        for ($i = 0; $i < sizeof($this->value); $i++) {
            for ($j = 0; $j < sizeof($this->value[$i]); $j++) {
                if ($this->value[$i][$j] < $this->MARKED) {
                    $score += $this->value[$i][$j];
                }
            }
        }

        return $score * $drawing;
    }

    public function mark($number)
    {
        for ($i = 0; $i < sizeof($this->value); $i++) {
            for ($j = 0; $j < sizeof($this->value[$i]); $j++) {
                if ($this->value[$i][$j] == $number) {
                    $this->value[$i][$j] = $this->value[$i][$j] + $this->MARKED;
                }
            }
        }
    }

    public function won()
    {
        $won = false;
        $boardNums = [0, 0, 0, 0, 0];

        for ($i = 0; $i < sizeof($this->value); $i++) {
            $num = array_map(function ($value) {
                if ($value >= $this->MARKED) {
                    return 1;
                } else {
                    return 0;
                }
            }, $this->value[$i]);

            // Horizontal bingo
            if (array_sum($num) == 5) {
                $won = true;
            }

            foreach ($num as $key => $number) {
                $boardNums[$key] += $number;
            }
        }

        // Vertical bingo
        if (!$won) {
            foreach ($boardNums as $markedValue) {
                if ($markedValue == 5) {
                    $won = true;
                }
            }
        }

        return $won;
    }
}
