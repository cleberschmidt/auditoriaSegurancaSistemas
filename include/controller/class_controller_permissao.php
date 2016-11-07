<?php

class ControllerPermissao extends ControllerPadrao {
    
    public function buscaPermissao(){
        
        $iCodigoUsuario = $_SESSION['codigoUsuario'];
        
        return $this->getControllerPadraoEstrutura()->buscarPermissao($iCodigoUsuario);
    }
   
}

