<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class HeightMapReader implements DataReader
{
    private $heightMap;

    public function __construct()
    {
        $this->heightMap = new HeightMap();
    }

    public function parse($data)
    {
        $data = preg_replace('~[\r\n]+~', '', $data);
        
        $this->heightMap->addRow();
        $heights = str_split($data);
        foreach($heights as $height) {
            $this->heightMap->addCol($height);
        }
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->heightMap;
    }
}
