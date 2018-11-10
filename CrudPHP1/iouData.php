<?php
	require "Model/database.php";
	use Model\database as db;

	$bd;
	try
	{
		$bd = db::conexion();

		$id = htmlentities(addslashes($_POST["idBrand"]));
		$name = htmlentities(addslashes($_POST["brandName"]));
		$status = 1;

		if($id > 0)
		{
			$query = "UPDATE Brand SET brandName = :name 
					  WHERE idBrand = :id";
		}
		else
		{
			$query = "INSERT INTO Brand(brandName, status) 
					  VALUES(:name, :status)";
		}		

		$consulta = $bd->prepare($query);

		$consulta->bindValue(":name", $name);

		if($id > 0)
			$consulta->bindValue(":id", $id);
		else
			$consulta->bindValue(":status", $status);

		$consulta->execute();

		if($consulta->rowCount() > 0)
		{
			if($id == 0)
				$id = $bd->lastInsertId();

			echo "Last ID: {$id}";
		}

	}
	catch(Exception $e)
	{
		die("Error: {$e->getMessage()}");
	}
	finally{
		$bd = null;
	}