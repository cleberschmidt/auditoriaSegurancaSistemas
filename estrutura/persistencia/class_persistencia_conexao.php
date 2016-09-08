<?php

class Conexao{
 
    private static $conexao = null;
    
    const SERVIDOR = '127.0.0.1';
    const PORTA    = '3306';
    const BANCO    = 'projeto_auditoria';
    const USUARIO  = 'root';
    const SENHA    = '';
    
    public static function conectar(){
        if(is_null(self::$conexao)){
            self::$conexao = @mysql_connect(self::SERVIDOR, self::USUARIO, self::SENHA) 
            or die ("Não foi possível conectar ao servidor MySQL");
            mysql_select_db(self::BANCO) or die("Não foi possível conectar ao banco de dados MySQL;");
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
            mysql_close(self::$conexao);
        }
    }
    
    public static function memoriaConsumidaPeloPHP(){
        echo "Memória utilizada até o momento: ".memory_get_usage()." bytes\n";
    }
    
    public function __destruct() {}
    
    
}



