<?php 
	header('Content-Type:application/json');

	$name = $_POST['name'];
	$lastname = $_POST['lastname'];
	$age = $_POST['age'];

	$persona = array('name' => $name, 'lastname' => $lastname, 'age' => $age);

	echo json_encode($persona, JSON_FORCE_OBJECT);
?>