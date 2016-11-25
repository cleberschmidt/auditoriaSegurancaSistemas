<style>
    .input_manutencao, .select_manutencao{
        width: 450px;
    }
    
    .label-descricao{
        position: absolute;
        margin-top: 4px;
    }
</style>
<div class="tela_manutencao" id="tela_manutencao_log">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
    <br>
    <label for="nomeTabela" >Tabela: </label>
    <input type="text" id="nomeTabela" class="input_manutencao"/>
    <br> 
    <label for="data" >Data: </label>
    <input type="text" id="data" class="input_manutencao"/>
    <br> 
    <label for="acao" >Ação: </label>
    <input type="text" id="acao" class="input_manutencao"/>
    <br> 
    <label for="Usuario.codigo" >Usuário: </label>
    <select class="select_manutencao" nomeColuna="Usuario.codigo" ></select>
    <br> 
    
    <label for="log" class="label-descricao">Histórico: </label>
    <label for="log" style="color: transparent; text-shadow: none">Descrição: </label>
    <textarea id="log" class="input_manutencao text-area"></textarea>
    <br> 
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>