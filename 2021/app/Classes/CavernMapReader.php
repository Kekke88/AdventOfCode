<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\CavernMap;

class CavernMapReader implements DataReader
{
    private $map;

    public function __construct()
    {
        $this->map = new CavernMap();
    }

    public function parse($data) {
        $data = preg_replace('~[\r\n]+~', '', $data);
        [$from, $to] = explode('-', $data);
        $this->map->link($from, $to);
    }

    public function read($data)
    {
        return;
    }

    public function data() {
        return $this->map;
    }
}
