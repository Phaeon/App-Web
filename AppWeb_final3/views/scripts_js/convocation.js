let publier = document.querySelector('button[value=\'Publier\']');
let form = document.querySelector('form');

function nbr_joueurs()
{
    let matchs = document.querySelectorAll('fieldset.match');
    let equipe_valide = true;

    for(let i=0; i<matchs.length;i++)
    {
        let joueurs = matchs[i].querySelectorAll('input');
        let nbr_joueurs_choisis = 0;

        for(let j=0; j<joueurs.length;j++)
        {
            if(joueurs[j].checked)
            {
                nbr_joueurs_choisis++;
            }
        }

        if( (nbr_joueurs_choisis > 14) || (nbr_joueurs_choisis < 11) )
        {
            equipe_valide = false;
            break;
        }
    }

    if(!equipe_valide)
    {
        event.preventDefault();
        alert('Nombre de joueurs invalides pour les équipes');
    }
    else
    {
        form.submit();
    }
}

publier.addEventListener('click',nbr_joueurs);
