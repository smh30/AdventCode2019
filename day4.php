<?php

$lower = 359282;
$upper = 820401;
$count = 0;

for($i=$lower; $i<=$upper; $i++){
    if(test_password(strval($i))){
        $count++;
    }
}

echo $count;

function test_password($password){
    if ($password[5]>=$password[4] &
        $password[4]>=$password[3]&
        $password[3]>=$password[2]&
        $password[2]>=$password[1]&
        $password[1]>=$password[0]
        ){
        if (test_adjacent($password)){
            return true;
        }
    }
    return false;
}


function test_adjacent($password){
    if (($password[0]==$password[1] & $password[1]!=$password[2]) ||
        ($password[1]==$password[2] & $password[2]!=$password[3] & $password[1]!=$password[0]) ||
        ($password[2]==$password[3] & $password[3]!=$password[4] & $password[2]!=$password[1]) ||
        ($password[3]==$password[4] & $password[4]!=$password[5] & $password[3]!=$password[2]) ||
        ($password[4]==$password[5] & $password[4]!=$password[3])){

        return true;
    }
    return false;
}