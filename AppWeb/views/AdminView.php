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

		<div id="page">

		<p id="titre">CONVOCATIONS</p>		

		<table>
			<tr class="convocation">
				<td class="convocation">
					20-02-2021
				</td>
				<td class="convocation">
					Coupe régionale - Martigné VS Segré
				</td>
				<td class="image">
					<img class="pdf" src="pdf.png">
				</td>
			</tr>
			<tr class="convocation">
				<td class="convocation">
					14-03-2021
				</td>
				<td class="convocation">
					Coupe de France - Angers VS Saumur
				</td>
				<td class="image">
					<img class="pdf" src="pdf.png">
				</td>
			</tr>
			<tr class="convocation">
				<td class="convocation">
					26-06-2021
				</td>
				<td class="convocation">
					Coupe départementale - Avrillé VS Briollay
				</td>
				<td class="image">
					<img class="pdf" src="pdf.png">
				</td>
			</tr>
		</table>
		</div>
</body>
</html>