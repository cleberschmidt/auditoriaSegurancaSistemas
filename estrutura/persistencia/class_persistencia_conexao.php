<?php

class Conexao{
 
    private static $conexao = null;
    
    const SERVIDOR = '127.0.0.1';
    const PORTA    = '5433';
    const BANCO    = 'projeto_auditoria';
    const USUARIO  = 'postgres';
    const SENHA    = 'postgres';
    
    public static function conectar(){
        if(is_null(self::$conexao)){
            self::$conexao = pg_connect("host     =".self::SERVIDOR."
                                         port     =".self::PORTA." 
                                         dbname   =".self::BANCO." 
                                         user     =".self::USUARIO."
                                         password =".self::SENHA) 
            or die ("Não foi possível conectar ao servidor PostgreSQL");
        }
        return self::$conexao;
    }
    
    public static function statusConexao(){
        $status = pg_connection_status(self::$conexao);
        if($status === 0){
            echo 'status da conexão: Conectado com o servidor PostgreSQL';
        }else{
            echo 'status da conexão: Não conectado com o servidor PostgreSQL';
        }
    }
    
    public static function desconectar(){
        if(!is_null(self::$conexao)){
            pg_close(self::$conexao);
            self::$conexao = null;
        }
    }
    
    public static function memoriaConsumidaPeloPHP(){
        echo "Memória utilizada até o momento: ".memory_get_usage()." bytes\n";
    }
    
    public function __destruct() {}

}



