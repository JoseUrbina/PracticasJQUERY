<?php
	namespace examples;
	
	include "example2.php";
	include "examples4.php";

	// use examples\second as newSecond;

	// $obj = new newSecond();
	//$obj->execMessage("Hello World! :)");
	//
	$objArt = new \Articulo();

	$objArt = $objArt->getArticulo(1, "Cushion");

	var_dump($objArt);