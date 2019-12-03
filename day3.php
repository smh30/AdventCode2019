<?php

$input = file("input3.txt");

$wire1 = explode(",", substr($input[0], 0, strlen($input[0]) - 1));
$wire2 = explode(",", $input[1]);

$wire1_posn = trace_wire($wire1);
echo "done wire 1\n";
$wire2_posn = trace_wire($wire2);
echo "done wire 2\n";

[$distance, $time] = find_intersections($wire1_posn, $wire2_posn);
echo "\n min distance = $distance, min time = $time";


function find_intersections($wire1, $wire2)
{
    $distances = array();
    $times = array();
    foreach ($wire1 as $posn) {
        if (in_array($posn, $wire2)) {
            [$x, $y] = explode(",", $posn);
            $distances[] = abs($x) + abs($y);

            $time1 = array_search($posn, $wire1);
            $time2 = array_search($posn, $wire2);

            $times[] = $time1 + $time2 +2;
        }
        echo ".\n";
    }
    return array(min($distances), min($times));
}

function trace_wire($wire)
{
    $x = 0;
    $y = 0;

    foreach ($wire as $path) {
        $direction = $path[0];
        $distance = substr($path, 1);
        if ($direction == "U") {
            for ($i = 0; $i < $distance; $i++) {
                $y--;
                $wire_posn[] = "$x, $y";
            }
        }
        if ($direction == "D") {
            for ($i = 0; $i < $distance; $i++) {
                $y++;
                $wire_posn[] = "$x, $y";
            }
        }
        if ($direction == "L") {
            for ($i = 0; $i < $distance; $i++) {
                $x--;
                $wire_posn[] = "$x, $y";
            }
        }
        if ($direction == "R") {
            for ($i = 0; $i < $distance; $i++) {
                $x++;
                $wire_posn[] = "$x, $y";
            }
        }

    }
    return $wire_posn;
}