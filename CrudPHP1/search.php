<?php
	require "Model/database.php";
	use Model\database as bd;
	$db;

	try
	{
		$db = bd::conexion();

		$query = "SELECT idBrand, brandName FROM Brand 
			  	  WHERE idBrand = :id && status = 1";
		$id = htmlentities(addslashes($_GET["id"]));

		$consulta = $db->prepare($query);
		$consulta->bindValue(":id", $id);
		$consulta->execute();

		$brand = array("idBrand" => 0, "brandName" => "");

		if($consulta->rowCount() > 0)
		{
			$brand = $consulta->fetch(PDO::FETCH_ASSOC);
		}
		else
		{
			echo "<script>alert('Record has not been found');</script>";
			header("location:index.php");
		}

		$consulta->closeCursor();	
	}
	catch(Exception $e)
	{
		die("Error: {$e->getMessage()}");
	}
	finally{
		$db = null;
	}