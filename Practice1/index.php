<?php
	$controller = ucwords("product");

	if(!isset($_REQUEST['c']))
	{
		require_once "Controller/{$controller}Controller.php";
		$controller .= "Controller";
		$clase = "Controller\\{$controller}";

		call_user_func(array($clase, 'index'));
	}
	else
	{
		$controller = ucwords($_REQUEST['c']);
		$action = (isset($_REQUEST['a'])? $_REQUEST['a'] : 'index');

		require_once "Controller/{$controller}Controller.php";

		$controller .= "Controller";
		$clase = "Controller\\{$controller}";

		call_user_func(array($clase, $action));
	}