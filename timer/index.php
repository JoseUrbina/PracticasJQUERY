<!DOCTYPE html>
<?php require "vendor/autoload.php";?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Practice APP - Timer</title>
</head>
<body>
	<?php
		use App\Producto;

		$producto = new Producto();

		$prods = $producto->getProducto();

		var_dump($prods);
	?>
</body>
</html>