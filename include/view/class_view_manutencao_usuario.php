<div class="tela_manutencao" id="tela_manutencao_usuario">
    
    <input type="text" id="acao"         class="input_manutencao input_hide"/>
    <input type="text" id="codigo"       class="input_manutencao input_hide"/>
    <input type="date" id="dataCadastro" class="input_manutencao input_hide"/>
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
    <select class="select_manutencao" nomeColuna="nivelAcesso" >
        <option value="1" nomeColuna="nivelAcesso">Administrador</option>
        <option value="2" nomeColuna="nivelAcesso">Normal</option>
    </select>
    <br>
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>