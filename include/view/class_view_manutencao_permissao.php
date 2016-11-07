
<div class="tela_manutencao" id="tela_manutencao_permissao">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
    <br>

    <p class="nomeUsuario">Usuário: Cleber</p>
    <table class="table-bordered table">
        <tr>
            <td>Menu</td>
            <td>Visualização</td>
            <td>Inclusão</td>
            <td>Alteração</td>
            <td>Exclusão</td>
        </tr>
        <tr id="linha_usuario">
            <td>Usuário</td>
            <td><input type="checkbox" id="tabelaUsuario" class="v" disabled="disabled" /></td>
            <td><input type="checkbox" id="tabelaUsuario" class="i" disabled="disabled" /></td>
            <td><input type="checkbox" id="tabelaUsuario" class="a" disabled="disabled" /></td>
            <td><input type="checkbox" id="tabelaUsuario" class="e" disabled="disabled" /></td>
        </tr>
        <tr id="linha_produto">
            <td>Produto</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
        <tr id="linha_cliente">
            <td>Cliente</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
        <tr id="linha_venda">
            <td>Venda</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
        <tr id="linha_estado">
            <td>Estado</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
        <tr id="linha_cidade">
            <td>Cidade</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
        <tr id="linha_cep">
            <td>Cep</td>
            <td><input type="checkbox" id="tabelaProduto" class="v"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="i"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="a"/></td>
            <td><input type="checkbox" id="tabelaProduto" class="e"/></td>
        </tr>
    </table>
    
   
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>