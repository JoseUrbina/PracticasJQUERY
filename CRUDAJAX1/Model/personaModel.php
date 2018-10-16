<?php 
	header("Content-Type: application/json");
	require_once "database.php";

	class personaModel
	{
		public $Id;
		public $Name;
		public $Phone;
		public $Address;
		public $Email;

		private $db;
		private $query = '';
		private $response = array('message' => '', 'status' => false);

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

		public function ListPeople()
		{
			try
			{
				$this->query = 'SELECT * FROM PERSONA';

				$consulta = $this->db->prepare($this->query);
				$consulta->execute();

				$people = $consulta->fetchAll(PDO::FETCH_OBJ);
				$consulta->closeCursor();

				echo json_encode($people, JSON_OBJECT_AS_ARRAY);
			}
			catch(Exception $e)
			{
				echo json_encode(array('message' => $e->getMessage(), 'status' => false)
							     , JSON_FORCE_OBJECT);
			}			
		}

		public function findPerson($Id)
		{
			try
			{
				$this->query = "SELECT * FROM PERSONA WHERE Id = :Id";
				$consulta = $this->db->prepare($this->query);
				$consulta->execute(array(':Id' => $Id));

				$person = new personaModel();

				if($consulta->rowCount() > 0)
				{
					$person = $consulta->fetch(PDO::FETCH_OBJ);
				}				

				echo json_encode($person, JSON_FORCE_OBJECT);
			}
			catch(Exception $e)
			{
				echo json_encode(array('message' => $e->getMessage(), 'status' => false)
							     ,JSON_FORCE_OBJECT);
			}	
		}

		public function addOrEdit(personaModel $person)
		{
			if($person->Id == 0)
			{
				$this->query ="INSERT INTO PERSONA(Name, Phone, Address, Email)
							   VALUES(:Name, :Phone, :Address, :Email)";
			}
			else
			{
				
				$this->query = "UPDATE PERSONA SET Name = :Name, Phone = :Phone,
								Address = :Address, Email = :Email WHERE Id = :Id";
			}

			try
			{
				$consulta =  $this->db->prepare($this->query);

				$consulta->bindValue(':Name', $person->Name);
				$consulta->bindValue(':Phone', $person->Phone);
				$consulta->bindValue(':Address', $person->Address);
				$consulta->bindValue(':Email', $person->Email);

				($person->Id != 0) ? $consulta->bindValue(':Id', $person->Id):'';

				$consulta->execute();

				if($consulta->rowCount())
				{
					$this->response['message'] = "Operation performs successful";
				}
				else
				{
					$this->response['message'] = "Record has been found";
				}

				$this->response['status'] = true;
				$consulta->closeCursor();

				echo json_encode($this->response, JSON_FORCE_OBJECT);
			}
			catch(Exception $e)
			{
				echo json_encode(array('message' => $e->getMessage(), 'status' => false)
								, JSON_FORCE_OBJECT);
			}			
		}

		public function deletePerson($Id)
		{
			try
			{
				$this->query = "DELETE FROM PERSONA WHERE Id = :Id";

				$consulta = $this->db->prepare($this->query);
				$consulta->bindValue(':Id', $Id);
				$consulta->execute();

				if($consulta->rowCount())
				{
					$this->response['message'] = "Record deleted correctly";
				}
				else
				{
					$this->response['message'] = "Record has been found";
				}

				$this->response['status'] = true;
				$consulta->closeCursor();

				echo json_encode($this->response, JSON_FORCE_OBJECT);
			}
			catch(Exception $e)
			{
				echo json_encode(array('message' => $e->getMessage(), 'status' => false)
							     ,JSON_FORCE_OBJECT);
			}			
		}
	}

?>