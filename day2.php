<?php

function run_intcode($noun, $verb){
    $input = file_get_contents ("input2.txt");
    $array = explode(',', $input);

    $array[1] = $noun;
    $array[2] = $verb;

    $current_position =0;
    $opcode = $array[0];

    while($opcode != 99){
        if ($opcode == 1){
            $array[$array[$current_position+3]] = $array[$array[$current_position+1]] + $array[$array[$current_position+2]];
        } elseif ($opcode ==2){
            $array[$array[$current_position+3]] = $array[$array[$current_position+1]] * $array[$array[$current_position+2]];
        } else {
            echo "you fucked up";
        }
        $current_position += 4;
        $opcode = $array[$current_position];
    }
return $array[0];
}

for($i=0;$i<100;$i++){
    for($j=$i; $j<100; $j++){

        $output = run_intcode($i, $j);

        if($output==19690720){
            echo (100*$i+$j);
        }
    }
}





