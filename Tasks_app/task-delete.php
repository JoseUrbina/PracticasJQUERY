<?php 
	include 'database.php';
	header('Content-type:application/json');

	if(isset($_POST['id']))
	{
		$id = htmlentities(addslashes($_POST['id']));

		$query = "DELETE FROM task WHERE id = $id";

		$result = $connection->query($query);

		if(!$result)
		{
			die("Query failed: {$connection->error}");
		}

		$response = array('message' => '', 'status' => false);

		if($connection->affected_rows)
		{
			$response['message'] = 'Record deleted successfully';
			$response['status'] = true;
		}
		else
		{
			$response['message'] = 'Record dhas not been deleted';
		}

		echo json_encode($response, JSON_FORCE_OBJECT);
	}

?>