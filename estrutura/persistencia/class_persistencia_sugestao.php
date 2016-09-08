<?php

class PersistenciaSugestao extends PersistenciaPadraoEstrutura{
    
    public function getSuggest($sPesquisa, $oPersistencia, $iQtde){
        
        
        $sSql = $this->selectSuggest($sPesquisa, $oPersistencia->getTitulo() ,$oPersistencia->getSchemaTabela(), $iQtde);
        return $this->getQuery()->selectAll($sSql);
    }
}

