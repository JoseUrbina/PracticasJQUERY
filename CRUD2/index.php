<!DOCTYPE html>
<?php
	require 'config.php';

	$con = new mysqli(dbHost, dbUser, dbPwd);

	if($con->connect_errno)
	{
		die("Error: {$con->error}");
	}

	$con->select_db(dbName) or die("Error DB");
	$con->set_charset(dbCharset);

	$query = "SELECT * FROM PERSONA";

	$results = $con->query($query);

	$result = $con->prepare($query);
	$result->execute();
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<a href="create.php"><button>New</button></a>
	<hr>
	<table>
		<thead>
			<tr>
				<td width="100px">ID</td>
				<td>Name</td>
				<td>Phone</td>
				<td>Address</td>
				<td>Email</td>
				<td width="160px">Action</td>
			</tr>
		</thead>
		<tbody>

			<?php
				$result->bind_result($Id, $Name, $Phone, $Address, $Email);

				while($result->fetch()){
			?>
			
			<tr>
				<td><?php echo $Id;?></td>
				<td><?php echo $Name;?></td>
				<td><?php echo $Phone;?></td>
				<td><?php echo $Address;?></td>
				<td><?php echo $Email;?></td>
				<td>
					<a href="edit.php?id=<?php echo $Id;?>"><button>Edit</button></a> |
					<a href="delete.php?id=<?php echo $Id;?>"><button>Delete</button></a>
				</td>
			</tr>

			<!-- <?php //while($r = $results->fetch_array(MYSQLI_ASSOC)){?>
				<tr>
					<td><?php //echo $r['Id'];?></td>
					<td><?php //echo $r['Name'];?></td>
					<td><?php //echo $r['Phone'];?></td>
					<td><?php //echo $r['Address'];?></td>
					<td><?php //echo $r['Email'];?></td>
					<td></td>
				</tr> -->
			<?php }

				$result->close();
				$con->close();
			?>
		</tbody>
	</table>
</body>
</html>