<?php

declare(strict_types=1);

namespace App\Classes;

class OceanFloor
{
    private $hydroVents = [];
    private $map;

    public function addVent(HydroVent $vent)
    {
        $this->hydroVents[] = $vent;
    }

    public function overlaps(): int
    {
        $overlaps = 0;
        foreach ($this->map as $row) {
            foreach ($row as $col) {
                if ($col > 1) $overlaps++;
            }
        }

        return $overlaps;
    }

    public function map($diagonal = false)
    {
        $this->map = [];
        
        foreach ($this->hydroVents as $hydroVent) {
            if ($hydroVent->fromX == $hydroVent->toX || $hydroVent->fromY == $hydroVent->toY) {
                // Only horizontal and vertical lines

                // Loop over X and Y and increase danger zones
                for ($x = min($hydroVent->fromX, $hydroVent->toX); $x <= max($hydroVent->fromX, $hydroVent->toX); $x++) {
                    for ($y = min($hydroVent->fromY, $hydroVent->toY); $y <= max($hydroVent->fromY, $hydroVent->toY); $y++) {
                        if (!isset($this->map[$x][$y])) {
                            $this->map[$x][$y] = 0;
                        }
                        $this->map[$x][$y] += 1;
                    }
                }
            } else if($diagonal) {
                // Diagonal line

                $steps = abs($hydroVent->fromX - $hydroVent->toX);
                for($i = 0; $i <= $steps; $i++) {
                    if (!isset($this->map[$hydroVent->fromX][$hydroVent->fromY])) {
                        $this->map[$hydroVent->fromX][$hydroVent->fromY] = 0;
                    }
                    $this->map[$hydroVent->fromX][$hydroVent->fromY]++;

                    $hydroVent->fromX > $hydroVent->toX ? $hydroVent->fromX-- : $hydroVent->fromX++;
                    $hydroVent->fromY > $hydroVent->toY ? $hydroVent->fromY-- : $hydroVent->fromY++;
                }
            }
        }

        return $this;
    }
}
