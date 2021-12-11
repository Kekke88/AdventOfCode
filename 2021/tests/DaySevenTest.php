<?php

declare(strict_types=1);

use App\Classes\CrabFuelReader;
use App\Classes\CrabFuel;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DaySevenTest extends TestCase
{
    public function testFishSchoolGeneratesCorrectAmountOfFish(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/07/test.in');

        $crabFuel = $parser->read(new CrabFuelReader);

        $this->assertEquals(37, $crabFuel->calculateOptimalRoute());
        $this->assertEquals(170, $crabFuel->calculateRealOptimalRoute());
    }
}
