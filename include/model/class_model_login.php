<?php

class ModelLogin {
    
    private $email;
    private $password;
    private $nomeUsuario;
    
    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNomeUsuario() {
        return $this->nomeUsuario;
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
}