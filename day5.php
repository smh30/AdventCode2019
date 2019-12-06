<?php

$input = file_get_contents("input5.txt");
$memory = explode(',', $input);
run_intcode();

function run_intcode()
{
    global $memory;

    $pointer = 0;
    $opcode_full =  "0000". $memory[$pointer];
    $opcode = substr($opcode_full, strlen($opcode_full) - 2);

    while ($opcode != 99) {

        $param1_mode = $opcode_full[-3];
        $param2_mode = $opcode_full[-4];

        $p1 = get_value($pointer+1, $param1_mode);
        $p2 = get_value($pointer+2, $param2_mode);

        switch ($opcode) {
            case 01:
                write_value($pointer+3,  $p1 + $p2);
                $pointer += 4;
                break;
            case 02:
                write_value($pointer+3,  $p1 * $p2);
                $pointer += 4;
                break;
            case 03:
                echo "enter the system ID number: ";
                $input_param = readline("enter the system to test: ");
                echo "\n";
                write_value($pointer+1, $input_param);
                $pointer += 2;
                break;
            case 04:
                echo 'output= ' . $p1 . "\n";
                $pointer += 2;
                break;
            case 05:
                if ($p1!=0){
                    $pointer = $p2;
                } else $pointer +=3;
                break;
            case 06:
                if($p1 ==0){
                    $pointer = $p2;
                } else $pointer += 3;
                break;
            case 07:
                write_value($pointer+3, $p1<$p2?1:0);
                $pointer +=4;
                break;
            case '08':
                write_value($pointer+3, $p1==$p2?1:0);
                $pointer += 4;
                break;
            default:
                echo "nope\n";
                break;
        }
        $opcode_full = "0000" . $memory[$pointer];
        $opcode = substr($opcode_full, strlen($opcode_full) - 2);
    }
}

function get_value($position, $mode){
    global $memory;
    $value = $mode ? $memory[$position] : $memory[$memory[$position]];
    return $value;
}

function write_value($position, $value){
    global $memory;
    $memory[$memory[$position]] = $value;
}





