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
    
    public function getAllFromModel(){
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        return $oControllerPadraoEstrutura->buscaDados(); 
    }

    public function getFromModel(){
        return $this->getControllerPadraoEstrutura()->buscaDados($this->getModel());
    }
    
    public function exclui(){
        return $this->getControllerPadraoEstrutura()->exclui($this->getModel());
    }
}