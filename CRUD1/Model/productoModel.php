<?php 
	require 'Model/database.php';

	class productoModel
	{
		public $ID;
		public $SECCION;
		public $NOMBRE;
		public $FOTO;

		private $db;

		// Funcion constructora
		function __construct()
		{
			try
			{
				$this->db = database::conexion();
			}
			catch(Exception $e)
			{
				die('Error: ' . $e->getMessage());
			}
		}

		// Function that gets all products into the database
		public function getProducts($pagina, $numPag, $totalRecord)
		{
			try
			{
				$pagInicio = ($pagina - 1) * $numPag;

				$query = "SELECT * FROM PRODUCTOS LIMIT :inicio, :fin";

				$consulta = $this->db->prepare($query);
				$consulta->bindValue(':inicio', $pagInicio, PDO::PARAM_INT);
				$consulta->bindValue(':fin',$numPag, PDO::PARAM_INT);
				$consulta->execute();

				return $consulta->fetchAll(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die('Error: ' . $e->getMessage());
			}
		}

		public function numRecords()
		{
			try
			{
				$query = "SELECT COUNT(*) total FROM PRODUCTOS";

				$consulta = $this->db->prepare($query);
				$consulta->execute();

				return $consulta->fetch(PDO::FETCH_ASSOC);
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		// Function that add or edit a product
		public function addOrEditProduct(productoModel $Product)
		{
			try
			{
				if($Product->ID > 0)
				{
					$query = "UPDATE PRODUCTOS SET SECCION = :seccion, NOMBRE = :nombre,
							 FOTO = :foto WHERE ID = :id";
				}
				else
				{
					$query = "INSERT INTO PRODUCTOS(SECCION, NOMBRE, FOTO) 
							  VALUES(:seccion, :nombre, :foto)";
				}

				$consulta = $this->db->prepare($query);
				($Product->ID > 0) ? $consulta->bindValue(':id', $Product->ID):'';
				$consulta->bindValue(':seccion', $Product->SECCION);
				$consulta->bindValue(':nombre', $Product->NOMBRE);
				$consulta->bindValue(':foto', $Product->FOTO);

				if($consulta->execute())
				{
					if($consulta->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}			
		}

		// function that search a determinated product by id
		public function findProduct($id)
		{
			try
			{
				$query = "SELECT * FROM PRODUCTOS WHERE ID = :id";
				$consulta = $this->db->prepare($query);
				$consulta->execute(array(':id' => $id));

				return $consulta->fetch(PDO::FETCH_OBJ);
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}		
		}

		// function that delete a determinated product by id
		public function deleteProduct($id)
		{
			try
			{
				$query = 'DELETE FROM PRODUCTOS WHERE ID = :id';
				$consulta = $this->db->prepare($query);

				if($consulta->execute(array(':id' => $id)))
				{
					if($consulta->rowCount() > 0)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}	
		}
	}
?>