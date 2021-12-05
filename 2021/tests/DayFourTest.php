<?php

declare(strict_types=1);

use App\Classes\BingoReader;
use PHPUnit\Framework\TestCase;
use App\Classes\Parser;
use App\Classes\OceanFloorReader;

final class DayFourTest extends TestCase
{
    public function testFindCorrectBingoBoards(): void
    {
        $parser = new Parser(dirname(__FILE__) . '/../tasks/04/test.in');

        $bingo = $parser->readStruct(new BingoReader);
        $bingo->play();

        $parser->close();
        
        $this->assertEquals(4512, $bingo->getFirstWinnerFinalScore());
        $this->assertEquals(1924, $bingo->getLastWinnerFinalScore());
    }
}
