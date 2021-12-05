<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\HydroVent;
use App\Classes\OceanFloor;

class OceanFloorReader implements DataReader
{
    private $oceanFloor;

    public function __construct()
    {
        $this->oceanFloor = new OceanFloor();
    }

    public function parse($data) {
        [$start, $end] = explode(" -> ", $data);
        $this->oceanFloor->addVent(new HydroVent($start, $end));
    }

    public function read($data)
    {
        return;
    }

    public function data() {
        return $this->oceanFloor;
    }
}
