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
        
        if(PersistenciaPadrao::$sNomeModel == "Log"){ // Só serve para colocar um nome em vez de numero na consulta do log
            $aModel = $this->verificaNomeAcaoLog($aModel);
        }
        
        if($aRetorno = $this->getArrayModel($aModel, $tipoRetorno)){
            if(ControllerAreaTrabalho::$sAcao == "visualizar" && PersistenciaPadrao::$sNomeModel != "Log" && PersistenciaPadrao::$sNomeModel != "Permissao"){
                $aAuxTeste = $this->renomeiaPropriedade($aRetorno);
                
                $aAux = PersistenciaPadrao::$sNomeModel;
                
                PersistenciaPadrao::$aRelacionamento = null;
                $sAuxTabela = PersistenciaPadrao::$sSchemaTabela;
                $sAuxTabela = substr($sAuxTabela, 8); // Retira os x primeiros caracteres
                
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $oPersistenciaLog = new PersistenciaLog();
                $oPersistenciaLog->setRelacionamento();
                
                session_start();
                date_default_timezone_set('America/Sao_Paulo');
                $sData = date('Y-m-d H:i');
                
                $oModelLogPadrao = new ModelLog();
                $oModelLogPadrao->setAcao(4); // Visualizar
                $oModelLogPadrao->setData($sData);
                $oModelLogPadrao->setNomeTabela($sAuxTabela);
                $oModelLogPadrao->getUsuario()->setCodigo($_SESSION['codigoUsuario']);
                
                $sString = implode(', ', $aAuxTeste);
                
                $oModelLogPadrao->setLog($sString);
                
                $oPersistencia->insere($oModelLogPadrao);
                
                PersistenciaPadrao::$aRelacionamento = null;
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $sPersistencia = 'Persistencia'.$aAux;
                $oPersistencia = new $sPersistencia();
                $oPersistencia->setRelacionamento();
            }else if(ControllerAreaTrabalho::$sAcao == "excluir" && PersistenciaPadrao::$sNomeModel != "Log"){
                $aAuxTeste = $this->renomeiaPropriedade($aRetorno);
                
                $aAux = PersistenciaPadrao::$sNomeModel;
                
                PersistenciaPadrao::$aRelacionamento = null;
                $sAuxTabela = PersistenciaPadrao::$sSchemaTabela;
                $sAuxTabela = substr($sAuxTabela, 8); // Retira os x primeiros caracteres
                
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $oPersistenciaLog = new PersistenciaLog();
                $oPersistenciaLog->setRelacionamento();
                
                session_start();
                date_default_timezone_set('America/Sao_Paulo');
                $sData = date('Y-m-d H:i');
                
                $oModelLogPadrao = new ModelLog();
                $oModelLogPadrao->setAcao(3); // Excluir
                $oModelLogPadrao->setData($sData);
                $oModelLogPadrao->setNomeTabela($sAuxTabela);
                $oModelLogPadrao->getUsuario()->setCodigo($_SESSION['codigoUsuario']);
                
                $sString = implode(', ', $aAuxTeste);
                
                $oModelLogPadrao->setLog($sString);
                
                $oPersistencia->insere($oModelLogPadrao);
                
                PersistenciaPadrao::$aRelacionamento = null;
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $sPersistencia = 'Persistencia'.$aAux;
                $oPersistencia = new $sPersistencia();
                $oPersistencia->setRelacionamento();
            }else if(ControllerAreaTrabalho::$sAcao == "alterar" && PersistenciaPadrao::$sNomeModel != "Log"){
                $t = $this->toArray($oModel);
                
                $sAntes = $this->renomeiaPropriedade(Array($t));
                $sAntesT = implode(', ',$sAntes);
                
                $aAuxTeste = $this->renomeiaPropriedade($aRetorno);
                $sString = implode(', ', $aAuxTeste);
                
                $aAux = PersistenciaPadrao::$sNomeModel;
                
                PersistenciaPadrao::$aRelacionamento = null;
                $sAuxTabela = PersistenciaPadrao::$sSchemaTabela;
                $sAuxTabela = substr($sAuxTabela, 8); // Retira os x primeiros caracteres
                
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $oPersistenciaLog = new PersistenciaLog();
                $oPersistenciaLog->setRelacionamento();
                
                session_start();
                date_default_timezone_set('America/Sao_Paulo');
                $sData = date('Y-m-d H:i');
                
                $oModelLogPadrao = new ModelLog();
                $oModelLogPadrao->setAcao(2); // Alterar
                $oModelLogPadrao->setData($sData);
                $oModelLogPadrao->setNomeTabela($sAuxTabela);
                $oModelLogPadrao->getUsuario()->setCodigo($_SESSION['codigoUsuario']);
                
                
                
                $junt = 'Anterior = '.$sString.' / Atual = '.$sAntesT;
                
                $oModelLogPadrao->setLog($junt);
                
                $oPersistencia->insere($oModelLogPadrao);
                
                PersistenciaPadrao::$aRelacionamento = null;
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $sPersistencia = 'Persistencia'.$aAux;
                $oPersistencia = new $sPersistencia();
                $oPersistencia->setRelacionamento();
            }
            return $aRetorno;
        }
    } 
    
    private function renomeiaPropriedade($aModel, $iTipo = 1){
   
        $aAux = Array();
        if($iTipo == 1){
            foreach($aModel[0] as $sPropriedade => $sValor){
                foreach(PersistenciaPadrao::$aRelacionamento as $aRelacionamento){
                    if($aRelacionamento['propriedadeModel'] == $sPropriedade){
                        $aAux[] = $aRelacionamento['nomeCampoConsulta']." : ".$sValor;
                        break;
                    }
                }
            }
        }else if($iTipo == 2){
            foreach($aModel[0] as $sPropriedade => $sValor){
                foreach(PersistenciaPadrao::$aRelacionamento as $aRelacionamento){
                    if($aRelacionamento['colunaBanco'] == $sPropriedade){
                        $aAux[] = $aRelacionamento['nomeCampoConsulta']." : ".$sValor;
                        break;
                    }
                }
            }
        }
        return $aAux;
    }
    
    private function verificaNomeAcaoLog($aModel){
        
        $aNew = Array();
        foreach($aModel as $aModelAux){
            foreach ($aModelAux as $valor) {
                switch ($aModelAux['lpa_tipo_log']) {
                    case 1:
                        $aModelAux['lpa_tipo_log'] = 'Inserção';
                        break;
                    case 2:
                        $aModelAux['lpa_tipo_log'] = 'Alteração';
                        break;
                    case 3:
                        $aModelAux['lpa_tipo_log'] = 'Exclusão';
                        break;
                    case 4:
                        $aModelAux['lpa_tipo_log'] = 'Visualização';
                        break;
                }
                $aNew[] = $aModelAux;
                break;
            }
        }
        return $aNew;
    }


    /* Inserção padrão */
    public function insereDados($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $oPersistencia = new PersistenciaPadraoEstrutura();
        if($oPersistencia->insere($oModel)){
            $aModel = $oPersistencia->buscaUltimoRegistro();

            if(ControllerAreaTrabalho::$sAcao == "inserir" && PersistenciaPadrao::$sNomeModel != "Log"){
                $aAuxTeste = $this->renomeiaPropriedade($aModel, 2);
                
                $aAux = PersistenciaPadrao::$sNomeModel;
                
                PersistenciaPadrao::$aRelacionamento = null;
                $sAuxTabela = PersistenciaPadrao::$sSchemaTabela;
                $sAuxTabela = substr($sAuxTabela, 8); // Retira os x primeiros caracteres
                
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $oPersistenciaLog = new PersistenciaLog();
                $oPersistenciaLog->setRelacionamento();
                
                session_start();
                date_default_timezone_set('America/Sao_Paulo');
                $sData = date('Y-m-d H:i');
                
                $oModelLogPadrao = new ModelLog();
                $oModelLogPadrao->setAcao(1); // Excluir
                $oModelLogPadrao->setData($sData);
                $oModelLogPadrao->setNomeTabela($sAuxTabela);
                $oModelLogPadrao->getUsuario()->setCodigo($_SESSION['codigoUsuario']);
                
                $sString = implode(', ', $aAuxTeste);
                
                $oModelLogPadrao->setLog($sString);
                
                $oPersistencia->insere($oModelLogPadrao);
                
                PersistenciaPadrao::$aRelacionamento = null;
                PersistenciaPadrao::$sSchemaTabela = null;
                
                $sPersistencia = 'Persistencia'.$aAux;
                $oPersistencia = new $sPersistencia();
                $oPersistencia->setRelacionamento();
            }
            
        }
        return true;
    }
    
    public function alteraDados($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $this->buscaDados($oModel); //Somente para criar log
        $oPersistencia = new PersistenciaPadraoEstrutura();
        if($oPersistencia->altera($oModel)){
            
            return true;
        }
    }
    
    public function exclui($aJson){
        $oModel = $this->converteArrayModel($aJson);
        $this->buscaDados($oModel); //Somente para criar log
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
    
    public function zerarTentativaLogin($iCodigoUsuario){
        $this->Persistencia->zerarTentativaLogin($iCodigoUsuario);
    }
    
    public function insere($oModel){
        return $this->Persistencia->insere($oModel);
    }
    
}
