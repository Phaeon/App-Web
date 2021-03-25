<?php

require_once 'models/Model.php';

class ConvocModel extends Model {
    
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

    public function getConvocationEnregistree($date) {
	
	$sql = "SELECT * FROM Convocations_enregistrees WHERE date_m = '$date'";

	try {
		$req = $this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'accéder aux convocations enregistrées.');</script>";
	}

	return $req;
    }

    public function clearConvocation($date) {
	
	$sql = "DELETE FROM Convocations_enregistrees WHERE date_m = '$date'";

	try {
		$this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible de supprimer la convocation enregistrée.');</script>";
	}
    }

    public function saveConvocation($date,$joueur,$match) {
	
	$sql = "INSERT INTO Convocations_enregistrees VALUES ('$date','$joueur','$match')";

	try {
		$this->executeRequest($sql);
	} catch (Exception $e) {
		echo "<script>alert('Erreur : impossible d\'enregistrer le joueur pour cette convocation.');</script>";
	}
    }
    
}

?>
