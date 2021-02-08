<?php

require_once('models/Model.php');

class CalendarModel extends Model {
    
    public function insertNewMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heure, $site, $terrain) {
        $sql = "INSERT INTO Matchs VALUES (TO_DATE('$dateMatch', 'DD/MM/YYYY'), '$categorie', '$compet', '$equipe', '$equipeAdv', '$heure', '$site', '$terrain')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Match a été ajouté avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    public function removeMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heure) {
        $sql = "DELETE FROM Matchs WHERE date_m = '$dateMatch' AND categorie = '$categorie' AND competition = '$compet' AND equipe = '$equipe' AND equipe_adv = '$equipeAdv' AND heure = '$heure'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Match a été supprimé avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
}

?>