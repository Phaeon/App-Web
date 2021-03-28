<?php

require_once 'models/PlayerModel.php';

class PlayerControler {

    private $_player;

    public function __construct() {
        $this->_player = new PlayerModel();
    }

    // Gestion des joueurs

    public function newPlayer($nom, $prenom, $licence, $categorie) {        
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));
        $categorie = strtoupper($categorie);

        $this->_player->newPlayer($nom, $prenom, $licence, $categorie);
    }

    public function removePlayer($nom, $prenom) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));

        $this->_player->removePlayer($nom, $prenom);
    }

    public function changePlayer($nom, $prenom,$categorie) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));

        $this->_player->changePlayer($nom, $prenom,$categorie);
    }

    public function getPlayer() {
        return $this->_player->getPlayer();
    }

    // Gestion des absents

    public function newAbsentPlayer($nom, $prenom, $raison,$date) {
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

        $this->_player->insertAbsentPlayer($nom, $prenom, $raison, $raisonC,$date);
    }

    public function removeAbsentPlayer($nom, $prenom,$date) {
        $nom = ucfirst(strtolower($nom));
        $prenom = ucfirst(strtolower($prenom));

        $this->_player->removeAbsentPlayer($nom, $prenom,$date);
    }

    public function getAbsent() {
        return $this->_player->getAbsent();
    }

    public function getPresent($date) {
        return $this->_player->getPresent($date);
    }

    // Gestion des équipes

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

    public function getTeam() {
        return $this->_player->getTeam();
    }

    public function getCategorie() {
        return $this->_player->getCategorie();
    }


}

?>
