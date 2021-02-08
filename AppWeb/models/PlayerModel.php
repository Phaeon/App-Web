<?php

require_once('models/Model.php');

class PlayerModel extends Model {
    
    public function insertAbsentPlayer($nom, $prenom, $dateMatch, $raison, $raisonC) {
        $sql = "INSERT INTO Absences VALUES ('$nom', '$prenom', '$dateMatch', '$raison', '$raisonC')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été ajouté en tant que absent.');</script>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    public function removeAbsentPlayer($nom, $prenom, $dateMatch) {
        $sql = "DELETE FROM Absences WHERE nom = '$nom'' AND prenom = '$prenom' AND date_m = '$dateMatch'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." n'est plus absent.');</script>";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
    }
    
    
    public function newPlayer($nom, $prenom, $licence, $equipe) {
        $sql = "INSERT INTO Effectifs VALUES ('$nom', '$prenom', '$licence', '$equipe')";
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été ajouté.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d'ajouter le joueur.');</script>";
        }
        
    }
    
    public function removePlayer($nom, $prenom) {
        $sql = "DELETE FROM Effectifs WHERE nom = '$nom' AND prenom = '$prenom'";
        
        try {
            $req = $this->executeRequest($sql);
            if ($req->rowCount() > 0) {
                echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été retiré.');</script>";
            } else echo "<script>alert('Erreur: Impossible de retirer le joueur.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de retirer le joueur.');</script>";
        }
        
    }
}

?>