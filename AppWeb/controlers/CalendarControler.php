<?php

session_start();

require_once 'models/CalendarModel.php';

class CalendarControler {
    
    private $_cal;
    
    public function __construct() {
        $this->_cal = new CalendarModel();
    }
    
    public function newMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heureH, $heureM, $site='', $terrain='') {
        $categorie = strtoupper($categorie);
        $compet = strtoupper($compet);
        $equipe = strtoupper($equipe);
        $equipeAdv = strtoupper($equipeAdv);
        
        // CHECK DATE FORMAT
        $dateMatch;
        
        // FORMAT TIME
        $heure = "$heureH:$heureM";
        
        
        $this->_cal->insertNewMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heure, $site, $terrain);
    }
    
    public function removeMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heureH, $heureM) {
        $categorie = strtoupper($categorie);
        $compet = strtoupper($compet);
        $equipe = strtoupper($equipe);
        $equipeAdv = strtoupper($equipeAdv);
        
        // CHECK DATE FORMAT
        $dateMatch;
        
        // FORMAT TIME
        $heure = "$heureH:$heureM";
        
        
        $this->_cal->removeMatch($dateMatch, $categorie, $compet, $equipe, $equipeAdv, $heure);
    }
    
}

?>