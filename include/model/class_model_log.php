<?php

class ModelLog {
    private $codigo;
    private $nomeTabela;
    private $data;
    private $acao;
    private $log;
    
    /** @var ModelUsuario */
    private $Usuario;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getNomeTabela() {
        return $this->nomeTabela;
    }

    function getData() {
        return $this->data;
    }

    function getAcao() {
        return $this->acao;
    }

    function getLog() {
        return $this->log;
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

    function setNomeTabela($nomeTabela) {
        $this->nomeTabela = $nomeTabela;
    }

    function setData($data) {
        $this->data = $data;
    }

    function setAcao($acao) {
        $this->acao = $acao;
    }

    function setLog($log) {
        $this->log = $log;
    }

    function setUsuario(ModelUsuario $Usuario) {
        $this->Usuario = $Usuario;
    }
    
}