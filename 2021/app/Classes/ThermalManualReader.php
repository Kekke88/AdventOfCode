<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\ThermalManual;

class ThermalManualReader implements DataReader
{
    private $manual;

    public function __construct()
    {
        $this->manual = new ThermalManual();
    }

    public function parse($data)
    {
        $data = preg_replace('~[\r\n]+~', '', $data);
        if (str_contains($data, "fold")) {
            $data = preg_replace('/\w{4}\s\w{5}\s/', '', $data);
            [$coordinate, $position] = explode('=', $data);
            $this->manual->addFold($coordinate, $position);
        } else if($data != '') {
            [$x, $y] = explode(',', $data);
            $this->manual->addDot($y, $x);
        }
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->manual;
    }
}
