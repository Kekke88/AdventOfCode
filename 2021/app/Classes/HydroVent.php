<?php

declare(strict_types=1);

namespace App\Classes;

class HydroVent
{


    public function __construct(
        public $fromX,
        public $fromY,
        public $toX,
        public $toY
    ) {
    }
}
