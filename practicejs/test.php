<?php
	
	$producto1 = array('Name' => 'Apple', 'Color' => 'Red');
	$producto2 = array('Name' => 'Pear', 'Color' => 'Green');
	$producto3 = array('Name' => 'Banana', 'Color' => 'Yellow');
	$producto4 = array('Name' => 'Coffee', 'Color' => 'Brown');
	$producto5 = array('Name' => 'Paper', 'Color' => 'White');

	$products = array();
	array_push($products, $producto1, $producto2, $producto3, $producto4, $producto5);

	echo json_encode($products, JSON_OBJECT_AS_ARRAY);