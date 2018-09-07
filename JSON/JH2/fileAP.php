<?php 
	header('Content-Type:application/json');

	$name = htmlentities(addslashes($_POST['name']));
	$lastname = htmlentities(addslashes($_POST['lastname']));
	$age = htmlentities(addslashes($_POST['age']));

	$persona = array('name' => $name, 'lastname' => $lastname, 'age' => $age );

	echo json_encode($persona, JSON_FORCE_OBJECT);
?>