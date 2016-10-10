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
        <link href="estrutura/core/css/manutencao.css" rel="stylesheet">
    </head>
    <body>
        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="framework/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="estrutura/core/js/default.js"></script>
        
        <script>
            var gLinhaSelecionada;
            var gRotinaAtual;
            var gAcao;
            
            var gRotina;
            
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
                        success: function(xResultado){
                            switch(xResultado){
                                case 1:
                                    window.location.href = 'index.php?pagina=sistema';
                                    break;
                                case 2:
                                    console.log(xResultado);
                                    break;
                                default:
                                    /* receber um Array */
                                    if(xResultado[0] == 2){
                                        for(var iIndice in xResultado){
                                            var sJson = JSON.stringify(xResultado[iIndice]);
                                            localStorage['parametroAlterar'] = sJson;
                                        }
                                        window.location.href = 'index.php?pagina=sistema&rot='+gRotinaAtual+'&acao='+gAcao; 
                                        
                                    }else{
                                  
                                        if($(".tela_manutencao").length){ // se for retorno de inclusão ou alteração, entra aqui
                                            var telaManutencao = $(".tela_manutencao");
                                            var nomeTelaManutencao = telaManutencao.attr("id"); 
                                            
                                            var nomeTelaConsulta = nomeTelaManutencao.slice(16);
                                            
                                            $(".tela_manutencao").remove();
                                            var sJson = '{"tela_consulta":"'+nomeTelaConsulta+'"}';
                                            var oJson = JSON.parse(sJson);

                                            chamaAjax(2, oJson);
                                            break;
                                        }else{
                                            
                                            gRotina = xResultado[0];
                                            if(gRotina == 'usuario'){
                                                gRotinaAtual = 1000;
                                            }else if(gRotina == 'produto'){
                                                gRotinaAtual = 1001;
                                            }
                                            
                                            // Se for retorno de exclusão entra aqui
                                            if(xResultado[0] == 3){
                                                var sJson = '{"tela_consulta":"'+xResultado[1]+'"}';
                                                var oJson = JSON.parse(sJson);

                                                chamaAjax(2, oJson);
                                                break;
                                            }
                                        
                                            var containerConsulta = $('#container_consulta');

                                            if(!$("#tabelaSistema").length){
                                                var oDiv = $("<div />").addClass("table-responsive").attr("id", "tabelaSistemaPai");
                                                containerConsulta.append(oDiv);
                                            }

                                            /* criar table padrão */
                                            var tabelaSistemaPai = $("#tabelaSistemaPai");

                                            if($("#tabelaSistema").length){
                                                $("#tabelaSistema").remove();
                                            }
                                            var oTabelaSistema = $("<table />").addClass("table table-striped").attr("id", "tabelaSistema");
                                            var oThead = $("<thead />");
                                            var oTr    = $("<tr />");
                                            var oTh    = $("<th />").text("#");

                                            tabelaSistemaPai.append(oTabelaSistema);
                                            oTabelaSistema.append(oThead);
                                            oThead.append(oTr);
                                            oTr.append(oTh);


                                            for(var iIndice in xResultado){
                                                if(iIndice > 0){

                                                    var aModel = xResultado[iIndice];
                                                    var oLinha = document.createElement("tr");
                                                    oLinha.setAttribute("id", "linhaConsulta");
                                                    //oLinha.setAttribute("onclick", "linhaSelecionada("+aModel.codigo+")");
                                                    var oColuna = document.createElement("td");
                                                    oColuna.setAttribute("id", "checkbox");
                                                    var oInputCheckbox = document.createElement("input");
                                                    oInputCheckbox.setAttribute("type", "checkbox");
                                                    oInputCheckbox.setAttribute("class", "checkbox");
                                                    oInputCheckbox.setAttribute("id", "linhaSelecionada");

                                                    oColuna.appendChild(oInputCheckbox);
                                                    oLinha.appendChild(oColuna);
                                                    for(var sIndice in aModel){
                                                        var oColuna = document.createElement("td");
                                                        oColuna.setAttribute("id", sIndice);
                                                        oColuna.textContent = aModel[sIndice];
                                                        oLinha.appendChild(oColuna);
                                                    }
                                                    oTabelaSistema.append(oLinha);
                                                } 
                                            }
                                            break;
                                        }
                                    } 
                            }
                        },
                        error: function (result) {
                            alert("deu erro "+result.responseText);
                        }
                    });
                    
                }
                
                $("#btnUsuario").click(function(){  
                    gRotinaAtual = 1000;
                    gRotina = 'Usuario';
                    var sJson = '{"tela_consulta":"Usuario"}';
                    var oJson = JSON.parse(sJson);
                    
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                });
                
                $("#btnProduto").click(function(){  
                    gRotinaAtual = 1001;
                    gRotina = 'Produto';
                    var sJson = '{"tela_consulta":"Produto"}';
                    var oJson = JSON.parse(sJson);
                    
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                });
                
                $("#btnExcluir").click(function(){   
                    
                    var sJson = '{"tela_consulta":"'+gRotina+'","codigo": "'+gLinhaSelecionada+'"}';
                    var oJson = JSON.parse(sJson);
                    
                    /* 3 - Ação Excluir Usuário */
                    chamaAjax(3, oJson);
                });
                
                $("#btnIncluir").click(function(){   
                    localStorage.removeItem('parametroAlterar');
                    window.location.href = 'index.php?pagina=sistema&rot='+gRotinaAtual+'&acao=102';
                });
                
                $("#btnVisualizar").click(function(){   
                    if(gLinhaSelecionada){
                        gAcao = 105;
                        var sJson = '{"codigo": "'+gLinhaSelecionada+'","tela_consulta": "'+gRotina+'"}';
                        var oJson = JSON.parse(sJson);

                        /* 3 - Ação Alterar Usuário */
                        chamaAjax(5, oJson);
                    }
                });
                
                $("#btnAlterar").click(function(){   
                    if(gLinhaSelecionada){
                        gAcao = 103;
                        var sJson = '{"codigo": "'+gLinhaSelecionada+'","tela_consulta": "'+gRotina+'"}';
                        var oJson = JSON.parse(sJson);

                        /* 3 - Ação Alterar */
                        chamaAjax(5, oJson);
                    }
                });
                
                $("#btnManutencaoConfirmar").click(function(){
                    var telaManutencao = $(".tela_manutencao");
                    var nomeTelaManutencao = telaManutencao.attr("id"); // Pega o id da class

                    var sJson = '{"nomeTelaManutencao":"'+nomeTelaManutencao+'"';
                  
                    $('.tela_manutencao input').each(function(){
                        var nomeAtributo  = $(this).attr("id");
                        var valorAtributo = $(this).val();
                        sJson += ',"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                    });
                    
                    
                    $('.tela_manutencao select').each(function(){
                        var nomeAtributo  = $(this).attr("id");
                        var valorAtributo = $(this).val();
                        sJson += ',"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                    });
                    
                    sJson += '}';
                    var oJson = JSON.parse(sJson);
                    
                    console.log(oJson);
                    /* 4 - Ação incluir */
                    chamaAjax(4, oJson);
                });
                
                $("#btnManutencaoLimpar").click(function(){
                    $('.tela_manutencao input').each(function(){
                        $(this).val('');
                    });
                });
                
                
                $(document).on('click', '#linhaConsulta', function(){
                    gLinhaSelecionada = $(this).children('td#codigo').text();
                    
                    //$(this).children().find('input[type="checkbox"]').attr('checked', true);
                    $(this).parent().children().find('input[type="checkbox"]').attr('checked', false);
  
                    if($(this).children().find('input[type="checkbox"]').prop('checked')){
                        $(this).children().find('input[type="checkbox"]').prop('checked', false);
                    }else{
                        $(this).children().find('input[type="checkbox"]').prop('checked', true);
                    }
                });
            });
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