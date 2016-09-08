<?php
class PersistenciaPadraoEstrutura{
    
    private $Query;
    
    function getQuery(){
        if (!isset($this->Query)){
            $this->Query = new Query();
        }
        return $this->Query;
    }
    
    public function selectSuggest($sPesquisa, $sColuna, $sSchemaTabela, $iQtde){
        return 'SELECT '.$sColuna.' FROM '.$sSchemaTabela. ' WHERE '.$sColuna.' LIKE \'%'.$sPesquisa.'%\' ORDER BY '.$sColuna.' LIMIT '.$iQtde;
    }
    
    public function getModelAll($oModel){
        $sColunas = '';
        $iContador = 0;
        
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        /* Colunas da tabela do banco de dados */
        $iTamanhoArray = count($aRelacionamento);
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            
            $sColunas .= $aNewRelacionamento['colunaBanco'];
            if($iTamanhoArray != $iContador){
                $sColunas .= ', ';
            }
        }
        
        /* renomeia os indices, retirando o nome da classe da frente */
        $sNomeClasse = get_class($oModel);
        $iTamanhoNomeClasse = strlen($sNomeClasse);
        $iTamanhoNomeClasse++;
        $aModel = (array) $oModel;
        
        $aNewModel = Array();
        foreach ($aModel as $indice => $valor){
            $sNovoIndice = substr($indice, $iTamanhoNomeClasse); // Retira os x primeiros caracteres
            $sNovoIndice = ltrim($sNovoIndice);
            $aNewModel[$sNovoIndice] = $valor;
        }
       

        /* */
        $sCondicao = '';
        $iContador = 0;
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            
            $sCondicao .= $aNewRelacionamento['colunaBanco'].' = ';
            foreach($aNewModel as $sIndice => $sValor){
                
                if($sIndice == $aNewRelacionamento['propriedadeModel']){
                    
                    $sCondicao .= '\''.$aNewModel[$sIndice].'\'';
                } 
            }
            
            if($iTamanhoArray != $iContador){
                $sCondicao .= ' and ';
            }
        }
        
        $sSql = 'select '.$sColunas.' from '.$sSchemaTabela.' where '.$sCondicao;
        
        return $this->getQuery()->selectAll($sSql);
    }
}
