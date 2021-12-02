<?php

declare(strict_types=1);

namespace App\Classes;

class SubmarineCommand
{
    public int $amount;
    public string $direction;

    public function __construct($direction, $amount)
    {
        $this->direction = $direction;
        $this->amount = intval($amount);
    }
}
