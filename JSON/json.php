<?php
	$json = '{"name":"José", "lastname":"Urbina", "age": 25}';

	// json_decode -> become a character JSON chain to php object 
	$objPersona = json_decode($json);

	echo "{$objPersona->name} {$objPersona->lastname} : {$objPersona->age}";
?>