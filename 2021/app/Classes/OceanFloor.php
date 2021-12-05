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

                $fromX = $hydroVent->fromX < $hydroVent->toX ? $hydroVent->fromX : $hydroVent->toX;
                $toX = $hydroVent->fromX < $hydroVent->toX ? $hydroVent->toX : $hydroVent->fromX;
                $fromY = $hydroVent->fromY < $hydroVent->toY ? $hydroVent->fromY : $hydroVent->toY;
                $toY = $hydroVent->fromY < $hydroVent->toY ? $hydroVent->toY : $hydroVent->fromY;

                for ($x = $fromX; $x <= $toX; $x++) {
                    for ($y = $fromY; $y <= $toY; $y++) {
                        if (!isset($this->map[$x][$y])) {
                            $this->map[$x][$y] = 0;
                        }
                        $this->map[$x][$y] += 1;
                    }
                }
            } else if($diagonal) {
                // Diagonal line

                $spaces = abs($hydroVent->fromX - $hydroVent->toX);
                for($i = 0; $i <= $spaces; $i++) {
                    if (!isset($this->map[$hydroVent->fromX][$hydroVent->fromY])) {
                        $this->map[$hydroVent->fromX][$hydroVent->fromY] = 0;
                    }
                    $this->map[$hydroVent->fromX][$hydroVent->fromY]++;
                    
                    if($hydroVent->fromX > $hydroVent->toX) {
                        $hydroVent->fromX--;
                    } else {
                        $hydroVent->fromX++;
                    }

                    if($hydroVent->fromY > $hydroVent->toY) {
                        $hydroVent->fromY--;
                    } else {
                        $hydroVent->fromY++;
                    }
                }
            }
        }

        return $this;
    }
}
