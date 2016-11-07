<?php

class ModelPermissao{
    
    /** @var ModelUsuario */
    private $Usuario;
    private $tabelaUsuario;
    private $tabelaProduto;
    private $tabelaCliente;
    private $tabelaVenda;
    private $tabelaCep;
    private $tabelaCidade;
    private $tabelaEstado;
    
    function getUsuario() {
        return $this->Usuario;
    }

    function getTabelaUsuario() {
        return $this->tabelaUsuario;
    }

    function getTabelaProduto() {
        return $this->tabelaProduto;
    }

    function getTabelaCliente() {
        return $this->tabelaCliente;
    }

    function getTabelaVenda() {
        return $this->tabelaVenda;
    }

    function getTabelaCep() {
        return $this->tabelaCep;
    }

    function getTabelaCidade() {
        return $this->tabelaCidade;
    }

    function getTabelaEstado() {
        return $this->tabelaEstado;
    }

    function setUsuario(ModelUsuario $Usuario) {
        $this->Usuario = $Usuario;
    }

    function setTabelaUsuario($tabelaUsuario) {
        $this->tabelaUsuario = $tabelaUsuario;
    }

    function setTabelaProduto($tabelaProduto) {
        $this->tabelaProduto = $tabelaProduto;
    }

    function setTabelaCliente($tabelaCliente) {
        $this->tabelaCliente = $tabelaCliente;
    }

    function setTabelaVenda($tabelaVenda) {
        $this->tabelaVenda = $tabelaVenda;
    }

    function setTabelaCep($tabelaCep) {
        $this->tabelaCep = $tabelaCep;
    }

    function setTabelaCidade($tabelaCidade) {
        $this->tabelaCidade = $tabelaCidade;
    }

    function setTabelaEstado($tabelaEstado) {
        $this->tabelaEstado = $tabelaEstado;
    }


}
