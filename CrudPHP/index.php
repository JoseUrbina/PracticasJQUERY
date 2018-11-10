<!DOCTYPE html>
<?php require "list.php";?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>List of Brands</title>
	<style>
		td{
			border: 1px dotted red;
		}

		form{
			display: inline;
		}
	</style>
</head>
<body>
	<a href="edit.php"><button>Add</button></a>
	<hr>
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Brand</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($brands as $brand){?>
				<tr>
					<td><?php echo $brand["idBrand"];?></td>
					<td><?php echo $brand["brandName"];?></td>
					<td>
						<a href="edit.php?id=<?php echo $brand["idBrand"];?>"><button>Edit</button></a>|<form action="delete.php" method="post">
							<input type="hidden" name="id" value="<?php echo $brand["idBrand"];?>">
							<input type="submit" value="Delete">
						</form>
					</td>
				</tr>
			<?php }?>
		</tbody>
	</table>
</body>
</html>