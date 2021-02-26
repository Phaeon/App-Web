<form method="post">
	<fieldset>
	<legend>Enregistrer un nouveau joueur</legend>

	<label>Nom :</label>
	<input type="text" name="nom_ajout" required><br>

	<label>Prénom :</label>
	<input type="text" name="prenom_ajout" required><br>

	<label>Equipe :</label>
	<select name="equipe_ajout" required>
		<option value="">-- Choisissez une équipe --</option>

		<?php

		session_start();

		$joueurs = $_SESSION['equipes'];

		foreach($joueurs as $record)
		{
			echo "<option value=\"$record[0]-$record[1]\">$record[0]-$record[1]</option>";
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
	<legend>Changer un joueur d'équipe</legend>

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

	<label>Equipe :</label>
	<select name="equipe_changement" required>
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
		<th class="effectifs">Equipe</th>
	</tr>

	<?php

	$joueurs = $_SESSION['joueurs'];

	foreach($joueurs as $record)
	{
		echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td><td class=\"effectifs\">$record[2]</td><td class=\"effectifs\">$record[3] - $record[4]</td></tr>";
	}

	?>
</table>
