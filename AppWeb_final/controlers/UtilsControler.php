<?php

require_once 'models/UtilsModel.php';

class UtilsControler {
    
    private $_utils;
    
    public function __construct() {
        $this->_utils = new UtilsModel();
    }
    
    // COMPETITIONS

    public function newCompetition($nom_compet, $importance=1) {
        $nom_compet = strtoupper($nom_compet);
        
        $this->_utils->insertNewCompetition($nom_compet, $importance);
        
    }
    
    public function removeCompetition($nom_compet) {
        $nom_compet = strtoupper($nom_compet);
        
        $this->_utils->removeCompetition($nom_compet);  
    }

    public function getCompetition() {
	
	return $this->_utils->getCompetition();
    }

    // MATCHS

    public function newMatch($date, $categorie, $competition, $equipe, $equipe_adv, $heure, $site, $terrain) {

        $this->_utils->insertNewMatch($date, $categorie, $competition, $equipe, $equipe_adv, $heure, $site, $terrain); 
    }

    public function insertScore($date, $categorie, $competition, $equipe, $equipe_adv,$domicile, $exterieur) {

	$this->_utils->insertScore($date, $categorie, $competition, $equipe, $equipe_adv,$domicile, $exterieur);
    }

    public function removeMatch($compet, $categorie, $equipe, $adv, $date) {
        
        $this->_utils->removeMatch($compet, $categorie, $equipe, $adv, $date);
    }

    public function getMatch() {
	
	return $this->_utils->getMatch();
    }

    public function getSpecificMatch($date) {
	
	return $this->_utils->getSpecificMatch($date);
    }	

    public function getDate() {
	
	return $this->_utils->getDate();
    }
}

?>
