<?php

$I_sk = rand(6,7);
$metu_sk = substr(rand(1910, 2023), -2);
$menuo_sk = str_pad(rand(1, 12), 2, 0, STR_PAD_LEFT);
$diena_sk = str_pad(rand(1, 31), 2, 0, STR_PAD_LEFT);
$rand_sk = str_pad(rand(1, 999), 4, 0, STR_PAD_LEFT);

$ak = "{$I_sk}{$metu_sk}{$menuo_sk}{$diena_sk}{$rand_sk}";

echo $ak;
?>

