<?php

session_start();

require_once 'models/PlayerModel.php';

class PlayerControler {
    
    private $_player;
    
    public function __construct() {
        $this->_player = new PlayerModel();
    }
    
    public function newAbsentPlayer($nom, $prenom, $dateMatch, $raison='') {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        $raisonC = '';
        
        switch ($raison) {
            case 'Absent':
                $raisonC = 'A';
                break;
            case 'Blessé':
                $raisonC = 'B';
                break;
            case 'Suspendu':
                $raisonC = 'S';
                break;
            case 'Sans licence':
                $raisonC = 'N';
                break;
            default:
                break;
        }
        
        $this->_player->insertAbsentPlayer($nom, $prenom, $dateMatch, $raison, $raisonC);
    }
    
    public function removeAbsentPlayer($nom, $prenom, $dateMatch) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        
        $this->_player->removeAbsentPlayer($nom, $prenom, $dateMatch);
    }
    
    public function newPlayer($nom, $prenom, $licence='Libre', $equipe='') {        
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        $equipe = strtoupper($equipe);
        
        $this->_player->newPlayer($nom, $prenom, $licence, $equipe);
    }
    
    public function removePlayer($nom, $prenom) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        
        $this->_player->removePlayer($nom, $prenom);
    }
  
    
}

?>