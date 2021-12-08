<?php

declare(strict_types=1);

namespace App\Classes;

use App\Interfaces\DataReader;

class SignalPatternReader implements DataReader
{
    private $signalPattern;

    public function __construct()
    {
        $this->signalPattern = new SignalPattern();
    }

    public function parse($data)
    {
        $data = preg_replace('~[\r\n]+~', '', $data);
        [$signalPatterns, $outputValues] = explode(' | ', $data);
        $signalPattern = explode(' ', $signalPatterns);
        $outputValue = explode(' ', $outputValues);
        $this->signalPattern->add($signalPattern, $outputValue);
    }

    public function read($data)
    {
        return;
    }

    public function data()
    {
        return $this->signalPattern;
    }
}
