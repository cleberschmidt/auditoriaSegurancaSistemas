<?php

class Query{
    
    private $conexao;
    
    public function __construct() {
        $this->conexao = Conexao::conectar();
    }
    
    public function selectAll($sSql){
        $rSql     = $this->query($sSql);
        $aRetorno = Array();
        
        $aLinhaAtualUtf8 = Array();
        while($aLinhaAtual = pg_fetch_assoc($rSql)){
            foreach ($aLinhaAtual as $sIndice => $xCampo){
                $aLinhaAtualUtf8[$sIndice] = $xCampo;
            }
            $aRetorno[] = $aLinhaAtualUtf8;
        }
        Conexao::desconectar();
        return $aRetorno;  
    }
    
    public function query($sSql){
        $rRetorno = @pg_query($this->conexao, $sSql);
        if($rRetorno !== false){
            return $rRetorno;
        }
        echo "<pre>".print_r(pg_last_error($this->conexao). $sSql)."</pre>";
        throw new Exception('Erro ao executar comando SQL');
    }
    
}

