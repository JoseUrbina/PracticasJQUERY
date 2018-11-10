<?php
	$con = new mysqli("localhost","root","");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Chess") or die("not found");
	$con->set_charset("utf8");

	$id = htmlentities(addslashes($_POST["idBrand"]));
	$name = htmlentities(addslashes($_POST["brandName"]));
	$status = 1;

	if($id > 0)
	{
		$query = "UPDATE Brand SET brandName = ? WHERE idBrand = ?";
		$consulta = $con->prepare($query);

		$consulta->bind_param("si", $name, $id);
	}
	else
	{
		$query = "INSERT INTO Brand(brandName, status) VALUES(?, ?)";
		$consulta = $con->prepare($query);

		$consulta->bind_param("si", $name, $status);
	}

	$consulta->execute();

	if($consulta->affected_rows > 0)
	{
		if($id == 0)
		{
			$id = $con->insert_id;
		}

		echo "Last id: " . $id;
	}

	$consulta->close();
	$con->close();