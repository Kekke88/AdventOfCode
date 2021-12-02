<?php

declare(strict_types=1);

namespace App\Classes;

class SubmarineComputer
{
    public $commands;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function calculate()
    {
        $depth = 0;
        $position = 0;

        foreach($this->commands as $command) {
            switch($command->direction) {
                case 'forward':
                    $position += $command->amount;
                    break;
                case 'down':
                    $depth += $command->amount;
                    break;
                case 'up':
                    $depth -= $command->amount;
                    break;
            }
        }

        return $position * $depth;
    }

    public function calculateAdvanced(): int
    {
        $depth = 0;
        $position = 0;
        $aim = 0;

        foreach($this->commands as $command) {
            switch($command->direction) {
                case 'forward':
                    $position += $command->amount;
                    $depth += $aim * $command->amount;
                    break;
                case 'down':
                    $aim += $command->amount;
                    break;
                case 'up':
                    $aim -= $command->amount;
                    break;
            }
        }

        return $position * $depth;
    }
}
