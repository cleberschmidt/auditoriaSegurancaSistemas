<?php

class ModelCep {
    
    private $codigo;
    private $identificador;
    
    /** @var ModelCidade */
    private $Cidade;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getIdentificador() {
        return $this->identificador;
    }

    function getCidade() {
        return $this->Cidade;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setIdentificador($identificador) {
        $this->identificador = $identificador;
    }

    function setCidade(ModelCidade $Cidade) {
        $this->Cidade = $Cidade;
    }

}