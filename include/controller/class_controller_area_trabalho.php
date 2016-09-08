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
    
    private $pesquisa;
    private $tipo;
    
    function getPesquisa() {
        return $this->pesquisa;
    }

    function getTipo() {
        return $this->tipo;
    }

    function setPesquisa($pesquisa) {
        $this->pesquisa = $pesquisa;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function processaDados(){
        $this->parametrosAjax();
        //$oPersistencia = $this->selecionaRelacionamento();
        //$this->pesquisaSuggest($oPersistencia);
    }
    
    private function parametrosAjax(){
        if(isset($_POST['iProcesso'])){
            $iProcesso = $_POST['iProcesso'];
            $aJson     = $_POST['oJson'];
            switch($iProcesso){
                case PersistenciaAreaTrabalho::PROCESSO_LOGIN_SISTEMA:
                    $oControllerLogin = new ControllerLogin($aJson);
                    if($oControllerLogin->processaDados()){
                        echo json_encode(true); 
                    }
                    break;
                //default:
            }
        }
    }
  
    private function selecionaRelacionamento(){
       
        $oPersistenciaMateria = new PersistenciaMateria();
        switch ($this->getTipo()){
            case PersistenciaAreaTrabalho::MATERIA:
                $oPersistenciaMateria = $oPersistenciaMateria->setRelacionamento();
                break;
        }
        return $oPersistenciaMateria;
    }
    
    private function pesquisaSuggest($oPersistencia){
        
        $sugestao = new ControllerSugestao();
        //print_r(get_declared_classes());
        $r = $sugestao->buscaSugestao($this->getPesquisa(), $oPersistencia);
        echo json_encode($r); 
    }
    
}

$executar = new ControllerAreaTrabalho();
$executar->processaDados();
