<?php 
	include 'database.php';
	header('Content-type: application/json');

	if(isset($_POST['search']) && !empty($_POST['search']))
	{
		$search = $_POST['search'];

		$query = "SELECT * FROM task WHERE name LIKE '$search%'";

		$result = $connection->query($query);

		if(!$result)
		{
			die("Error de consulta " . $connection->error);
		}
		
		$json = array();
		while($row = $result->fetch_array(MYSQLI_ASSOC)){
			$json[] = array(
				'name' => $row['name'],
				'description' => $row['description'] ,
				'Id' => $row['id']
			);
		}

		echo json_encode($json, JSON_OBJECT_AS_ARRAY);
	}
?>