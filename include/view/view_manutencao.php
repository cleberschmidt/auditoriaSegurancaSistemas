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
    }

?>
<script>
 
    /* JS ATUAL */
    
    if(localStorage['parametroAlterar']){
        
        var iAcao = getAcaoUrl();
     
        var sJson = localStorage['parametroAlterar'];
        var aJson = JSON.parse(sJson);
        
        var oCampoTelaManutencao = aJson[1]; // Objeto com os valores que serão setados nos campos da tela Ex: Objeto produto
        console.log(oCampoTelaManutencao);
        aJson.splice(0, 2);
        console.log(aJson);
        
       var aJson = aJson[0];

        if(iAcao == 105){
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

            
            $('#btnManutencaoConfirmar').attr('disabled', 'disabled');   
            $('#btnManutencaoLimpar').attr('disabled', 'disabled');   
            
        }else if(iAcao == 103){ // Alteração
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
</script>
