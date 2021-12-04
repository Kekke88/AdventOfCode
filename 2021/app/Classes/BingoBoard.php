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
        $boardNums = [0, 0, 0, 0, 0];

        for ($i = 0; $i < sizeof($this->value); $i++) {
            // Save all marked numbers as 1s and unmarked as 0
            // Then count the sum of the array, if it is 5 that means we have a horizontal bingo
            // If we don't get 5 we save the array and add it together inside another array
            // Which means if we have 5 on the same index, we will have a 5 inside boardNums
            $num = array_map(function ($value) {
                return $value >= $this->MARKED ? 1 : 0;
            }, $this->value[$i]);

            // Horizontal bingo
            if (array_sum($num) == 5) {
                return true;
            }

            // Vertical bingo
            foreach ($num as $key => $number) {
                $boardNums[$key] += $number;

                if($boardNums[$key] == 5) return true;
            }
        }

        return false;
    }
}
