<?php
	$cadena = "Welcome, come in";

	echo strlen($cadena) . "<br>";

	// new str_split
	$cadInverse = join('',array_reverse(str_split($cadena)));
	echo "Cadena invertida : {$cadInverse}";