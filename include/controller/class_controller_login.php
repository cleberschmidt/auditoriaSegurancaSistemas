<?php
session_start();
class ControllerLogin extends ControllerPadrao{

    function __construct($aJson) {
        $oModelLogin = new ModelLogin();
        $oModelLogin->setEmail($aJson['email']);
        $oModelLogin->setPassword(md5($aJson['password']));

        $this->setModel($oModelLogin);
    }
    
    function processaDados(){
        $oPersistenciaLogin = new PersistenciaLogin();
        $oPersistenciaLogin->setRelacionamento();
        
        $oControllerPadraoEstrutura = new ControllerPadraoEstrutura();
        if($aModel = $oControllerPadraoEstrutura->buscaDados($this->getModel(), PersistenciaAreaTrabalho::TIPO_RETORNO_OBJETO)){
            
            foreach($aModel as /* @var $oModel ModelLogin */ $oModel){
                $nomeUsuario = $oModel->getNomeUsuario();
            }
            $_SESSION['nomeUsuario'] = $nomeUsuario;
            return true;
        }
    }
}