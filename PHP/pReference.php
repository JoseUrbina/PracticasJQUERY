<?php

function message(&$value, $add)
{
	$value .= $add;
}

$message = "Hello World!!!";

message($message, ' :)');

echo "<h3>{$message}</h3>";