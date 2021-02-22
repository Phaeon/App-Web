<form method="post">
	<fieldset>
	<legend>Enregistrer une absence</legend>

	<label>Joueur :</label>
	<select name="joueur_abs">
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

	<label>Raison :</label>
	<select name="raison_abs">
		<option value="">-- Choisissez une raison --</option>
		<option value="absent">Absent</option>
		<option value="blesse">Blessé</option>
		<option value="suspendu">Suspendu</option>
		<option value="sans_licence">Sans licence</option>
	</select><br>

	<button type="submit" name="abs" value="enr_abs">Enregistrer</button>
    <button type="submit" name="abs" value="supp_abs">Supprimer</button>


	</fieldset>
</form>

<form method="post">
	<fieldset>
	<legend>Retirer un joueur de la liste des absences</legend>

	<label>Liste des joueurs absents :</label>
	<select name="joueur_abs">
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

	<label>Raison :</label>
	<select name="raison_abs">
		<option value="">-- Choisissez une raison --</option>
		<option value="absent">Absent</option>
		<option value="blesse">Blessé</option>
		<option value="suspendu">Suspendu</option>
		<option value="sans_licence">Sans licence</option>
	</select><br>

	<button type="submit" name="abs" value="enr_abs">Enregistrer</button>
    <button type="submit" name="abs" value="supp_abs">Supprimer</button>


	</fieldset>
</form>
