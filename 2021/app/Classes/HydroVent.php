<?php

declare(strict_types=1);

namespace App\Classes;

class HydroVent
{
    public int $fromX;
    public int $fromY;
    public int $toX;
    public int $toY;

    public function __construct($x, $y)
    {
        $from = explode(',', $x);
        $to = explode(',', $y);

        $this->fromX = intval($from[0]);
        $this->fromY = intval($from[1]);
        $this->toX = intval($to[0]);
        $this->toY = intval($to[1]);
    }
}
