<?php
session_start();
class ControllerLogin extends ControllerPadrao{

    function __construct($aJson) {
        $oModelLogin = new ModelLogin();
        $oModelLogin->setEmail($aJson['email']);
        $oModelLogin->setPassword(md5($aJson['password']));

        $this->setModel($oModelLogin);
    }
    
    public function processaDados(){
        $oPersistenciaLogin = new PersistenciaLogin();
        $oPersistenciaLogin->setRelacionamento();
        
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        if($aModel = $oControllerPadraoEstrutura->buscaDados($this->getModel(), PersistenciaAreaTrabalho::TIPO_RETORNO_OBJETO)){
            
                foreach($aModel as /* @var $oModel ModelLogin */ $oModel){
                    $codigoUsuario = $oModel->getCodigo();
                    $nomeUsuario   = $oModel->getNomeUsuario();
                    $iStatus       = (int) $oModel->getStatus();
                    $iNivelAcesso  = (int) $oModel->getNivel();
                    $sEmail        = $oModel->getEmail();
                }
                
                if($this->isUsuarioAtivo($iStatus)){
                    $_SESSION['codigoUsuario'] = $codigoUsuario;
                    $_SESSION['nomeUsuario']   = $nomeUsuario;
                    $_SESSION['nivelUsuario']  = $iNivelAcesso;
                    
                    $oControllerPermissao = new ControllerPermissao();
                    $aPermissao = $oControllerPermissao->buscaPermissao();
                    
                    $_SESSION['tabelaUsuario'] = $aPermissao[0]['per_tabela_usuario'];
                    $_SESSION['tabelaProduto'] = $aPermissao[0]['per_tabela_produto'];
                    $_SESSION['tabelaCliente'] = $aPermissao[0]['per_tabela_cliente'];
                    $_SESSION['tabelaVenda']   = $aPermissao[0]['per_tabela_venda'];
                    $_SESSION['tabelaEstado']  = $aPermissao[0]['per_tabela_estado'];
                    $_SESSION['tabelaCidade']  = $aPermissao[0]['per_tabela_cidade'];
                    $_SESSION['tabelaCep']     = $aPermissao[0]['per_tabela_cep'];
                    
                    return true;
                }else{
                    $_SESSION['textoMensagemNomeUsuario']  = $nomeUsuario;
                    $_SESSION['textoMensagemEmailUsuario'] = $sEmail;
                    return false;
                }
                
        }else{
            if($oControllerPadraoEstrutura->tentativaLogin($this->getModel()->getEmail())){
                $_SESSION['textoMensagemNomeUsuario']  = "(não identificado)";
                $_SESSION['textoMensagemEmailUsuario'] = $this->getModel()->getEmail();
                return false;
            }
        }
    }
    
    private function isUsuarioAtivo($iStatus){
        return $iStatus == 1 ? true : false;
    }
    
    public function isUsuarioPodeLogar(){
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        if($oControllerPadraoEstrutura->buscaNumeroTentativaLogin($this->getModel()->getEmail())){
                return false;
        }
        return true;
    }
}