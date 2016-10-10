<div class="tela_manutencao" id="tela_manutencao_usuario">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
    <br>
    <label for="nome" >Nome: </label>
    <input type="text" id="nomeUsuario" class="input_manutencao"/>
    <br>
    <label for="email" >E-mail: </label>
    <input type="email" id="email" class="input_manutencao"/>
    <br>
    <label for="password" >Senha: </label>
    <input type="password" id="password" class="input_manutencao"/>
    <br>
    <label for="nivelAcesso" >Nível acesso: </label>
    <select class="select_manutencao" id="nivelAcesso" >
        <option value="1" id="nivelAcesso">Administrador</option>
        <option value="2" id="nivelAcesso">Normal</option>
    </select>
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