<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\Cavern;

class CavernReader implements DataReader
{
    private $cavern;

    public function __construct()
    {
        $this->cavern = new Cavern();
    }

    public function parse($data) {
        $data = preg_replace('~[\r\n]+~', '', $data);

        $this->cavern->addRow();
        $octopuses = str_split($data);
        foreach($octopuses as $octopus) {
            $this->cavern->addCol($octopus);
        }
    }

    public function read($data)
    {
        return;
    }

    public function data() {
        return $this->cavern;
    }
}
