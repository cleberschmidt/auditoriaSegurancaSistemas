<?php

class PersistenciaCep extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbcep');
        $this->add('cep_codigo',        'codigo',        'Código',               true,  true);
        $this->add('cep_identificador', 'identificador', 'Endereçamento Postal', false, false, true);
        $this->add('cid_codigo',        'Cidade.codigo', 'Cidade',               false, false, false, true);

        $this->addNomeModel('Cep');
    }
}

