<?php

class Query{
    
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::conectar();
    }
    
    public function selectAll($sSql){
        $rSql     = $this->query($sSql);
        $aRetorno = Array();
        while($oLinhaAtual = mysql_fetch_assoc($rSql)){
            $aRetorno[] = $oLinhaAtual;
        }
        Conexao::desconectar();
        return $aRetorno;  
    }
    
    public function query($sSql){
        $rRetorno = @mysql_query($sSql, $this->conexao);
        if($rRetorno !== false){
            return $rRetorno;
        }
        echo "<pre>".print_r(mysql_error($this->conexao). $sSql)."</pre>";
        throw new Exception('Erro ao executar comando SQL');
    }
    
}

