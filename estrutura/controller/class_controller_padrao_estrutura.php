<?php

class ControllerPadraoEstrutura{   
    
    /* Busca conforme o model setado como parametro 
       Retorna Array de Models 
       $tipoRetorno = 1 Array, 2 Objeto     */
    public function buscaDados($oModel = false, $tipoRetorno = PersistenciaAreaTrabalho::TIPO_RETORNO_ARRAY){    
        $oPersistencia = new PersistenciaPadraoEstrutura();
        
        $aModel = $oPersistencia->getModelAll($oModel);
        return $this->getArrayModel($aModel, $tipoRetorno);
    } 
    
    /* Inserção padrão */
    public function insereDados($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->insere($oModel);
    }
    
    public function alteraDados($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->altera($oModel);
    }
    
    public function exclui($oModel){
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->exclui($oModel);
    }
    
    /* Recebe como parametro um único Array
       Retorna o Model especifico do Array, com os valores já setados */
    private function converteArrayModel($aModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        $sNomeModel      = PersistenciaPadrao::$sNomeModel;
   
        $sModel = 'Model'.$sNomeModel;
        $oModel = new $sModel();
        
        foreach($aModel as $sIndice => $xCampoValor){
            $sNomeCampo = 'set'.ucfirst($sIndice);
            $oModel->$sNomeCampo($xCampoValor);
        }
        
        return $oModel;
    }

    /* Recebe um Array */
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


    public function getArrayModel($aModel, $tipoRetorno){
        $aNewModel = Array();
         
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        $sNomeModel      = PersistenciaPadrao::$sNomeModel;
   
        $sModel = 'Model'.$sNomeModel;
        $oModel = new $sModel();
        
        foreach ($aModel as $aCampo){
            
            foreach($aCampo as $sIndice => $xCampo){
                foreach($aRelacionamento as $aCampoRelacionamento){
                    if($aCampoRelacionamento['colunaBanco'] == $sIndice){
                        $sNomeCampo = $aCampoRelacionamento['propriedadeModel'];
                        $sNomeCampo = 'set'.ucfirst($sNomeCampo);
                        break;
                    }
                }
                
                $oModel->$sNomeCampo($xCampo);
            }
            if($tipoRetorno == 1){
                $xModel = $this->toArray($oModel);
            }else{
                $xModel = $oModel;
            }
            $aNewModel[] = $xModel;
        }
        return $aNewModel;
    }
}
