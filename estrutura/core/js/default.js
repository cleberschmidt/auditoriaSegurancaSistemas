/* @author Cleber José Schmidt */

function getElementoId(sElemento, bValue = false){
    if(bValue === true){
        return document.getElementById(sElemento).value;
    }
    return document.getElementById(sElemento);
}

function imp(sValor){
    console.log(sValor);
}



