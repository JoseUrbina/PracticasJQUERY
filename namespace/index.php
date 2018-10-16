<?php 

	include 'ffn.php';
	include 'sfn.php';	

	// A way to use namespace

	/* namespace second;
	$objSecond = new A;
	echo "<br>";
	// global namespace
	$objFIrst = new \A; */

	use second\A as newA;

	$objSecond = new newA();
	echo "<br/>";
	$objGlobal = new A();