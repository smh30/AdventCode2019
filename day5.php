<?php

run_intcode();

function run_intcode()
{
    $input = file_get_contents("input5.txt");
    $array = explode(',', $input);

    $current_position = 0;
    $opcode_full =  $array[$current_position];
    $opcode = substr($opcode_full, strlen($opcode_full) - 2);


    while ($opcode != 99) {
        $param1_mode = substr($opcode_full, strlen($opcode_full) - 3, 1) ?? 0;
        $param2_mode = substr($opcode_full, strlen($opcode_full) - 4, 1) ?? 0;
        $param3_mode = substr($opcode_full, strlen($opcode_full) - 5, 1) ?? 0;
       // echo "full = $opcode_full, opcode = $opcode, mode1 = $param1_mode, mode2 = $param2_mode, mode3 = $param3_mode\n";

        $loc = $array[$current_position + 3];
        $p1 = $param1_mode ? $array[$current_position + 1] : $array[$array[$current_position + 1]];
        $p2 = $param2_mode ? $array[$current_position + 2] : $array[$array[$current_position + 2]];

        switch ($opcode) {
            case 01:
                $array[$loc] = $p1 + $p2;
                $current_position += 4;
                break;
            case 02:
                $array[$loc] = $p1 * $p2;
                $current_position += 4;
                break;
            case 03:
               // echo "currposs: ".$current_position;
                echo "enter the system number: ";
                $input_param = readline("enter the system to test: ");
                echo "\n";
               // echo "writing to posn". $array[$current_position +1];
                $array[$array[$current_position +1]] = $input_param;
               // print_r($array);
                $current_position += 2;
                break;
            case 04:

                $output = $p1;
               // print_r($array);
                echo 'output= ' . $output . "\n";
                $current_position += 2;
                break;
            case 05:
                if ($p1!=0){
                    $current_position = $p2;
                   // echo "jumping t0 $p2";
                } else $current_position +=3;
                break;
            case 06:
                if($p1 ==0){
                    $current_position = $p2;
                   // echo "jumping t0 $p2";
                } else $current_position += 3;
                break;
            case 07:
                $array[$loc]=$p1<$p2?1:0;
                $current_position +=4;
                break;
            case '08':
                //echo "at 8";
                $array[$loc]=$p1==$p2?1:0;
                $current_position += 4;
               // print_r($array);
                break;
            default:
                echo "nope\n";
                //print_r($array);
                break;


        }
        $opcode_full = $array[$current_position];
        $opcode_full = "0000" . $opcode_full;
        $opcode = substr($opcode_full, strlen($opcode_full) - 2);
    }
    return $array[0];
}





