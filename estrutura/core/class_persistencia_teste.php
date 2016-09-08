<?php

function __autoload($sClasse){
    /* Chamado a partir de uma classe do include */
    $sArquivo = caminhoEstrutura($sClasse);
    
    if(arquivoExiste($sArquivo)){
        require_once $sArquivo;
    }else{
        $sArquivo = caminhoInclude($sClasse);
        if(arquivoExiste($sArquivo)){
            require_once $sArquivo;
        }else{
            echo 'Arquivo não encontrado! ';
        }
    }
}

function arquivoExiste($sArquivo){
    return file_exists($sArquivo);
}

/*function caminhoEstrutura($sClasse){
    if(preg_match('/Persistencia/', $sClasse)){
        $sClasse = substr($sClasse, 12); // Retira os doze primeiros caracteres
        $sArquivo = 'estrutura/persistencia/class_persistencia_'.$sClasse.'.php'; 
    }else if(preg_match('/Model/', $sClasse)){
        $sClasse = substr($sClasse, 5); // Retira os cinco primeiros caracteres
        $sArquivo = 'estrutura/model/class_model_'.$sClasse.'.php';
    }else if(preg_match('/View/', $sClasse)){
        $sClasse = substr($sClasse, 4); // Retira os quatro primeiros caracteres
        $sArquivo = 'estrutura/view/class_view_'.$sClasse.'.php';
    }else if(preg_match('/Controller/', $sClasse)){
        $sClasse = substr($sClasse, 10); // Retira os dez primeiros caracteres
        $sArquivo = 'estrutura/controller/class_controller_'.$sClasse.'.php';
    }else{
        $sArquivo = 'estrutura/core/class_persistencia_'.$sClasse.'.php';
    }
    return $sArquivo;
}*/

function caminhoEstrutura($sClasse){
    if(preg_match('/Persistencia/', $sClasse)){
        $sClasse = substr($sClasse, 12); // Retira os doze primeiros caracteres
        $sArquivo = '../../estrutura/persistencia/class_persistencia'.construirNomeArquivo($sClasse).'.php'; 
    }else if(preg_match('/Model/', $sClasse)){
        $sClasse = substr($sClasse, 5); // Retira os cinco primeiros caracteres
        $sArquivo = '../../estrutura/model/class_model'.construirNomeArquivo($sClasse).'.php';
    }else if(preg_match('/View/', $sClasse)){
        $sClasse = substr($sClasse, 4); // Retira os quatro primeiros caracteres
        $sArquivo = '../../estrutura/view/class_view'.construirNomeArquivo($sClasse).'.php';
    }else if(preg_match('/Controller/', $sClasse)){
        $sClasse = substr($sClasse, 10); // Retira os dez primeiros caracteres
        $sArquivo = '../../estrutura/controller/class_controller'.construirNomeArquivo($sClasse).'.php';
    }else{
        $sArquivo = '../../estrutura/persistencia/class_persistencia'.construirNomeArquivo($sClasse).'.php';
    }
    return $sArquivo;
}

function caminhoInclude($sClasse){
    if(preg_match('/Persistencia/', $sClasse)){
        $sClasse = substr($sClasse, 12); // Retira os doze primeiros caracteres
        $sArquivo = '../../include/persistencia/class_persistencia'.construirNomeArquivo($sClasse).'.php'; 
    }else if(preg_match('/Model/', $sClasse)){
        $sClasse = substr($sClasse, 5); // Retira os cinco primeiros caracteres
        $sArquivo = '../../include/model/class_model'.construirNomeArquivo($sClasse).'.php';
    }else if(preg_match('/View/', $sClasse)){
        $sClasse = substr($sClasse, 4); // Retira os quatro primeiros caracteres
        $sArquivo = '../../include/view/class_view'.construirNomeArquivo($sClasse).'.php';
    }else if(preg_match('/Controller/', $sClasse)){
        $sClasse = substr($sClasse, 10); // Retira os dez primeiros caracteres
        $sArquivo = '../../include/controller/class_controller'.construirNomeArquivo($sClasse).'.php';
    }else{
        $sArquivo = '../../include/persistencia/class'.construirNomeArquivo($sClasse).'.php';
    }
    return $sArquivo;
}

function construirNomeArquivo($sClasse){
    $sClasseAux = ''; 
    for($i = 0; $i < strlen($sClasse); $i++){
        if(ctype_upper($sClasse[$i])){
            $sClasseAux .= '_'.strtolower($sClasse[$i]);
        }else{
            $sClasseAux .= $sClasse[$i];
        }
    }
    return $sClasseAux;
}
