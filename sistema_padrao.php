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
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Settings</a></li>
                    <li><a href="#">Profile</a></li>
                    <li><a href="#">Help</a></li>
                </ul>
                <form class="navbar-form navbar-right">
                    <input type="text" class="form-control" placeholder="Procurar...">
                </form>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-md-2 sidebar">
                <ul class="nav nav-sidebar menu_lateral_esquerdo">
                    <li id="btnUsuario"><a href="#">Usuários<span class="sr-only">(current)</span></a></li>
                    <li id="btnProduto"><a href="#">Produtos</a></li>
                    <li><a href="#">Clientes</a></li>
                    <li><a href="#">Vendas</a></li>
                </ul>

            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" id="container_consulta">
                <button type="button" class="btn btn-primary" id="btnIncluir">Incluir Usuário</button>
                <button type="button" class="btn btn-primary" id="btnAlterar">Alterar</button>
                <button type="button" class="btn btn-primary" id="btnExcluir">Excluir</button>
                <button type="button" class="btn btn-primary" id="btnVisualizar">Visualizar</button>

                <h2 class="sub-header">Usuários</h2>
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
