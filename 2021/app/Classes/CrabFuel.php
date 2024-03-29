<?php

declare(strict_types=1);

namespace App\Classes;

class CrabFuel
{
    private $crabs = [];

    public function add($fuel)
    {
        $this->crabs[] = $fuel;
    }

    public function calculateOptimalRoute()
    {
        sort($this->crabs);
        $median = $this->crabs[sizeof($this->crabs)/2];
        $cheapestRoute = 0;

        foreach($this->crabs as $crab) {
            $cheapestRoute += abs($crab - $median);
        }

        return $cheapestRoute;
    }

    public function calculateRealOptimalRoute()
    {
        $mean = array_sum($this->crabs) / sizeof($this->crabs);
        $mean = $mean - intval($mean) >= 0.6 ? round($mean) : floor($mean);

        $cheapestRoute = 0;

        foreach($this->crabs as $crab) {
            $cost = abs($crab - $mean);
            $cheapestRoute += (($cost * $cost) + $cost) / 2;
        }

        return $cheapestRoute;
    }
}
