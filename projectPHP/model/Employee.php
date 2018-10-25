<?php
	namespace model;

	require_once "database.php";
	include "model/Telefono.php";

	// Doesn't matter if both class are the same namespace, always you must declare the use with
	// the namespace assigned previously
	use model\Telefono;
	use model\database;

	// as i am using namespace and use, it's necessary to add the namesapce \PDO : general context
	use \PDO;

	class Employee
	{
		public $idEmployee;
		public $Name;
		public $Edad;
		public $idArea;

		private $db;

		// Empty array to store the phones record of employee
		public $telefonos = [];

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

		// function that gets all employee records
		public function getEmployees()
		{
			$query = "SELECT * FROM Employee";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->execute();

				$Employees = $consulta->fetchAll(PDO::FETCH_OBJ);

				$consulta->closeCursor();
				return $Employees;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}

		// function that allows us to get data about a determinated employee
		public function searchEmp($idEmployee)
		{
			$query = "SELECT * FROM Employee WHERE idEmployee = :id";

			try
			{
				$emps = new Employee();

				$consulta = $this->db->prepare($query);
				$consulta->execute(array(':id' => $idEmployee));

				$emps = $consulta->fetch(PDO::FETCH_OBJ);
				$consulta->closeCursor();

				// Getting the phones record about this employee
				$tel = new Telefono();
				$emps->telefonos = $tel->getEmpTel($emps->idEmployee);

				return $emps;
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		// Function that inserts or edits a row
		public function uoriEmployee()
		{
			if($this->idEmployee > 0)
			{
				$query = "UPDATE Employee SET Name = :name, Edad = :edad, 
						 idArea = :idArea WHERE idEmployee = :id";
			}
			else
			{
				$query = "INSERT INTO Employee(Name, Edad, idArea) VALUES(:name, :edad, :idArea)";
			}

			try
			{
				$consulta = $this->db->prepare($query);

				$consulta->bindValue(":name", $this->Name);
				$consulta->bindValue(":edad", $this->Edad);
				$consulta->bindValue(":idArea", $this->idArea);

				($this->idEmployee > 0) ? $consulta->bindValue(":id", $this->idEmployee) : '';

				if($consulta->execute())
				{
					if($this->idEmployee == 0)
					{
						// lastInsertId() : function of db connection PDO
						$this->idEmployee = $this->db->lastInsertId();
					}

					// First we need to delete the previous phones record
					$tel = new Telefono();
					$tel->delEmpPhones($this->idEmployee);

					// if we get new phone record from the form, we'll add the phones record
					if(count($this->telefonos) > 0)
					{
						$tel->addEmpPhones($this->idEmployee, $this->telefonos);
					}	

					return true;				
				}				
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			finally{
				$this->db = null;
			}
		}

		// Function that allows us delete a Employee record
		public function delEmployee($idEmployee)
		{
			$query = "DELETE FROM Employee WHERE idEmployee = :idEmp";

			try
			{
				$consulta = $this->db->prepare($query);
				$consulta->bindValue(":idEmp", $idEmployee);

				$consulta->execute();

				if($consulta->rowCount())
				{
					$consulta->closeCursor();
					return true;
				}
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