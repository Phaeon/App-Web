<?php

require_once 'models/Model.php';

class UtilsModel extends Model {
    
    // GESTION DES COMPETITIONS

    public function insertNewCompetition($nom_compet) {
        $sql = "INSERT INTO Competitions VALUES ('$nom_compet')";

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
            echo "<script>alert('".$nom_compet." a été supprimée avec succès.');</script>";
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

    // GESTION DES MATCHS

    public function insertNewMatch($date, $categorie, $competition, $equipe, $equipe_adv, $heure, $site, $terrain) {
        $sql = "INSERT INTO Matchs VALUES ('$date', '$categorie', '$competition', '$equipe', '$equipe_adv', '$heure', '$site', '$terrain')";

        try {
            $this->executeRequest($sql);
            echo "<script>alert('Le match a été ajouté avec succès.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur : impossible d\'ajouter le match.');</script>";
        }
        
    }

    public function removeMatch($compet, $categorie, $equipe, $adv, $date) {
        $sql = "DELETE FROM Matchs WHERE competition = '$compet' AND categorie = '$categorie' AND equipe = '$equipe' AND equipe_adv = '$adv' AND date_m = '$date'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Le match a été supprimé avec succès.');</script>";
        } catch (Exception $e) {
            echo "<script>alert('Erreur : impossible de retirer le match.');</script>";
        }
        
    }

    public function getMatch() {
		
	$sql = "SELECT * FROM Matchs";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux matchs.');</script>";
	}

	return $req;
    }

    public function getSpecificMatch($date) {
		
	$sql = "SELECT * FROM Matchs WHERE date_m = '$date'";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux matchs.');</script>";
	}

	return $req;
    }
    
    public function getDate() {
	
	$sql = "SELECT DISTINCT date_m FROM Matchs";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux dates.');</script>";
	}

	return $req;
    }

    // GESTION DES CONVOCATIONS

    public function insertNewConvocation($date) {
        $sql = "INSERT INTO Convocations VALUES ('$date')";
	$sql2 = "SELECT count(date_m) FROM Convocations WHERE date_m = '$date'";

        try {
	    $existe = $this->executeRequest($sql2)->fetch(PDO::FETCH_NUM);

	    if($existe[0] == 0)
	    {
            	$this->executeRequest($sql);
            	echo "<script>alert('La convocation a été ajoutée avec succès.');</script>";
	    }
	    else
	    {
		echo "<script>alert('La convocation a été mise à jour avec succès.');</script>";
	    }
        } catch (Exception $e) {
            echo "<script>alert('Erreur : impossible d\'ajouter la convocation.');</script>";
        }
        
    }

    public function getConvocation() {
	
	$sql = "SELECT * FROM Convocations ORDER BY date_m DESC";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux convocations.');</script>";
	}

	return $req;
    }
}

?>
