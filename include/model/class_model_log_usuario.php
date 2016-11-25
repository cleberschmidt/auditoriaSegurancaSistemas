<?php

class ModelLogUsuario {
    
    private $codigo;
    private $data;
    private $loginUtilizado;
    private $senhaUtilizada;
    private $historico;
    
    /** @var ModelUsuario */
    private $Usuario;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getData() {
        return $this->data;
    }

    function getLoginUtilizado() {
        return $this->loginUtilizado;
    }

    function getSenhaUtilizada() {
        return $this->senhaUtilizada;
    }

    function getHistorico() {
        return $this->historico;
    }

    function getUsuario() {
        if(!isset($this->Usuario)){
            $this->Usuario = new ModelUsuario();
        }
        return $this->Usuario;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setLoginUtilizado($loginUtilizado) {
        $this->loginUtilizado = $loginUtilizado;
    }

    function setSenhaUtilizada($senhaUtilizada) {
        $this->senhaUtilizada = $senhaUtilizada;
    }

    function setHistorico($historico) {
        $this->historico = $historico;
    }

    function setUsuario(ModelUsuario $Usuario) {
        $this->Usuario = $Usuario;
    }

}
