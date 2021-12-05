<?php

declare(strict_types=1);

use App\Classes\BingoReader;
use App\Classes\DiagnosticComputer;
use App\Classes\DiagnosticReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\OceanFloorReader;

final class DayThreeTest extends TestCase
{
    public function testFindCorrectPowerConsumptionAndLifeSupportRating(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/03/test.in');

        $commands = $parser->read(new DiagnosticReader);
        $computer = new DiagnosticComputer($commands);

        $parser->close();

        $this->assertEquals(198, $computer->calculatePowerConsumption());
        $this->assertEquals(230, $computer->calculateLifeSupportRating());
    }
}
