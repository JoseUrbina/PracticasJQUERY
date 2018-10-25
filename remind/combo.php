<?php 
	$countries = $_POST['countries'];

	foreach($countries as $value)
	{
		echo "Country: {$value}<br>";
	}
