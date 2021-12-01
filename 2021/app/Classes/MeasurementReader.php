<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class MeasurementReader implements DataReader
{
    private $data = [];

    public function parse($data) {
        $this->data[] = new Measurement($data);
    }

    public function data() {
        return $this->data;
    }
}
