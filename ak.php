<?php

$I_sk = rand(5,6);
$metu_sk = substr(rand(1923, 2023), -2);
$menuo_sk = str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT);
$diena_sk = str_pad(rand(1, 31), 2, 0, STR_PAD_LEFT);
$rand_sk = str_pad(rand(1, 999), 3, 0, STR_PAD_LEFT);
$rand_sk2 = rand(1, 9);

$ak = "{$I_sk}{$metu_sk}{$menuo_sk}{$diena_sk}{$rand_sk}{$rand_sk2}";

echo $ak;
?>

