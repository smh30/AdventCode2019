<?php

$starttime = microtime(true);
$input = file("input3.txt");

$wire1 = explode(",", substr($input[0], 0, strlen($input[0]) - 1));
$wire2 = explode(",", $input[1]);

$wire1_posn = trace_wire($wire1);
$wire2_posn = trace_wire($wire2);

[$distance, $time] = find_intersections($wire1_posn, $wire2_posn);
echo "\n min distance = $distance, min time = $time\n";

$endtime = microtime(true);
$elapsed = ($endtime-$starttime);
echo $elapsed. ' elapsed,';

function find_intersections($wire1, $wire2)
{
    $distances = array();
    $times = array();
    foreach ($wire1 as $posn => $steps){
        if (key_exists($posn, $wire2)){
            [$x, $y] = explode(",", $posn);
            $distances[] = abs($x) + abs($y);

            $times[] = $wire1[$posn] + $wire2[$posn];
        }
    }
    return array(min($distances), min($times));
}

function trace_wire($wire)
{
    $x = 0;
    $y = 0;
    $steps = 0;

    foreach ($wire as $path) {
        $direction = $path[0];
        $distance = substr($path, 1);
        if ($direction == "U") {
            for ($i = 0; $i < $distance; $i++) {
                $steps++;
                $y--;
                $wire_posn["$x, $y"] = $steps;
            }
        }
        if ($direction == "D") {
            for ($i = 0; $i < $distance; $i++) {
                $steps++;
                $y++;
                $wire_posn["$x, $y"] = $steps;
            }
        }
        if ($direction == "L") {
            for ($i = 0; $i < $distance; $i++) {
                $steps++;
                $x--;
                $wire_posn["$x, $y"] = $steps;
            }
        }
        if ($direction == "R") {
            for ($i = 0; $i < $distance; $i++) {
                $steps++;
                $x++;
                $wire_posn["$x, $y"] = $steps;
            }
        }
    }
    return $wire_posn;
}