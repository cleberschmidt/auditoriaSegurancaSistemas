<?php

class PersistenciaVenda extends PersistenciaPadrao {
   
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbvenda');
        $this->add('ven_codigo',     'codigo',         'Código',     true,  true);
        $this->add('ven_data',       'data',           'Data Venda', false, true);
        $this->add('ven_data_pgto',  'dataPgto',       'Data Pagamento');
        $this->add('ven_valor_pgto', 'valorPgto',      'Valor Pagamento');
        $this->add('cli_codigo',     'Cliente.codigo', 'Cliente');
        
        $this->addNomeModel('Venda');
    }
}

