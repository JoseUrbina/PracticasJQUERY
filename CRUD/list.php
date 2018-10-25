<?php
	header('Content-type: aplpication/json');

	$con = new mysqli('localhost', 'root', '');

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db('Usuarios') or die("DB HAS NOT BEEN FOUND");
	$con->set_charset("utf8");

	$query = "CALL sp_getUsers();";

	$consulta = $con->prepare($query);
	$consulta->execute();

	$consulta->bind_result($idUser, $firstName, $lastName);

	$users = array();

	while($consulta->fetch())
	{
		$users[] = array('idUser' => $idUser,
						 'firstName' => $firstName,
						 'lastName' => $lastName);
	}

	echo json_encode($users, JSON_OBJECT_AS_ARRAY);