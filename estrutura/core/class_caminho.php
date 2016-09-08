<?php
$sClasse = 'AreaTrabalho';
$sClasseAux = ''; 
for($i = 0; $i < strlen($sClasse); $i++){
    if(ctype_upper($sClasse[$i])){
        $sClasseAux .= '_'.strtolower($sClasse[$i]);
    }else{
        $sClasseAux .= $sClasse[$i];
    }
}

echo $sClasseAux;

 