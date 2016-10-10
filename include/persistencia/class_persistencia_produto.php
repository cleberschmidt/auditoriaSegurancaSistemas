<?php

class PersistenciaProduto extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('tbproduto');
        $this->add('pro_codigo',    'codigo', true, true);
        $this->add('pro_descricao', 'descricao');
        $this->add('pro_preco',     'preco');
        $this->add('pro_estoque',   'estoque');
        
        $this->addNomeModel('Produto');
    }
}