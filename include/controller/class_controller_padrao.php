<?php

class ControllerPadrao{
    
    private $Model;
    private $ControllerPadraoEstrutura;
    
    function getModel() {
        return $this->Model;
    }

    function setModel($Model) {
        $this->Model = $Model;
    }
    
    function __construct($aJson = false) {
        if($aJson){
            $this->setModel($this->getControllerPadraoEstrutura()->converteArrayModel($aJson));
        }
    }
    
    /** @return ControllerPadraoEstrutura */
    public function getControllerPadraoEstrutura(){
        if(!isset($this->ControllerPadraoEstrutura)){
            $this->ControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        }
        return $this->ControllerPadraoEstrutura;
    }
    
    public function setControllerPadraoEstrutura(ControllerPadraoEstrutura $ControllerPadraoEstrutura){
        $this->ControllerPadraoEstrutura = $ControllerPadraoEstrutura;
    }
    
    public function getAllFromModel(){ // Utilizado somente no carregamento de dados para consulta
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        return $oControllerPadraoEstrutura->buscaDados(); 
    }

    public function getFromModel(){
        return $this->getControllerPadraoEstrutura()->buscaDados($this->getModel());
    }
    
    public function exclui($aJson){
        return $this->getControllerPadraoEstrutura()->exclui($aJson);
    }
    
    public function getAllFromModelRelacionamento(){
        return $this->getControllerPadraoEstrutura()->getAllFromModelRelacionamento();
    }
}