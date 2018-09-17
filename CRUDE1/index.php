<!DOCTYPE html>
<?php 
	session_start();
	require_once 'app/nocsrf.php';
 ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
</head>
<body>
	<form method="POST" action="controller/user.php">
		<input type="submit" name="save" value="Save">
		<input type="hidden" name="_token" value="<?php echo nocsrf::generate('_token');?>">
	</form>
</body>
</html>