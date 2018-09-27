<?php 
	require 'config.php';

	$con = new mysqli(dbHost, dbUser, dbPwd);

	if($con->connect_errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db(dbName) or die("NOT DB");
	$con->set_charset(dbCharset);

	$id = htmlentities(addslashes($_GET['id']));

	$query = "DELETE FROM PERSONA WHERE Id = ?";

	$result = $con->prepare($query);

	$result->bind_param('i', $id);

	if($result->execute())
	{
		if($result->affected_rows > 0)
		{
			$result->close();
			$con->close();

			header('location:index.php');
		}
	}
?>