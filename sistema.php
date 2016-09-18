<?php
if(!isset($_SESSION['nomeUsuario'])){
   echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=index.php'>";
}else{
   require 'sistema_padrao.php';
}