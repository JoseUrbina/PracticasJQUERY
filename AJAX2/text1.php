<?php 
	header('Content-type:application/json');
 	
	$fruits = $_POST['fruit'];

	echo json_encode($fruits, JSON_OBJECT_AS_ARRAY);
?>