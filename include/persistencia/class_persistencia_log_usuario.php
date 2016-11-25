<?php

class PersistenciaLogUsuario extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tblogusuario');
        
        $this->add('lus_codigo',          'codigo',         'Código', true, true);
        $this->add('lus_data',            'data',           'Data');
        $this->add('lus_login_utilizado', 'loginUtilizado', 'Login Utilizado');
        $this->add('lus_senha_utilizada', 'senhaUtilizada', 'Senha Utilizada');
        $this->add('lus_historico',       'historico',      'Histórico');
        $this->add('usu_codigo',          'Usuario.codigo', 'Usuário', false, false, false, true);

        $this->addNomeModel('LogUsuario');
    }
}