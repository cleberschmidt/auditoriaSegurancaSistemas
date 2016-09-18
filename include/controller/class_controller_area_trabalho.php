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
    
    function __construct() {   
        $this->processaDados();
    }

    public function processaDados(){
        $this->parametrosAjax();
    }
    
    private function parametrosAjax(){
        if(isset($_POST['iProcesso'])){
            $iProcesso = $_POST['iProcesso'];
            $aJson     = $_POST['oJson'];
            switch($iProcesso){
                case PersistenciaAreaTrabalho::PROCESSO_LOGIN_SISTEMA:
                    $oControllerLogin = new ControllerLogin($aJson);
                    if($oControllerLogin->processaDados()){
                        echo json_encode(1); 
                    }
                    break;
                case PersistenciaAreaTrabalho::ACAO_CARREGAR_USUARIO:
                    $oControllerUsuario = new ControllerUsuario();
                    $oControllerUsuario->getAllFromModel();
                    
                    break;
                //default:
            }
        }
    }
}
$oControllerAreaTrabalho = new ControllerAreaTrabalho();

                
