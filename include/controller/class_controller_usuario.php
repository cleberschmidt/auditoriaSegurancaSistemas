<?php

class ControllerUsuario extends ControllerPadrao{
    
    function __construct($aJson = false) {
        if($aJson){
            $oModelUsuario = new ModelUsuario();
            $oModelUsuario->setCodigo($aJson['codigo']);

            $this->setModel($oModelUsuario);
        }
    }
}
