<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Titre de la page</title>
	<link rel="stylesheet" type="text/css" href="views/stylesheets/style.css">

	<script src="views/scripts_js/match.js" defer></script>
	<script src="views/scripts_js/onglets.js" defer></script>
</head>

<body>
		<div id="barre">
		<table>
			<tr>
				<td class="barre">Club de Sport</td>
                <td><form id="login" method="post"><button name="deco" class="login" type="submit" value="deco">Déconnexion</button></form></td>
			</tr>
		</table>
		</div>

		<div>
		<table class="onglets">
			<tr class="onglets">
				<td class="onglets"></td>
				<td class="accueil">Accueil</td>
				<td class="convocations">Convocations</td>
				<td class="absences">Absences</td>
				<td class="calendrier">Calendrier</td>
				<td class="effectif">Effectif</td>
				<td class="onglets"></td>
			</tr>
		</table>
		</div>

		<div>
		<table class="match">
			<tr class="match">
				<td class="bouton_arriere" rowspan="3"><<</td>
				<td class="match-date" colspan="3">03-01-2021</td>
				<td class="match_date_centre" colspan="3">15-01-2021</td>
				<td class="match-date" colspan="3">20-02-2021</td>
				<td class="bouton_avant" rowspan="3">>></td>
			</tr>

			<tr class="match">
				<td class="match">Cholet</td>
				<td class="tiret"></td>
				<td class="match-droit">Trélazé</td>

				<td class="match_centre">Bouchemaine</td>
				<td class="tiret_centre"></td>
				<td class="match_droit_centre">Saint-Martin</td>

				<td class="match">Ecouflant</td>
				<td class="tiret"></td>
				<td class="match-droit">Candé</td>
			</tr>

			<tr class="match">
				<td class="match">2</td>
				<td class="tiret">-</td>
				<td class="match-droit">1</td>

				<td class="match_centre">0</td>
				<td class="tiret_centre">-</td>
				<td class="match_droit_centre">0</td>

				<td class="match">0</td>
				<td class="tiret">-</td>
				<td class="match-droit">3</td>
			</tr>
		</table>
		</div>

<!-- PAGE ACCUEIL -->

		<div id="accueil">

		<p id="titre">CONVOCATIONS</p>		

		<table>
			<?php

				$convocations = $_SESSION['convocation'];

				foreach($convocations as $record)
				{
					echo "<tr class=\"convocation\">\n\t<td class=\"convocation\">$record[0]</td>\n\t<td class=\"convocation\">\n\t\t<a href=\"views/convocations/$record[0].html\" target=\"_blank\">Convocation du $record[0]</a>\n\t</td>\n\t<td class=\"image\">\n\t\t<a href=\"views/convocations/$record[0].csv\" target=\"_blank\"><img class=\"csv\" src=\"views/images/csv.jpg\"></a>\n\t</td></tr>";
				}
			?>
		</table>
		</div>

<!-- PAGE CONVOCATION -->

		<div id="convocations">
			<form method="post">
				<fieldset>
				<legend>Choisissez la date de rencontre</legend>

				<label>Date :</label>
				<select name="date_rencontre" required>
					<option value="">-- Choisissez une date --</option>

					<?php

					session_start();

					$dates = $_SESSION['date'];
	
					foreach($dates as $record)
					{
						echo "<option value=\"$record[0]\">$record[0]</option>";
					}

					?>
				</select><br>

				<button class="convocations" type="submit" name="selection" value="Sélectionner">Sélectionner</button>

				</fieldset>
			</form>
		</div>

