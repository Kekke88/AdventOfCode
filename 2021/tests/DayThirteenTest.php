<?php

declare(strict_types=1);

use App\Classes\CavernMapReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\ThermalManualReader;

final class DayThirteenTest extends TestCase
{
    public function testDisplayCorrectAmountOfDots(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/13/test.in');

        $manual = $parser->read(new ThermalManualReader);
        $manual->fold(1);
        $dots = $manual->countDots();

        $manual->fold();
        $part2Dots = $manual->countDots();

        $this->assertEquals(17, $dots);
        $this->assertEquals(16, $part2Dots);
    }
}
