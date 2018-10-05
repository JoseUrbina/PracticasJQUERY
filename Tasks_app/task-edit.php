<?php
	include 'database.php';
	header('Content-type:application/json');

	$id = htmlentities(addslashes($_POST['id']));
	$name = htmlentities(addslashes($_POST['name']));
	$description = htmlentities(addslashes($_POST['description']));

	$query = "UPDATE task SET name = '$name',
			 description = '$description' WHERE id = $id";

	$result = $connection->query($query);

	if(!$result)
	{
		die("Query failed : {$connection->error}");
	}

	$response = array('message' => '', 'status' => false);

	if($connection->affected_rows)
	{
		$response['message'] = 'Record edited successfully';
		$response['status'] = true;
	}
	else
	{
		$response['message'] = "Record has not been edited";
	}

	echo json_encode($response, JSON_FORCE_OBJECT);
?>