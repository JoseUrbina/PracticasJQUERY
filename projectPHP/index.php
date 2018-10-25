<?php
	$controller = ucwords("employee");

	if(!isset($_REQUEST['c']))
	{
		require_once "controller/{$controller}Controller.php";

		$controller .= "Controller";

		$clase = new $controller;
		$clase->index();
	}
	else
	{
		$controller = ucwords($_REQUEST['c']);
		$action = (isset($_REQUEST['a'])?$_REQUEST['a']:"index");

		require_once "controller/{$controller}Controller.php";

		$controller .= "Controller";
		$clase = new $controller;

		call_user_func(array($clase, $action));
	}