<?php 
	include 'database.php';
	header('Content-type:application/json');

	if(isset($_POST['id']))
	{
		$id = $_POST['id'];

		$query = "SELECT * FROM task WHERE id = $id";

		$result = $connection->query($query);

		if(!$result)
		{
			die("Query failed : {$connection->error}");
		}

		$row = $result->fetch_array(MYSQLI_ASSOC);
		$json = array('id' => $row['id'],
					  'name' => $row['name'],
					  'description' => $row['description']);

		echo json_encode($json, JSON_FORCE_OBJECT);
	}
?>