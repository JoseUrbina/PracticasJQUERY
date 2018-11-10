<?php
	$con = new mysqli("localhost","root","");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Chess") or die("Not found");
	$con->set_charset("utf8");

	$query = "UPDATE Brand SET status = ? WHERE idBrand = ?";

	$id = htmlentities(addslashes($_POST["id"]));
	$status = 0;

	$consulta = $con->prepare($query);

	$consulta->bind_param("ii", $status, $id);
	$consulta->execute();

	if($consulta->affected_rows > 0)
	{
		header("location:index.php");
	}

	$consulta->close();
	$con->close();
