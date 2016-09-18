<?php

class PersistenciaUsuario extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('tbusuario');
        $this->add('usu_codigo',        'codigo');
        $this->add('usu_email',         'email');
        $this->add('usu_senha',         'password');
        $this->add('usu_nome',          'nomeUsuario');
        $this->add('usu_data_cadastro', 'dataCadastro');
        $this->add('usu_nivel',         'nivelAcesso'); 
    }
}