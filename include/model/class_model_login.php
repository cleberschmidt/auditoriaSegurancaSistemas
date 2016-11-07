<?php

class ModelLogin {
    
    private $codigo;
    private $email;
    private $password;
    private $nomeUsuario;
    private $status;
    private $nivel;
     
    function getCodigo() {
        return $this->codigo;
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

    function getStatus() {
        return $this->status;
    }

    function getNivel() {
        return $this->nivel;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
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

    function setStatus($status) {
        $this->status = $status;
    }

    function setNivel($nivel) {
        $this->nivel = $nivel;
    }


}