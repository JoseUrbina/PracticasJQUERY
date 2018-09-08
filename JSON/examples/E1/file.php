<?php 
	header('Content-Type: application/json');

	// convirtiendo la variable json a un objeto tipo array de php
	//  2do parameter: true- COnverto to array
	$obj = json_decode($_POST['x'], true);

	// echo json_encode($obj, JSON_FORCE_OBJECT);
	/* $name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];

	$data = array('name' => $name, 'lastname' => $lastname, 'age' => $age); */

	echo json_encode($obj, JSON_FORCE_OBJECT);
?>