<?php

class ModelUsuario {
    
    private $codigo;
    private $dataCadastro;
    private $email;
    private $password;
    private $nomeUsuario;
    private $nivelAcesso;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getDataCadastro() {
        return $this->dataCadastro;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
    }

    function getNivelAcesso() {
        return $this->nivelAcesso;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setDataCadastro($dataCadastro) {
        $this->dataCadastro = $dataCadastro;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNomeUsuario($nomeUsuario) {
        $this->nomeUsuario = $nomeUsuario;
    }

    function setNivelAcesso($nivelAcesso) {
        $this->nivelAcesso = $nivelAcesso;
    }
}