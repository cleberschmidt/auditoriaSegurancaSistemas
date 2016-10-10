<?php

class PersistenciaPadrao{

    static public $aRelacionamento = Array();
    static public $sSchemaTabela;
    static public $sNomeModel;
    static private $iContador = 0;
    
    /*
     * $bChaveCondicao - Utiliza campo para realizar condição no BD (Ex: true -> coluna_teste = 10),
     * caso contrário o campo só será utilizado para seleção de dados (Ex: select coluna_teste ...)
     */
    public function add($sColunaBanco, $sPropriedadeModel, $bChaveCondicao = false, $bChave = false){ 
        self::$aRelacionamento[self::$iContador]['colunaBanco']      = $sColunaBanco;
        self::$aRelacionamento[self::$iContador]['propriedadeModel'] = $sPropriedadeModel;
        self::$aRelacionamento[self::$iContador]['chaveCondicao']    = $bChaveCondicao;
        self::$aRelacionamento[self::$iContador]['chave']            = $bChave;
        self::$iContador++;
    }
    
    public function addSchemaTabela($sSchemaTabela) {
        self::$sSchemaTabela = $sSchemaTabela;
    }
    
    public function addNomeModel($sNomeModel){
        self::$sNomeModel = $sNomeModel;
    }
}