<?php

class ControllerUsuario extends ControllerPadrao{
    
    public function getAllFromModel(){
        $oPersistenciaUsuario = new PersistenciaUsuario();
        $oPersistenciaUsuario->setRelacionamento();
        
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        $aModel = $oControllerPadraoEstrutura->buscaDados();
    }
}
