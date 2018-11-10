<!DOCTYPE html>
<?php
	if(!isset($_GET["id"]))
	{
		$brand = array("idBrand" => 0,
					   "brandName" => "");
	}
	else
	{
		if(!empty($_GET["id"]))
		{
			require "search.php";
		}
		else{
			header("location:index.php");
		}
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Brand</title>
</head>
<body>
	<form method="post" action="iouData.php">
		<input type="hidden" name="idBrand" 
			   value="<?php echo $brand["idBrand"];?>">
		<label>
			Brand: <input type="text" name="brandName" 
						  value="<?php echo $brand["brandName"];?>">
		</label>
		<input type="submit" value="Save">
	</form>
</body>
</html>