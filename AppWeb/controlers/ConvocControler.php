<?php

session_start();

require_once 'models/ConvocModel.php';

class ConvocControler {
    
    private $_conv;
    
    public function __construct() {
        $this->_conv = new ConvocModel();
    }
    
    public function newConvocation($dateMatch, $categorie, $compet, $equipeAdv, $site, $terrain, $heureH, $heureM, $rdv='', $equipe) {
        $categorie = strtoupper($categorie);
        $compet = strtoupper($compet);
        $equipe = strtoupper($equipe);
        $equipeAdv = strtoupper($equipeAdv);
        $site = strtoupper($site);
        $terrain = strtoupper($terrain);
        
        // CHECK DATE FORMAT
        $dateMatch;
        
        // FORMAT TIME
        $heure = "$heureH:$heureM";
        
        $this->_cal->insertNewConvoc($dateMatch, $categorie, $compet, $equipeAdv, $site, $terrain, $heure, $rdv='', $equipe);
    }
    
    public function removeConvocation($dateMatch, $compet, $equipeAdv, $heureH, $heureM, $equipe) {
        $compet = strtoupper($compet);
        $equipe = strtoupper($equipe);
        $equipeAdv = strtoupper($equipeAdv);
        
        // CHECK DATE FORMAT
        $dateMatch;
        
        // FORMAT TIME
        $heure = "$heureH:$heureM";
        
        $this->_cal->removeConvoc($dateMatch, $compet, $equipeAdv, $heure, $equipe);
    }
    
}

?>