<?php

declare(strict_types=1);

namespace App\Classes;

class FishSchool
{
    private $fishes = [];
    private $fishCount = [];

    public function add(LanternFish $fish)
    {
        $this->fishes[] = $fish;
    }

    public function days($numberOfDays)
    {
        $this->fishCount = [0, 0, 0, 0, 0, 0, 0, 0, 0];
        foreach ($this->fishes as $fish) {
            $this->fishCount[$fish->breedingTimer]++;
        }

        for ($i = 0; $i < $numberOfDays; $i++) {
            $newFish = [0, 0, 0, 0, 0, 0, 0, 0, 0];

            for ($j = 8; $j >= 0; $j--) {
                if ($j == 0) {
                    $newFish[8] = $this->fishCount[0];
                    $newFish[6] += $this->fishCount[0];
                    $this->fishCount[$j] = 0;
                } else {
                    $newFish[$j - 1] = $this->fishCount[$j];
                    $this->fishCount[$j] = 0;
                }
            }

            $this->fishCount = $newFish;
        }

        return array_sum($this->fishCount);
    }
}
