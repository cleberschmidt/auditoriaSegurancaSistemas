<?php

class ControllerLogin extends ControllerPadrao{

    function __construct($aJson) {
        $oModelLogin = new ModelLogin();
        $oModelLogin->setEmail($aJson['email']);
        $oModelLogin->setPassword(md5($aJson['password']));

        $this->setModel($oModelLogin);
    }
    
    function processaDados(){
        $oPersistenciaLogin = new PersistenciaLogin();
        $oPersistenciaLogin->setRelacionamento();
        
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        if($oControllerPadraoEstrutura->buscaDados($this->getModel())){
            return true;
        }
    }
    
  
}