<?php

class PersistenciaLogin extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbusuario');
        $this->add('usu_email', 'email',    'E-mail',   true);
        $this->add('usu_senha', 'password', 'Password', true);
        $this->add('usu_nome',  'nomeUsuario');
        
        $this->addNomeModel('Login');
    }
}