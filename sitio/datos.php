<?php 
	require "model/producto.php";
	require "controller/producto.php";

	$objProduct1 = new model\producto\producto();
	$objProduct1->imprime();

	echo "<br>";

	$objProduct2 = new controller\producto\producto();
	$objProduct2->imprime();
?>