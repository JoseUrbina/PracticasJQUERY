<?php
	header('Content-type:application/json');

	$con = mysqli_connect("localhost", "root", "");

	if(mysqli_errno($con))
	{
		die("Error");
	}

	mysqli_select_db($con, "Chess") or die("DB NOT FOUND");
	mysqli_set_charset($con, "utf8");

	$user = $_POST['user'];
	$pwd = password_hash($_POST['pwd'], PASSWORD_DEFAULT);


	$query = "INSERT INTO Users(Usuario, Contra)
			 SELECT '{$user}' , '{$pwd}' FROM Users
			 WHERE NOT EXISTS(SELECT Usuario FROM Users 
			 				  WHERE Usuario = '{$user}') LIMIT 1";

	$result = mysqli_query($con, $query);
	$insert_id = mysqli_insert_id($con);

	$response = array('message' => '', 'status' => false);
	
	if($insert_id != '')
	{
		$response['message'] = "Record has been saved successfully";
		$response['status'] = true;		
	}
	else
	{
		$response['message'] = "User already exist into Database";
	}

	echo json_encode($response, JSON_FORCE_OBJECT);