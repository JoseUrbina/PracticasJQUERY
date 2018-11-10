<?php
	require "Model/database.php";
	use Model\database as bd;

	$db;

	try
	{
		$db = bd::conexion();
		$query = "UPDATE Brand SET status = :status 
				  WHERE idBrand = :id";

		$id = htmlentities(addslashes($_POST["id"]));
		$status = 0;

		$consulta = $db->prepare($query);
		$consulta->bindValue(":status", $status);
		$consulta->bindValue(":id", $id, PDO::PARAM_INT);
		$consulta->execute();

		if($consulta->rowCount() > 0)
		{
			header("location:index.php");
		}
		$consulta->closeCursor();
	}
	catch(Exception $e){
		die("Error: {$e->getMessage()}");
	}
	finally{
		$db = null;
	}