<?php

declare(strict_types=1);

use App\Classes\BingoReader;
use App\Classes\DiagnosticComputer;
use App\Classes\DiagnosticReader;
use App\Classes\MeasurementReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\OceanFloorReader;

final class DayOneTest extends TestCase
{
    public function testFindCorrectPowerConsumptionAndLifeSupportRating(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/01/test.in');

        $measurements = $parser->read(new MeasurementReader);
        $increases = 0;

        for ($i = 1; $i < sizeof($measurements); $i++) {
            $increases = $measurements[$i] > $measurements[$i - 1] ? $increases + 1 : $increases;
        }

        $this->assertEquals(7, $increases);

        $parser->close();
        $parser = new Parser(dirname(__FILE__) . '/../tasks/01/test.in');

        $increases = 0;
        $measurements = $parser->read(new MeasurementReader);

        $previousMeasurement = $measurements[0]->value + $measurements[1]->value + $measurements[2]->value;

        for ($i = 1; $i < sizeof($measurements) - 2; $i++) {
            $measurement = $measurements[$i]->value + $measurements[$i + 1]->value + $measurements[$i + 2]->value;

            $increases = $measurement > $previousMeasurement ? $increases + 1 : $increases;

            $previousMeasurement = $measurement;
        }

        $this->assertEquals(5, $increases);

        $parser->close();
    }
}
