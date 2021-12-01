<?php

declare(strict_types=1);

namespace App\Classes;

class Measurement
{
    public int $value;

    public function __construct($value)
    {
        $this->value = intval($value);
    }
}
