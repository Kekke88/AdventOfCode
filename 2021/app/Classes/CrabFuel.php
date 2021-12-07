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
        $min = min($this->crabs);
        $max = max($this->crabs);

        $cheapestRoute = PHP_INT_MAX;

        for($i = $min; $i <= $max; $i++) {
            $cost = 0;
            foreach($this->crabs as $crab) {
                $cost += abs($crab - $i);
            }

            if($cheapestRoute > $cost) {
                $cheapestRoute = $cost;
            }
        }

        return $cheapestRoute;
    }

    public function calculateRealOptimalRoute()
    {
        $min = min($this->crabs);
        $max = max($this->crabs);

        $cheapestRoute = PHP_INT_MAX;

        for($i = $min; $i <= $max; $i++) {
            $cost = 0;
            foreach($this->crabs as $crab) {
                $cost += (abs($crab - $i) / 2)*(1 + abs($crab - $i));
            }

            if($cheapestRoute > $cost) {
                $cheapestRoute = $cost;
            }
        }

        return $cheapestRoute;
    }
}
