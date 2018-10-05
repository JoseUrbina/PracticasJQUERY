<?php 
	include 'database.php';
	header('Content-type:application/json');

	$query = "SELECT * FROM task";

	$result = $connection->query($query);

	if(!$result)
	{
		die("Query failed {$connection->error}");
	}

	$tasks = array();

	while($row = $result->fetch_array(MYSQLI_ASSOC))
	{
		$tasks[] = array('id' => $row['id'],
						 'name' => $row['name'],
						 'description' => $row['description']);
	}

	echo json_encode($tasks, JSON_OBJECT_AS_ARRAY);
?>