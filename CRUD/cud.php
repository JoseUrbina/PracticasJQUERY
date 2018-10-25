<?php
	header('Content-type:application/json');

	// Establecer la conexion en general
	$con = new mysqli("localhost", "root", "");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db("Usuarios") or die("NOT FOUND");
	$con->set_charset("utf8");

	if(isset($_POST['action']))
	{
		$idUser = (isset($_POST['id']) ? $_POST['id'] : 0);
		$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : "";	
		$firstName = htmlentities(addslashes($firstName));
		$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : "";
		$lastName = htmlentities(addslashes($lastName));

		if($_POST['action'] == "Add")
		{
			$query = "INSERT INTO Users(firstName,lastName) VALUES(?,?)";

			$consulta = $con->prepare($query);
			$consulta->bind_param("ss", $firstName, $lastName);
			$consulta->execute();

			$response = array('message' => '', 'status' => false);

			if($consulta->affected_rows)
			{
				$response['message'] = "Record saved successfully";
				$response['status'] = true;
			}
			else
			{
				$response['message'] = "Record has not been added";
			}

			$consulta->close();

			echo json_encode($response, JSON_FORCE_OBJECT);
		}
		else if($_POST['action'] == "Edit")
		{
			$query = "UPDATE Users SET firstName = ?, lastName = ?
					 WHERE idUser = ?";

			$consulta = $con->prepare($query);
			$consulta->bind_param("ssi", $firstName, $lastName, $idUser);
			$consulta->execute();

			$response = array('message' => '', 'status' => false);

			if($consulta->affected_rows)
			{
				$response['message'] = "Record edited successfully";
				$response['status'] = true;
			}
			else
			{
				$response['message'] = "Record has not been added";
			}

			$consulta->close();

			echo json_encode($response, JSON_FORCE_OBJECT);
		}
		else if($_POST['action'] == "Delete")
		{
			$query = "DELETE FROM Users WHERE idUser = ?";

			$consulta = $con->prepare($query);
			$consulta->bind_param('i', $idUser);
			$consulta->execute();

			$response = array('message' => '', 'status' => false);

			if($consulta->affected_rows)
			{
				$response['status'] = true;
				$response['message'] = "Record deleted successfully";
			}
			else
			{
				$response['message'] = "Record has not been deleted";
			}

			$consulta->close();
			echo json_encode($response, JSON_FORCE_OBJECT);
		}
	}

	$con->close();