<!-- PAGE ABSENCE -->

		<div id="absences">

			<form method="post">
				<fieldset>
				<legend>Enregistrer une absence</legend>

				<label>Joueur :</label>
				<select name="joueur_abs">
					<option value="">-- Choisissez un joueur --</option>
	
					<?php

					session_start();
	
					$joueurs = $_SESSION['joueurs_presents'];
	
					foreach($joueurs as $record)
					{
						echo "<option value=\"$record[0] $record[1]\">$record[0] $record[1]</option>";
					}
		
					?>	

				</select><br>

				<label>Raison :</label>
				<select name="raison_abs">
					<option value="">-- Choisissez une raison --</option>
					<option value="Absent">Absent</option>
					<option value="Blesse">Blessé</option>
					<option value="Suspendu">Suspendu</option>
					<option value="Sans licence">Sans licence</option>
				</select><br>

				<button type="submit" name="abs" value="enr_abs">Enregistrer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Retirer un joueur de la liste des absences</legend>

				<label>Liste des joueurs absents :</label>
				<select name="retirer_abs">
					<option value="">-- Choisissez un joueur --</option>

					<?php
	
					session_start();
	
					$joueurs = $_SESSION['absents'];
	
					foreach($joueurs as $record)
					{
						echo "<option value=\"$record[0] $record[1]\">$record[0] $record[1]</option>";
					}
		
					?>	

				</select><br>

				<button type="submit" name="abs" value="supp_abs">Supprimer</button>

				</fieldset>
			</form>

			<hr>

			<p id="titre">JOUEURS ABSENTS</p>

			<table>
				<tr>
					<th class="effectifs">Nom</th>
					<th class="effectifs">Prénom</th>
					<th class="effectifs">Raison</th>
				</tr>

				<?php

				$joueurs = $_SESSION['absents'];

				foreach($joueurs as $record)
				{
					echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td><td class=\"effectifs\">$record[2]</td></tr>";
				}

				?>
			</table>
		</div>

<!-- PAGE CALENDRIER -->

		<div id="calendrier">

			<form method="post">
				<fieldset>
				<legend>Enregistrer une nouvelle compétition</legend>

				<label>Nom :</label>
				<input type="text" name="compet_ajout" required><br>

  			      <button name="compet" type="submit" value="Enregistrer">Enregistrer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Supprimer une compétition</legend>

				<label>Liste des compétitions :</label>
				<select name="compet_retrait" required>
					<option value="">-- Choisissez une compétition --</option>

					<?php

					session_start();

					$competitions = $_SESSION['competition'];

					foreach($competitions as $record)
					{
						echo "<option value=\"$record[0]\">$record[0]</option>";
					}
	
					?>
				</select><br>

       			 	<button name="compet" type="submit" value="Supprimer">Supprimer</button>

				</fieldset>
			</form>

			<hr>

			<form method="post">
				<fieldset>
				<legend>Enregistrer un nouveau match</legend>

				<label>Compétition :</label>
				<select name="compet_match" required>
					<option value="">-- Choisissez une compétition --</option>

					<?php

					session_start();

					$competitions = $_SESSION['competition'];

					foreach($competitions as $record)
					{
						echo "<option value=\"$record[0]\">$record[0]</option>";
					}
	
					?>
				</select><br>

				<label>Liste des équipes :</label>
				<select name="equipe_match" required>
					<option value="">-- Choisissez une équipe --</option>

					<?php

					session_start();

					$equipes = $_SESSION['equipes'];

					foreach($equipes as $record)
					{
						echo "<option value=\"$record[0]-$record[1]\">$record[0]-$record[1]</option>";
					}
	
					?>
				</select><br>

				<label>Equipe adverse :</label>
				<input type="text" name="adv_match" required><br>

				<label>Date :</label>
				<input type="date" name="date_match" required><br>

				<label>Horaire :</label>
				<input type="time" name="horaire_match" required><br>

				<button type="submit" name="match" value="Enregistrer">Enregistrer</button>

				</fieldset>
			</form>

			<form method="post" enctype="multipart/form-data">
				<fieldset>
				<legend>Enregistrer plusieurs matchs via un fichier .csv</legend>

				<label>Choisir un fichier :</label>
				<input type="file" name="fichier" /><br>

   				<button name="match" type="submit" value="Enregistre-plusieurs">Enregistrer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Supprimer un match</legend>

				<label>Liste des matchs :</label>
				<select name="match_retrait" required>
					<option value="">-- Choisissez un match --</option>

					<?php

					session_start();

					$matchs = $_SESSION['match'];

					foreach($matchs as $record)
					{
						echo "<option value=\"$record[2]-$record[1]-$record[3]-$record[4]-$record[0]\">$record[2] $record[1] - $record[3] / $record[4] - $record[0]</option>";
					}
	
					?>
				</select><br>

   				<button name="match" type="submit" value="Supprimer">Supprimer</button>

				</fieldset>
			</form>

			<hr>

			<p id="titre">MATCHS</p>

			<table>
				<tr>
					<th class="effectifs">Compétition</th>
					<th class="effectifs">Equipe domicile</th>
					<th class="effectifs">Equipe adverse</th>
					<th class="effectifs">Date</th>
					<th class="effectifs">Heure</th>
					<th class="effectifs">Site</th>
					<th class="effectifs">Terrain</th>
				</tr>

				<?php

				$matchs = $_SESSION['match'];

				foreach($matchs as $record)
				{
					echo "<tr><td class=\"effectifs\">$record[2]</td><td class=\"effectifs\">$record[3] - $record[1]</td><td class=\"effectifs\">$record[4]</td><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[5]</td><td class=\"effectifs\">$record[6]</td><td class=\"effectifs\">$record[7]</td></tr>";
				}

				?>
			</table>
		</div>

