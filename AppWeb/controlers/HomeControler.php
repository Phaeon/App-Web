<?php


class HomeControler {

    private $_utils;

    public function __construct() {
        $this->_utils = new UtilsControler();
    }
    
    public function home() {

	$_SESSION['match'] = $this->_utils->getMatch()->fetchAll(PDO::FETCH_NUM);
	$_SESSION['convocation'] = $this->_utils->getConvocation()->fetchAll(PDO::FETCH_NUM);

        require_once('views/MainView.php');
    }

}

