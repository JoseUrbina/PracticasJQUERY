<?php
	header('Content-Type: application/json');
	require "database.php";

	$db;
	$id = htmlentities(addslashes($_GET['id']));
	$response = array('message' => '', 'status' => false);

	try
	{
		$db = database::conexion();

		$query = "DELETE FROM PRODUCTOS WHERE ID = :id";
		$consulta = $db->prepare($query);
		$consulta->execute(array(':id' => $id));

		$message = '';

		if($consulta->rowCount() > 0)
		{
			$message = 'Record deleted properly';			
		}
		else
		{
			$message = 'Record has been found';
		}

		$response['message'] = $message;
		$response['status'] = true;
	}
	catch(Exception $e)
	{
		$response['message'] = $e->getMessage();
	}

	echo json_encode($response, JSON_FORCE_OBJECT);
?>