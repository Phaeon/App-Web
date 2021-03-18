let curseur = 0;

let bouton_arriere = document.querySelector('.bouton_arriere');
let bouton_avant = document.querySelector('.bouton_avant');

bouton_arriere.addEventListener('click',defilement_arriere);
bouton_avant.addEventListener('click',defilement_avant);

function defilement_arriere()
{
	if(curseur > 0)
	{
		curseur--;

		// on récupère les matchs fond gris

		let td_match_date = document.querySelectorAll('td.match-date');
		let td_match = document.querySelectorAll('td.match');
		let td_tiret = document.querySelectorAll('td.tiret');
		let td_match_droit = document.querySelectorAll('td.match-droit');

		// on récupère les matchs fond blanc

		let td_match_date_centre = document.querySelectorAll('td.match_date_centre');
		let td_match_centre = document.querySelectorAll('td.match_centre');
		let td_tiret_centre = document.querySelectorAll('td.tiret_centre');
		let td_match_droit_centre = document.querySelectorAll('td.match_droit_centre');

		// on change les classes de chaque match pour qu'ils soient de l'autre couleur

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

		// s'il y a deux gris, c'est que c'est le blanc qui est au centre

		if(td_match_date.length == 2)
		{
			// le deuxième gris prend la valeur du blanc, le blanc prend la valeur du premier gris, le premier gris prend la valeur du match précédent qui apparaît

			// on s'occupe d'abord de la date

			let match_precedent_date = matchs[curseur][0];

			td_match_date[1].textContent = td_match_date_centre[0].textContent;
			td_match_date_centre[0].textContent = td_match_date[0].textContent;
			td_match_date[0].textContent = match_precedent_date;

			// ensuite on s'occupe de l'équipe

			let match_precedent_equipe = matchs[curseur][1]+" - "+matchs[curseur][2];

			td_match[1].textContent = td_match_centre[0].textContent;
			td_match_centre[0].textContent = td_match[0].textContent;
			td_match[0].textContent = match_precedent_equipe;

			// ensuite du score de l'équipe
			
			let temp = td_match[3].textContent;

			td_match[3].textContent = td_match_centre[1].textContent;
			td_match_centre[1].textContent = td_match[2].textContent;
			td_match[2].textContent = temp;

			// ensuite de l'adversaire

			let match_precedent_adversaire = matchs[curseur][3];

			td_match_droit[1].textContent = td_match_droit_centre[0].textContent;
			td_match_droit_centre[0].textContent = td_match_droit[0].textContent;
			td_match_droit[0].textContent = match_precedent_adversaire;

			// enfin du score de l'adversaire

			temp = td_match_droit[3].textContent;

			td_match_droit[3].textContent = td_match_droit_centre[1].textContent;
			td_match_droit_centre[1].textContent = td_match_droit[2].textContent;
			td_match_droit[2].textContent = temp;
		}
		else // sinon c'est qu'il y a deux blancs et que le gris est au centre
		{
			let match_precedent_date = matchs[curseur][0];

			td_match_date_centre[1].textContent = td_match_date[0].textContent;
			td_match_date[0].textContent = td_match_date_centre[0].textContent;
			td_match_date_centre[0].textContent = match_precedent_date;

			let match_precedent_equipe = matchs[curseur][1]+" - "+matchs[curseur][2];

			td_match_centre[1].textContent = td_match[0].textContent;
			td_match[0].textContent = td_match_centre[0].textContent;
			td_match_centre[0].textContent = match_precedent_equipe;

			let temp = td_match_centre[3].textContent;

			td_match_centre[3].textContent = td_match[1].textContent;
			td_match[1].textContent = td_match_centre[2].textContent;
			td_match_centre[2].textContent = temp;

			let match_precedent_adversaire = matchs[curseur][3];

			td_match_droit_centre[1].textContent = td_match_droit[0].textContent;
			td_match_droit[0].textContent = td_match_droit_centre[0].textContent;
			td_match_droit_centre[0].textContent = match_precedent_adversaire;

			temp = td_match_droit_centre[3].textContent;

			td_match_droit_centre[3].textContent = td_match_droit[1].textContent;
			td_match_droit[1].textContent = td_match_droit_centre[2].textContent;
			td_match_droit_centre[2].textContent = temp;
		}
	}
}

function defilement_avant()
{
	if( (curseur+3) < matchs.length)
	{
		curseur++;
	
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
			let match_suivant_date = matchs[curseur+2][0];

			td_match_date[0].textContent = td_match_date_centre[0].textContent;
			td_match_date_centre[0].textContent = td_match_date[1].textContent;
			td_match_date[1].textContent = match_suivant_date;
	
			let match_suivant_equipe = matchs[curseur+2][1]+" - "+matchs[curseur][2];

			td_match[0].textContent = td_match_centre[0].textContent;
			td_match_centre[0].textContent = td_match[1].textContent;
			td_match[1].textContent = match_suivant_equipe;

			let temp = td_match[2].textContent;

			td_match[2].textContent = td_match_centre[1].textContent;
			td_match_centre[1].textContent = td_match[3].textContent;
			td_match[3].textContent = temp;

			let match_suivant_adversaire = matchs[curseur+2][3];

			td_match_droit[0].textContent = td_match_droit_centre[0].textContent;
			td_match_droit_centre[0].textContent = td_match_droit[1].textContent;
			td_match_droit[1].textContent = match_suivant_adversaire;

			temp = td_match_droit[2].textContent;

			td_match_droit[2].textContent = td_match_droit_centre[1].textContent;
			td_match_droit_centre[1].textContent = td_match_droit[3].textContent;
			td_match_droit[3].textContent = temp;
		}
		else
		{
			let match_suivant_date = matchs[curseur+2][0];

			td_match_date_centre[0].textContent = td_match_date[0].textContent;
			td_match_date[0].textContent = td_match_date_centre[1].textContent;
			td_match_date_centre[1].textContent = match_suivant_date;

			let match_suivant_equipe = matchs[curseur+2][1]+" - "+matchs[curseur][2];

			td_match_centre[0].textContent = td_match[0].textContent;
			td_match[0].textContent = td_match_centre[1].textContent;
			td_match_centre[1].textContent = match_suivant_equipe;

			let temp = td_match_centre[2].textContent;

			td_match_centre[2].textContent = td_match[1].textContent;
			td_match[1].textContent = td_match_centre[3].textContent;
			td_match_centre[3].textContent = temp;
	
			let match_suivant_adversaire = matchs[curseur+2][3];

			td_match_droit_centre[0].textContent = td_match_droit[0].textContent;
			td_match_droit[0].textContent = td_match_droit_centre[1].textContent;
			td_match_droit_centre[1].textContent = match_suivant_adversaire;

			temp = td_match_droit_centre[2].textContent;

			td_match_droit_centre[2].textContent = td_match_droit[1].textContent;
			td_match_droit[1].textContent = td_match_droit_centre[3].textContent;
			td_match_droit_centre[3].textContent = temp;
		}
	}
}
