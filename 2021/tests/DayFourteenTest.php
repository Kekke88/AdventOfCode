<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\PolymerReader;

final class DayFourteenTest extends TestCase
{
    public function testCodeCharacterQuantity(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/14/test.in');

        $manual = $parser->readStruct(new PolymerReader);
        $manual->step(10);
        $quantity = $manual->getQuantity();
        $manual->step(30);
        $quantity2 = $manual->getQuantity();

        $this->assertEquals(1588, $quantity);
        $this->assertEquals(2188189693529, $quantity2);
    }
}
