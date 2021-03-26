<?php 
$this->title = "Site du FC Belle-Beille - Admin";

$this->scripts = "" ?>


<div id="barre">
    <table>
        <tr>
            <td>FC Belle-Beille</td>
            <td>
                <form name="login" method="post" id="login">
                    <label for="user">Identifiant : </label>
                    <input class="login" type="text" name="user">

                    <label for="password">Mot de passe : </label>
                    <input class="login" type="password" name="password">

                    <button class="login" type="submit" value="Connexion">Connexion</button>
                </form>
            </td>
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
