<?php 
	header('Content-Type: application/json');

	$name = $_GET['name'];
	$lastname = $_GET['lastname'];
	$age = $_GET['age'];

	$data = array('name' => $name, 'lastname' => $lastname, 'age' => $age);

	echo json_encode($data, JSON_FORCE_OBJECT);
?>