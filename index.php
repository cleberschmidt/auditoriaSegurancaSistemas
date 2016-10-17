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
                                    alert('Algo deu errado!');
                                    break;
                                case 3:
                                    alert('E-mail ou Senha não confere!');
                                    break;
                                case 4:
                                    alert('Acesso bloqueado! \nSomente o administrador pode liberar o seu acesso agora!\nUm e-mail foi enviado para o administrador!');
                                    break;
                                default:
                                    /* Retorno do click do botão 'Alterar' */
                                    if(xResultado[0] == 2){
                                        console.log('Retorno do click do botão Alterar!');
                                        JSON.stringify(xResultado);

                                        localStorage['parametroAlterar'] = JSON.stringify(xResultado);
                 
                                        window.location.href = 'index.php?pagina=sistema&rot='+gRotinaAtual+'&acao='+gAcao; 
                                        
                                    }else{
                                        if(xResultado[1] == 2){ // Retorno de alteração ou inclusão
                                            if($(".tela_manutencao").length){ // se for retorno de inclusão ou alteração, entra aqui
                                                console.log('entrou no retorno inclusão');
                                                var telaManutencao = $(".tela_manutencao");
                                                var nomeTelaManutencao = telaManutencao.attr("id"); 

                                                var nomeTelaConsulta = nomeTelaManutencao.slice(16);

                                                $(".tela_manutencao").remove();
                                                var sJson = '{"tela_consulta":"'+nomeTelaConsulta+'"}';
                                                var oJson = JSON.parse(sJson);

                                                chamaAjax(2, oJson);
                                                break;
                                            }
                                        }else{
                                            if(xResultado[0] != 6 && xResultado[0] != 7){
                                                if($(".tela_manutencao").length){
                                                    $(".tela_manutencao").remove();
                                                }
                                                gRotina = xResultado[0];
                                                if(gRotina == 'usuario'){
                                                    gRotinaAtual = 1000;
                                                }else if(gRotina == 'produto'){
                                                    gRotinaAtual = 1001;
                                                }else if(gRotina == 'cliente'){
                                                    gRotinaAtual = 1002;
                                                }else if(gRotina == 'venda'){
                                                    gRotinaAtual = 1003;
                                                }else if(gRotina == 'estado'){
                                                    gRotinaAtual = 2000;
                                                }else if(gRotina == 'cidade'){
                                                    gRotinaAtual = 2001;
                                                }else if(gRotina == 'cep'){
                                                    gRotinaAtual = 2002;
                                                }

                                                // Se for retorno de exclusão entra aqui
                                                if(xResultado[0] == 3){
                                                    console.log('entrou no retorno exclusão');
                                                    var sJson = '{"tela_consulta":"'+xResultado[1]+'"}';
                                                    var oJson = JSON.parse(sJson);

                                                    chamaAjax(2, oJson);
                                                    break;
                                                }else if(xResultado[0] == 4){ // Retorno de click no btnIncluir - tabela estrangeira
                                                    if(!isUndefined(xResultado[1])){
                                                        var oJson = xResultado[1];

                                                        var sJson = JSON.stringify(oJson);
                                                        localStorage['inclusao'] = sJson;    
                                                    }


                                                    window.location.href = 'index.php?pagina=sistema&rot='+gRotinaAtual+'&acao=102';
                                                    break;
                                                }

                                                if(xResultado[0] == 5){ // retorno de click em selecionar
                                                    xResultado.splice(0, 1); 
                                                    var oJson = xResultado;

                                                    var sJson = JSON.stringify(oJson);
                                                    localStorage['selecionar'] = sJson;   
                                                    window.location.href = 'index.php?pagina=sistema&rot=1003&acao=102';
                                                    break;
                                                }
                                            }else{
                                                if(xResultado[0] != 7){
                                                    console.log('opa');
                                                    xResultado.splice(0, 1); 
                                                    var oJson = xResultado;

                                                    var sJson = JSON.stringify(oJson);
                                                    localStorage['selecionar'] = sJson;   
                                                    //window.location.href = 'index.php?pagina=sistema&rot=1003&acao=102';
                                                break;
                                                }else{
                                                    localStorage.removeItem('selecionar');
                                                    break;
                                                }
                                                
                                                 
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
                                            var oTr    = $("<tr />").attr("id", "tituloColuna");
                                            var oTd    = $("<td />"); 
                                            var oTh    = $("<th />").text("#");
                                            oTd.append(oTh);
                                            oTr.append(oTd);
                                            
                                            console.log(xResultado[0]);
                                            if(xResultado[0] == 'lupa'){
                                                $("#btnIncluir").fadeOut(0);
                                                $("#btnAlterar").fadeOut(0);
                                                $("#btnExcluir").fadeOut(0);
                                                $("#btnVisualizar").fadeOut(0);
                                                $("#btnSelecionar").fadeIn(0);
                                                xResultado.splice(0, 1); 
                                            }
                                            
                                            var aNomeColuna = xResultado[1];
                                            for(var iIndice in aNomeColuna){
                                                var oTd    = $("<td />").text(aNomeColuna[iIndice]);
                                                oTr.append(oTd);
                                            }
                                            
                                            
                                            xResultado.splice(0, 1); 

                                            tabelaSistemaPai.append(oTabelaSistema);
                                            oTabelaSistema.append(oTr);

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
                                                    //oInputCheckbox.setAttribute("id", "linhaSelecionada");

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
                            alert("Error: "+result.responseText);
                        }
                    });
                    
                }
                
                $("#btnEstado").click(function(){  
                    gRotinaAtual = 2000;
                    gRotina = 'Estado';
                    var sJson = '{"tela_consulta":"Estado"}';
                    var oJson = JSON.parse(sJson);
                     
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Estados');
                });
                
                $("#btnCidade").click(function(){  
                    gRotinaAtual = 2001;
                    gRotina = 'Cidade';
                    var sJson = '{"tela_consulta":"Cidade"}';
                    var oJson = JSON.parse(sJson);
                     
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Cidades');
                });
                
                $("#btnCep").click(function(){  
                    gRotinaAtual = 2002;
                    gRotina = 'Cep';
                    var sJson = '{"tela_consulta":"Cep"}';
                    var oJson = JSON.parse(sJson);
                     
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('CEP');
                });
                
                $("#btnVenda").click(function(){  
                    gRotinaAtual = 1003;
                    gRotina = 'Venda';
                    var sJson = '{"tela_consulta":"Venda"}';
                    var oJson = JSON.parse(sJson);
                     
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Vendas');
                });
                
                $("#btnUsuario").click(function(){  
                    gRotinaAtual = 1000;
                    gRotina = 'Usuario';
                    var sJson = '{"tela_consulta":"Usuario"}';
                    var oJson = JSON.parse(sJson);
                     
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Usuários');
                });
                
                $("#btnProduto").click(function(){  
                    gRotinaAtual = 1001;
                    gRotina = 'Produto';
                    var sJson = '{"tela_consulta":"Produto"}';
                    var oJson = JSON.parse(sJson);
                    
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Produtos');
                });
                
                
                $("#btnCliente").click(function(){  
                    gRotinaAtual = 1002;
                    gRotina = 'Cliente';
                    var sJson = '{"tela_consulta":"Cliente"}';
                    var oJson = JSON.parse(sJson);
                    
                    //$(this).addClass('active');
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Clientes');
                });
                
                $("#btnExcluir").click(function(){   
                    
                    var sJson = '{"tela_consulta":"'+gRotina+'","codigo": "'+gLinhaSelecionada+'"}';
                    var oJson = JSON.parse(sJson);
                    
                    /* 3 - Ação Excluir Usuário */
                    chamaAjax(3, oJson);
                });
                
                $("#btnIncluir").click(function(){   
                    localStorage.removeItem('parametroAlterar');
                    localStorage.removeItem('inclusao');
                    
                    var sJson = '{"tela_consulta": "'+gRotina+'"}';
                    var oJson = JSON.parse(sJson);

                    chamaAjax(6, oJson);
                });
                
                $("#btnVisualizar").click(function(){   
                    if(gLinhaSelecionada){
                        gAcao = 105;
                        var sJson = '{"codigo": "'+gLinhaSelecionada+'","tela_consulta": "'+gRotina+'"}';
                        var oJson = JSON.parse(sJson);

                        chamaAjax(5, oJson);
                    }
                });
                
                $("#btnAlterar").click(function(){   
                    if(gLinhaSelecionada){
                        gAcao = 103;
                        var sJson = '{"codigo": "'+gLinhaSelecionada+'","tela_consulta": "'+gRotina+'"}';
                        var oJson = JSON.parse(sJson);

                        chamaAjax(5, oJson);
                    }
                });
                
                $("#btnSelecionar").click(function(){   
                    if(gLinhaSelecionada){
                        gAcao = 106;
                        var sJson = '{"codigo": "'+gLinhaSelecionada+'"}';
                        var oJson = JSON.parse(sJson);

                        chamaAjax(7, oJson);
                    }
                });
                
                $("#btnManutencaoConfirmar").click(function(){
                    var telaManutencao = $(".tela_manutencao");
                    var nomeTelaManutencao = telaManutencao.attr("id"); // Pega o id da class

                     
                    if(nomeTelaManutencao != 'tela_manutencao_venda'){
                         
                        var sJson = '{"nomeTelaManutencao":"'+nomeTelaManutencao+'"';
                        $('.tela_manutencao input').each(function(){
                            var nomeAtributo  = $(this).attr("id");
                            var valorAtributo = $(this).val();
                            sJson += ',"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                        });

                        $('.tela_manutencao select').each(function(){
                            var nomeAtributo  = $(this).attr("nomeColuna");
                            var valorAtributo = $(this).val();
                            sJson += ',"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                            
                        });
                        sJson += '}';
                    }else{
                        
                        sJson = '{';
                        $('.tela_manutencao select').each(function(){
                            var nomeAtributo  = $(this).attr("nomeColuna");
                            var valorAtributo = $(this).val();
                            sJson += '"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                             
                        });
                        /* Gambia */
                        
                        $('.tela_manutencao_venda_gambiarra input').each(function(){
                            var nomeAtributo  = $(this).attr("id");
                            var valorAtributo = $(this).val();
                            sJson += ',"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                        });
                        sJson += '},';
                        
                        var aProduto = new Array();
                        $('.div_grid_manutencao input').each(function(){
                            var nomeAtributo  = $(this).attr("id");
                            var valorAtributo = $(this).val();
                            if(nomeAtributo == 'Produto.codigo'){
                                sJson += '{'; 
                            }
                            sJson += '"'+nomeAtributo+'"'+':'+'"'+valorAtributo+'"';
                            if(nomeAtributo == 'ItemVenda.preco'){
                                sJson += '}';
                                aProduto.push(sJson);
                                sJson = '';
                            }else{
                                sJson += ', ';
                            }
                        });
                        
                        sJson = '['+aProduto.toString()+']';
                        localStorage.removeItem('selecionar');
                    }
                    
                    
    
                    console.log(sJson);
                    var oJson = JSON.parse(sJson);
                    
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
                
                $(document).on('click', '#btnLupa', function(){
                    gRotinaAtual = 1001;
                    gRotina = 'Produto';
                    var sJson = '{"tela_consulta":"Produto", "lupa":true}';
                    var oJson = JSON.parse(sJson);
                    
                    /* 2 - Ação Carregar Dados da consulta */
                    chamaAjax(2, oJson);
                    $(".titulo_consulta").text('Produtos');
                });
                
                $(document).on('click', '#btnMenos', function(){
                    var oThis = $(this);
                    var iCodigo = oThis.parent().children('.codigo').val();
                    var sJson = '{"codigo":"'+iCodigo+'"}';
                    var oJson = JSON.parse(sJson);

                    chamaAjax(8, oJson);
                    
                    oThis.parent().children().remove();
                });
                
                $(document).on('keyup', '.quantidade', function(){
       
                    var oThis = $(this);

                    var iQuantidade = $(this).val();
                    var fPreco      = oThis.parent().children('.preco').val();

                    var valorTotal = iQuantidade * fPreco;
                    console.log('valorTotal: '+valorTotal);
                });

                $('.quantidade').click(function(){

                    var oThis = $(this);

                    var iQuantidade = $(this).val();
                    var fPreco      = oThis.parent().children('.preco').val();

                    var valorTotal = iQuantidade * fPreco;
                    console.log('valorTotal: '+valorTotal);
                });
            });
            
            /* Mais uma linha do Grid - Produtos */
            $(document).on('click', '#btnMais', function(){
            
                
                
            
                var oGrid      = $(".div_grid_manutencao");
                var oLinhaGrid = $("<div />").attr('class','div_linha_grid');

                var oInputCodigo    = $('<input  type=text     id=Produto.codigo       class="input_manutencao codigo" disabled />');
                var oButtonLupa     = $('<button type=button   id=btnLupa              class="btnManutencao" />').html('<span class="glyphicon glyphicon-search"></span>').css('margin', '0 2px 1px 2px');
                var oInputDescricao = $('<input  type=text     id=Produto.descricao    class="input_manutencao" disabled />');
                var oInputQtde      = $('<input  type=number   id=ItemVenda.quantidade class="input_manutencao quantidade" />');
                var oInputPreco     = $('<input  type=text   id=ItemVenda.preco        class="input_manutencao preco" disabled />');
                var oButtonMenos    = $('<button type="button" id="btnMenos"           class="btnManutencao" />').html('<span class="glyphicon glyphicon-minus"></span>').css('margin', '0 0 1px 2px');
                var oButtonMais     = $('<button type="button" id="btnMais"            class="btnManutencao" />').html('<span class="glyphicon glyphicon-plus"></span>').css('margin', '0 2px 1px 2px');

                oLinhaGrid.append(oInputCodigo);
                oLinhaGrid.append(oButtonLupa);
                oLinhaGrid.append(oInputDescricao);
                oLinhaGrid.append(oInputQtde);
                oLinhaGrid.append(oInputPreco);
                oLinhaGrid.append(oButtonMenos);
                oLinhaGrid.append(oButtonMais);

                oGrid.append(oLinhaGrid);
            });

            
            
            
            
            function isUndefined(xParametro){
                return typeof xParametro == 'undefined' ? true : false;
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