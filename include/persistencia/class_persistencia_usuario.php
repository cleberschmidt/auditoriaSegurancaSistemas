<?php

class PersistenciaUsuario extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbusuario');
        $this->add('usu_codigo',        'codigo',       'Código', true, true);
        $this->add('usu_email',         'email',        'E-mail');
        $this->add('usu_senha',         'password',     'Senha');
        $this->add('usu_nome',          'nomeUsuario',  'Nome');
        $this->add('usu_data_cadastro', 'dataCadastro', 'Data do Cadastro');
        $this->add('usu_nivel',         'nivelAcesso',  'Nível de Acesso'); 
        
        $this->addNomeModel('Usuario');
    }
}