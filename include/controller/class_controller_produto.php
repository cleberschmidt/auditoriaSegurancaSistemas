<?php

class ControllerProduto extends ControllerPadrao{
    
    function __construct($aJson = false) {
        if($aJson){
            $oModelProduto = new ModelProduto();
            $oModelProduto->setCodigo($aJson['codigo']);

            $this->setModel($oModelProduto);
        }
    }
}
