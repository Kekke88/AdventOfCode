<?php

declare(strict_types=1);

namespace App\Classes;

class Bingo
{
    public $drawing;
    public $boards;

    private $currentDrawing;
    private $MARKED = 100;
    private $lastWinner;
    private $firstScore;
    private $lastScore;

    public function __construct($drawings)
    {
        $this->drawing = new BingoDrawing($drawings);
    }

    public function addBoard($board)
    {
        $this->boards[] = $board;
    }

    public function play()
    {
        while ($this->draw()) {
            $this->removeWinningBoards();

            // Once we have a winner, set the first score
            if ($this->lastWinner && !$this->firstScore) {
                $this->firstScore = $this->lastWinner->score($this->currentDrawing);
            }

            // When we have no more boards, set the last score to the last winners score
            if (sizeof($this->boards) == 0) {
                $this->lastScore = $this->lastWinner->score($this->currentDrawing);
                return;
            }
        }
    }

    public function getFirstWinnerFinalScore()
    {
        return $this->firstScore;
    }

    public function getLastWinnerFinalScore()
    {
        return $this->lastScore;
    }

    public function draw()
    {
        $this->currentDrawing = $this->drawing->getNext();

        if ($this->currentDrawing === false) {
            return $this->currentDrawing;
        }

        foreach ($this->boards as $board) {
            // Mark all boards
            $board->mark($this->currentDrawing);
        }

        return true;
    }

    public function removeWinningBoards()
    {
        $newBoards = [];

        foreach ($this->boards as $board) {
            if($board->won()) {
                $this->lastWinner = $board;
            } else {
                $newBoards[] = $board;
            }
        }

        $this->boards = $newBoards;
    }
}
