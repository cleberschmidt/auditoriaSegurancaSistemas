<?php

class PersistenciaItemVenda extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbitemvenda');
        $this->add('ite_codigo',     'codigo',         'Código',      true,  true);
        $this->add('pro_codigo',     'Produto.codigo', 'Produto',     false, false, true);
        $this->add('ven_codigo',     'Venda.codigo',   'Código Venda');
        $this->add('ven_data'  ,     'Venda.data',     'Data Venda');
        $this->add('cli_codigo',     'Cliente.codigo', 'Cliente');
        $this->add('ite_quantidade', 'quantidade',     'Quantidade');
        $this->add('ite_preco',      'preco',          'Preço');
        
        $this->addNomeModel('ItemVenda');
    }
}