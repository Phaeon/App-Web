<?php

require_once 'models/Model.php';

class ConvocModel extends Model {
    
    public function insertNewConvoc($dateMatch, $categorie, $compet, $equipeAdv, $site, $terrain, $heure, $rdv='', $equipe) {
        $sql = "INSERT INTO Matchs VALUES (TO_DATE('$dateMatch', 'DD/MM/YYYY'), '$categorie', '$compet', '$equipeAdv', '$site', '$terrain', '$heure', '$rdv', '$equipe')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Convocation a été créée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
    }
    
    public function removeConvoc($dateMatch, $categorie, $compet, $equipeAdv, $heure, $equipe) {
        $sql = "DELETE FROM Convocations WHERE date_m = '$dateMatch' AND categorie = '$categorie' AND competition = '$compet' AND equipe_adv = '$equipeAdv' AND heure = '$heure' AND equipe = '$equipe'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Convocation a été supprimée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
    }
    
}

?>