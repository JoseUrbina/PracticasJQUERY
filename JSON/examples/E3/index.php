<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Insert</title>
	<script src="../../../js/jquery.min.js"></script>
	<style>
		table
		{
			margin:auto;
			border: 1px dotted blue;
		}

		.message{
			border: 2px dotted green;
		}
	</style>
</head>
<body>
	<form id="frmInsert" method="POST" enctype="multipart/form-data">
		<table>
			<tr>
				<td>Seccion:</td>
				<td><input type="text" name="seccion" id="seccion"></td>
			</tr>
			<tr>
				<td>Articulo:</td>
				<td><input type="text" name="articulo" id="articulo"></td>
			</tr>
			<tr>
				<td>Imagen:</td>
				<td><input type="file" name="image" id="image"></td>
			</tr>
			<tr>
				<td colspan="2">
					<input type="submit" name="enviar" value="Save">
				</td>
			</tr>
		</table>
	</form>

	<script>
		$(document).ready(function(){
			var form = $('#frmInsert');

			form.on('submit', function(e){
				e.preventDefault();

				var data = new FormData(this);

				var data1 = {
					'seccion': document.getElementById('seccion').value,
					'articulo': document.getElementById('articulo').value,
					'image': document.getElementById('image').files[0]
				};

				$.ajax({
					url: 'insert.php',
					method: 'POST',
					data: data,
					processData: false,
					contentType: false
				})
				.done(function(data, status, jqXHR){
					console.log([status, jqXHR]);
					
					if(data.status)
					{	
						form.hide();
						messageControl(data.message);
					}
				})
				.fail(function(jqXHR, status){
					console.log([jqXHR, status]);
				});
			});

			function messageControl(message)
			{
				var container = `<div class="message">
									<h3>${message}</h3>
								 <div>`;

				// beforeBegin: add before the element 
				document.getElementById('frmInsert')
						.insertAdjacentHTML('beforebegin', container);

				setTimeout(function(){
					$('.message').fadeOut('slow');
					form.show();
				}, 2000);
			}
		});
	</script>
</body>
</html>