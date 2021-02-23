<?php

require_once('models/Model.php');

class PlayerModel extends Model {
    
    public function insertAbsentPlayer($nom, $prenom, $raison, $raisonC) {
        $sql = "INSERT INTO Absences VALUES ('$nom', '$prenom', '$raison', '$raisonC')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a été ajouté en tant qu\'absent.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d'ajouter le joueur en tant qu\'absent.');</script>";
        }
        
    }
    
    public function removeAbsentPlayer($nom, $prenom) {
        $sql = "DELETE FROM Absences WHERE nom = '$nom' AND prenom = '$prenom'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." n\'est plus absent.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de retirer le joueur des absents.');</script>";
        }
        
    }
    
    
    public function newPlayer($nom, $prenom, $licence, $equipe, $categorie) {
        $sql = "INSERT INTO Effectifs VALUES ('$nom', '$prenom', '$licence', '$equipe','$categorie')";

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

    public function changePlayer($nom, $prenom, $equipe, $categorie) {
        $sql = "UPDATE Effectifs SET nom_equipe = '$equipe', categorie = '$categorie' WHERE nom = '$nom' AND prenom = '$prenom'";

        try {
            $req = $this->executeRequest($sql);
            if ($req->rowCount() > 0) {
                echo "<script>alert('Joueur ".ucfirst(strtolower($nom))." ".ucfirst(strtolower($prenom))." a changé d\'équipe.');</script>";
            } else echo "<script>alert('Erreur: Impossible de changer le joueur d'équipe.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible de changer le joueur d'équipe.');</script>";
        } 
    }

    public function getPlayer() {
	$sql = "SELECT * FROM Effectifs";

	try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir le joueur.');</script>";
        }

	return $req;
    }

    public function getTeam() {
	$sql = "SELECT nom_equipe,categorie FROM Equipes";

	try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir les équipes.');</script>";
        }

	return $req;
    }

    public function getAbsent() {
	$sql = "SELECT * FROM Absences";

	try {
            $req = $this->executeRequest($sql);
        } catch (Exception $e) {
            echo "<script>alert('Erreur: Impossible d\'avoir les absents.');</script>";
        }

	return $req;
    }

    public function getPresent() {
	$sql = "SELECT nom,prenom FROM Effectifs WHERE nom NOT IN (SELECT nom FROM Absences) AND prenom NOT IN (SELECT prenom FROM Absences)";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : Impossible d\'avoir les présents.');</script>";
	}

	return $req;
    }
}

?>
