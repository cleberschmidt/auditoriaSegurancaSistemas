<?php

class ModelVenda {
    
    private $codigo;
    private $data;
    private $dataPgto;
    private $valorPgto;
    
    /*@var ModelCliente */
    private $Cliente;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getData() {
        return $this->data;
    }

    function getDataPgto() {
        return $this->dataPgto;
    }

    function getValorPgto() {
        return $this->valorPgto;
    }

    function getCliente() {
        return $this->Cliente;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setDataPgto($dataPgto) {
        $this->dataPgto = $dataPgto;
    }

    function setValorPgto($valorPgto) {
        $this->valorPgto = $valorPgto;
    }

    function setCliente($Cliente) {
        $this->Cliente = $Cliente;
    }




}
