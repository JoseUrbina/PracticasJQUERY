<?php
	namespace model;

	require_once "database.php";
	use model\database;
	use \PDO;

	class Area
	{
		public $idArea;
		public $nArea;

		private $db;

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

		public function getAreas()
		{
			$query = "SELECT * FROM Area";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->execute();

				$areas = $consulta->fetchAll(PDO::FETCH_OBJ);

				$consulta->closeCursor();
				return $areas;
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

		public function getEmpArea($id)
		{
			$query = "SELECT * FROM Area WHERE idArea = :idArea";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->execute(array(':idArea' => $id));

				while($row = $consulta->fetch(PDO::FETCH_OBJ))
				{
					$this->idArea = $row->idArea;
					$this->nArea = $row->nArea;
				}

				$consulta->closeCursor();

				return $this;
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