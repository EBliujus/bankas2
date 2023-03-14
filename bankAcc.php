<?php

$salis = 'LT';
$kontroliniai_sk = rand(10, 99);
$banko_kodas = 10100;
$sask_nr = rand(10000000000, 99999999999);

$saskaita = "{$salis}{$kontroliniai_sk}{$banko_kodas}{$sask_nr}";

echo $saskaita;




?>