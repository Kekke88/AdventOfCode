<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\SignalPatternReader;

final class DayEightTest extends TestCase
{
    public function testGenerateCorrectOutputSignals(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/08/test.in');

        $signalPattern = $parser->read(new SignalPatternReader);

        $this->assertEquals(26, $signalPattern->countOutput());
        $this->assertEquals(61229, $signalPattern->getOutput());
    }
}
