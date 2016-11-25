<link href="dashboard.css" rel="stylesheet">
<div>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Winphor</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a><?php echo $_SESSION['nomeUsuario']; ?></a></li>
                    <li><a class="btnSair">Sair</a></li>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar menu_lateral_esquerdo">
                    <?php 
                    
                    
                    if($_SESSION['tabelaUsuario'] != "2,2,2,2" && $_SESSION['nivelUsuario'] == 1){
                        echo '<li id="btnLog"><a href="#">Log Padrão</a></li>';
                        echo '<li id="btnLogUsuario"><a href="#">Log Usuário</a></li>';
                        echo '<li id="btnPermissao"><a href="#">Permissão</a></li>';
                        echo '<li id="btnUsuario"><a href="#">Usuários<span class="sr-only">(current)</span></a></li>';
                    }
                    if($_SESSION['tabelaProduto'] != "2,2,2,2"){
                        echo '<li id="btnProduto"><a href="#">Produtos</a></li>';
                    }
                    if($_SESSION['tabelaCliente'] != "2,2,2,2"){
                        echo '<li id="btnCliente"><a href="#">Clientes</a></li>';
                    }
                    if($_SESSION['tabelaVenda'] != "2,2,2,2"){
                        echo '<li id="btnVenda"><a href="#">Vendas</a></li>';
                    }
                    if($_SESSION['tabelaEstado'] != "2,2,2,2"){
                        echo '<li id="btnEstado"><a href="#">Estado</a></li>';
                    }
                    if($_SESSION['tabelaCidade'] != "2,2,2,2"){
                        echo '<li id="btnCidade"><a href="#">Cidade</a></li>';
                    }
                    if($_SESSION['tabelaCep'] != "2,2,2,2"){
                        echo '<li id="btnCep"><a href="#">Cep</a></li>';
                    }
                    
                    ?>
                </ul>

            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="container_consulta">
                <button type="button" class="btn btn-primary" id="btnSelecionar">Selecionar</button>
                
                <button type="button" class="btn btn-primary" id="btnIncluir">Incluir</button>
                <button type="button" class="btn btn-primary" id="btnAlterar">Alterar</button>
                <button type="button" class="btn btn-primary" id="btnExcluir">Excluir</button>
                <button type="button" class="btn btn-primary" id="btnVisualizar">Visualizar</button>

                <h2 class="sub-header titulo_consulta"></h2>
                <?php
                    if(isset($_GET['acao'])){
                        $iAcao = $_GET['acao'];
                        if($iAcao == 101){
                            echo "<div class=\"table-responsive\" id=\"tabelaSistemaPai\"></div>";
                        }else if($iAcao == 102 || $iAcao == 103 || $iAcao == 105){
                            require 'include/view/view_manutencao.php';
                        }
                    
                    }else{
                        echo "<div class=\"table-responsive\" id=\"tabelaSistemaPai\"></div>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>
