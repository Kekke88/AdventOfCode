<?php

declare(strict_types=1);

namespace App\Classes;

class LanternFish
{
    public function __construct(
        public int $breedingTimer
    ) {
    }

    public function breed()
    {
        if($this->breedingTimer == 0) {
            $this->breedingTimer = 6;

            return new LanternFish(8);
        }

        $this->breedingTimer--;

        return false;
    }
}
