<?php
	namespace Model;

	require_once "database.php";
	require_once "brand.php";

	use Model\brand as brand;
	use Model\database as database;
	use \PDO;

	class product
	{
		public $idProduct;
		public $idBrand;
		public $name;
		public $statu;

		public $brand;

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

		public function getAllProducts()
		{
			$query = "SELECT * FROM product WHERE statu = 1";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->execute();

				$products = [];//$consulta->fetchAll(PDO::FETCH_OBJ);

				while($row = $consulta->fetch(PDO::FETCH_ASSOC))
				{
					// Get product
					$product = new product;
					$product->idProduct = $row["idProduct"];
					$product->idBrand = $row["idBrand"];
					$product->name = $row["name"];
					$product->statu = $row["statu"];

					// Get brand
					$br = new brand;
					$product->brand = $br->getProBrand($row["idBrand"]);

					// Store product variable into the list of products
					$products[] = $product;
				}

				$consulta->closeCursor();

				return $products;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}

		public function findProduct($idProduct)
		{
			$query = "SELECT * FROM product WHERE idProduct = :id && statu = 1";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->bindValue(":id", $idProduct, PDO::PARAM_INT);
				$consulta->execute();

				$product = $consulta->fetch(PDO::FETCH_OBJ);

				$consulta->closeCursor();

				return $product;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		public function sORuProduct()
		{
			if($this->idProduct == 0)
			{
				$query = "INSERT INTO product(idBrand, name, statu)
						  VALUES(:idBrand, :name, :statu)";
			}
			else
			{
				$query = "UPDATE product SET idBrand = :idBrand, name = :name,
						  statu = :statu WHERE idProduct = :id";
			}

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->bindValue(':idBrand', $this->idBrand);
				$consulta->bindValue(':name', $this->name);
				$consulta->bindValue(':statu', $this->statu);

				if($this->idProduct > 0)
				{
					$consulta->bindValue(":id", $this->idProduct);
				}

				$consulta->execute();

				$response = array("message" => '', "status" => false);

				if($consulta->rowCount() > 0)
				{
					if($product->idProduct > 0)
						$response['message'] = "Record updated successfully";
					else
					{						
						$product->idProduct = $this->db->lastInsertId();
						$response['message'] = "Record saved successfully, 
											    record: " . $product->idProduct;
					}

					$response['status'] = true;
				}
				else
				{
					$response['message'] = "Operation hasn't been performed";
				}

				$consulta->closeCursor();
				return $response;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		public function deleteProduct($idProduct)
		{
			$query = "UPDATE product SET statu = 0 WHERE idProduct = :id";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->bindValue(':id', $idProduct);
				$consulta->execute();

				$response = array('message' => '' , 'status' => false);

				if($consulta->rowCount())
				{	
					$response['message'] = "Record deleted successfully";
					$response['status'] = true;
				}
				else
				{
					$response['message'] = "Record hasn't deleted";
				}

				$consulta->closeCursor();

				return $response;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}
	}