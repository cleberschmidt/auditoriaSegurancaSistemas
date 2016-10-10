<div class="tela_manutencao" id="tela_manutencao_produto">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
    <br>
    <label for="descricao" >Descricao: </label>
    <input type="text" id="descricao" class="input_manutencao"/>
    <br>
    <label for="preco" >Preço: </label>
    <input type="text" id="preco" class="input_manutencao"/>
    <br>
    <label for="estoque" >Estoque: </label>
    <input type="number" id="estoque" class="input_manutencao"/>
    <br>
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>

<script>
    if(localStorage['parametroAlterar']){
        
        var iAcao = getAcaoUrl();
     
        var sJson = localStorage['parametroAlterar'];
        var oJson = JSON.parse(sJson);

        if(iAcao == 105){
            $('.tela_manutencao input').each(function(){
                var nomeAtributo  = $(this).attr("id");
                for(var propriedade in oJson){
                    if(propriedade == nomeAtributo){
                        $(this).prop('disabled', true);
                        $(this).val(oJson[propriedade]);
                        break;
                    }
                }
            });

            $('.tela_manutencao select').each(function(){
                var nomeAtributo  = $(this).attr("id");
                for(var propriedade in oJson){
                    if(propriedade == nomeAtributo){
                        $(this).prop('disabled', true);
                        $(this).val(oJson[propriedade]);
                        break;
                    }
                }
            });
            
            $('#btnManutencaoConfirmar').attr('disabled', 'disabled');   
            $('#btnManutencaoLimpar').attr('disabled', 'disabled');   
            
        }else if(iAcao == 103){
             $('.tela_manutencao input').each(function(){
            var nomeAtributo  = $(this).attr("id");
            for(var propriedade in oJson){
                if(propriedade == nomeAtributo){
                    $(this).val(oJson[propriedade]);
                    break;
                }
            }
        });

        $('.tela_manutencao select').each(function(){
            var nomeAtributo  = $(this).attr("id");
            for(var propriedade in oJson){
                if(propriedade == nomeAtributo){
                    $(this).val(oJson[propriedade]);
                    break;
                }
            }
        });
            
        $("#acao").val(103);
        } 
    }
    function getAcaoUrl(){
        var sSearch = $(location).attr('search');
        var aSearch = sSearch.split('&');
        
        sSearch = aSearch[2];
        var aAcao   = sSearch.split('=');
        return aAcao[1];
    }
</script>