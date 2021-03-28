<?php 
$this->title = "Site du FC Belle-Beille - Admin";

$this->scripts = "<script src=\"views/scripts_js/onglets_convoc.js\" defer></script>
	<script src=\"views/scripts_js/convocation.js\" defer></script>"; ?>


<div id="barre">
    <table>
        <tr>
            <td class="barre">FC Belle-Beille</td>
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


<?php
$matchs = $_SESSION['match'];

$tableau = "";

foreach($matchs as $match)
{
    $tab_match = "['$match[0]','$match[3]','$match[1]','$match[4]']";
    if($tableau == "")
    {
        $tableau = $tab_match;
    }
    else
    {
        $tableau = $tableau.",".$tab_match;
    }
}

$tableau = "[".$tableau."]";

echo "<script> let matchs = $tableau;</script>";
?>

<div>
    <table class="match">
        <tr class="match">
            <td class="bouton_arriere" rowspan="3"><<</td>
            <td class="match-date" colspan="3"><?php if(count($_SESSION['match']) >= 1){$match1 = $_SESSION['match'][0]; echo "$match1[0]";} ?></td>
            <td class="match_date_centre" colspan="3"><?php if(count($_SESSION['match']) >= 2){$match2 = $_SESSION['match'][1]; echo "$match2[0]";} ?></td>
            <td class="match-date" colspan="3"><?php if(count($_SESSION['match']) >= 3){$match3 = $_SESSION['match'][2]; echo "$match3[0]";} ?></td>
            <td class="bouton_avant" rowspan="3">>></td>
        </tr>

        <tr class="match">
            <td class="match"><?php if(count($_SESSION['match']) >= 1){$match1 = $_SESSION['match'][0]; echo "$match1[3] - $match1[1]";} ?></td>
            <td class="tiret"></td>
            <td class="match-droit"><?php if(count($_SESSION['match']) >= 1){$match1 = $_SESSION['match'][0]; echo "$match1[4]";} ?></td>

            <td class="match_centre"><?php if(count($_SESSION['match']) >= 2){$match2 = $_SESSION['match'][1]; echo "$match2[3] - $match2[1]";} ?></td>
            <td class="tiret_centre"></td>
            <td class="match_droit_centre"><?php if(count($_SESSION['match']) >= 2){$match2 = $_SESSION['match'][1]; echo "$match2[4]";} ?></td>

            <td class="match"><?php if(count($_SESSION['match']) >= 3){$match3 = $_SESSION['match'][2]; echo "$match3[3] - $match3[1]";} ?></td>
            <td class="tiret"></td>
            <td class="match-droit"><?php if(count($_SESSION['match']) >= 3){$match3 = $_SESSION['match'][2]; echo "$match3[4]";} ?></td>
        </tr>

        <tr class="match">
            <td class="match"><?php if(count($_SESSION['match']) >= 1){$match1 = $_SESSION['match'][0]; echo "$match1[8]";} ?></td>
            <td class="tiret">-</td>
            <td class="match-droit"><?php if(count($_SESSION['match']) >= 1){$match1 = $_SESSION['match'][0]; echo "$match1[9]";} ?></td>

            <td class="match_centre"><?php if(count($_SESSION['match']) >= 2){$match2 = $_SESSION['match'][1]; echo "$match2[8]";} ?></td>
            <td class="tiret_centre">-</td>
            <td class="match_droit_centre"><?php if(count($_SESSION['match']) >= 2){$match2 = $_SESSION['match'][1]; echo "$match2[9]";} ?></td>

            <td class="match"><?php if(count($_SESSION['match']) >= 3){$match3 = $_SESSION['match'][2]; echo "$match3[8]";} ?></td>
            <td class="tiret">-</td>
            <td class="match-droit"><?php if(count($_SESSION['match']) >= 3){$match3 = $_SESSION['match'][2]; echo "$match3[9]";} ?></td>
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

<!-- PAGE CONVOCATIONS -->

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

    <form method="post">

        <?php
        if(isset($_SESSION['specific_matchs']))
        {
            $matchs = $_SESSION['specific_matchs'];

            $joueurs = $_SESSION['joueurs_presents'];

            $date = $_POST['date_rencontre'];

            $_SESSION["date_convocation"] = $date;

            $convoc_enregistree = $_SESSION['convoc_enregistree'];

            foreach($matchs as $record)
            {
                echo "<div><fieldset class=\"match\"><legend>$record[2] - $record[3] contre $record[4]</legend>Joueurs disponibles<br><br>";

                foreach($joueurs as $joueur)
                {
                    if($joueur[3] == $record[1])
                    {
                        if( in_array(array("$date","$joueur[0] $joueur[1]","$record[2] : $record[3] contre $record[4]"),$convoc_enregistree) )
                        {
                            echo"<label>$joueur[0] $joueur[1] </label><input type=\"radio\" name=\"$joueur[0]-$joueur[1]\" value=\"$record[2] : $record[3] contre $record[4];Site : $record[6];Terrain : $record[7];Horaire : $record[5]\" checked><br>";
                        }
                        else
                        {
                            echo"<label>$joueur[0] $joueur[1] </label><input type=\"radio\" name=\"$joueur[0]-$joueur[1]\" value=\"$record[2] : $record[3] contre $record[4];Site : $record[6];Terrain : $record[7];Horaire : $record[5]\"><br>";
                        }
                    }
                }

                echo "</fieldset></div>";
            }

            echo "<div><button type=\"submit\" name=\"Publier_convoc\" value=\"Publier\">Publier</button>";
            echo "<button type=\"submit\" name=\"Enregistrer_convoc\" value=\"Enregistrer\">Enregistrer</button></div>";
        }		
        ?>

    </form>

</div>

<!-- PAGE ABSENCES -->

<div id="absences">

    <form method="post">
        <fieldset>
            <legend>Enregistrer une absence</legend>

            <label>Joueur :</label>
            <select name="joueur_abs" required>
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
            <select name="raison_abs" required>
                <option value="">-- Choisissez une raison --</option>
                <option value="Absent">Absent</option>
                <option value="Blesse">Blessé</option>
                <option value="Suspendu">Suspendu</option>
                <option value="Sans licence">Sans licence</option>
            </select><br>

            <label>Date :</label>
            <input type="date" name="date_abs" required><br>

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
            <th class="effectifs">Date</th>
        </tr>

        <?php

        $joueurs = $_SESSION['absents'];

        foreach($joueurs as $record)
        {
            if($record[3] == 'N')
            {
                echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td><td class=\"effectifs\">$record[2]</td><td class=\"effectifs\">En attente de validation</td></tr>";
            }
            else
            {
                echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td><td class=\"effectifs\">$record[2]</td><td class=\"effectifs\">$record[4]</td></tr>";
            }
        }

        ?>
    </table>
</div>

<!-- PAGE CALENDRIER -->

<div id="calendrier">

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

    <hr>

    <p id="titre">EQUIPES</p>

    <table>
        <tr>
            <th class="effectifs">Nom</th>
            <th class="effectifs">Catégorie</th>
        </tr>

        <?php

        $equipes = $_SESSION['equipes'];

        foreach($equipes as $record)
        {
            echo "<tr><td class=\"effectifs\">$record[0]</td><td class=\"effectifs\">$record[1]</td></tr>";
        }

        ?>
    </table><br>

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
