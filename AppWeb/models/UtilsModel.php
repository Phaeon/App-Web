<?php

require_once 'models/Model.php';

class UtilsModel extends Model {
    
    // GESTION DES SITES
    public function insertNewSite($nom_site, $terrain) {
        $sql = "INSERT INTO Sites VALUES ('$nom_site', '$terrain')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Site a été ajouté avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    public function removeSite($nom_site, $terrain) {
        $sql = "DELETE FROM Sites WHERE nom_site = '$nom_site' AND terrain = '$terrain'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Site a été supprimé avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    // GESTION DES COMPETITIONS
    public function insertNewCompetition($nom_compet, $importance) {
        $sql = "INSERT INTO Competitions VALUES ('$nom_compet', '$importance')";

        try {
            $this->executeRequest($sql);
            echo "<script>alert('".$nom_compet." a été ajoutée avec succès.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur : impossible d\'ajouter la compétition.');</script>";
        }
        
    }
    
    public function removeCompetition($nom_compet) {
        $sql = "DELETE FROM Competitions WHERE nom_compet = '$nom_compet'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert(".$nom_compet." a été supprimée avec succès.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur : impossible de retirer la compétition.');</script>";
        }
        
    }

    public function getCompetition() {
		
	$sql = "SELECT nom_compet FROM Competitions";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux compétitions.');</script>";
	}

	return $req;
    }
    
    
}

?>
