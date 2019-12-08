<?php
$width = 25;
$height = 6;

$input = file_get_contents("input8.txt");
$num_layers = strlen($input) / ($width * $height);
$layer_size = strlen($input) / $num_layers;
$layers = str_split($input, $layer_size);

$min = get_fewest_zero($layers);
echo "Part 1: ".substr_count($layers[$min], "1")*substr_count($layers[$min], "2")."\n";

$image = decode_image($layers, $width, $height);
display_image($image);

function display_image($image){
    foreach ($image as $lines){
        foreach ($lines as $pixel){
            if ($pixel=="1"){
                echo "#";
            } else echo " ";
        }
        echo "\n";
    }
}

function decode_image($layers, $width, $height){
    $final_image = array_fill(0, $height, array_fill(0, $width, " "));
    foreach ($layers as $layer){
        $lines = str_split($layer, $width);
        foreach ($lines as $k=>$line){
            $chars = str_split($line);
            foreach ($chars as $m=>$char){
                if ($char != "2"){
                    if ($final_image[$k][$m] == " "){
                        $final_image[$k][$m] = $char;
                    }
                }
            }
        }
    }
    return $final_image;
}

function get_fewest_zero($layers){
$zeros_per_layer = array();
    foreach ($layers as $num=>$layer){
        $zeros_per_layer[$num] = substr_count($layer, "0");
    }
    return min(array_keys($zeros_per_layer, min($zeros_per_layer)));
}