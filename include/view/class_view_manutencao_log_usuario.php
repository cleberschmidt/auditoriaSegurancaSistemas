<style>
    .input_manutencao, .select_manutencao{
        width: 450px;
    }
</style>
<div class="tela_manutencao" id="tela_manutencao_log_usuario">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
     
    <label for="data" >Data: </label>
    <input type="text" id="data" class="input_manutencao"/>
    <br> 
    <label for="loginUtilizado" >Login Utilizado: </label>
    <input type="text" id="loginUtilizado" class="input_manutencao"/>
    <br> 
    <label for="senhaUtilizada" >Senha Utilizada: </label>
    <input type="text" id="senhaUtilizada" class="input_manutencao"/>
    <br> 
    <label for="historico" >Histórico: </label>
    <input type="text" id="historico" class="input_manutencao"/>
    <br> 
    <label for="Usuario.codigo" >Usuário: </label>
    <select class="select_manutencao" nomeColuna="Usuario.codigo" ></select>
    <br> 
    
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>