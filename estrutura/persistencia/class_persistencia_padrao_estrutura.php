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

    /* */
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
        
        $aNewModel = false;
        if($oModel != false){
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
        }
       

        $sSql = 'select '.$sColunas.' from '.$sSchemaTabela; 
        
        if($oModel != false){
            if(!empty($sCondicao = $this->getCondicao($aRelacionamento, $aNewModel))){
                $sSql .= ' where '.$sCondicao;
            }
        }

        return $this->getQuery()->selectAll($sSql);
    }
    
    function getCondicao($aRelacionamento, $aNewModel){
        $sCondicao = '';
        $iContador = 0;
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            if($aNewRelacionamento['chaveCondicao'] != false){
                if(!empty($sCondicao)){
                    $sCondicao .= ' and ';
                }
                $sCondicao .= $aNewRelacionamento['colunaBanco'].' = ';
                foreach($aNewModel as $sIndice => $sValor){

                    if($sIndice == $aNewRelacionamento['propriedadeModel']){
                        $sCondicao .= '\''.$aNewModel[$sIndice].'\'';
                    } 
                }
            }
        }
        return $sCondicao;
    }
    
    function getCondicaoExclui($aRelacionamento, $aNewModel){
        $sCondicao = '';
        $iContador = 0;
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            if($aNewRelacionamento['chave'] != false){
                if(!empty($sCondicao)){
                    $sCondicao .= ' and ';
                }
                $sCondicao .= $aNewRelacionamento['colunaBanco'].' = ';
                foreach($aNewModel as $sIndice => $sValor){

                    if($sIndice == $aNewRelacionamento['propriedadeModel']){
                        $sCondicao .= '\''.$aNewModel[$sIndice].'\'';
                    } 
                }
            }
        }
        return $sCondicao;
    }
    
    /* Recebe um Model, Retorna um Array */
    private function toArray($oModel){
        if($oModel != false){
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
            return $aNewModel;
        }
    }
    
    public function altera($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $aModel = $this->toArray($oModel);
        
        /* salva nos arrays as respectivas colunas e valores */
        $aSet = Array();
        $sCondicaoCodigo = '';
        
        foreach($aModel as $sCampo => $xValor){
            foreach($aRelacionamento as $aCampoRelacionamento){
                if($aCampoRelacionamento['propriedadeModel'] == $sCampo){
                    if(!empty($xValor)){
                        if($aCampoRelacionamento['propriedadeModel'] == 'codigo'){
                            $sCondicaoCodigo = $aCampoRelacionamento['colunaBanco'].' = '.$xValor;
                        }else{
                            $sNomeCampoBD = $aCampoRelacionamento['colunaBanco'];
                            $aSet[] = $sNomeCampoBD.' = "'.$xValor.'"';
                        }
                    }
                    break;
                }
            }
        }
            
        $sSet = implode(", ", $aSet);
 
        $sSql = 'update '.$sSchemaTabela.' set '.$sSet.' where '.$sCondicaoCodigo;
        return $this->getQuery()->query($sSql);
    }
    
    public function insere($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $aModel = $this->toArray($oModel);
        
        /* salva nos arrays as respectivas colunas e valores */
        $aCampoBd = Array();
        $aValorBd = Array();
        
        foreach($aModel as $sCampo => $xValor){
            foreach($aRelacionamento as $aCampoRelacionamento){
                if($aCampoRelacionamento['propriedadeModel'] == $sCampo){
                    if(!empty($xValor)){
                        $sNomeCampoBD = $aCampoRelacionamento['colunaBanco'];
                        $aCampoBd[] = $sNomeCampoBD;
                        $aValorBd[] = '"'.$xValor.'"';
                    }
                    break;
                }
            }
        }
            
        $sCampoBd = implode(", ", $aCampoBd);
        $sValorBd = implode(", ", $aValorBd);
        
        $sSql = 'insert into '.$sSchemaTabela.'('.$sCampoBd.') values('.$sValorBd.')';
        return $this->getQuery()->query($sSql);
    }
    
    function exclui($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $sSql = 'delete from '.$sSchemaTabela;
        
        $aNewModel = $this->toArray($oModel);
        if(!empty($sCondicao = $this->getCondicaoExclui($aRelacionamento, $aNewModel))){
            $sSql .= ' where '.$sCondicao;
        }

        return $this->getQuery()->query($sSql);
    }
}
