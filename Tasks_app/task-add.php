<?php 
	include 'database.php';
	header('Content-type:application/json');

	if(isset($_POST['name']) && isset($_POST['description']))
	{
		$name = htmlentities(addslashes($_POST['name']));
		$description = htmlentities(addslashes($_POST['description']));

		$query = "INSERT INTO task(name, description)
				 VALUES('$name','$description')";

		$result = $connection->query($query);

		if(!$result)
		{
			die('Query failed');
		}

		$response = array('message' => '', 'status' => false);

		if($connection->affected_rows)
		{
			$response['message'] = "Record saved correctly";
			$response['status'] = true;
		}
		else
		{
			$response['message'] = "Record has not been saved";
		}

		echo json_encode($response, JSON_FORCE_OBJECT);
	}
?>