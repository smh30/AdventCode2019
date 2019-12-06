<?php

$input = file("input6.txt");
global $directly_orbits_map;

foreach($input as $line){
    $line = explode(")", $line);
    $directly_orbits_map[substr($line[1], 0, strlen($line[1])-1)] = $line[0];
}

$total = 0;
foreach ($directly_orbits_map as $orbiter => $planet){
    $total += get_orbit_steps($orbiter, "COM");
}

echo "Part 1: total steps: $total \n";

$join = get_divergence_point();
$path = get_orbit_steps($directly_orbits_map["YOU"], $join) + get_orbit_steps($directly_orbits_map["SAN"], $join);
echo "Part 2: path length: ".$path;


function get_orbit_steps($orbiter, $destination){
    global $directly_orbits_map;
    if ($directly_orbits_map[$orbiter]==$destination){
        return 1;
    }
    return 1 + get_orbit_steps($directly_orbits_map[$orbiter], $destination);
}

function get_divergence_point(){
    $your_path = path_to_origin("YOU");
    $santa_path = path_to_origin("SAN");

    foreach ($your_path as $planet){
        if (in_array($planet, $santa_path)){
            return $planet;
        }
    }
}

function path_to_origin($from){
    global $directly_orbits_map;

    while ($directly_orbits_map[$from] != "COM"){
        $from = $directly_orbits_map[$from];
        $planets[] = $from;
    }
    return $planets;
}