<?php 
	header('Content-Type: application/json');

	$datos = array('user' => $_POST['user'],
				   'image' => $_FILES['image']['name']);

	echo json_encode($datos, JSON_FORCE_OBJECT);
 ?>