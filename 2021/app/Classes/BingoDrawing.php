<?php

declare(strict_types=1);

namespace App\Classes;

class BingoDrawing
{
    public $drawings;
    private $iterator = 0;

    public function __construct($drawings)
    {
        $this->drawings = explode(',', $drawings);
    }

    public function getNext()
    {
        if (sizeof($this->drawings) > $this->iterator - 1) {
            $drawing = $this->drawings[$this->iterator];
            $this->iterator++;

            return $drawing;
        }

        return false;
    }

    public function last()
    {
        return sizeof($this->drawings) - $this->iterator-1 == 0 ? true : false;
    }
}
