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
	<select name="match_compet" required>
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

	<label>Equipe adverse :</label>
	<input type="text" name="equipe" required><br>

	<label>Date :</label>
	<input type="date" name="date" required><br>

	<label>Horaire :</label>
	<input type="time" name="horaire" required><br>

	<button type="submit" name="match" value="enr_abs">Enregistrer</button>

	</fieldset>
</form>
