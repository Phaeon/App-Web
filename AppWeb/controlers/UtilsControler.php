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
    
    // EQUIPES
    public function newTeam($nom_equipe, $categorie, $effectif=0) {
        $nom_equipe = strtoupper($nom_equipe);
        $categorie = strtoupper($categorie);
        
        $this->_utils->insertNewTeam($nom_equipe, $categorie, $effectif);
        
    }
    
    public function removeTeam($nom_equipe, $categorie) {
        $nom_equipe = strtoupper($nom_equipe);
        $categorie = strtoupper($categorie);
        
        $this->_utils->removeTeam($nom_equipe, $categorie);
        
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
    
}

?>
