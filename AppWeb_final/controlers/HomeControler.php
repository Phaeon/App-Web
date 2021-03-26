<?php


class HomeControler {

    private $_utils;
    private $_conv;

    public function __construct() {
        $this->_utils = new UtilsControler();
        $this->_conv = new ConvocControler();
    }

    public function home() {

        $_SESSION['match'] = $this->_utils->getMatch()->fetchAll(PDO::FETCH_NUM);
        $_SESSION['convocation'] = $this->_conv->getConvocation()->fetchAll(PDO::FETCH_NUM);

        $vue = new View("Main");
        $vue->generate(array());
    }

}

