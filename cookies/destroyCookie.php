<?php
	setcookie('test',"", time() - 1);
	header('location:index.php');