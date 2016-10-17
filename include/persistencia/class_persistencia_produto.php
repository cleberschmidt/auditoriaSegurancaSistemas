<?php

class PersistenciaProduto extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbproduto');
        $this->add('pro_codigo',    'codigo',    'Código', true, true);
        $this->add('pro_descricao', 'descricao', 'Descrição');
        $this->add('pro_preco',     'preco',     'Valor R$');
        $this->add('pro_estoque',   'estoque',   'Qtde em Estoque');
        
        $this->addNomeModel('Produto');
    }
}