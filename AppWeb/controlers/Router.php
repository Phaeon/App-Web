<?php

require_once('controlers/HomeControler.php');
require_once('views/View.php');

class Router {

    private $_mainCtrl;

    public function __construct() {
        $this->_mainCtrl = new HomeControler();
    }

    // Route une requête entrante : exécution l'action associée
    public function routerRequest() {
        try {
            $this->_mainCtrl->home();
        }
        catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }

    
    private function error($msgError) {
        $vue = new View("Error");
        $vue->generate(array('msgError' => $msgError));
    }

}
