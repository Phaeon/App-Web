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
    
    
    
    // GESTION DES EQUIPES
    public function insertNewTeam($nom_equipe, $categorie, $effectif) {
        $sql = "INSERT INTO Equipes VALUES ('$nom_equipe', '$categorie', '$effectif')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Equipe a été ajoutée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    public function removeTeam($nom_equipe, $categorie) {
        $sql = "DELETE FROM Equipes WHERE nom_equipe = '$nom_equipe' AND categorie = '$categorie'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Equipe a été supprimée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    
    
    // GESTION DES COMPETITIONS
    public function insertNewCompetition($nom_compet, $importance) {
        $sql = "INSERT INTO Competitions VALUES ('$nom_compet', '$importance')";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Compétition a été ajoutée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    public function removeCompetition($nom_compet) {
        $sql = "DELETE FROM Competitions WHERE nom_compet = '$nom_compet'";
        
        try {
            $this->executeRequest($sql);
            echo "<script>alert('Compétition a été supprimée avec succès.');</script>";
        } catch (Exception $e) {
            echo "ERROR : ".$e->getMessage();
        }
        
    }
    
    
}

?>