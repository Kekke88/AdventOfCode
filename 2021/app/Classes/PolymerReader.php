<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\Polymer;

class PolymerReader implements DataReader
{
    private $manual;

    public function parse($data)
    {
        return;
    }

    public function read($file)
    {
        $this->manual = new Polymer(preg_replace('~[\r\n]+~', '', fgets($file)));

        // Read first newline
        fgets($file);

        while (!feof($file)) {
            [$from, $to] = explode(' -> ', fgets($file));
            $to = preg_replace('~[\r\n]+~', '', $to);
            $this->manual->addInstruction($from, $to);
        }
    }

    public function data()
    {
        return $this->manual;
    }
}
