<?php
	namespace Model;

	require_once "Model/database.php";
	use Model\database as database;
	use \PDO;

	class brand
	{
		public $idBrand;
		public $brandName;
		private $db = null;

		function __construct()
		{
			try
			{
				$this->db = database::conexion();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		public function getAllBrands()
		{
			$query = "SELECT * FROM brand";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->execute();

				$brands = $consulta->fetchAll(PDO::FETCH_OBJ);
				$consulta->closeCursor();

				return $brands;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}

		public function getProBrand($idBrand)
		{
			$query = "SELECT * FROM brand WHERE idBrand = :id";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->bindValue(":id", $idBrand);
				$consulta->execute();

				$brand = $consulta->fetch(PDO::FETCH_OBJ);
				$consulta->closeCursor();

				return $brand;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally
			{
				$this->db = null;
			}
		}
	}
