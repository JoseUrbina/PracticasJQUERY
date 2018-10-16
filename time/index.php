<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>App</title>
</head>
<body>
	<script>
		function getFile()
		{
			var request = new XMLHttpRequest();
			request.open('GET', 'div.php', true);

			request.onload = function()
			{
				if(request.readyState >= 4 && request.readyState < 200)
				{
					var response = request.responseText;

					document.body.insertAdjacentHTML("afterbegin", response);
				}
				else
				{
					console.log('Error');
				}
			}

			request.onerror = () => {console.log('Error')};
			request.send();
		}

		window.onload = getFile();
	</script>
</body>
</html>