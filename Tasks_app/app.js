$(function(){
	var edit = false;
	$('#task-result').hide();
	fetchTask();

	console.log('JQUERY is working!');

	$('#search').on('keyup',function(event){
		var result = $('#task-result');
		result.hide();

		// si el campo no esta vacio
		if($(this).val())
		{
			let search =  $(this).val();

			$.ajax({
				url: 'task-search.php',
				method: 'POST',
				data: { search }
			})
			.done(function(response, status, jqXHR){
				console.log([status, jqXHR]);

				var template = '';

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

	$('#task-form').on('submit',function(event){
		event.preventDefault();

		const postData = {
			id: $('#taskId').val(),
			name : $('#name').val(),
			description: $('#description').val()
		};

		var url = edit === false ? 'task-add.php' : 'task-edit.php';

		$.post(url, postData)
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);
			debugger;
			fetchTask();
			$('#task-form').trigger('reset');
		})
		.fail(function(jqXHR, status){
			console.log([jqXHR, status]);
		});
	});

	function fetchTask()
	{
		$.get('task-list.php')
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);

			var template = '';

			response.forEach(task => {
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

				alert(response.message);
				fetchTask();
			})
			.fail((jqXHR, status) => {console.log([jqXHR, status])});
		}		
	});

	$(document).on('click','.task-item',function(event){
		event.preventDefault();

		let element = $(this)[0].parentElement.parentElement;
		let id = $(element).attr('taskId');

		$.post('task-single.php', {id})
		.done(function(response, status, jqXHR){
			console.log([status, jqXHR]);

			$('#taskId').val(response.id);
			$('#name').val(response.name);
			$('#description').val(response.description);
			edit = true;
		})
		.fail((jqXHR, status) => {console.log([jqXHR, status])});
	});
});