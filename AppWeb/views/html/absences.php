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
