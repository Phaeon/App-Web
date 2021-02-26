<?php

require_once 'models/PlayerModel.php';

class PlayerControler {
    
    private $_player;
    
    public function __construct() {
        $this->_player = new PlayerModel();
    }
    
    public function newAbsentPlayer($nom, $prenom, $raison) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        $raisonC = '';
        
        switch ($raison) {
            case 'Absent':
                $raisonC = 'A';
                break;
            case 'Blesse':
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
        
        $this->_player->insertAbsentPlayer($nom, $prenom, $raison, $raisonC);
    }
    
    public function removeAbsentPlayer($nom, $prenom) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        
        $this->_player->removeAbsentPlayer($nom, $prenom);
    }
    
    public function newPlayer($nom, $prenom, $licence, $equipe, $categorie) {        
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        $equipe = strtoupper($equipe);
	$categorie = strtoupper($categorie);
        
        $this->_player->newPlayer($nom, $prenom, $licence, $equipe, $categorie);
    }
    
    public function removePlayer($nom, $prenom) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        
        $this->_player->removePlayer($nom, $prenom);
    }

    public function changePlayer($nom, $prenom,$equipe,$categorie) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        
        $this->_player->changePlayer($nom, $prenom,$equipe,$categorie);
    }

    public function newTeam($equipe, $categorie) {        
        $equipe = strtoupper($equipe);
	$categorie = strtoupper($categorie);
        
        $this->_player->newTeam($equipe, $categorie);
    }

    public function removeTeam($equipe, $categorie) {        
        $equipe = strtoupper($equipe);
	$categorie = strtoupper($categorie);
        
        $this->_player->removeTeam($equipe, $categorie);
    }
  
    public function getPlayer() {
	return $this->_player->getPlayer();
    }

    public function getTeam() {
	return $this->_player->getTeam();
    }

    public function getAbsent() {
	return $this->_player->getAbsent();
    }

    public function getPresent() {
	return $this->_player->getPresent();
    }
}

?>
