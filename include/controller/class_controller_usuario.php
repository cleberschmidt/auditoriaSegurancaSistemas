<?php

class ControllerUsuario extends ControllerPadrao{
    public function zerarTentativaLogin($codigoUsuario){
        $this->getControllerPadraoEstrutura()->zerarTentativaLogin($codigoUsuario);
    }
}
