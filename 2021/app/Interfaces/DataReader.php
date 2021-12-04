<?php

declare(strict_types=1);

namespace App\Interfaces;

interface DataReader {
    public function parse($data);
    public function read($file);
    public function data();
}