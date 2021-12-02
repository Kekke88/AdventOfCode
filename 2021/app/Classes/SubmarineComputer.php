<?php

declare(strict_types=1);

namespace App\Classes;

class SubmarineComputer
{
    public $commands;
    private $depth;
    private $position;
    private $aim;

    public function __construct($commands)
    {
        $this->commands = $commands;
    }

    public function getDepth()
    {
        return $this->depth;
    }

    public function getPosition()
    {
        return $this->position;
    }

    public function execute()
    {
        foreach($this->commands as $command) {
            switch($command->direction) {
                case 'forward':
                    $this->position += $command->amount;
                    break;
                case 'down':
                    $this->depth += $command->amount;
                    break;
                case 'up':
                    $this->depth -= $command->amount;
                    break;
            }
        }
    }

    public function executeAdvanced()
    {
        foreach($this->commands as $command) {
            switch($command->direction) {
                case 'forward':
                    $this->position += $command->amount;
                    $this->depth += $this->aim * $command->amount;
                    break;
                case 'down':
                    $this->aim += $command->amount;
                    break;
                case 'up':
                    $this->aim -= $command->amount;
                    break;
            }
        }
    }
}
