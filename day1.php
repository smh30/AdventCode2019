<?php

$modules = file("input1.txt");
$part1 = calculate_fuel($modules);
echo "Solution part 1: $part1\n";

$recursive_fuel = 0;
foreach ($modules as $module){
    $recursive_fuel += calculate_fuel_recursive($module);
}
echo "Solution part 2: $recursive_fuel";



function calculate_fuel($modules){
    $total_fuel =0;
    foreach ($modules as $module){
        $total_fuel += intdiv($module, 3)-2;
    }
    return $total_fuel;
}

function calculate_fuel_recursive($mass){
    $fuel = intdiv($mass, 3)-2;

    if ($fuel <= 0){
        return 0;
    }

    return $fuel + calculate_fuel_recursive($fuel);

}