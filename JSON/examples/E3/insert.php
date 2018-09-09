<?php 
	header('Content-Type: application/json');
	require "database.php";

	$db;
	$response = array('message' => '', 'status' => false);
	$seccion = htmlentities(addslashes($_POST['seccion']));
	$articulo = htmlentities(addslashes($_POST['articulo']));

	$imageName = $_FILES['image']['name'];
	$imageType = $_FILES['image']['type'];
	$imageSize = $_FILES['image']['size'];

	if($imageSize < 3000000)
	{
		if($imageType == "image/jpg" || $imageType == "image/jpeg"
		   || $imageType == "image/png" || $imageType == "image/gif")
		{
			$carpeta_destino = "imagenes/";
			move_uploaded_file($_FILES['image']['tmp_name'], $carpeta_destino . $imageName);
		}
		else
		{
			die("It's not an image");
		}
	}
	else
	{
		die("Image is bigger");
	}

	try
	{
		$db = database::conexion();

		$query = "INSERT INTO PRODUCTOS(SECCION, NOMBRE, FOTO)
				 VALUES(:seccion, :articulo, :foto)";

		$consulta = $db->prepare($query);
		$consulta->bindValue(':seccion', $seccion);
		$consulta->bindValue(':articulo', $articulo);
		$consulta->bindValue(':foto', $imageName);

		$consulta->execute();

		if($consulta->rowCount())
		{
			$response['message'] = "Record saved correctly";
			$response['status'] = true;
		}
	}
	catch(Exception $e)
	{
		$response['message'] = $e->getMessage();
	}

	echo json_encode($response, JSON_FORCE_OBJECT);
?>