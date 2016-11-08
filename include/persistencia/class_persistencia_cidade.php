<?php

class PersistenciaCidade extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbcidade');
        $this->add('cid_codigo', 'codigo',        'Código', true,  true);
        $this->add('cid_nome',   'nome',          'Nome',   false, false, true);
        $this->add('est_codigo', 'Estado.codigo', 'Estado', false, false, false, true);

        $this->addNomeModel('Cidade');
    }
}