<?php
	$con = new mysqli("localhost","root","");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Chess") or die("NOT DB");
	$con->set_charset("utf8");

	$query = "SELECT idBrand, brandName FROM Brand 
			  WHERE idBrand = ? && status = 1";

	$id = htmlentities(addslashes($_GET["id"]));

	$consulta = $con->prepare($query);
	$consulta->bind_param("i", $id);
	$consulta->execute();

	$consulta->store_result();
	$row = $consulta->num_rows;
	$brand = array("idBrand" => 0, "brandName" => "");

	if($row > 0)
	{
		$consulta->bind_result($idBrand, $brandName);		

		while($consulta->fetch())
		{
			$brand["idBrand"] = $idBrand;
			$brand["brandName"] = $brandName;
		}
	}else{
		echo "<script>alert('Record has not been found');</script>";
		header("location:index.php");
	}

	$consulta->close();
	$con->close();