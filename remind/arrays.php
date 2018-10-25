<?php

	$elements = array('apple', 'pear', 'banana', 'grape');

	unset($elements[0]);

	echo join(' - ',$elements);

	$e = array('fruit1' => 'apple', 
			   'fruit2' => 'pear', 
			   'fruit3' => 'banana', 
			   'fruit4' => 'grape');

	unset($e['fruit2']);
	asort($e);

	$e['fruit5'] = 'watermelon';

	$keys = array_keys($e);
	$values = array_values($e);

	echo "<br>";
	var_dump($keys);
	echo "<br>";
	var_dump($values);