<?php

declare(strict_types=1);

use App\Classes\NavigationSystemReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DayTenTest extends TestCase
{
    public function testGetCorrectNavigationPoints(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/10/test.in');

        $navigation = $parser->read(new NavigationSystemReader);
        $navigation->getCorruptedPoints();

        $this->assertEquals(26397, $navigation->getInvalidPoints());
        $this->assertEquals(288957, $navigation->getCorruptedPoints());
    }
}
