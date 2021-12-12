<?php

declare(strict_types=1);

use App\Classes\CavernMapReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DayTwelveTest extends TestCase
{
    public function testFindCorrectAmountOfPaths(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/12/test.in');

        $cavern = $parser->read(new CavernMapReader);
        $paths = $cavern->paths();
        $advancedPaths = $cavern->paths(2);

        $this->assertEquals(10, $paths);
        $this->assertEquals(36, $advancedPaths);
    }
}
