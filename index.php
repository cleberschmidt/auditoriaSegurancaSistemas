<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- As 3 meta tags acima *devem* vir em primeiro lugar dentro do `head`; qualquer outro conteúdo deve vir *após* essas tags -->
        <title>Bootstrap 101 Template</title>

        <!-- Bootstrap -->
        <link href="framework/bootstrap-3.3.6-dist/css/bootstrap.min.css" rel="stylesheet">

        <link href="cover.css" rel="stylesheet">
        <link href="estilo.css" rel="stylesheet">
    </head>
    <body>
        <!-- jQuery (obrigatório para plugins JavaScript do Bootstrap) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário -->
        <script src="framework/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>

        <div class="site-wrapper">

            <div class="site-wrapper-inner">

                <div class="cover-container">

                    <div class="masthead clearfix">
                        <div class="inner">
                            <h3 class="masthead-brand">Winphor</h3>
                            <nav>
                                <ul class="nav masthead-nav">

                                    <li class="active"><a href="#">Favoritos</a></li>
                                    <li><a href="#">Ajuda</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="boxPrincipal">
                        <?php 
                        if(isset($_GET['pagina'])){
                            require $_GET['pagina'].'.php';                 
                        }else{
                            require 'home.php';
                        }
                        ?>
                    </div>

                    <div class="mastfoot">
                        <div class="inner">
                            <p>Template desenvolvido por <a href="http://getbootstrap.com">Cleber José Schmidt</a>.</p>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </body>
</html>