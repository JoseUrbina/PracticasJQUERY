<?php

	$cadena = "Welcome to my website";

	$newChain = str_split($cadena);

	echo join(' ', $newChain) . "<br>";

	$fruits = array("Vegetable" => 'Tomato', "Citrics" => 'Orange', 'Juice' => 'Coca-Cola');

	echo join(' | ',array_keys($fruits)) ."<br>";
	echo join(' | ', array_values($fruits)) . "<br>";

	echo "Specific Key: " . array_search('Orange', $fruits) . "<br>";