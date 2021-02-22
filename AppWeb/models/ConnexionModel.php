<?php

require_once('models/Model.php');

class ConnexionModel extends Model {
    
    public function checkConnexion($login, $mdp) {
        $sql = "select login, mdp from Utilisateurs where login=?";
        
        $utilisateur = $this->executeRequest($sql, array($login));
        if ($utilisateur->rowCount() == 1) {
            if (password_verify($mdp, $utilisateur->fetchColumn(1))) return true;
            else return false;
        }
        
    }
    
}

?>