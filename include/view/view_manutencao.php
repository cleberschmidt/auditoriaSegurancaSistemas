<?php
    if($_GET['rot'] == 1000){ // Rotina Usuário
        require 'class_view_manutencao_usuario.php';
    }else if($_GET['rot'] == 1001){ // Rotina Produto
        require 'class_view_manutencao_produto.php';
    }else if($_GET['rot'] == 1002){ // Rotina Cliente
        require 'class_view_manutencao_cliente.php';
    }else if($_GET['rot'] == 2000){ // Rotina Estado
        require 'class_view_manutencao_estado.php';
    }else if($_GET['rot'] == 2001){ // Rotina Cidade
        require 'class_view_manutencao_cidade.php';
    }else if($_GET['rot'] == 2002){ // Rotina Cep
        require 'class_view_manutencao_cep.php';
    }else if($_GET['rot'] == 1003){ // Rotina Venda
        require 'class_view_manutencao_venda.php';
    }else if($_GET['rot'] == 3000){ // Rotina Venda
        require 'class_view_manutencao_permissao.php';
    }
    

?>
<script>
 
    /* JS ATUAL */
    
    var validarPermissaoViewManutencao = function(){
        switch(getRotinaUrl()){
            case "1000":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaUsuario']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "1001":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaProduto']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "1002":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaCliente']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "1003":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaVenda']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "2000":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaEstado']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "2001":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaCidade']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "2002":
                var permissoesAcesso = ('<?php echo $_SESSION['tabelaCep']; ?>');
                validarPermissoes(permissoesAcesso);
                break;
            case "3000":
                var permissoesAcesso = "1,2,1,2";
                validarPermissoes(permissoesAcesso);
                break;
        }
         
    };
    
    var validarPermissoes = function(sPermissao){
        $("#btnVisualizar").removeClass("disabled");
        $("#btnIncluir").removeClass("disabled");
        $("#btnAlterar").removeClass("disabled");
        $("#btnExcluir").removeClass("disabled");

        if(sPermissao[0] == 2){ // Visualização
            $("#btnVisualizar").addClass("disabled");
        }
        if(sPermissao[2] == 2){ // Inserção
            $("#btnIncluir").addClass("disabled");
        }
        if(sPermissao[4] == 2){ // Alteração
            $("#btnAlterar").addClass("disabled");
        }
        if(sPermissao[6] == 2){ // Exclusão
            $("#btnExcluir").addClass("disabled");
        }
    };
    
    validarPermissaoViewManutencao();
    
    
    
    if(localStorage['parametroAlterar']){
        
        var iAcao = getAcaoUrl();
        console.log(iAcao);
     
        var sJson = localStorage['parametroAlterar'];
        var aJson = JSON.parse(sJson);
        
        var oCampoTelaManutencao = aJson[1]; // Objeto com os valores que serão setados nos campos da tela Ex: Objeto produto
        console.log(oCampoTelaManutencao);
        aJson.splice(0, 2);
        console.log(aJson);
        
       var aJson = aJson[0];

        if(iAcao == 105){
            if(getRotinaUrl() != "3000"){
                $('.tela_manutencao input').each(function(){
                    var nomeAtributo  = $(this).attr("id");
                    for(var propriedade in oCampoTelaManutencao){
                        if(propriedade == nomeAtributo){
                            $(this).val(oCampoTelaManutencao[propriedade]);
                            $(this).attr('disabled','disabled');
                            break;
                        }
                    }
                });

                $('.tela_manutencao select').each(function(){
                    var nomeAtributo  = $(this).attr("nomeColuna");
                    for(var indice in aJson){
                        var aExterno = aJson[indice];
                        for(var propriedade in aExterno){
                            var oJsonAux = aExterno[propriedade];
                            var oOption = $(this);
                            var valor;
                            var texto;
                            var isConferido = false;
                            for(var propriedadeAux in oJsonAux){
                                if(nomeAtributo == propriedadeAux){
                                    valor = oJsonAux[propriedadeAux];
                                    isConferido = true;
                                }else{
                                    texto = oJsonAux[propriedadeAux];
                                }
                            }
                            if(isConferido){
                                oOption.append($("<option />").val(valor).text(texto));
                                isConferido = false;
                            }
                        }
                    }     
                });

                /* Moer de novo para setar os option corretos - Aqui dá boa */ 
                $('.tela_manutencao select').each(function(){
                    var nomeAtributo  = $(this).attr("nomeColuna");
                    for(var propriedade in oCampoTelaManutencao){
                        if(nomeAtributo == propriedade){
                            $(this).val(oCampoTelaManutencao[propriedade]);
                            $(this).attr('disabled','disabled');
                        }
                    }
                });
            }else{
                for(var propriedade in oCampoTelaManutencao){
                    if(propriedade == "Usuario.codigo"){
                        $(".nomeUsuario").text(oCampoTelaManutencao[propriedade]);
                    }
                }
                
                var sCheckbox = oCampoTelaManutencao.tabelaUsuario;
                if(sCheckbox[0] == 1){
                    $("#linha_usuario .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_usuario .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_usuario .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_usuario .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaProduto;
                $("#linha_produto .v").attr("disabled", true);
                $("#linha_produto .i").attr("disabled", true);
                $("#linha_produto .a").attr("disabled", true);
                $("#linha_produto .e").attr("disabled", true);
                $("#linha_cliente .v").attr("disabled", true);
                $("#linha_cliente .i").attr("disabled", true);
                $("#linha_cliente .a").attr("disabled", true);
                $("#linha_cliente .e").attr("disabled", true);
                $("#linha_venda .v").attr("disabled", true);
                $("#linha_venda .i").attr("disabled", true);
                $("#linha_venda .a").attr("disabled", true);
                $("#linha_venda .e").attr("disabled", true);
                $("#linha_estado .v").attr("disabled", true);
                $("#linha_estado .i").attr("disabled", true);
                $("#linha_estado .a").attr("disabled", true);
                $("#linha_estado .e").attr("disabled", true);
                $("#linha_cidade .v").attr("disabled", true);
                $("#linha_cidade .i").attr("disabled", true);
                $("#linha_cidade .a").attr("disabled", true);
                $("#linha_cidade .e").attr("disabled", true);
                $("#linha_cep .v").attr("disabled", true);
                $("#linha_cep .i").attr("disabled", true);
                $("#linha_cep .a").attr("disabled", true);
                $("#linha_cep .e").attr("disabled", true);
                
                if(sCheckbox[0] == 1){
                    $("#linha_produto .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_produto .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_produto .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_produto .e").attr("checked", true);
                    
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCliente;
                if(sCheckbox[0] == 1){
                    $("#linha_cliente .v").attr("checked", true);
                    
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cliente .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cliente .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cliente .e").attr("checked", true);
                    
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaVenda;
                if(sCheckbox[0] == 1){
                    $("#linha_venda .v").attr("checked", true);
                    
                }
                if(sCheckbox[2] == 1){
                    $("#linha_venda .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_venda .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_venda .e").attr("checked", true);
                    
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaEstado;
                if(sCheckbox[0] == 1){
                    $("#linha_estado .v").attr("checked", true);
                    
                }
                if(sCheckbox[2] == 1){
                    $("#linha_estado .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_estado .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_estado .e").attr("checked", true);
                    
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCidade;
                if(sCheckbox[0] == 1){
                    $("#linha_cidade .v").attr("checked", true);
                    
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cidade .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cidade .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cidade .e").attr("checked", true);
                    
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCep;
                if(sCheckbox[0] == 1){
                    $("#linha_cep .v").attr("checked", true);
                    
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cep .i").attr("checked", true);
                    
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cep .a").attr("checked", true);
                    
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cep .e").attr("checked", true);
                    
                }
            }
            $('#btnManutencaoConfirmar').attr('disabled', 'disabled');   
            $('#btnManutencaoLimpar').attr('disabled', 'disabled');   
        }else if(iAcao == 103){ // Alteração
            if(getRotinaUrl() != "3000"){
                $('.tela_manutencao input').each(function(){
                    var nomeAtributo  = $(this).attr("id");
                    for(var propriedade in oCampoTelaManutencao){
                        if(propriedade == nomeAtributo){
                            $(this).val(oCampoTelaManutencao[propriedade]);
                            break;
                        }
                    }
                });

                $('.tela_manutencao select').each(function(){
                    var nomeAtributo  = $(this).attr("nomeColuna");
                    for(var indice in aJson){
                        var aExterno = aJson[indice];
                        for(var propriedade in aExterno){
                            var oJsonAux = aExterno[propriedade];
                            var oOption = $(this);
                            var valor;
                            var texto;
                            var isConferido = false;
                            for(var propriedadeAux in oJsonAux){
                                if(nomeAtributo == propriedadeAux){
                                    valor = oJsonAux[propriedadeAux];
                                    isConferido = true;
                                }else{
                                    texto = oJsonAux[propriedadeAux];
                                }
                            }
                            if(isConferido){
                                oOption.append($("<option />").val(valor).text(texto));
                                isConferido = false;
                            }
                        }
                    }     
                });

                /* Moer de novo para setar os option corretos - Aqui dá boa */ 
                $('.tela_manutencao select').each(function(){
                    var nomeAtributo  = $(this).attr("nomeColuna");
                    for(var propriedade in oCampoTelaManutencao){
                        if(nomeAtributo == propriedade){
                            $(this).val(oCampoTelaManutencao[propriedade]);
                        }
                    }
                });
                
            }else{
                for(var propriedade in oCampoTelaManutencao){
                    if(propriedade == "Usuario.codigo"){
                        $(".nomeUsuario").text(oCampoTelaManutencao[propriedade]);
                    }
                }
                
                var sCheckbox = oCampoTelaManutencao.tabelaUsuario;
                if(sCheckbox[0] == 1){
                    $("#linha_usuario .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_usuario .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_usuario .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_usuario .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaProduto;
                if(sCheckbox[0] == 1){
                    $("#linha_produto .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_produto .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_produto .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_produto .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCliente;
                if(sCheckbox[0] == 1){
                    $("#linha_cliente .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cliente .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cliente .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cliente .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaVenda;
                if(sCheckbox[0] == 1){
                    $("#linha_venda .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_venda .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_venda .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_venda .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaEstado;
                if(sCheckbox[0] == 1){
                    $("#linha_estado .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_estado .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_estado .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_estado .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCidade;
                if(sCheckbox[0] == 1){
                    $("#linha_cidade .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cidade .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cidade .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cidade .e").attr("checked", true);
                }
                
                sCheckbox = oCampoTelaManutencao.tabelaCep;
                if(sCheckbox[0] == 1){
                    $("#linha_cep .v").attr("checked", true);
                }
                if(sCheckbox[2] == 1){
                    $("#linha_cep .i").attr("checked", true);
                }
                if(sCheckbox[4] == 1){
                    $("#linha_cep .a").attr("checked", true);
                }
                if(sCheckbox[6] == 1){
                    $("#linha_cep .e").attr("checked", true);
                }
                
            }
            $("#acao").val(103);
        } 
    }else if(localStorage['inclusao']){
        var sJson = localStorage['inclusao'];
        var oJson = JSON.parse(sJson);
        
        $('.tela_manutencao select').each(function(){
            var nomeAtributo  = $(this).attr("nomeColuna");
            for(var indice in oJson){
                var oJsonAux = oJson[indice];
                var oOption = $(this);
                var valor;
                var texto;
                
                var isConferido = false;
                for(var propriedade in oJsonAux){
                    if(nomeAtributo == propriedade){
                        valor = oJsonAux[propriedade];
                        isConferido = true;
                    }else if(isConferido == true){
                        texto = oJsonAux[propriedade];
                    }
                }
                if(isConferido){
                    oOption.append($("<option />").val(valor).text(texto));
                    isConferido = false;
                }
            }  
        });
    }
    
    function getAcaoUrl(){
        var sSearch = $(location).attr('search');
        var aSearch = sSearch.split('&');
        
        sSearch = aSearch[2];
        var aAcao   = sSearch.split('=');
        return aAcao[1];
    }
    
    function getRotinaUrl(){
        var sSearch = $(location).attr('search');
        var aSearch = sSearch.split('&');
        
        sSearch = aSearch[1];
        var aRotina   = sSearch.split('=');
        return aRotina[1];
    }
</script>
