<?php

require_once 'models/UtilsModel.php';

class UtilsControler {
    
    private $_utils;
    
    public function __construct() {
        $this->_utils = new UtilsModel();
    }
    
    // SITES
    public function newSite($site, $terrain) {
        $site = strtoupper($site);
        $terrain = strtoupper($terrain);
        
        $this->_utils->insertNewSite($site, $terrain);
    }
    
    public function removeSite($site, $terrain) {
        $site = strtoupper($site);
        $terrain = strtoupper($terrain);
        
        $this->_utils->removeSite($site, $terrain);
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
    
}

?>
