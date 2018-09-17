<?php 
	header('Content-Type:application/json');

	$material = $_POST['material'];

	echo json_encode($material, JSON_OBJECT_AS_ARRAY);
?>