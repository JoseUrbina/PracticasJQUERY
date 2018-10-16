$(function(){
	// This varable manages if we edit or not a record
	// this begins with the false value, I used a variable
	// because the page doesn't refresh when we use AJAX
	var edit = false;

	// Begginig the element with the id task-result is hidden
	$('#task-result').hide();
	// we get all record and fill the table
	fetchTask();

	console.log('JQUERY is working!');

	$('#search').on('keyup',function(event){
		var result = $('#task-result');
		result.hide();

		// si el campo no esta vacio
		if($(this).val())
		{
			// Getting the search field value
			let search =  $(this).val();

			$.ajax({
				url: 'task-search.php',
				method: 'POST',
				data: { search }
			})
			.done(function(response, status, jqXHR){
				console.log([status, jqXHR]);

				var template = '';

				// Array - forEach
				response.forEach(task => {
					template += `<li>
						${task.name}
					</li>`;
				});

				$('#container').html(template);
				result.show();
			})
			.fail(function(jqXHR, status){
				console.log([jqXHR, status]);
			});			
		}
	});

	// When submited datas
	$('#task-form').on('submit',function(event){
		event.preventDefault();

		// Create an object with the values
		const postData = {
			id: $('#taskId').val(),
			name : $('#name').val(),
			description: $('#description').val()
		};

		// false: Add True: Edit
		// This variable is send througth th $.post parameter
		var url = edit === false ? 'task-add.php' : 'task-edit.php';

		$.post(url, postData)
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);

			// Refresh data table
			fetchTask();
			// Clean form fields
			$('#task-form').trigger('reset');
		})
		.fail(function(jqXHR, status){
			console.log([jqXHR, status]);
		});
	});

	// Function that gets all task records
	function fetchTask()
	{
		$.get('task-list.php')
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);

			var template = '';

			response.forEach(task => {
				// taskId: Store the id, then we will get with .attr() jquery method
				// It's assigned to tr because this is the father element of td (General td) 
				template += `<tr taskId = "${task.id}">
								<td>${task.id}</td>
								<td>
									<a href="#" class="task-item">${task.name}</a>
								</td>
								<td>${task.description}</td>
								<td>
									<button class="task-delete btn btn-danger">
										Delete
									</button>
								</td>
							  </tr>`;
			});

			$('#tasks').html(template);
		})
		.fail((jqXHR, status) => {console.log([jqXHR, status])});
	}

	// Click botton with class task-delete
	$(document).on('click', '.task-delete', function(event){
		event.preventDefault();

		if(confirm('Are you sure? You want to delete it?'))
		{
			// [0]: selecciono el primer elemento, esto se debe a que retorna un 
			// arreglo de botones, y luego su padre
			var element = $(this)[0].parentElement.parentElement;

			// Al tr se le asigno un atributo llamado taskId: alamacena el valor del Id
			var id = $(element).attr("taskId");

			$.post('task-delete.php', {id})
			.done(function(response, status, jqXHR){
				console.log([status, jqXHR]);

				// Show the response message
				alert(response.message);
				// Refresh data table
				fetchTask();
			})
			.fail((jqXHR, status) => {console.log([jqXHR, status])});
		}		
	});

	// When click element with the class task-item
	$(document).on('click','.task-item',function(event){
		event.preventDefault();

		// we get the parent element of td
		let element = $(this)[0].parentElement.parentElement;
		let id = $(element).attr('taskId');

		// Get a only record with unique Id
		$.post('task-single.php', {id})
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);

			// Fill field with datas
			$('#taskId').val(response.id);
			$('#name').val(response.name);
			$('#description').val(response.description);
			// Change the edit variable value to true : we will edit rigth now 
			edit = true;
		})
		.fail((jqXHR, status) => {console.log([jqXHR, status])});
	});
});