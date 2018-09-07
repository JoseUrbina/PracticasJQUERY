/* function* generator()
{
	yield "Jose";
	yield "Antonio";
	yield "Peter";
	return "Unknown";
}

var gen = generator();

var i = gen.next();

while(i.value)
{
	console.log(i.value);

	i = gen.next();
} */
var pageCounter = 1;
var animalContainer = document.getElementById('animal-info');
var btn = document.getElementById('btnInfo');

btn.addEventListener('click', function(e){
	var request =  new XMLHttpRequest();

	// you must always think that addres is from beginning
	// 
	// Abrir el request hacia donde queremos enviar o obtener datos
	request.open('GET','json/animals-' + pageCounter + '.json');
	// cuando se obtengan los datos hacer esto
	request.onload = function(){
		if(request.status >= 200 && request.status <= 400)
		{
			// request.responseText: datos devueltos
			var ourData =  JSON.parse(request.responseText);

			renderHTML(ourData);
		}
		else{
			console.log("We connected to the server, but it occurs an error");
		}
		
	};

	request.onerror = function(){
		console.log('Error conection');
	};

	// envio de la peticion para poder obtener los datos a traves del request
	request.send();
	pageCounter++;

	if(pageCounter > 3)
	{
		btn.classList.add('hide-me');
	}
});

function renderHTML(data){
	var htmlString = "";

	for(i=0;i<data.length;i++){
		htmlString += `<p>${data[i].name} is a ${data[i].species} that likes to eat `;

		for(ii=0;ii<data[i].foods.likes.length;ii++)
		{
			if(ii == 0)
			{
				htmlString += data[i].foods.likes[ii];
			}
			else
			{
				htmlString += " and " + data[i].foods.likes[ii];
			}
		}

		htmlString += " and dislikes ";

		for(ii=0;ii<data[i].foods.dislikes.length;ii++)
		{
			if(ii == 0)
			{
				htmlString += data[i].foods.dislikes[ii];
			}
			else
			{
				htmlString += " and " + data[i].foods.dislikes[ii];
			}
		}

		htmlString += `</p>`;
	}

	animalContainer.insertAdjacentHTML('beforeend', htmlString);
}

