<?php 
	require '../Model/personaModel.php';

	$person = new personaModel();

	if(isset($_REQUEST['p']))
	{
		$page = $_REQUEST['p'];

		if($page == "ae")
		{
			$person->Id = htmlentities(addslashes($_POST['Id']));
			$person->Name = htmlentities(addslashes($_POST['Name']));
			$person->Phone = htmlentities(addslashes($_POST['Phone']));
			$person->Address = htmlentities(addslashes($_POST['Address']));
			$person->Email = htmlentities(addslashes($_POST['Email']));

			$person->addOrEdit($person);
		}
		else if($page == "f")
		{
			$person->findPerson($_GET['Id']);
		}
		else
		{
			$person->deletePerson($_GET['Id']);
		}
	}
	else
	{
		$person->ListPeople();
	}
?>