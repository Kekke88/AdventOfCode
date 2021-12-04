<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;
use App\Classes\Bingo;

class BingoReader implements DataReader
{
    private $bingo;

    public function parse($data)
    {
        return $this->bingo;
    }

    public function read($file)
    {
        $this->bingo = new Bingo(fgets($file));

        // Read first newline
        fgets($file);
        $tempBoard = [];
        $i = 0;

        while(!feof($file)) {
            $line = fgets($file);

            if($line == PHP_EOL) {
                $i = 0;
                $this->bingo->addBoard(new BingoBoard($tempBoard));
            } else {
                $numbers = array_values(array_filter(explode(' ', $line), function($value) {
                    return $value != '';
                }));
                
                $tempBoard[$i] = $numbers;
                $i++;
            }
        }

        $this->bingo->addBoard(new BingoBoard($tempBoard));
    }

    public function data()
    {
        return $this->bingo;
    }
}
