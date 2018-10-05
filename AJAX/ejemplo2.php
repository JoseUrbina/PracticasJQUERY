<?php 
	$name = htmlentities(addslashes($_POST['Name']));
	$lastname = htmlentities(addslashes($_POST['Lastname']));

	echo "{$name} {$lastname}";
?>