<!-- PAGE EFFECTIF -->

		<div id="effectif">

			<form method="post">
				<fieldset>
				<legend>Enregistrer un nouveau joueur</legend>

				<label>Nom :</label>
				<input type="text" name="nom_ajout" required><br>

				<label>Prénom :</label>
				<input type="text" name="prenom_ajout" required><br>

				<label>Catégorie :</label>
				<select name="categorie_ajout" required>
					<option value="">-- Choisissez une catégorie --</option>

					<?php

					session_start();

					$categories = $_SESSION['categorie'];
		
					foreach($categories as $record)
					{
						echo "<option value=\"$record[0]\">$record[0]</option>";
					}
	
					?>
				</select><br>

				<label>Licence : Oui </label>
				<input type="radio" name="licence_ajout" value="oui" checked>
				<label>Non</label>
				<input type="radio" name="licence_ajout" value="non">
				<br>

        			<button name="eff" type="submit" value="Enregistrer">Enregistrer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Changer un joueur de catégorie</legend>

				<label>Liste des joueurs :</label>
				<select name="nom_changement" required>
					<option value="">-- Choisissez un joueur --</option>

					<?php

					session_start();

					$joueurs = $_SESSION['joueurs'];

					foreach($joueurs as $record)
					{
						echo "<option value=\"$record[0] $record[1]\">$record[0] $record[1]</option>";
					}
	
					?>
				</select><br>

				<label>Catégorie :</label>
				<select name="categorie_changement" required>
					<option value="">-- Choisissez une catégorie --</option>

					<?php

					session_start();

					$categories = $_SESSION['categorie'];

					foreach($categories as $record)
					{
						echo "<option value=\"$record[0]\">$record[0]</option>";
					}
	
					?>
				</select><br>

        			<button name="eff" type="submit" value="Changer">Changer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Supprimer un joueur</legend>

				<label>Liste des joueurs :</label>
				<select name="nom_retrait">
					<option value="">-- Choisissez un joueur --</option>

					<?php

					session_start();

					$joueurs = $_SESSION['joueurs'];

					foreach($joueurs as $record)
					{
						echo "<option value=\"$record[0] $record[1]\">$record[0] $record[1]</option>";
					}
	
					?>
				</select><br>

        			<button name="eff" type="submit" value="Supprimer">Supprimer</button>

				</fieldset>
			</form>

			<hr>

			<form method="post">
				<fieldset>
				<legend>Créer une nouvelle équipe</legend>

				<label>Nom :</label>
				<input type="text" name="equipe_ajout" required><br>

				<label>Catégorie :</label>
				<input type="text" name="cat_ajout" required><br>

        			<button name="equipe" type="submit" value="Créer">Créer</button>

				</fieldset>
			</form>

			<form method="post">
				<fieldset>
				<legend>Supprimer une équipe</legend>

				<label>Liste des équipes :</label>
				<select name="equipe_retrait" required>
					<option value="">-- Choisissez une équipe --</option>

					<?php

					session_start();

					$equipes = $_SESSION['equipes'];

					foreach($equipes as $record)
					{
						echo "<option value=\"$record[0]-$record[1]\">$record[0]-$record[1]</option>";
					}
	
					?>
				</select><br>

        			<button name="equipe" type="submit" value="Supprimer">Supprimer</button>

				</fieldset>
			</form>

			<hr>

			<p id="titre">JOUEURS</p>

			<table>
				<tr>
					<th class="effectifs">Nom</th>
					<th class="effectifs">Prénom</th>
					<th class="effectifs">Licence</th>
					<th class="effectifs">Catégorie</th>
				</tr>

				<?php

				$joueurs = $_SESSION['joueurs'];

				foreach($joueurs as $record)
				{
					echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td><td class=\"effectifs\">$record[2]</td><td class=\"effectifs\">$record[3]</td></tr>";
				}

				?>
			</table>
		</div>
</body>
</html>
