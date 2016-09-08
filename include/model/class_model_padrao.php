<?php

class ModelPadrao{
    
    private $schemaTabela;
    
    private $Model;
    
    function getSchemaTabela() {
        return $this->schemaTabela;
    }

    function getModel() {
        return $this->Model;
    }

    function setSchemaTabela($schemaTabela) {
        $this->schemaTabela = $schemaTabela;
    }

    function setModel($Model) {
        $this->Model = $Model;
    }


}
