<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class SubmarineCommandsReader implements DataReader
{
    private $data = [];

    public function parse($data) {
        $data = explode(" ", $data);
        $this->data[] = new SubmarineCommand($data[0], $data[1]);
    }

    public function data() {
        return $this->data;
    }
}
