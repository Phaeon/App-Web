let accueil = document.querySelector('td.accueil');
let convocations = document.querySelector('td.convocations');
let absences = document.querySelector('td.absences');
let calendrier = document.querySelector('td.calendrier');
let effectif = document.querySelector('td.effectif');

accueil.addEventListener("click",page_accueil);

function page_accueil()
{
	accueil.style.backgroundColor = '#9b9b9b';
	convocations.style.backgroundColor = '#d8d8d8';
	absences.style.backgroundColor = '#d8d8d8';
	calendrier.style.backgroundColor = '#d8d8d8';
	effectif.style.backgroundColor = '#d8d8d8';

	let page = new XMLHttpRequest();

	page.onreadystatechange = function()
	{
		if(page.readyState == XMLHttpRequest.DONE)
		{
			document.querySelector('#page').innerHTML = page.responseText;
		}
	}

	page.open("POST","views/html/accueil.html",true);
	page.send();
}

/*****/

convocations.addEventListener("click",page_convocations);

function page_convocations()
{
	accueil.style.backgroundColor = '#d8d8d8';
	convocations.style.backgroundColor = '#9b9b9b';
	absences.style.backgroundColor = '#d8d8d8';
	calendrier.style.backgroundColor = '#d8d8d8';
	effectif.style.backgroundColor = '#d8d8d8';

	let page = new XMLHttpRequest();

	page.onreadystatechange = function()
	{
		if(page.readyState == XMLHttpRequest.DONE)
		{
			document.querySelector('#page').innerHTML = page.responseText;
		}
	}

	page.open("POST","views/html/convocations.html",true);
	page.send();
}

/*****/

absences.addEventListener("click",page_absences);

function page_absences()
{
	accueil.style.backgroundColor = '#d8d8d8';
	convocations.style.backgroundColor = '#d8d8d8';
	absences.style.backgroundColor = '#9b9b9b';
	calendrier.style.backgroundColor = '#d8d8d8';
	effectif.style.backgroundColor = '#d8d8d8';

	let page = new XMLHttpRequest();

	page.onreadystatechange = function()
	{
		if(page.readyState == XMLHttpRequest.DONE)
		{
			document.querySelector('#page').innerHTML = page.responseText;
		}
	}

	page.open("POST","views/html/absences.html",true);
	page.send();
}

/*****/

calendrier.addEventListener("click",page_calendrier);

function page_calendrier()
{
	accueil.style.backgroundColor = '#d8d8d8';
	convocations.style.backgroundColor = '#d8d8d8';
	absences.style.backgroundColor = '#d8d8d8';
	calendrier.style.backgroundColor = '#9b9b9b';
	effectif.style.backgroundColor = '#d8d8d8';

	let page = new XMLHttpRequest();

	page.onreadystatechange = function()
	{
		if(page.readyState == XMLHttpRequest.DONE)
		{
			document.querySelector('#page').innerHTML = page.responseText;
		}
	}

	page.open("POST","views/html/calendrier.html",true);
	page.send();
}

/*****/

effectif.addEventListener("click",page_effectif);

function page_effectif()
{
	accueil.style.backgroundColor = '#d8d8d8';
	convocations.style.backgroundColor = '#d8d8d8';
	absences.style.backgroundColor = '#d8d8d8';
	calendrier.style.backgroundColor = '#d8d8d8';
	effectif.style.backgroundColor = '#9b9b9b';

	let page = new XMLHttpRequest();

	page.onreadystatechange = function()
	{
		if(page.readyState == XMLHttpRequest.DONE)
		{
			document.querySelector('#page').innerHTML = page.responseText;
		}
	}

	page.open("POST","views/html/effectif.html",true);
	page.send();
}