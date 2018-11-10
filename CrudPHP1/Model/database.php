<?php
	namespace Model;

	use \PDO;

	class database
	{
		public static function conexion()
		{
			try
			{
				$con = new PDO("mysql:host=localhost;dbname=Chess", "root","");
				$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$con->exec("SET CHARACTER SET utf8");
				return $con;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}
	}