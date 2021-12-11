<?php

declare(strict_types=1);

use App\Classes\CavernReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;

final class DayElevenTest extends TestCase
{
    public function testOctopusesFlashesCorrectly(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/11/test.in');

        $cavern = $parser->read(new CavernReader);
        $flashes = $cavern->step(100);

        $this->assertEquals(1656, $flashes);
        $this->assertEquals(195, $cavern->findSimultaneouslyFlashing() + 101);
    }
}
