<?php

declare(strict_types=1);

namespace App\Classes;

class Diagnostic
{
    public $value;

    public function __construct($value)
    {
        $this->value = $value;
    }
}
