<?php
	namespace model;

	require_once "database.php";
	use model\database;
	use \PDO;

	class Telefono
	{
		public $idTelefono;
		public $Tel;
		public $idEmployee;

		private $db;

		// function that deletes the phones record about an employee
		public function delEmpPhones($idEmployee)
		{
			// if employee has phones record to do this
			if($this->numPhones($idEmployee) > 0)
			{
				$query = "DELETE FROM Telefono WHERE idEmployee = :id";

				try
				{
					$this->db = database::conexion();

					$response = false;

					$consulta = $this->db->prepare($query);
					$consulta->bindValue(":id", $idEmployee);

					if($consulta->execute())
					{
						if($consulta->rowCount() > 0)
						{
							$response = true;
						}
					}
					
					$consulta->closeCursor();
					return $response;
				}
				catch(Exception $e)
				{
					die("Error: {$e->getMessage()}");
				}
				finally{
					$this->db = null;			
				}
			}
		}

		// function that allows us get the phones record about an employee
		public function getEmpTel($idEmployee)
		{
			$query = "SELECT Tel FROM Telefono WHERE idEmployee = :Id";

			try
			{
				$this->db = database::conexion();

				$consulta = $this->db->prepare($query);
				$consulta->execute(array(':Id' => $idEmployee));

				$tels = array();

				// Create an array with the phones record that we got it
				while($row = $consulta->fetch(PDO::FETCH_ASSOC))
				{
					$tels[] = $row['Tel'];
				}
				
				return $tels;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		// function that returns us the amount of phones record that employee has.
		private function numPhones($idEmployee)
		{
			$query = "SELECT COUNT(*) AS Total FROM Telefono WHERE idEmployee = :idEmp";

			try
			{
				$this->db = database::conexion();

				$consulta = $this->db->prepare($query);
				// Just in case, we pass the parameter with PDO::PARAM_INT
				$consulta->bindValue(':idEmp', $idEmployee, PDO::PARAM_INT);
				$consulta->execute();

				$record = $consulta->fetch(PDO::FETCH_ASSOC);

				$consulta->closeCursor();
				return $record['Total'];
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}

		// function that allows us adds multiple phone record to database
		public function addEmpPhones($idEmployee, $Phones)
		{
			$query = "INSERT INTO Telefono(Tel, idEmployee) VALUES(:Tel, :idEmp)";

			try
			{
				$this->db = database::conexion();

				$consulta = $this->db->prepare($query);

				// Getting the new phone records, then, we have to execute the query multiple times
				foreach ($Phones as $phone) {
					$consulta->execute(array(':Tel' => $phone, ':idEmp' => $idEmployee));
				}

				$consulta->closeCursor();
				return true;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}
	}