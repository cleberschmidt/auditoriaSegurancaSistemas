<?php

class ModelCliente {
    
    private $codigo;
    private $nome;
    private $sexo;
    private $endereco;
    private $dataNascimento;
    private $ativo;
    private $saldoDevedor;
    
    /** @var ModelCep */
    private $Cep;
      
    function getCodigo() {
        return $this->codigo;
    }

    function getNome() {
        return $this->nome;
    }

    function getSexo() {
        return $this->sexo;
    }

    function getEndereco() {
        return $this->endereco;
    }

    function getDataNascimento() {
        return $this->dataNascimento;
    }

    function getAtivo() {
        return $this->ativo;
    }

    function getSaldoDevedor() {
        return $this->saldoDevedor;
    }

    function getCep() {
        return $this->Cep;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setSexo($sexo) {
        $this->sexo = $sexo;
    }

    function setEndereco($endereco) {
        $this->endereco = $endereco;
    }

    function setDataNascimento($dataNascimento) {
        $this->dataNascimento = $dataNascimento;
    }

    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }

    function setSaldoDevedor($saldoDevedor) {
        $this->saldoDevedor = $saldoDevedor;
    }

    function setCep(ModelCep $Cep) {
        $this->Cep = $Cep;
    }     
    
}