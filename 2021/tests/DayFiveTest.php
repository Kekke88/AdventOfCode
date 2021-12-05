<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\OceanFloorReader;

final class DayFiveTest extends TestCase
{
    public function testMapGeneratesCorrectOverlaps(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/05/test.in');

        $oceanFloor = $parser->read(new OceanFloorReader);

        $this->assertEquals(5, $oceanFloor->map()->overlaps());
        $this->assertEquals(12, $oceanFloor->map(true)->overlaps());
    }
}
