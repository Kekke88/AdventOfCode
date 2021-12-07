<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class CrabFuelReader implements DataReader
{
    private $crabFuel;

    public function __construct()
    {
        $this->crabFuel = new CrabFuel();
    }

    public function parse($data)
    {
        foreach(explode(',', $data) as $crabFuel) {
            $this->crabFuel->add($crabFuel);
        }
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->crabFuel;
    }
}
