<?php

class ControllerPadraoEstrutura{   
    
    /* Busca conforme o model setado como parametro */
    public function buscaDados($oModel = false){    
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->getModelAll($oModel);
    } 
}
