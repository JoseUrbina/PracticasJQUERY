<?php
	require "model/Employee.php";
	require "model/Area.php";

	use model\Employee;
	use model\Area;

	class EmployeeController
	{
		private $emp;

		function __construct()
		{
			try
			{
				$this->emp = new Employee();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		public function index()
		{
			try
			{
				$emps = $this->emp->getEmployees();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
			
			require_once "view/Employee/list.php";
		}

		public function edit()
		{	
			$Areas;
			$sEmp;

			try
			{
				$sEmp= new Employee();

				// if id exists , getting record
				if(isset($_GET['id']))
				{
					$sEmp = $sEmp->searchEmp($_GET['id']);
				}
				
				$A = new Area();
				$Areas = $A->getAreas();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}			

			require "view/Employee/edit.php";
		}

		// function that edits or adds an employee record depends on idEmployee field
		public function save()
		{
			try
			{
				$recordEmp = new Employee();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}

			$recordEmp->idEmployee = (int)htmlentities(addslashes($_POST['id']));
			$recordEmp->Name = htmlentities(addslashes($_POST['Name']));
			$recordEmp->Edad = htmlentities(addslashes($_POST['Edad']));
			$recordEmp->idArea = htmlentities(addslashes($_POST['idArea']));

			// if it has some phone record to add else it assigns a new empty array 
			$recordEmp->telefonos = isset($_POST['Telefonos']) ? $_POST['Telefonos'] : array();

			if($recordEmp->uoriEmployee())
			{
				header('location: index.php');
			}
		}

		// function that deletes a employee record
		public function del()
		{
			if(isset($_POST['id']))
			{
				$idEmployee = $_POST['id'];

				if($this->emp->delEmployee($idEmployee))
				{
					header('location:index.php');
				}
			}
		}
	}
?>