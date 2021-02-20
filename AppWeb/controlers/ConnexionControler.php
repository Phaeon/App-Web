<?php

session_start();

require_once 'models/ConnexionModel.php';
require_once 'controlers/HomeControler.php';
require_once 'views/View.php';

class ConnexionControler {
    
    private $_conn;
    private $_main;
    
    public function __construct() {
        $this->_conn = new ConnexionModel();
        $this->_main = new HomeControler();
    }
    
    public function connexion($login, $mdp) {
        $connEtablie = $this->_conn->checkConnexion($login, $mdp);
        // Si la connexion est établie, charger la page
        if ($connEtablie) {
            $role = $this->_conn->getRole($login);
            $_SESSION['admin'] = $login;
            $_SESSION['role'] = $role;
            $this->admin();
        }else{
            echo "<script>alert('Votre identifiant ou mot de passe est incorrect');</script>";
            $this->_main->home();
        }
    }
    
    public function deconnexion() {
        session_destroy();
        require_once('views/MainView.php');
    }
    
    public function admin() {
        // Créer une nouvelle vue admin
        require_once('views/AdminView.php');
    }
    
}

?>
