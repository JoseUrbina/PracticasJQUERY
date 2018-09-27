<?php 
	require 'config.php';

	$con = new mysqli(dbHost, dbUser, dbPwd);

	if($con->connect_errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db(dbName) or die("NOT DB");
	$con->set_charset(dbCharset);

	if(isset($_GET['a']))
	{
		$id = htmlentities(addslashes($_POST['Id']));

		$query = "UPDATE PERSONA SET Name = ?, Phone = ?
				 ,Address = ?, Email = ? WHERE Id = ?";
	}
	else
	{
		$query = "INSERT INTO PERSONA(Name, Phone, Address, Email)
			 	  VALUES(?, ?, ?, ?)";
	}

	$name = htmlentities(addslashes($_POST['Name']));
	$phone = htmlentities(addslashes($_POST['Phone']));
	$address = htmlentities(addslashes($_POST['Address']));
	$email = htmlentities(addslashes($_POST['Email']));	

	$result = $con->prepare($query);

	if(isset($_GET['a']))
	{
		$result->bind_param('ssssi',$name, $phone, $address, $email, $id);
	}
	else
	{
		$result->bind_param('ssss', $name, $phone, $address, $email);
	}	

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