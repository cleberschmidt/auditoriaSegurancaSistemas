<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="framework/bootstrap-3.3.6-dist/css/bootstrap.css" rel="stylesheet">

        <link href="cover.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
    </head>
    <body>
        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="framework/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="estrutura/core/js/default.js"></script>
        
        <script>
            $(document).ready(function(){
                $("#btnLogarSistema").click(function(){
                    var sEmail    = $("#inputEmail").val();
                    var sPassword = $("#inputPassword").val();
                    
                    var sJson = '{"email": "'+sEmail+'","password": "'+sPassword+'"}';
                    var oJson = JSON.parse(sJson);
                    
                    /* 1 - Ato logar */
                    chamaAjax(1, oJson);
                });
      
                function chamaAjax(iProcesso, oJson){
                    $.ajax({
                        url: "include/controller/class_controller_area_trabalho.php",
                        dataType: 'json',
                        type: 'post',
                        data:{
                            iProcesso : iProcesso,
                            oJson: oJson
                        },
                        success: function(iResultado){
                            switch(iResultado){
                                case 1:
                                    window.location.href = 'index.php?pagina=sistema';
                                    break;
                            }
                        },
                        error: function (result) {
                            alert("deu erro "+result.responseText);
                        }
                    });
                    
                }
                
                $("#btnUsuario").click(function(){                  
                    var sJson = '{}';
                    var oJson = JSON.parse(sJson);
                    
                    /* 2 - Ação Carregar Usuários */
                    chamaAjax(2, oJson);
                });
                
                
            });
            
            function linhaSelecionada(iCodigo){
                var oCheckbox = document.getElementById('linha'+iCodigo);
                if(oCheckbox.checked == true){
                    oCheckbox.checked = false;
                }else{
                    oCheckbox.checked = true;
                }
            }
        </script>
        
        <div class="site-wrapper">

            <div class="site-wrapper-inner">

                <div class="cover-container paginaInicial">

                    <div class="masthead clearfix cabalho-sistema">
                        <div class="inner">
                            <h3 class="masthead-brand">Winphor</h3>
                            <nav>
                                <ul class="nav masthead-nav">

                                    <li class="active"><a href="#">Favoritos</a></li>
                                    <li><a href="#">Ajuda</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>

                    <div class="boxPrincipal">
                        <?php
                        if(isset($_GET['pagina'])){
                            require $_GET['pagina'].'.php';       
                        }else{
                            require 'home.php';
                        }
                        ?>
                    </div>
                <div class="cover-container paginaInicial">
                    <div class="mastfoot">
                        <div class="inner">
                            <p>Template desenvolvido por <a href="http://getbootstrap.com">Cleber José Schmidt</a>.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </body>
</html>