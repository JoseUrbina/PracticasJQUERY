<?php
	namespace model;
	
	require_once "config/conexion.php";

	use \PDO;
	
	class database
	{
		public static function conexion()
		{
			try
			{
				$con = new PDO("mysql:host=" . DBHOST . ";dbname=" . DBNAME, DBUSER, DBPWD);
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$con->exec("SET CHARACTER SET utf8");
				return $con;
			}
			catch(Exception $e)
			{
				throw $e;
			}
		}
	}