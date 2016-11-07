<?php

class ControllerPadraoEstrutura{   
    
    /** @var PersistenciaPadraoEstrutura */
    private $Persistencia;

    public function __construct() {
        $this->Persistencia = new PersistenciaPadraoEstrutura();
    }
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
    
    public function exclui($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->exclui($oModel);
    }
    
    public function getAllFromModelRelacionamento(){
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->getAllFromModelRelacionamento();
    }
    
    /* Recebe como parametro um único Array
       Retorna o Model especifico do Array, com os valores já setados */
    public function converteArrayModel($aModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        $sNomeModel      = PersistenciaPadrao::$sNomeModel;
   
        $sModel = 'Model'.$sNomeModel;
        $oModel = new $sModel();
        
        foreach($aModel as $sIndice => $xCampoValor){
            if($aModelT = $this->verificaPossuiRelacionamento($sIndice)){
                $sModelAux = 'Model'.$aModelT[0];
                $oModelAux = new $sModelAux();
                
                
                $sNomeCampoAux = 'set'.ucfirst($aModelT[1]);
                $oModelAux->$sNomeCampoAux($xCampoValor); 
                
                $sNomeCampo = 'set'.ucfirst($aModelT[0]);
                $oModel->$sNomeCampo($oModelAux);
               
            }else{
                $sNomeCampo = 'set'.ucfirst($sIndice);
                $oModel->$sNomeCampo($xCampoValor);
            }
            
        }
        
        return $oModel;
    }
    
    /* Função duplicada - existe na PersistenciaPadraoEstrutura */
    private function verificaPossuiRelacionamento($sPropriedadeModel){
        
        if(stripos($sPropriedadeModel, '.')){
            return explode(".",$sPropriedadeModel);
        }
        return false;
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
                
                if(is_object($valor)){
                    $sNomeClasseAux = get_class($valor);
                    $sNome = substr($sNomeClasseAux, 5);
                    $iTamanhoNomeClasseAux = strlen($sNomeClasseAux);
                    $iTamanhoNomeClasseAux++;
                    $aModelAux = (array) $valor;
                    foreach ($aModelAux as $sIndice => $sValor){
                        if(!empty($sValor)){
                            $sNovoIndiceAux = substr($sIndice, $iTamanhoNomeClasseAux); // Retira os x primeiros caracteres
                            $sNovoIndiceAux = ltrim($sNovoIndiceAux);
                            $aNewModel[$sNome.'.'.$sNovoIndiceAux] = $sValor;
                        }
                    }
                }else{
                    $aNewModel[$sNovoIndice] = $valor;
                }  
            }
            return $aNewModel;
        }
    }

    /* recebe vários arrays para model 
    O array recebido possui como índice as colunas do banco 'Ex: est_codigo' 
    Caso retorno for do tipo Array -> o índice será a propriedade do model 'Ex: codigo, Estado.codigo' */
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
                    
                    if($aModelRelacionamento = $this->verificaPossuiRelacionamento($aCampoRelacionamento['propriedadeModel'])){
                        $sModelAux = 'Model'.$aModelRelacionamento[0];
                        $oModelAux = new $sModelAux();

                        $sNomeCampoAux = 'set'.ucfirst($aModelRelacionamento[1]);
                        $oModelAux->$sNomeCampoAux($xCampo); 

                        $sNomeCampo = 'set'.ucfirst($aModelRelacionamento[0]);
                        //$oModel->$sNomeCampo($oModelAux);
                        $xCampo = $oModelAux;
                        break;
                    }
                    
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
    
    public function insereDadosVenda($aJson){
        /* Jeito porco :( */
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->insereVenda($aJson);
    }
    
    public function envioEmailAdm(){
        $oEnvioEmail = new EnvioEmail();
        $oEnvioEmail->setAssunto('TENTATIVA DE LOGIN');
        $oEnvioEmail->setMensagem('Usuário '.$_SESSION['textoMensagemNomeUsuario'].' realizou três tentativas de login! Acesso do mesmo bloqueado.'
                . 'E-mail: '.$_SESSION['textoMensagemEmailUsuario']);
        $oEnvioEmail->addDestinatario('cleberjoseschmidt@gmail.com');
        if($oEnvioEmail->enviaEmail()){
            return true;
        }else{
            return false;
        }
    }
    
    public function tentativaLogin($sEmailUsuario){
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->tentativaLogin($sEmailUsuario);
    }
    
    public function buscaNumeroTentativaLogin($sEmailUsuario){
        $oPersistencia = new PersistenciaPadraoEstrutura();
        return $oPersistencia->buscaNumeroTentativaLogin($sEmailUsuario);
    }
    
    public function buscarPermissao($iCodigoUsuario){
        return $this->Persistencia->buscaPermissao($iCodigoUsuario);
    }
    
}
