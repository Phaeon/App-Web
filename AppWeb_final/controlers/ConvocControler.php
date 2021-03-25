<?php

require_once 'models/ConvocModel.php';

class ConvocControler {
    
    private $_conv;
    
    public function __construct() {
        $this->_conv = new ConvocModel();
    }
    
    // CONVOCATIONS

    public function newConvocation($date) {

        $this->_conv->insertNewConvocation($date); 
    }

    public function getConvocation() {
	
	return $this->_conv->getConvocation();
    }

    public function getConvocationEnregistree($date) {

	return $this->_conv->getConvocationEnregistree($date);

    }

    public function clearConvocation($date) {
	
	$this->_conv->clearConvocation($date);

    }

    public function saveConvocation($date,$joueur,$match) {

	$this->_conv->saveConvocation($date,$joueur,$match);
    }
    
}

?>
