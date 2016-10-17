<?php

class PersistenciaEstado extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbestado');
        $this->add('est_codigo', 'codigo', 'Código', true,  true);
        $this->add('est_nome',   'nome',   'Nome',   false, false, true);
        $this->add('est_sigla',  'sigla',  'Sigla');
        
        $this->addNomeModel('Estado');
    }
}