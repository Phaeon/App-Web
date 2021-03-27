let btn_accueil = document.querySelector('td.accueil');
let btn_absences = document.querySelector('td.absences');
let btn_calendrier = document.querySelector('td.calendrier');
let btn_effectif = document.querySelector('td.effectif');

let accueil = document.querySelector('#accueil');
let absences = document.querySelector('#absences');
let calendrier = document.querySelector('#calendrier');
let effectif = document.querySelector('#effectif');

/***** Affichage *****/

accueil.hidden = true;
absences.hidden = true;
calendrier.hidden = true;
effectif.hidden = true;

btn_accueil.style.backgroundColor = '#d8d8d8';
btn_absences.style.backgroundColor = '#d8d8d8';
btn_calendrier.style.backgroundColor = '#d8d8d8';
btn_effectif.style.backgroundColor = '#d8d8d8';

/*****/

btn_accueil.addEventListener("click",page_accueil);

function page_accueil()
{
	btn_accueil.style.backgroundColor = '#9b9b9b';
	btn_absences.style.backgroundColor = '#d8d8d8';
	btn_calendrier.style.backgroundColor = '#d8d8d8';
	btn_effectif.style.backgroundColor = '#d8d8d8';
	
	accueil.hidden = false;
	absences.hidden = true;
	calendrier.hidden = true;
	effectif.hidden = true;
}

/*****/

btn_absences.addEventListener("click",page_absences);

function page_absences()
{
	btn_accueil.style.backgroundColor = '#d8d8d8';
	btn_absences.style.backgroundColor = '#9b9b9b';
	btn_calendrier.style.backgroundColor = '#d8d8d8';
	btn_effectif.style.backgroundColor = '#d8d8d8';

	accueil.hidden = true;
	absences.hidden = false;
	calendrier.hidden = true;
	effectif.hidden = true;
}

/*****/

btn_calendrier.addEventListener("click",page_calendrier);

function page_calendrier()
{
	btn_accueil.style.backgroundColor = '#d8d8d8';
	btn_absences.style.backgroundColor = '#d8d8d8';
	btn_calendrier.style.backgroundColor = '#9b9b9b';
	btn_effectif.style.backgroundColor = '#d8d8d8';

	accueil.hidden = true;
	absences.hidden = true;
	calendrier.hidden = false;
	effectif.hidden = true;
}

/*****/

btn_effectif.addEventListener("click",page_effectif);

function page_effectif()
{
	btn_accueil.style.backgroundColor = '#d8d8d8';
	btn_absences.style.backgroundColor = '#d8d8d8';
	btn_calendrier.style.backgroundColor = '#d8d8d8';
	btn_effectif.style.backgroundColor = '#9b9b9b';

	accueil.hidden = true;
	absences.hidden = true;
	calendrier.hidden = true;
	effectif.hidden = false;
}

/*****/
