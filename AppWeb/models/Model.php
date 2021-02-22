<?php

abstract class Model {

    private $_bdd;

    protected function executeRequest($sql, $params = null) {
        if ($params == null) {
            $resultat = $this->getBdd()->query($sql);
        }
        else {
            $resultat = $this->getBdd()->prepare($sql);
            $resultat->execute($params);
        }

        return $resultat;
    }

    private function getBdd() {
        if ($this->_bdd == null) {
            $this->_bdd = new PDO('mysql:host=localhost;dbname=convocations;charset=utf8',
                    'etudiant', 'etudiant',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        }
        return $this->_bdd;
    }

}
