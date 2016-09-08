<?php

class ControllerSugestao{

    /**
     * @param type $sPesquisa - Conteúdo que o usuário informa na pesquisa
     * @param type $iQtde     - Quantidade de resultados que deve retornar
     * 
     */
    public function buscaSugestao($sPesquisa, $oPersistencia, $iQtde = 5){
       $persistenciaSugestao = new PersistenciaSugestao();
        $r = $persistenciaSugestao->getSuggest($sPesquisa, $oPersistencia, $iQtde);
        return $r;
    }
}

