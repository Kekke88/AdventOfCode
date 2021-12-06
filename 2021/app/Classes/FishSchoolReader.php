<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\HydroVent;
use App\Classes\FishSchool;

class FishSchoolReader implements DataReader
{
    private $fishSchool;

    public function __construct()
    {
        $this->fishSchool = new FishSchool();
    }

    public function parse($data)
    {
        $fishAges = explode(',', $data);
        foreach ($fishAges as $fishAge) {
            $this->fishSchool->add(new LanternFish(intval($fishAge)));
        }
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->fishSchool;
    }
}
