<?php
    if($_GET['rot'] == 1000){ // Rotina Usuário
        require 'class_view_manutencao_usuario.php';
    }else if($_GET['rot'] == 1001){ // Rotina Produto
        require 'class_view_manutencao_produto.php';
    }
