<?php

class PersistenciaLog extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tblogpadrao');
        
        $this->add('lpa_codigo',      'codigo',           'Código', true, true);
        $this->add('lpa_nome_tabela', 'nomeTabela',       'Tabela');
        $this->add('lpa_data',        'data',             'Data');
        $this->add('lpa_tipo_log',    'acao',             'Ação');
        $this->add('lpa_log',         'log',              'Descrição');
        $this->add('usu_codigo',      'Usuario.codigo',   'Usuário', false, false, false, true);

        $this->addNomeModel('Log');
    }
}
