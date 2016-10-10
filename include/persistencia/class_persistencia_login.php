<?php

class PersistenciaLogin extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('tbusuario');
        $this->add('usu_email', 'email',    true);
        $this->add('usu_senha', 'password', true);
        $this->add('usu_nome',  'nomeUsuario');
        
        $this->addNomeModel('Login');
    }
}