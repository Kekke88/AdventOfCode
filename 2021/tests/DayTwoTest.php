<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\SubmarineCommandsReader;
use App\Classes\SubmarineComputer;

final class DayTwoTest extends TestCase
{
    public function testCalculateSubmarinePosition(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/02/test.in');

        $commands = $parser->read(new SubmarineCommandsReader);
        $computer = new SubmarineComputer($commands);

        $this->assertEquals(150, $computer->calculate());
        $this->assertEquals(900, $computer->calculateAdvanced());
    }
}
