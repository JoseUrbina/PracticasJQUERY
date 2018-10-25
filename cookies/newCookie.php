<?php
	setcookie('test', "Hello World!" ,time() + 36000);
	header('location:index.php');