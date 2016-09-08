<?php

class PersistenciaLogin extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('tbusuario');
        $this->add('usu_email',    'email');
        $this->add('usu_senha', 'password');
    }
}