<?php

class PersistenciaPermissao extends PersistenciaPadrao{
    
    public function setRelacionamento(){
        $this->addSchemaTabela('projeto.tbpermissao');
        
        $this->add('per_tabela_usuario', 'tabelaUsuario',  'Menu usuários');
        $this->add('per_tabela_produto', 'tabelaProduto',  'Menu produtos');
        $this->add('per_tabela_cliente', 'tabelaCliente',  'Menu Cliente');
        $this->add('per_tabela_venda',   'tabelaVenda',    'Menu vendas');
        $this->add('per_tabela_cep',     'tabelaCep',      'Menu ceps');
        $this->add('per_tabela_cidade',  'tabelaCidade',   'Menu cidades');
        $this->add('per_tabela_estado',  'tabelaEstado',   'Menu estados');
        $this->add('usu_codigo',         'Usuario.codigo', 'Usuário', true, true);
        
        $this->addNomeModel('Permissao');
    }
}