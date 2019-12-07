<?php

$file_input = file_get_contents("input7.txt");
$memory = explode(',', $file_input);
$outputs = array();

global $list;
$blah = permute('01234', 0, 4);

foreach ($list as $item){
    $outputs[] = get_signal($item);
}
echo "part 1: ". max($outputs);

function get_signal($str)
{
    $output = 0;
    for($i =0; $i < 5; $i++){
        $output = run_intcode(substr($str, $i, 1), $output);
    }
    return $output;
}


function run_intcode($setting, $input)
{
    global $memory;

    $output = 0;
    $pointer = 0;
    $opcode_full = "0000" . $memory[$pointer];
    $opcode = substr($opcode_full, strlen($opcode_full) - 2);

    while ($opcode != 99) {

        $param1_mode = $opcode_full[-3];
        $param2_mode = $opcode_full[-4];

        $p1 = get_value($pointer + 1, $param1_mode);
        $p2 = get_value($pointer + 2, $param2_mode);

        switch ($opcode) {
            case 01:
                write_value($pointer + 3, $p1 + $p2);
                $pointer += 4;
                break;
            case 02:
                write_value($pointer + 3, $p1 * $p2);
                $pointer += 4;
                break;
            case 03:
                if ($setting != -1) {
                    write_value($pointer + 1, $setting);
                    $setting = -1;
                } else {
                    write_value($pointer + 1, $input);
                }
                $pointer += 2;
                break;
            case 04:

                $output = $p1;
                $pointer += 2;
                break;
            case 05:
                if ($p1 != 0) {
                    $pointer = $p2;
                } else $pointer += 3;
                break;
            case 06:
                if ($p1 == 0) {
                    $pointer = $p2;
                } else $pointer += 3;
                break;
            case 07:
                write_value($pointer + 3, $p1 < $p2 ? 1 : 0);
                $pointer += 4;
                break;
            case '08':
                write_value($pointer + 3, $p1 == $p2 ? 1 : 0);
                $pointer += 4;
                break;
            default:
                echo "nope\n";
                break;
        }
        $opcode_full = "0000" . $memory[$pointer];
        $opcode = substr($opcode_full, strlen($opcode_full) - 2);
    }
    return $output;
}

function get_value($position, $mode)
{
    global $memory;
    $value = $mode ? $memory[$position] : $memory[$memory[$position]];
    return $value;
}

function write_value($position, $value)
{
    global $memory;
    $memory[$memory[$position]] = $value;
}

// borrowed these from here:
//https://www.geeksforgeeks.org/write-a-c-program-to-print-all-permutations-of-a-given-string/
function permute($str, $start, $end)
{
    global $list;
    if ($start == $end) {
        $list[] = $str;
    }
    else
    {
        for ($i = $start; $i <= $end; $i++)
        {
            $str = swap($str, $start, $i);
            permute($str, $start + 1, $end);
            $str = swap($str, $start, $i);
        }
    }
}
function swap($a, $i, $j)
{
    $charArray = str_split($a);
    $temp = $charArray[$i] ;
    $charArray[$i] = $charArray[$j];
    $charArray[$j] = $temp;
    return implode($charArray);
}




