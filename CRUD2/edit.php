<!DOCTYPE html>
<?php
	require 'config.php';

	$con = new mysqli(dbHost, dbUser, dbPwd);

	if($con->connect_errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db(dbName) or die("NOT DB");
	$con->set_charset(dbCharset);

	$id = htmlentities(addslashes($_GET['id']));

	$query = "SELECT * FROM PERSONA WHERE Id = ?";

	$result = $con->prepare($query);
	$result->bind_param('i', $id);
	$result->execute();

	$result->bind_result($Id, $Name, $Phone, $Address, $Email);
	$result->fetch();

	$result->close();
	$con->close();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
</head>
<body>
	<form method="POST" action="save.php?a=edit">
		<input type="hidden" name="Id" value="<?php echo $Id;?>">
		<label>
			Name: <input type="text" name="Name" value="<?php echo $Name;?>">
		</label><br><br>
		<label>
			Phone: <input type="number" name="Phone" value="<?php echo $Phone;?>">
		</label><br><br>
		<label>
			Address: <textarea name="Address" rows="4" cols="20"><?php echo $Address;?></textarea>
		</label><br><br>
		<label>
			Email: <input type="text" name="Email" value="<?php echo $Email;?>">
		</label><br><br>
		<input type="submit" name="Save" value="Save">
	</form>
</body>
</html>