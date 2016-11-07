<?php
require 'PHPMailer.php';
require 'SMTP.php';
class EnvioEmail{
    
    private $servidor = 'smtp-mail.outlook.com';
    private $porta    = 587;
    private $conta    = 'cleber_blacks7@hotmail.com';
    private $senha    = 'rozelito';
    
    private $PHPMailer;
    
    function __construct(){
        $this->PHPMailer = new PHPMailer();
        $this->configuraEnvio();
    }
    
    private function configuraEnvio(){
        //Configura��es para envio
        //Informa que o envio ocorre atrav�s de SMTP
        $this->PHPMailer->isSMTP();
        
        $this->PHPMailer->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        ));
        
        //Endere�o do servidor respons�vel pelo envio        
        $this->PHPMailer->SMTPAuth   = true; //Usa autentica��o
        $this->PHPMailer->SMTPSecure = 'tls';
        
        $this->PHPMailer->Host       = $this->servidor;
        $this->PHPMailer->Port       = $this->porta;
        
        $this->PHPMailer->Username   = $this->conta; //Usu�rio de envio
        $this->PHPMailer->Password   = $this->senha; //Senha
        
        //Remetente
        $this->PHPMailer->From       = $this->conta;
        
        //Dados t�cnicos da mensagem
        $this->PHPMailer->isHTML(); //Conte�do ser� em formato HTML        
        $this->PHPMailer->CharSet = 'UTF-8';
    }
    
    public function addDestinatario($sDestinatario){
        $this->PHPMailer->addAddress($sDestinatario);
    }
    
    public function setAssunto($sAssunto){
        $this->PHPMailer->Subject = $sAssunto;
    }

    public function setMensagem($sMensagem){
        $this->PHPMailer->Body = $sMensagem;
        
    }

    public function enviaEmail(){
        return $this->PHPMailer->Send();
    }
}
/*
$oEnvioEmail = new EnvioEmail();
$oEnvioEmail->setAssunto('teste');
$oEnvioEmail->setMensagem('ola');
$oEnvioEmail->addDestinatario('cleberjoseschmidt@gmail.com');
$oEnvioEmail->enviaEmail();
*/