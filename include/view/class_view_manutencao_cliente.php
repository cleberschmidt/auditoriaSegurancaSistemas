<div class="tela_manutencao" id="tela_manutencao_cliente">
    
    <input type="text" id="acao"   class="input_manutencao input_hide"/>
    <input type="text" id="codigo" class="input_manutencao input_hide"/>
    <br>
    <label for="nome" >Nome: </label>
    <input type="text" id="nome" class="input_manutencao"/>
    <br>
    <label for="sexo" >Sexo: </label>
    <select class="select_manutencao" id="sexo" nomeColuna="sexo">
        <option value="1" id="sexo">Masculino</option>
        <option value="2" id="sexo">Feminino</option>
    </select>
    <br>
    <label for="endereco" >Endereço: </label>
    <input type="text" id="endereco" class="input_manutencao"/>
    <br>
    <label for="dataNascimento" >Data de Nascimento: </label>
    <input type="date" id="dataNascimento" class="input_manutencao"/>
    <br>
    <label for="ativo" >Ativo: </label>
    <select class="select_manutencao" nomeColuna="ativo" >
        <option value="1">Sim</option>
        <option value="2">Não</option>
    </select>
    <br>
    <label for="saldoDevedor" >Saldo Devedor: </label>
    <input type="number" id="saldoDevedor" class="input_manutencao"/>
    <br>
    <label for="Cep.codigo" >CEP: </label>
    <select class="select_manutencao" id="Cep.codigo" nomeColuna="Cep.codigo" ></select>
    <br>
    
    <button type="button" id="btnManutencaoConfirmar" class="btnManutencao">Confirmar</button>
    <button type="button" id="btnManutencaoLimpar"    class="btnManutencao">Limpar</button>
</div>