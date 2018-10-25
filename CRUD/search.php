<?php
	header('Content-type:application/json');

	$con = new mysqli('localhost','root','');

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Usuarios") or die("DB NOT FOUND");
	$con->set_charset("utf8");

	$query = "SELECT firstName, LastName FROM Users WHERE idUser = ?";

	$id = (isset($_GET['id'])?$_GET['id']:0);

	$consulta = $con->prepare($query);
	$consulta->bind_param('i', $id);
	$consulta->execute();

	$user = array();

	$consulta->store_result();

	if($consulta->num_rows)
	{
		$consulta->bind_result($firstName, $lastName);
		$consulta->fetch();

		$user[] = array('idUser' => $id,
						'firstName' => $firstName,
						'lastName' => $lastName);
	}

	$consulta->close();
	$con->close();

	echo json_encode($user, JSON_OBJECT_AS_ARRAY);

