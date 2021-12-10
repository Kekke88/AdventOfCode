<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\NavigationSystem;

class NavigationSystemReader implements DataReader
{
    private $navigation;

    public function __construct()
    {
        $this->navigation = new NavigationSystem();
    }

    public function parse($data) {
        $data = preg_replace('~[\r\n]+~', '', $data);
        $this->navigation->addInstruction($data);
    }

    public function read($data)
    {
        return;
    }

    public function data() {
        return $this->navigation;
    }
}
