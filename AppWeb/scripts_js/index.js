let bouton_arriere = document.querySelector('.bouton_arriere');
let bouton_avant = document.querySelector('.bouton_avant');

bouton_arriere.addEventListener('click',defilement_arriere);
bouton_avant.addEventListener('click',defilement_avant);

function defilement_arriere()
{
	let td_match_date = document.querySelectorAll('td.match-date');
	let td_match = document.querySelectorAll('td.match');
	let td_tiret = document.querySelectorAll('td.tiret');
	let td_match_droit = document.querySelectorAll('td.match-droit');

	let td_match_date_centre = document.querySelectorAll('td.match_date_centre');
	let td_match_centre = document.querySelectorAll('td.match_centre');
	let td_tiret_centre = document.querySelectorAll('td.tiret_centre');
	let td_match_droit_centre = document.querySelectorAll('td.match_droit_centre');

	for(let i=0; i<td_match_date.length; i++)
	{
		td_match_date[i].className = "match_date_centre";
	}

	for(let i=0;i<td_match.length;i++)
	{
		td_match[i].className = "match_centre";
		td_tiret[i].className = "tiret_centre";
		td_match_droit[i].className = "match_droit_centre";
	}

	for(let i=0; i<td_match_date_centre.length; i++)
	{
		td_match_date_centre[i].className = "match-date";
	}

	for(let i=0;i<td_match_centre.length;i++)
	{
		td_match_centre[i].className = "match";
		td_tiret_centre[i].className = "tiret";
		td_match_droit_centre[i].className = "match-droit";
	}

	if(td_match_date.length == 2)
	{
		let temp = td_match_date[1].textContent;

		td_match_date[1].textContent = td_match_date_centre[0].textContent;
		td_match_date_centre[0].textContent = td_match_date[0].textContent;
		td_match_date[0].textContent = temp;

		temp = td_match[1].textContent;

		td_match[1].textContent = td_match_centre[0].textContent;
		td_match_centre[0].textContent = td_match[0].textContent;
		td_match[0].textContent = temp;

		temp = td_match[3].textContent;

		td_match[3].textContent = td_match_centre[1].textContent;
		td_match_centre[1].textContent = td_match[2].textContent;
		td_match[2].textContent = temp;

		temp = td_match_droit[1].textContent;

		td_match_droit[1].textContent = td_match_droit_centre[0].textContent;
		td_match_droit_centre[0].textContent = td_match_droit[0].textContent;
		td_match_droit[0].textContent = temp;

		temp = td_match_droit[3].textContent;

		td_match_droit[3].textContent = td_match_droit_centre[1].textContent;
		td_match_droit_centre[1].textContent = td_match_droit[2].textContent;
		td_match_droit[2].textContent = temp;
	}
	else
	{
		let temp = td_match_date_centre[1].textContent;

		td_match_date_centre[1].textContent = td_match_date[0].textContent;
		td_match_date[0].textContent = td_match_date_centre[0].textContent;
		td_match_date_centre[0].textContent = temp;

		temp = td_match_centre[1].textContent;

		td_match_centre[1].textContent = td_match[0].textContent;
		td_match[0].textContent = td_match_centre[0].textContent;
		td_match_centre[0].textContent = temp;

		temp = td_match_centre[3].textContent;

		td_match_centre[3].textContent = td_match[1].textContent;
		td_match[1].textContent = td_match_centre[2].textContent;
		td_match_centre[2].textContent = temp;

		temp = td_match_droit_centre[1].textContent;

		td_match_droit_centre[1].textContent = td_match_droit[0].textContent;
		td_match_droit[0].textContent = td_match_droit_centre[0].textContent;
		td_match_droit_centre[0].textContent = temp;

		temp = td_match_droit_centre[3].textContent;

		td_match_droit_centre[3].textContent = td_match_droit[1].textContent;
		td_match_droit[1].textContent = td_match_droit_centre[2].textContent;
		td_match_droit_centre[2].textContent = temp;
	}
}

function defilement_avant()
{
	let td_match_date = document.querySelectorAll('td.match-date');
	let td_match_date_centre = document.querySelectorAll('td.match_date_centre');

	let td_match = document.querySelectorAll('td.match');
	let td_match_centre = document.querySelectorAll('td.match_centre');

	let td_tiret = document.querySelectorAll('td.tiret');
	let td_tiret_centre = document.querySelectorAll('td.tiret_centre');

	let td_match_droit = document.querySelectorAll('td.match-droit');
	let td_match_droit_centre = document.querySelectorAll('td.match_droit_centre');

	for(let i=0; i<td_match_date.length; i++)
	{
		td_match_date[i].className = "match_date_centre";
	}

	for(let i=0;i<td_match.length;i++)
	{
		td_match[i].className = "match_centre";
		td_tiret[i].className = "tiret_centre";
		td_match_droit[i].className = "match_droit_centre";
	}

	for(let i=0; i<td_match_date_centre.length; i++)
	{
		td_match_date_centre[i].className = "match-date";
	}

	for(let i=0;i<td_match_centre.length;i++)
	{
		td_match_centre[i].className = "match";
		td_tiret_centre[i].className = "tiret";
		td_match_droit_centre[i].className = "match-droit";
	}

	if(td_match_date.length == 2)
	{
		let temp = td_match_date[0].textContent;

		td_match_date[0].textContent = td_match_date_centre[0].textContent;
		td_match_date_centre[0].textContent = td_match_date[1].textContent;
		td_match_date[1].textContent = temp;

		temp = td_match[0].textContent;

		td_match[0].textContent = td_match_centre[0].textContent;
		td_match_centre[0].textContent = td_match[1].textContent;
		td_match[1].textContent = temp;

		temp = td_match[2].textContent;

		td_match[2].textContent = td_match_centre[1].textContent;
		td_match_centre[1].textContent = td_match[3].textContent;
		td_match[3].textContent = temp;

		temp = td_match_droit[0].textContent;

		td_match_droit[0].textContent = td_match_droit_centre[0].textContent;
		td_match_droit_centre[0].textContent = td_match_droit[1].textContent;
		td_match_droit[1].textContent = temp;

		temp = td_match_droit[2].textContent;

		td_match_droit[2].textContent = td_match_droit_centre[1].textContent;
		td_match_droit_centre[1].textContent = td_match_droit[3].textContent;
		td_match_droit[3].textContent = temp;
	}
	else
	{
		let temp = td_match_date_centre[0].textContent;

		td_match_date_centre[0].textContent = td_match_date[0].textContent;
		td_match_date[0].textContent = td_match_date_centre[1].textContent;
		td_match_date_centre[1].textContent = temp;

		temp = td_match_centre[0].textContent;

		td_match_centre[0].textContent = td_match[0].textContent;
		td_match[0].textContent = td_match_centre[1].textContent;
		td_match_centre[1].textContent = temp;

		temp = td_match_centre[2].textContent;

		td_match_centre[2].textContent = td_match[1].textContent;
		td_match[1].textContent = td_match_centre[3].textContent;
		td_match_centre[3].textContent = temp;

		temp = td_match_droit_centre[0].textContent;

		td_match_droit_centre[0].textContent = td_match_droit[0].textContent;
		td_match_droit[0].textContent = td_match_droit_centre[1].textContent;
		td_match_droit_centre[1].textContent = temp;

		temp = td_match_droit_centre[2].textContent;

		td_match_droit_centre[2].textContent = td_match_droit[1].textContent;
		td_match_droit[1].textContent = td_match_droit_centre[3].textContent;
		td_match_droit_centre[3].textContent = temp;
	}
}