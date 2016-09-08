<?php

//require_once '../model/class_model_materia.php';
//require_once 'class_persistencia_padrao.php';
class PersistenciaMateria extends PersistenciaPadrao{
   
    public function setRelacionamento(){
        $oModelMateria = new ModelMateria();
        $oModelMateria->setSchemaTabela('teste.tbmateria');
        $oModelMateria->setCodigo('codigo');
        $oModelMateria->setTitulo('titulo');
        $oModelMateria->setDescricao('descricao');
        return $oModelMateria;
    }
    
}

