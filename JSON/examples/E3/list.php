<?php 
	header('Content-Type: application/json');
	require "database.php";

	$db;
	$result = array('products' => [], 'message' => '', 'status' => false);

	try
	{	
		$db = database::conexion();

		$query = "SELECT * FROM PRODUCTOS";

		$consulta = $db->prepare($query);
		$consulta->execute();

		$result['products'] = $consulta->fetchAll(PDO::FETCH_OBJ);
		$result['message'] = "Records was found correctly";
		$result['status'] = true;
	}
	catch(Exception $e)
	{
		$result['message'] = $e->getMessage();
	}


	echo json_encode($result, JSON_OBJECT_AS_ARRAY);
?>