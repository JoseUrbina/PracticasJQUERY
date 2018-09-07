<?php 
	
	$name = htmlentities(addslashes($_POST['name']));

	$imageName = $_FILES['image']['name'];
	$imageType = $_FILES['image']['type'];
	$imageSize = $_FILES['image']['size'];

	$carpeta_destino = 'Imagenes/';

	move_uploaded_file($_FILES['image']['tmp_name'], $carpeta_destino . $imageName);

	echo "Image saved properly";
?>