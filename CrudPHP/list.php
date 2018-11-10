<?php
	$con = new mysqli("localhost","root","");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Chess") or die("NOT DB");
	$con->set_charset("utf8");

	$query= "SELECT * FROM Brand WHERE status = 1";

	$consulta = $con->prepare($query);
	$consulta->execute();

	$brands = array();

	$consulta->bind_result($idBrand, $brandName, $status);

	while($consulta->fetch())
	{
		$brands[] = array("idBrand" => $idBrand,
						  "brandName" => $brandName,
						  "status" => $status);
	}

	$consulta->close();
	$con->close();