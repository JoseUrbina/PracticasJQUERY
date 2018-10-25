<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cookies</title>
</head>
<body>
	<?php 
		if(!isset($_COOKIE['test']))
		{
	?>
		<a href="newCookie.php"><button>Add</button></a>

		<hr>

		<h3>There isn't any cookie available</h3>
	<?php }
		else{?>
		<a href="destroyCookie.php"><button>Destroy</button></a>

		<hr>

		<h3>There's some cookies available</h3>

		<p>Cookie: <?php echo $_COOKIE['test'];?></p>
	<?php }?>
</body>
</html>