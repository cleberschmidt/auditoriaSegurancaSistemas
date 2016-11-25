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
    
    static public $bCarregaConsulta;
    static public $sAcao;
            
    function __construct() {   
        $this->processaDados();
    }

    public function processaDados(){
        $this->parametrosAjax();
    }
    
    private function parametrosAjax(){
        self::$bCarregaConsulta = false;
        
        
        
        if(isset($_POST['iProcesso'])){
            $iProcesso = $_POST['iProcesso'];
            
            if(isset($_POST['oJson'])){
                $aJson = $_POST['oJson'];
            }
                    
            switch($iProcesso){
                case PersistenciaAreaTrabalho::PROCESSO_LOGIN_SISTEMA:
                    $oControllerLogin = new ControllerLogin($aJson);
                    if($oControllerLogin->processaDados()){  
                        /* Logado com sucesso */
                        
                        echo json_encode(self::RECARREGAR_PAGINA_PRINCIPAL); 
                    }else{
                        
                        if(!$oControllerLogin->isUsuarioPodeLogar()){
                            /* Enviar e-mail para o administrador */
                            $this->enviarEmailAdministrador();
                            
                            echo json_encode(4); 
                        }else{
                            echo json_encode(3); 
                        }
                    }
                    break;
                case PersistenciaAreaTrabalho::ACAO_CARREGAR_DADOS: // Carrega todos os dados da consulta
                    $sNomeTelaConsulta = ucfirst($aJson['tela_consulta']);
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController();
                    self::$bCarregaConsulta = true;
                    
                    if(isset($aJson['codigoUsuario'])){
                        $oController->zerarTentativaLogin($aJson['codigoUsuario']);
                    }
                    
                    
                    $aModel = $oController->getAllFromModel();
                    
                    if(!is_null($aModel)){
                        $aModel = $this->addIdentificadorProcesso($aModel, $sNomeTelaConsulta);
                    }else{
                        $aModel = Array(0 => 666, $sNomeTelaConsulta);
                    }

                    
                    if(isset($aJson['lupa'])){
                        $aModel = $this->addIdentificadorProcesso($aModel, 'lupa');
                    }

                    echo json_encode($aModel); 
                    break;
                case PersistenciaAreaTrabalho::ACAO_EXCLUIR_REGISTRO: // Exclui um registro
                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                    array_shift($aJson);
                    
                    if(isset($aJson['acao'])){
                        self::$sAcao = $aJson['acao'];
                        unset($aJson['acao']);
                    }
                    
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController();
                    if($oController->exclui($aJson)){
                        echo json_encode(Array(0 => 3, 1 => $sNomeTelaConsulta)); 
                    }
                    break;
                case 4: // Ação incluir e Alterar
                    
                    if(isset($aJson['password'])){
                        $aJson['password'] = md5($aJson['password']);
                    }
                    
                    
                    if(!isset($aJson['nomeTelaManutencao'])){ //Então é venda
                        /* Exclusivo para Venda */
                        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
                        $oControllerPadraoEstrutura->insereDadosVenda($aJson);
                        session_start();
                        unset($_SESSION['oProdutoGrid']);
                        echo json_encode(Array(0 => 1, 1 => 2)); 
                        
                        
                    
                        
                    }else{
                        $sNomeTelaManutencao = $aJson['nomeTelaManutencao'];
                        array_shift($aJson);
                        if($sNomeTelaManutencao == 'tela_manutencao_permissao'){
                            $sNomeClasse = substr($sNomeTelaManutencao, 16); // Retira os 16 primeiros caracteres
                            $sPersistencia = 'Persistencia'.ucfirst($sNomeClasse);

                            $oPersistencia = new $sPersistencia();
                            $oPersistencia->setRelacionamento();
                            
                            $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
                            if($oControllerPadraoEstrutura->alteraDados($aJson)){
                                
                                session_start();
                                $oControllerPermissao = new ControllerPermissao();
                                $aPermissao = $oControllerPermissao->buscaPermissao();

                                $_SESSION['tabelaUsuario'] = $aPermissao[0]['per_tabela_usuario'];
                                $_SESSION['tabelaProduto'] = $aPermissao[0]['per_tabela_produto'];
                                $_SESSION['tabelaCliente'] = $aPermissao[0]['per_tabela_cliente'];
                                $_SESSION['tabelaVenda']   = $aPermissao[0]['per_tabela_venda'];
                                $_SESSION['tabelaEstado']  = $aPermissao[0]['per_tabela_estado'];
                                $_SESSION['tabelaCidade']  = $aPermissao[0]['per_tabela_cidade'];
                                $_SESSION['tabelaCep']     = $aPermissao[0]['per_tabela_cep'];
                                
                                echo json_encode(Array(0 => 1, 1 => 2, 2 => 3)); 
                            }
                
                        }else{
                            // Inclusão normal


                            $iAcao = (int) $aJson['acao'];
                            array_shift($aJson);

                            $sNomeClasse = substr($sNomeTelaManutencao, 16); // Retira os 16 primeiros caracteres
                            $sPersistencia = 'Persistencia'.ucfirst($sNomeClasse);

                            $oPersistencia = new $sPersistencia();
                            $oPersistencia->setRelacionamento();

                            $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();

                            $aJson = $this->verificaData($aJson);

                            
                            if($iAcao == 103){
                                self::$sAcao = 'alterar';
                                if($oControllerPadraoEstrutura->alteraDados($aJson)){

                                    echo json_encode(Array(0 => 1, 1 => 2)); 
                                }
                            }else{

                                self::$sAcao = 'inserir';
                                /* Default */
                                 if($oControllerPadraoEstrutura->insereDados($aJson)){

                                    echo json_encode(Array(0 => 1, 1 => 2)); 
                                }
                            }
                        }
                    }
                    break;
                case 5: // Ação alterar //Retorna somente um model
                    
                    $aJson = $_POST['oJson'];

                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                                        
                    if(isset($aJson['acao'])){
                        self::$sAcao = $aJson['acao'];
                        unset($aJson['acao']);
                    }
                    
                    $aJsonAux = Array();
                    foreach($aJson as $sIndice => $sValor){
                       if($sIndice != 'tela_consulta'){
                           $aJsonAux[$sIndice] = $sValor;
                       } 
                    }
                    $aJson = $aJsonAux;
                    
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController          = new $sController($aJson); // segundo parametro ação de alterar / visualização
                    $aModel               = $oController->getFromModel();
                    $aModelRelacionamento = Array();
                    if($sNomeTelaConsulta != "Permissao"){
                        $aModelRelacionamento = $oController->getAllFromModelRelacionamento();
                    }
                    $aModel = $this->addIdentificadorProcesso($aModel, 2);
                    
                    array_push($aModel, $aModelRelacionamento);
                    echo json_encode($aModel); 

                    break;
                case 6: // Clicado em Incluir, verifica se possui tabelas relacionadas
                    $aJson = $_POST['oJson'];

                    $sNomeTelaConsulta = $aJson['tela_consulta'];
                    $sPersistencia = 'Persistencia'.ucfirst($sNomeTelaConsulta);
                    $sController = 'Controller'.ucfirst($sNomeTelaConsulta);
                    
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $oController = new $sController();
                    
                    $aModelRelacionamento = Array();
                   
                    $aModelRelacionamento = $oController->getAllFromModelRelacionamento();
                    
                    $aModelRelacionamento = $this->addIdentificadorProcesso($aModelRelacionamento, 4);
                    
                    echo json_encode($aModelRelacionamento); 
                    break;
                case 7:
                    $aJson = $_POST['oJson'];
                    $bJaTem = false;
                    $oPersistenciaProduto = new PersistenciaProduto();
                    $oPersistenciaProduto->setRelacionamento();
                    
                    $oControllerProduto = new ControllerProduto($aJson);
                    $aModel = $oControllerProduto->getFromModel();
                    
                    session_start();
                    if(isset($_SESSION['oProdutoGrid'])){
                        $aProdutoGrid = $_SESSION['oProdutoGrid'];
                        $aAux = Array();
                        foreach($aProdutoGrid as $aProduto){
                            $aAux[] = $aProduto;
                        }
                        
                        
                        foreach ($aAux as $aSession){
                            if($aSession['codigo'] == $aModel[0]['codigo']){
                                $bJaTem = true;
                            }
                        }
                        if(!$bJaTem){
                            array_push($aAux, $aModel[0]);
                            $_SESSION['oProdutoGrid'] = $aAux;
                        }
                    }else{
                        $_SESSION['oProdutoGrid'] = $aModel;
                    }
                    
                    $aModel = $_SESSION['oProdutoGrid'];
                    
                    if($bJaTem){
                        $aModel = $this->addIdentificadorProcesso($aModel, 13); //Já foi adicionado
                    }else{
                        $aModel = $this->addIdentificadorProcesso($aModel, 5);
                    }
                    
                    
                    echo json_encode($aModel);
                    break;
                case 8: // remove do session produto
                    session_start();
                    $aProdutos = $_SESSION['oProdutoGrid'];
                    
                    $aAux = Array();
                    foreach ($aProdutos as $aProduto){
                        if($aProduto['codigo'] != $aJson['codigo']){
                            $aAux[] = $aProduto;
                        }
                    }
                    $_SESSION['oProdutoGrid'] = $aAux;
                    $t = 6;
                    if(empty($aAux)){
                        $t = 7;
                    }
                    $aAux = $this->addIdentificadorProcesso($aAux, $t);
                    echo json_encode($aAux);
                    break;
                
            }
        }
    }
    
    private function addIdentificadorProcesso($aModel, $xIdentificador){
        array_unshift($aModel, $xIdentificador);
        return $aModel;
    }
    
    private function verificaData($aJson){
        foreach($aJson as $sPropriedade => $sValor){
            $sPropriedadeData = substr($sPropriedade, 0, 4); // 4 = data
            if($sPropriedadeData == 'data'){
                if(empty($sValor)){
                    date_default_timezone_set('America/Sao_Paulo');
                    $sData = date('Y-m-d');
                    $aJson[$sPropriedade] = $sData;
                }
            }
        }
        return $aJson;
    }
    
    /* Enviar e-mail para o administrador */
    private function enviarEmailAdministrador(){
        require '../../estrutura/core/email/EnvioEmail.php';
        $oControllerEstruturaPadrao = new ControllerPadraoEstrutura();
        $oControllerEstruturaPadrao->envioEmailAdm();
        
    }
}
$oControllerAreaTrabalho = new ControllerAreaTrabalho();

                
