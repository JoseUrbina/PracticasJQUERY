<?php

function add(&$num, $amount)
{
	$num += $amount;
}

$num = 10;
add($num, 10);
echo "Value: {$num}<br>";
$chain = "New World";
$chain = strtolower($chain);
$chain = str_replace('w','(.)', $chain);
$large = strlen($chain);
echo "{$chain} - large: {$large}";


