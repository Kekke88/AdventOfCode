<?php

declare(strict_types=1);

use App\Classes\FishSchoolReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DaySixTest extends TestCase
{
    public function testFishSchoolGeneratesCorrectAmountOfFish(): void
    {
        ini_set('memory_limit', '10G');

        $parser = new Parser(dirname(__FILE__) . '/../tasks/06/test.in');

        $fishSchool = $parser->read(new FishSchoolReader);

        $this->assertEquals(5934, $fishSchool->days(80));
        $this->assertEquals(26984457539, $fishSchool->days(176));
    }
}
