<?php

$lower = 359282;
$upper = 820401;
$count = 0;

for ($i = $lower; $i <= $upper; $i++) {
    if (test_ascending(strval($i))) {
        if (test_exact_dup(strval($i))) {
            $count++;
        }
    }
}
echo $count;

function test_exact_dup($password)
{
    for ($i = 0; $i < 5; $i++) {
        $num = $password[$i];
        $count = substr_count($password, $num);
        if ($count == 2){
            return true;
        }
    }
    return false;
}

function test_ascending($password)
{
    for ($i = 0; $i < 5; $i++) {
        if ($password[$i] > $password[$i + 1]) {
            return false;
        }
    }
    return true;
}


