<?php 
	$controller = ucwords('product');

	if(!isset($_REQUEST['c']))
	{
		require "Controller/{$controller}Controller.php";

		$nameClass = $controller . "Controller";

		$clase = new $nameClass;
		$clase->index();
	}
	else
	{
		$controller = ucwords($_REQUEST['c']);
		$action = (isset($_REQUEST['a'])?$_REQUEST['a']:'index');

		require "Controller/{$controller}Controller.php";

		$nameClass = $controller . "Controller";
		$clase = new $nameClass;

		call_user_func(array($clase, $action)); 
	}
?>