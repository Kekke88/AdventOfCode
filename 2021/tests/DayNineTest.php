<?php

declare(strict_types=1);

use App\Classes\HeightMapReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DayNineTest extends TestCase
{
    public function testHeightMapCalculatesCorrectRiskAndBasins(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/09/test.in');

        $heightMap = $parser->read(new HeightMapReader);

        $this->assertEquals(15, $heightMap->risk());
        $this->assertEquals(1134, $heightMap->basinSizes());
    }
}
