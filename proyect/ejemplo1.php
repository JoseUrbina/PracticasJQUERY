<!DOCTYPE html>
<?php require "vendor/autoload.php"; ?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>JQUERY</title>
	<script src="vendor/components/jquery/jquery.min.js"></script>
</head>
<body>
	<div id="container"></div>
	<script>
		$(function(){
			$('#container').append($(`<h3>Hello WOrld :)</h3>`));
		});
	</script>
</body>
</html>