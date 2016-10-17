<?php

class PersistenciaPadrao{

    static public $aRelacionamento = Array();
    static public $sSchemaTabela;
    static public $sNomeModel;
    static private $iContador = 0;
    
    /*
     * $bChaveCondicao - Utiliza campo para realizar condição no BD (Ex: true -> coluna_teste = 10),
     * caso contrário o campo só será utilizado para seleção de dados (Ex: select coluna_teste ...)
     * $sNomeCampoConsulta - Título da coluna na consulta
     * $bNomeExterno - Tela de Manutenção -> quando tiver select com externo pega o código e como descrição o campo que estiver marcado como true $bNomeExterno
     */
    public function add($sColunaBanco, $sPropriedadeModel, $sNomeCampoConsulta = '', $bChaveCondicao = false, $bChave = false, $bNomeExterno = false){ 
        self::$aRelacionamento[self::$iContador]['colunaBanco']       = $sColunaBanco;
        self::$aRelacionamento[self::$iContador]['propriedadeModel']  = $sPropriedadeModel;
        self::$aRelacionamento[self::$iContador]['nomeCampoConsulta'] = $sNomeCampoConsulta;
        self::$aRelacionamento[self::$iContador]['chaveCondicao']     = $bChaveCondicao;
        self::$aRelacionamento[self::$iContador]['chave']             = $bChave;
        self::$aRelacionamento[self::$iContador]['nomeExterno']       = $bNomeExterno;
        self::$iContador++;
    }
    
    public function addSchemaTabela($sSchemaTabela) {
        self::$sSchemaTabela = $sSchemaTabela;
    }
    
    public function addNomeModel($sNomeModel){
        self::$sNomeModel = $sNomeModel;
    }
}