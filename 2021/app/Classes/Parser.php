<?php

declare(strict_types=1);

namespace App\Classes;

use Exception;
use App\Interfaces\DataReader;

class Parser
{
    protected $file;

    public function __construct($fileName)
    {
        $this->file = fopen($fileName, 'r');

        if (!$this->file) {
            throw new Exception("File not found");
        }
    }

    public function read(DataReader $reader)
    {
        while (!feof($this->file)) {
            $reader->parse(fgets($this->file));
        }

        return $reader->data();
    }

    public function readLine(): string
    {
        return fgets($this->file);
    }

    public function eof(): bool
    {
        return feof($this->file);
    }

    public function close(): void
    {
        fclose($this->file);
    }
}
