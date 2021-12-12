<?php

declare(strict_types=1);

namespace App\Classes;

class CavernMap
{
    private $links = [];

    private function in_array_count($needle, $array): int
    {
        $count = 0;

        foreach ($array as $value) {
            if ($value == $needle) {
                $count++;
            }
        }

        return $count;
    }

    private function maxSmallCaveVisitCount($visited)
    {
        $visits = [];

        foreach ($visited as $cave) {
            if (!ctype_upper($cave) && !in_array($cave, ['start', 'end']))
                isset($visits[$cave]) ? $visits[$cave]++ : $visits[$cave] = 1;
        }

        sort($visits);

        return array_pop($visits) ?? 0;
    }

    public function paths($maxSmallCaveVisits = 1)
    {
        $visited = [];
        $paths = [];
        $this->find('start', $visited, $paths, $maxSmallCaveVisits);

        return sizeof($paths);
    }

    public function find($from, $visited, &$paths, $maxSmallCaveVisits)
    {
        if ($from == 'end') {
            $visited[] = $from;
            return $visited;
        }

        if (
            isset($visited)
            && !ctype_upper($from)
            && (($this->maxSmallCaveVisitCount($visited) >= $maxSmallCaveVisits && in_array($from, $visited))
            || $this->in_array_count($from, $visited) >= ($from == 'start' ? 1 : $maxSmallCaveVisits))
        ) {
            return false;
        }

        $visited[] = $from;

        foreach ($this->links[$from] as $to) {
            $path = $this->find($to, $visited, $paths, $maxSmallCaveVisits);

            if ($path && $path[sizeof($path) - 1] == 'end') {
                $paths[] = $path;
            }
        }
    }

    public function link($from, $to)
    {
        $this->links[$from][] = $to;
        $this->links[$to][] = $from;
    }

    public function debug()
    {
        foreach ($this->links as $from => $links) {
            foreach ($links as $to) {
                echo "$from -> $to\n";
            }
        }
    }
}
