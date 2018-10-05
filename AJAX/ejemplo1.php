<?php 
	header('Content-type: application/json');

	switch ($_GET['f']) {
		case 1:
			$fruits = ['apple', 'pear', 'banana'];
			break;
		case 2:
			$fruits = ['watermelon', 'grape', 'orange'];
			break;
	}

	echo json_encode($fruits, JSON_OBJECT_AS_ARRAY);
?>