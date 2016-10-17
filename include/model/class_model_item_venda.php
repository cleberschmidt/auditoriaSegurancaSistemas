<?php

class ModelItemVenda {
    
    private $codigo;
    private $quantidade;
    private $preco;
    
    /** @var ModelProduto */
    private $Produto;
    
    /** @var ModelVenda */
    private $Venda;
    
    /** @var ModelCliente */
    private $Cliente;
    
    function getCodigo() {
        return $this->codigo;
    }

    function getQuantidade() {
        return $this->quantidade;
    }

    function getPreco() {
        return $this->preco;
    }

    function getProduto() {
        return $this->Produto;
    }

    function getVenda() {
        return $this->Venda;
    }

    function getCliente() {
        return $this->Cliente;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    function setPreco($preco) {
        $this->preco = $preco;
    }

    function setProduto(ModelProduto $Produto) {
        $this->Produto = $Produto;
    }

    function setVenda(ModelVenda $Venda) {
        $this->Venda = $Venda;
    }

    function setCliente(ModelCliente $Cliente) {
        $this->Cliente = $Cliente;
    }
}
