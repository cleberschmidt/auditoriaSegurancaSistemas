<?php

class PersistenciaCliente extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbcliente');
        $this->add('cli_codigo',          'codigo',         'Código', true,  true);
        $this->add('cli_nome',            'nome',           'Nome',   false, false, true);
        $this->add('cli_sexo',            'sexo',           'Sexo');
        $this->add('cli_endereco',        'endereco',       'Endereço');
        $this->add('cli_data_nascimento', 'dataNascimento', 'Data de Nascimento');
        $this->add('cli_ativo',           'ativo',          'Status');
        $this->add('cli_saldo_devedor',   'saldoDevedor',   'Saldo Devedor');
        $this->add('cep_codigo',          'Cep.codigo',     'CEP');
        
        $this->addNomeModel('Cliente');
    }
}