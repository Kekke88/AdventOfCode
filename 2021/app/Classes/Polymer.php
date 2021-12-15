<?php

declare(strict_types=1);

namespace App\Classes;

class Polymer
{
    private $pairsMap = [];
    private $instructions = [];
    private $lastCharacter;

    public function __construct($code)
    {
        for ($i = 0; $i < strlen($code) - 1; $i++) {
            $this->pairsMap[$code[$i] . $code[$i + 1]] = 1;
        }

        $this->lastCharacter = $code[strlen($code) - 1];
    }

    public function addInstruction($from, $to): void
    {
        $this->instructions[] = ['from' => $from, 'to' => $to];
    }

    public function getQuantity(): int
    {
        $characterCount = [$this->lastCharacter => 1];

        foreach ($this->pairsMap as $key => $count) {
            if ($count == 0) continue;

            if (!isset($characterCount[$key[0]])) {
                $characterCount[$key[0]] = 0;
            }

            $characterCount[$key[0]] += $count;
        }

        sort($characterCount);

        return $characterCount[sizeof($characterCount) - 1] - $characterCount[0];
    }

    public function step($steps = 1): void
    {
        for ($i = 0; $i < $steps; $i++) {
            $newPairs = [];

            foreach ($this->instructions as $instruction) {
                foreach ($this->pairsMap as $key => $count) {
                    if ($count > 0 && $key == $instruction['from']) {
                        if(!isset($newPairs[$key[0] . $instruction['to']])) $newPairs[$key[0] . $instruction['to']] = 0;
                        if(!isset($newPairs[$instruction['to'] . $key[1]])) $newPairs[$instruction['to'] . $key[1]] = 0;

                        $newPairs[$key[0] . $instruction['to']] += $count;
                        $newPairs[$instruction['to'] . $key[1]] += $count;
                        $this->pairsMap[$key] = 0;
                    }
                }
            }

            foreach ($newPairs as $key => $count) {
                if(!isset($this->pairsMap[$key])) $this->pairsMap[$key] = 0;
                $this->pairsMap[$key] += $count;
            }
        }
    }

    public function debug()
    {
        echo "--- DEBUG ---\n";
        foreach ($this->pairsMap as $pair => $count) {
            echo "Pair: $pair Count: $count\n";
        }
    }
}
