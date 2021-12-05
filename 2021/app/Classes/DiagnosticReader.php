<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class DiagnosticReader implements DataReader
{
    private $data = [];

    public function parse($data)
    {
        $this->data[] = new Diagnostic($data);
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->data;
    }
}
