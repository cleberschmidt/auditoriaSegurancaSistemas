<?php

class ModelCidade{

    private $codigo;
    private $nome;
    
    /** @var ModelEstado */
    private $Estado;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function getEstado() {
        return $this->Estado;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setEstado(ModelEstado $Estado) {
        $this->Estado = $Estado;
    }
    
}
