<style>
    .total{
        float: right;
        margin-right: 61px;
        width: 80px;
        color: black;
        text-align: right;
    }
    
    .div-p{
        
    }
    
    .div-p p{
        display: inline-block;
        margin-bottom: 0px;
        font-size: 12px;
    }
    
    .div-total{
        width: 551px;
        margin: auto;
        height: 50px;
        margin-top: 1px;
        
    }
    
    .div-total label{
        margin-right: 1px;
        float: right;
        line-height: 25px;
    }
    
    .p_codigo{ 
        text-align: left;
        margin-left: -45px;
        
        width: 70px;
        
    }
    
    .p_descricao{
        text-align: left;
        padding-left: 10px;
        width: 200px;
       
    }
    
    .p_valor_unit{
        width: 70px;
        
    }
    
    .p_qtde{
        width: 50px;
        
    }
    
    .p_valor_total{
        width: 100px;
        text-align: left;
        padding-left: 10px;
   
    }
</style>
<div class="tela_manutencao" id="tela_manutencao_venda">
    <div class="tela_manutencao_venda_gambiarra">
        <input type="text" id="acao"      class="input_manutencao input_hide"/>
        <input type="text" id="codigo"    class="input_manutencao input_hide"/>
        <input type="date" id="data"      class="input_manutencao input_hide"/>
        <input type="text" id="valorPgto" class="input_manutencao input_hide"/>

        <label for="dataPgto" >Data Pagamento: </label>
        <input type="date" id="dataPgto" class="input_manutencao" />
        <br>
        <label for="Cliente.codigo" >Cliente: </label>
        <select class="select_manutencao" nomeColuna="Cliente.codigo" >
        </select>
        <br>
        <br>
    </div>
    <div class="div_grid_manutencao">
        <p>Grid Produto</p>
        <div class="div-p">
            <p class="p_codigo">Código</p>
            <p class="p_descricao">Descrição</p>
            <p class="p_valor_unit">Valor Unit.</p>
            <p class="p_qtde">Qtde</p>
             
            <p class="p_valor_total">Valor Total</p>
        </div>
        <div class="div_grid_manutencao_interno"></div>
        
        <div class="div-total"> 
            <input type="text" id="total" class="total" disabled />
            <label for="total">Total:</label>
        </div> 
    </div>
    <br>
    
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>
<script>

    if(localStorage['selecionar']){
        
        var sJson = localStorage['selecionar'];
        var oJson = JSON.parse(sJson);
        var oGrid      = $(".div_grid_manutencao_interno");
        for(var propriedade in oJson){
            
            
            var oProduto = oJson[propriedade];
             
            var oLinhaGrid = $("<div />").attr('class','div_linha_grid');

            var oInputCodigo     = $('<input  type=text     id=Produto.codigo       class="input_manutencao codigo" disabled />').val(oProduto['codigo']);
            var oButtonLupa      = $('<button type=button   id=btnLupa              class="btnManutencao" />').html('<span class="glyphicon glyphicon-search"></span>').css('margin', '0 2px 1px 2px');
            var oInputDescricao  = $('<input  type=text     id=Produto.descricao    class="input_manutencao" disabled />').val(oProduto['descricao']);
            var oInputQtde       = $('<input  type=number   id=ItemVenda.quantidade class="input_manutencao quantidade" />').val(1);;
            var oInputPreco      = $('<input  type=text     id=ItemVenda.preco      class="input_manutencao preco" disabled />').val(oProduto['preco']);
            var oInputPrecoTotal = $('<input  type=text     id=ItemVenda.precoTotal class="input_manutencao precoTotal" disabled />').val(oProduto['preco']);
            var oButtonMenos     = $('<button type="button" id="btnMenos"           class="btnManutencao" />').html('<span class="glyphicon glyphicon-minus"></span>').css('margin', '0 0 1px 2px');
            var oButtonMais      = $('<button type="button" id="btnMais"            class="btnManutencao" />').html('<span class="glyphicon glyphicon-plus"></span>').css('margin', '0 2px 1px 2px');
            
            oLinhaGrid.append(oInputCodigo);
            oLinhaGrid.append(oButtonLupa);
            oLinhaGrid.append(oInputDescricao);
            oLinhaGrid.append(oInputPreco);
            oLinhaGrid.append(oInputQtde);
            oLinhaGrid.append(oInputPrecoTotal);
            oLinhaGrid.append(oButtonMenos);
            oLinhaGrid.append(oButtonMais);

            oGrid.append(oLinhaGrid);  
            
            var valorTotalAux = 0;
            $('.div_grid_manutencao_interno .precoTotal').each(function(){
                valorTotalAux = valorTotalAux + parseFloat($(this).val());
            });

            $(".total").val(valorTotalAux);
        }

    }else{
        var oGrid       = $(".div_grid_manutencao_interno");
        
        var oLinhaGrid  = $("<div />").attr('class','div_linha_grid');
         
        var oInputCodigo     = $('<input  type=text     id=Produto.codigo         class="input_manutencao codigo" disabled />');
        var oButtonLupa      = $('<button type=button   id=btnLupa                class="btnManutencao" />').html('<span class="glyphicon glyphicon-search"></span>').css('margin', '0 2px 1px 2px');
        var oInputDescricao  = $('<input  type=text     id=Produto.descricao      class="input_manutencao" disabled />');
        var oInputQtde       = $('<input  type=number   id="ItemVenda.quantidade" class="input_manutencao quantidade" />');
        var oInputPreco      = $('<input  type=text     id=ItemVenda.preco        class="input_manutencao preco" disabled />');
        var oInputPrecoTotal = $('<input  type=text     id=ItemVenda.precoTotal   class="input_manutencao precoTotal" disabled />'); 
        var oButtonMenos     = $('<button type="button" id="btnMenos"             class="btnManutencao" />').html('<span class="glyphicon glyphicon-minus"></span>').css('margin', '0 0 1px 2px');
        var oButtonMais      = $('<button type="button" id="btnMais"              class="btnManutencao" />').html('<span class="glyphicon glyphicon-plus"></span>').css('margin', '0 2px 1px 2px');

        oLinhaGrid.append(oInputCodigo);
        oLinhaGrid.append(oButtonLupa);
        oLinhaGrid.append(oInputDescricao);
        oLinhaGrid.append(oInputPreco);
        oLinhaGrid.append(oInputQtde);
        oLinhaGrid.append(oInputPrecoTotal);
        oLinhaGrid.append(oButtonMenos);
        oLinhaGrid.append(oButtonMais);
        oLinhaGrid.attr('id','espacamento_top');
        
        
        //var oLabelValorTotal = $('<label for="valorPgto" >Valor Total: </label>');
        //var oInputTotal      = $('<input type=text id="valorPgto" class="input_manutencao"  />');

        oGrid.append(oLinhaGrid);
        
        
    }

     
</script>