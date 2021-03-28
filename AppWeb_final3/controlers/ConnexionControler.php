<?php

require_once 'models/ConnexionModel.php';
require_once 'controlers/HomeControler.php';
require_once 'controlers/PlayerControler.php';
require_once 'controlers/UtilsControler.php';
require_once 'views/View.php';

class ConnexionControler {

    private $_conn;
    private $_main;
    private $_play;
    private $_utils;
    private $_convoc;

    public function __construct() {
        $this->_conn = new ConnexionModel();
        $this->_main = new HomeControler();
        $this->_play = new PlayerControler();
        $this->_utils = new UtilsControler();
        $this->_convoc = new ConvocControler();
    }

    public function connexion($login, $mdp) {
        $connEtablie = $this->_conn->checkConnexion($login, $mdp);
        // Si la connexion est établie, charger la page
        if ($connEtablie) {
            $_SESSION['admin'] = $login;
            $this->admin();
        }else{
            echo "<script>alert('Votre identifiant ou mot de passe est incorrect');</script>";
            $this->_main->home();
        }
    }

    public function deconnexion() {
        session_destroy();
        $this->_main->home();
    }

    public function admin() {

        $_SESSION['joueurs'] = $this->_play->getPlayer()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['categorie'] = $this->_play->getCategorie()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['equipes'] = $this->_play->getTeam()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['absents'] = $this->_play->getAbsent()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['competition'] = $this->_utils->getCompetition()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['match'] = $this->_utils->getMatch()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['date'] = $this->_utils->getDate()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['convocation'] = $this->_convoc->getConvocation()->fetchAll(PDO::FETCH_NUM);

        // Créer une nouvelle vue admin
        $login = $_SESSION['admin'];
        $role = $this->_conn->getRole($login);
        if ($role == "Entraîneur") {
            $vue = new View("Entr");
            $vue->generate(array());
        } else {
            $vue = new View("Secr");
            $vue->generate(array());
        }
    }

    public function admin_convoc($date) {

        $_SESSION['joueurs'] = $this->_play->getPlayer()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['categorie'] = $this->_play->getCategorie()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['equipes'] = $this->_play->getTeam()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['absents'] = $this->_play->getAbsent()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['joueurs_presents'] = $this->_play->getPresent($date)->fetchAll(PDO::FETCH_NUM);
        $_SESSION['competition'] = $this->_utils->getCompetition()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['match'] = $this->_utils->getMatch()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['date'] = $this->_utils->getDate()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['convocation'] = $this->_convoc->getConvocation()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['specific_matchs'] = $this->_utils->getSpecificMatch($date)->fetchAll(PDO::FETCH_NUM);
        $_SESSION['convoc_enregistree'] = $this->_convoc->getConvocationEnregistree($date)->fetchAll(PDO::FETCH_NUM);

        // Créer une nouvelle vue admin pour créer une convocation
        $login = $_SESSION['admin'];
        $role = $this->_conn->getRole($login);
        if ($role == "Entraîneur") {
            $vue = new View("EntrConvoc");
            $vue->generate(array());
        } else {
            $vue = new View("Secr");
            $vue->generate(array());
        }
    }
    

}

?>
