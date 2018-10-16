<?php 
	session_start();
	require_once '../app/nocsrf.php';

	if(isset($_POST['_token']))
	{	
		/*
			1ER PARAMETER: Token name
			2DO PARAMETER: TYpe of method
			3ER PARAMETER: ACTIVATE EXCEPTIONS
			4TO PARAMETER: LIFETIME TOKEN
			5TO PARAMETER: SENDING TOKEN MULTIPLE TIMES: AJAX - TRUE ELSE PUT ON FALSE
		 */
		if(nocsrf::check('_token', $_POST, false, 60*4, false))
		{
			$con = new mysqli('localhost','root', '', 'Pruebas');

			$query = "UPDATE PRODUCTO SET SECCION = 'VIAJES', NOMBREARTICULO = 'Backpack' 
					 WHERE CODARTICULO = 'AR01'";

			$con->query($query);
			
			$con->close();
		}
		else {
			die("TOKEN IS INCORRECT");
		}
	}
	
?>