<?php

class PersistenciaPadrao{

    static public $aRelacionamento = Array();
    static public $sSchemaTabela;
    static private $iContador = 0;
    
    public function add($sColunaBanco, $sPropriedadeModel){ 
        self::$aRelacionamento[self::$iContador]['colunaBanco']      = $sColunaBanco;
        self::$aRelacionamento[self::$iContador]['propriedadeModel'] = $sPropriedadeModel;
        self::$iContador++;
    }
    
    public function addSchemaTabela($sSchemaTabela) {
        self::$sSchemaTabela = $sSchemaTabela;
    }
}