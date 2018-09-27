<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Index</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
</head>
<body>
	<div class="container" style="padding-top: 10px;">
		<button class="btn btn-primary" id="btnAdd">Add</button>
		<hr>

		<table class="table table-bordered" id="tabla">
			<thead>
				<tr>
					<th width="40px">ID</th>
					<th>Name</th>
					<th>Phone</th>
					<th>Address</th>
					<th>Email</th>
					<th width="140px">Action</th>
				</tr>
			</thead>
			<tbody id="ttbody"></tbody>
		</table>
	</div>	

	<!-- Modal para editar o agregar datos-->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" 
							aria-label="close"><span aria-hidden="true">&times;
					</span></button>
					<h4 class="modal-title" id="Title"></h4>
				</div>
				<div class="modal-body">
					<form method="POST" id="frmAE" class="form-horizontal">
						<input type="hidden" name="Id" id="Id" value="0">
						<div class="form-group">
							<label class="col-md-2" for="name">Name:</label>
							<div class="col-md-10">
								<input type="text" name="name" id="name" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2" for="phone">Phone:</label>
							<div class="col-md-10">
								<input type="text" name="phone" id="phone" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2" for="Address">Address:</label>
							<div class="col-md-10">
								<input type="text" name="address" id="address" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-2" for="Email">Email:</label>
							<div class="col-md-10">
								<input type="text" name="email" id="email" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-offset-2 col-md-10">
								<input type="button" class="btn btn-primary" 
										id="btnSave" value="Save">
								<input type="button" class="btn btn-default" data-dismiss="modal" value="Exit" >
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<script src="js/bootstrap.min.js"></script>

	<script>
		$(document).ready(function(){

			document.getElementById('btnAdd').addEventListener('click', function(event){
				event.preventDefault();
				findProduct(0);
			});

			document.getElementById('tabla').addEventListener('click',function(event){
				var element = event.target;

				// SI se dio click dentro de la tabla a uno de los botones
				if(element.classList.contains('btn'))
				{
					var father = element.parentElement.parentElement;

					var Id = parseInt(father.cells[0].innerHTML);

					if(element.id === "btnEdit")
					{
					    findProduct(Id);
					}
					else
					{
						delProduct(Id);
					}
				}
			});

			document.getElementById('btnSave').addEventListener('click',function(event){
				event.preventDefault();

				// Creando un objeto de datos
				var data = {
					"Id": parseInt(document.getElementById('Id').value),
					"Name": document.getElementById('name').value,
					"Phone": document.getElementById('phone').value,
					"Address": document.getElementById('address').value,
					"Email": document.getElementById('email').value,
					"p": "ae"
				};

				addOrEdit(data);
			});

			function addOrEdit(data)
			{
				// var datas  = $.param(data);

				// Object.keys = return an keys array, map does the operation
				// and then creating a string with &
				var datas = Object.keys(data).map(key => key + '=' + data[key]).join("&");

				//console.log(datas);

				var request = new XMLHttpRequest();
				request.open('POST', 'Controller/personaController.php');

				request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

				request.onload = function(){
					if(request.readyState == 4 || request.readyState == 200)
					{
						var response = JSON.parse(request.responseText);

						alert(response.message);
						$('#myModal').modal('hide');
						ListProducts();
					}
					else
					{
						console.log('ERROR!!');
					}
				}

				request.onerror = function()
				{
					console.log('Error!!!');
				}

				request.send(datas);

				/* $.post('Controller/personaController.php', data)
				.done(function(data, status, jqXHR){
					alert(data.message);
					$('#myModal').modal('hide');
					ListProducts();
				})
				.fail(function(jqXHR, status)
				{
					console.log([jqXHR, status]);
				}); */
			}

			function findProduct(Id)
			{
				document.getElementById('frmAE').reset();

				if(Id == 0)
				{
					$('#Id').val(0);
					$('#myModal').modal('show');
				}
				else
				{
					debugger;
					var req = new XMLHttpRequest();
					var param = '?p=f&Id=' + Id;

					req.open("GET", 'Controller/personaController.php' + param, true);
					//req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
					req.onload = function(){
						if(req.readyState == 4 || req.readyState == 200)
						{
							var data =  JSON.parse(req.responseText);
							$('#Id').val(data.Id);
							$('#name').val(data.Name);
							$('#phone').val(data.Phone);
							$('#address').val(data.Address);
							$('#email').val(data.Email);

							$('#myModal').modal('show'); 
						}
						else
						{
							console.log('ERROR!!');
						}
					}

					req.onerror = function(){
						console.log('ERROR!!')
					}

					req.send();

					/* $.get('Controller/personaController.php', {
						"p":"f",
						"Id": Id
					})
					.done(function(data, status, jqXHR){
						console.log([status, jqXHR]);

						$('#Id').val(data.Id);
						$('#name').val(data.Name);
						$('#phone').val(data.Phone);
						$('#address').val(data.Address);
						$('#email').val(data.Email);

						$('#myModal').modal('show');
					})
					.fail(function(jqXHR, status){
						console.log([jqXHR, status]);
					}); */
				}
			}			

			function delProduct(Id)
			{
				var request = new XMLHttpRequest();

				var data = '?p=d&Id=' + Id;

				// con get se debe concatenar los valores a la URL
				request.open('GET', 'Controller/personaController.php' + data, true);

				request.onload =  function()
				{
					if(request.readyState == 4 || request.readyState == 200)
					{
						var data = JSON.parse(request.responseText);

						alert(data.message);
						ListProducts();
					}
					else
					{
						console.log('It happened an error');
					}
				}

				request.onerror =  function(){
					console.log('It\'s alreadey happened an error');
				}

				request.send();

				/* $.get('Controller/personaController.php', {"p": "d" ,"Id" : Id})
				.done(function(data, status, jqXHR){
					console.log([status, jqXHR]);
					alert(data.message);
					ListProducts();
				})
				.fail(function(jqXHR, status){
					console.log([jqXHR, status]);
				}); */
			}

			function ListProducts()
			{
				/* $.ajax({method:'GET', url:'Controller/personaController.php'})
				.done(function(data, status, jqXHR){
					console.log([status, jqXHR]);

					// debugger;
					var large = data.length;
					var tbody = document.getElementById('ttbody');					

					if(large)
					{
						var elements = '';
						

						for(var i=0;i<large;i++)
						{
							elements += `<tr>
											<td>${data[i].Id}</td><td>${data[i].Name}</td>
											<td>${data[i].Phone}</td><td>${data[i].Address}</td>
											<td>${data[i].Email}</td>
											<td>
											<input type="button" class="btn btn-info" 
												id="btnEdit" value="Edit">
											<input type="button" class="btn btn-danger" 
											 	id="btnDelete" value="Delete">	
											</td>
										</tr>`;
						}

						tbody.innerHTML = elements;
					}
					else
					{
						tbody.innerHTML = '';
					}
					
				})
				.fail(function(jqXHR, status){
					console.log([jqXHR, status]);
				}); */

				var req = new XMLHttpRequest();

				req.open('GET', 'Controller/personaController.php');

				req.onload = function()
				{
					var data = JSON.parse(req.responseText);

					// debugger;
					var large = data.length;
					var tbody = document.getElementById('ttbody');					

					if(large)
					{
						var elements = '';						

						for(var i=0;i<large;i++)
						{
							elements += `<tr>
											<td>${data[i].Id}</td><td>${data[i].Name}</td>
											<td>${data[i].Phone}</td><td>${data[i].Address}</td>
											<td>${data[i].Email}</td>
											<td>
											<input type="button" class="btn btn-info" 
												id="btnEdit" value="Edit">
											<input type="button" class="btn btn-danger" 
											 	id="btnDelete" value="Delete">	
											</td>
										</tr>`;
						}

						tbody.innerHTML = elements;
					}
					else
					{
						tbody.innerHTML = '';
					}
				}

				req.onerror = function(){
					console.log('It\'s happenend an error');
				}

				req.send();
			}

			window.onload = ListProducts();
		});
	</script>
</body>
</html>