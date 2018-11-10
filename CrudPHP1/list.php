<?php
	require "Model/database.php";
	use Model\database as db;

	$bd;

	try
	{
		$bd = db::conexion();
		$query= "SELECT * FROM Brand WHERE status = 1";
		$consulta = $bd->prepare($query);
		$consulta->execute();

		$brands = array();

		while($row = $consulta->fetch(PDO::FETCH_ASSOC))
		{
			$brands[] = array("idBrand" => $row["idBrand"],
						  	  "brandName" => $row["brandName"],
						      "status" => $row["status"]);
		}
		$consulta->closeCursor();
	}
	catch(Exception $e)
	{
		die("Error: {$e->getMessage()}");
	}
	finally
	{
		$bd = null;
	}