<?php
/* 
 * Area de trabalho - (tela inicial)
 * @author Cleber José Schmidt
 * @since 21/07/2016
 * @package controller
 * @subpackage include
 */
require_once '../../estrutura/core/class_persistencia_teste.php';
class ControllerAreaTrabalho{
    
    const RECARREGAR_PAGINA_PRINCIPAL = 1;
    
    const ROTINA_USUARIO = 1000;
    const ROTINA_PRODUTO = 1001;
    
    function __construct() {   
        $this->processaDados();
    }

    public function processaDados(){
        $this->parametrosAjax();
    }
    
    private function parametrosAjax(){
        if(isset($_POST['iProcesso'])){
            $iProcesso = $_POST['iProcesso'];
            
            if(isset($_POST['oJson'])){
                $aJson = $_POST['oJson'];
            }
                    
            switch($iProcesso){
                case PersistenciaAreaTrabalho::PROCESSO_LOGIN_SISTEMA:
                    $oControllerLogin = new ControllerLogin($aJson);
                    if($oControllerLogin->processaDados()){
                        echo json_encode(self::RECARREGAR_PAGINA_PRINCIPAL); 
                    }
                    break;
                case PersistenciaAreaTrabalho::ACAO_CARREGAR_DADOS: // Carrega todos os dados da consulta
                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController();
                    $aModel = $oController->getAllFromModel();
                    $aModel = $this->addIdentificadorProcesso($aModel, $sNomeTelaConsulta);
                    echo json_encode($aModel); 
                    break;
                case PersistenciaAreaTrabalho::ACAO_EXCLUIR_REGISTRO: // Exclui um registro
                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                    array_shift($aJson);
                    
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController($aJson);
                    if($oController->exclui()){
                        echo json_encode(Array(0 => 3, 1 => $sNomeTelaConsulta)); 
                    }
                    break;
                case 4: // Ação incluir e Alterar
                    $sNomeTelaManutencao = $aJson['nomeTelaManutencao'];
                    array_shift($aJson);
                    
                    $iAcao = (int) $aJson['acao'];
                    array_shift($aJson);
                    
                    $sNomeClasse = substr($sNomeTelaManutencao, 16); // Retira os 16 primeiros caracteres
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeClasse);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
                    
                    if($iAcao == 103){
                        if($oControllerPadraoEstrutura->alteraDados($aJson)){
                        
                            echo json_encode(Array(0 => 1)); 
                        }
                    }else{
                        if($oControllerPadraoEstrutura->insereDados($aJson)){
                        
                            echo json_encode(Array(0 => 1)); 
                        }
                    }
                
                
                    break;
                case 5: // Ação alterar //Retorna somente um model
                    $aJson = $_POST['oJson'];

                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController($aJson);
                    $aModel = $oController->getFromModel();
                    $aModel = $this->addIdentificadorProcesso($aModel, 2);
                    echo json_encode($aModel); 

                    break;
                //default:
            }
        }
    }
    
    private function addIdentificadorProcesso($aModel, $sIdentificador){
        array_unshift($aModel, $sIdentificador);
        return $aModel;
    }
}
$oControllerAreaTrabalho = new ControllerAreaTrabalho();

                
