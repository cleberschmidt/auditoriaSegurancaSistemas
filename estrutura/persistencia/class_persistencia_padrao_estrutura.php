<?php
class PersistenciaPadraoEstrutura{

    private $Query;
    private $nomeClasse;
    
    function getQuery(){ 
        if(!isset($this->Query)){
            $this->Query = new Query();
        }
        
        return $this->Query;
    }
    
    function getNomeClasse(){
        if(!isset($this->nomeClasse)){
            $this->nomeClasse = PersistenciaPadrao::$sNomeModel;
        }
        return $this->nomeClasse;
    }
    
    public function selectSuggest($sPesquisa, $sColuna, $sSchemaTabela, $iQtde){
        return 'SELECT '.$sColuna.' FROM '.$sSchemaTabela. ' WHERE '.$sColuna.' LIKE \'%'.$sPesquisa.'%\' ORDER BY '.$sColuna.' LIMIT '.$iQtde;
    }

    /* */
    public function getModelAll($oModel){
        $sColunas = '';
        $iContador = 0;
        $sCondicaoAux = ' where ';
        $sCondicao = '';
        
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        /* Colunas da tabela do banco de dados */
        $iTamanhoArray = count($aRelacionamento);
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;

            if($aNewRelacionamento['trazDescricao'] == true){
                if(ControllerAreaTrabalho::$bCarregaConsulta == true){
                    
                    // Gambia
                    if($aNewRelacionamento['colunaBanco'] == 'cid_codigo'){
                        $sColunas .= 'cid_nome';
                        $sSchemaTabela .= ', projeto.tbcidade';
                        $sCondicaoAux .= 'tbcep.cid_codigo = tbcidade.cid_codigo';
                    }else if($aNewRelacionamento['colunaBanco'] == 'est_codigo'){
                        $sColunas .= 'est_nome';
                        $sSchemaTabela .= ', projeto.tbestado';
                        $sCondicaoAux .= 'tbcidade.est_codigo = tbestado.est_codigo';
                    }else if($aNewRelacionamento['colunaBanco'] == 'cli_codigo'){
                        $sColunas .= 'cli_nome';
                        $sSchemaTabela .= ', projeto.tbcliente';
                        $sCondicaoAux .= 'tbcliente.cli_codigo = tbvenda.cli_codigo';
                    }
                    
                    // Fecha Gambia
                
                }else{
                    $sColunas .= $aNewRelacionamento['colunaBanco'];
                }
            }else{
                $sColunas .= $aNewRelacionamento['colunaBanco'];
            }
             
            if($iTamanhoArray != $iContador){
                $sColunas .= ', ';
            }
        }
        
        $aNewModel = false;
        if($oModel != false){
            /* renomeia os indices, retirando o nome da classe da frente */
            $sNomeClasse = get_class($oModel);
            $iTamanhoNomeClasse = strlen($sNomeClasse);
            $iTamanhoNomeClasse++;
            $aModel = (array) $oModel;

            $aNewModel = Array();
            foreach ($aModel as $indice => $valor){
                $sNovoIndice = substr($indice, $iTamanhoNomeClasse); // Retira os x primeiros caracteres
                $sNovoIndice = ltrim($sNovoIndice);
                $aNewModel[$sNovoIndice] = $valor;
            }
        }
       

        $sSql = 'select '.$sColunas.' from '.$sSchemaTabela; 
        
        if($oModel != false){
            if(!empty($sCondicao = $this->getCondicao($aRelacionamento, $aNewModel))){}
        }
        
        if(!empty($sCondicao) && $sCondicaoAux != " where "){
            $sCondicaoAux = ' and '.$sCondicaoAux;
        }
        
        if($sCondicaoAux == " where " && empty($sCondicao)){
            $sCondicaoAux = "";
        }
        //$sSql .= $sCondicaoAux != " where " ? $sCondicaoAux : "";
        $sSql .= $sCondicaoAux;
        $sSql .= $sCondicao;
        $aRetorno = $this->getQuery()->selectAll($sSql);
        
        /* Nome das Colunas - Consulta */
        $aTituloColunaConsulta = Array();
        if($oModel == false){ // Significa que é o carregameto de todos os dados para a consulta
            foreach ($aRetorno as $aModel){
                foreach($aModel as $sColunaBanco => $sValor){
                    foreach($aRelacionamento as $aNewRelacionamento){
                        // gambia master
                        if($sColunaBanco == "cid_nome" && PersistenciaPadrao::$sNomeModel == "Cep"){
                            $sColunaBanco = "cid_codigo";
                        }else if($sColunaBanco == "est_nome" && PersistenciaPadrao::$sNomeModel == "Cidade"){
                            $sColunaBanco = "est_codigo";
                        }else if($sColunaBanco == "cli_nome" && PersistenciaPadrao::$sNomeModel == "Venda"){
                            $sColunaBanco = "cli_codigo";
                        }
                        if($aNewRelacionamento['colunaBanco'] == $sColunaBanco){
                            $aTituloColunaConsulta[$sColunaBanco] = $aNewRelacionamento['nomeCampoConsulta'];
                            break;
                        }
                    }
                }
                array_unshift($aRetorno, $aTituloColunaConsulta);
                break;
            }
        }

        return $aRetorno;
    }
    
    function getCondicao($aRelacionamento, $aNewModel){
        $sCondicao = '';
        $iContador = 0;
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            if($aNewRelacionamento['chaveCondicao'] != false){
                if(!empty($sCondicao)){
                    $sCondicao .= ' and ';
                }
                $sCondicao .= $aNewRelacionamento['colunaBanco'].' = ';
                foreach($aNewModel as $sIndice => $sValor){

                    if($sIndice == $aNewRelacionamento['propriedadeModel']){
                        $sCondicao .= '\''.$aNewModel[$sIndice].'\'';
                    } 
                    
                    /* tabela permissão gambia loka */
                    if($aRelacionamento[0]['colunaBanco'] == "per_tabela_usuario"){
                        /* @var $oModelUsuario ModelUsuario */
                        $oModelUsuario = $sValor;
                        $sCondicao = 'usu_codigo = \''.$oModelUsuario->getCodigo().'\'';
                        break;
                    }
                }
            }
        }
        return $sCondicao;
    }
    
    function getCondicaoExclui($aRelacionamento, $aNewModel){
        $sCondicao = '';
        $iContador = 0;
        foreach ($aRelacionamento as $aNewRelacionamento){
            $iContador++;
            if($aNewRelacionamento['chave'] != false){
                if(!empty($sCondicao)){
                    $sCondicao .= ' and ';
                }
                $sCondicao .= $aNewRelacionamento['colunaBanco'].' = ';
                foreach($aNewModel as $sIndice => $sValor){

                    if($sIndice == $aNewRelacionamento['propriedadeModel']){
                        $sCondicao .= '\''.$aNewModel[$sIndice].'\'';
                    } 
                }
            }
        }
        return $sCondicao;
    }
    
    /* Recebe somente um Model, Retorna um Array - Utilizado na INC, ALT, EXC
       Converte o Model para um Array seco. (sem array dentro de array) */
    private function toArray($oModel){
        if($oModel != false){
            /* Renomeia os indices, retirando o nome da classe da frente */
            $sNomeClasse        = get_class($oModel);
            $iTamanhoNomeClasse = strlen($sNomeClasse);
            $iTamanhoNomeClasse++;
   
            $aModel = (array) $oModel; // O nome da classe fica setado no indice do array criado "$aModel"

            $aModelAux = Array();
            foreach ($aModel as $sIndice => $xValor){
                $sNovoIndice = substr($sIndice, $iTamanhoNomeClasse); // Retira os x primeiros caracteres
                $sNovoIndice = ltrim($sNovoIndice);
                
                if(is_object($xValor)){
                    $sNomeClasseAux        = get_class($xValor);
                    $sNome                 = substr($sNomeClasseAux, 5); /* 5 = 'Model' */
                    $iTamanhoNomeClasseAux = strlen($sNomeClasseAux);
                    $iTamanhoNomeClasseAux++;
                    
                    $aModelAuxValor = (array) $xValor;
                    
                    foreach($aModelAuxValor as $sIndiceAux => $xValorAux){
                        $sNovoIndice = substr($sIndiceAux, $iTamanhoNomeClasseAux); // Retira os x primeiros caracteres
                        $sNovoIndice = ltrim($sNovoIndice);
                        if(!empty($xValorAux)){   
                            $aModelAux[$sNome.'.'.$sNovoIndice] = $xValorAux;
                        }
                    }
                }else{
                    $aModelAux[$sNovoIndice] = $xValor;
                } 
            }
            return $aModelAux;
        }
    }
    
    public function altera($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $aModel = $this->toArray($oModel);
        
        /* salva nos arrays as respectivas colunas e valores */
        $aSet = Array();
        $sCondicaoCodigo = '';
        
        foreach($aModel as $sCampo => $xValor){
            foreach($aRelacionamento as $aCampoRelacionamento){
                if($aCampoRelacionamento['propriedadeModel'] == $sCampo){
                    if(!empty($xValor)){
                        if($aCampoRelacionamento['propriedadeModel'] == 'codigo'){
                            $sCondicaoCodigo = $aCampoRelacionamento['colunaBanco'].' = '.$xValor;
                        }else if($this->isPermissao() && $aCampoRelacionamento['propriedadeModel'] == 'Usuario.codigo'){
                            $sCondicaoCodigo = $aCampoRelacionamento['colunaBanco'].' = '.$xValor;
                        }else{
                            $sNomeCampoBD = $aCampoRelacionamento['colunaBanco'];
                            $aSet[] = $sNomeCampoBD.' = \''.$xValor.'\'';
                        }
                    }
                    break;
                }
            }
        }
            
        $sSet = implode(", ", $aSet);
        
        $sSql = 'update '.$sSchemaTabela.' set '.$sSet.' where '.$sCondicaoCodigo;
        return $this->getQuery()->query($sSql);
    }
    
    private function isPermissao(){
        return PersistenciaPadrao::$sSchemaTabela == 'projeto.tbpermissao' ? true : false;
    }
    
    public function insere($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $aModel = $this->toArray($oModel);
        
        /* salva nos arrays as respectivas colunas e valores */
        $aCampoBd = Array();
        $aValorBd = Array();
        
        foreach($aModel as $sCampo => $xValor){
            foreach($aRelacionamento as $aCampoRelacionamento){
                if($aCampoRelacionamento['propriedadeModel'] == $sCampo){
                    if(!empty($xValor)){
                        $sNomeCampoBD = $aCampoRelacionamento['colunaBanco'];
                        $aCampoBd[] = $sNomeCampoBD;
                        $aValorBd[] = '\''.$xValor.'\'';
                    }
                    break;
                }
            }
        }
            
        $sCampoBd = implode(", ", $aCampoBd);
        $sValorBd = implode(", ", $aValorBd);
        
        $sSql = 'insert into '.$sSchemaTabela.'('.$sCampoBd.') values('.$sValorBd.')';

        $retorno = $this->getQuery()->query($sSql);
        
        if($sSchemaTabela == 'projeto.tbusuario'){
            $sSql = "insert into projeto.tbpermissao(usu_codigo, per_tabela_usuario, per_tabela_produto, per_tabela_cliente, per_tabela_venda, per_tabela_cep, per_tabela_cidade, per_tabela_estado) 
                     values((select max(usu_codigo) from projeto.tbusuario), '2,2,2,2', '2,2,2,2', '2,2,2,2', '2,2,2,2', '2,2,2,2', '2,2,2,2', '2,2,2,2')";
            $this->Query = new Query();
            $this->getQuery()->query($sSql); 
        }
        return $retorno;
    }
    
    function exclui($oModel){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $sSql = 'delete from '.$sSchemaTabela;
        
        $aNewModel = $this->toArray($oModel);
        if(!empty($sCondicao = $this->getCondicaoExclui($aRelacionamento, $aNewModel))){
            $sSql .= ' where '.$sCondicao;
        }

        return $this->getQuery()->query($sSql);
    }
    
    public function getAllFromModelRelacionamento(){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        $sSchemaTabela   = PersistenciaPadrao::$sSchemaTabela;
        
        $aCampoConsulta = Array();
        
        //$iTamanhoArray = count($aRelacionamento);
        foreach ($aRelacionamento as $aNewRelacionamento){
            $sPropriedadeModel = $aNewRelacionamento['propriedadeModel'];
            $aPropriedade = Array();
            if($aPropriedade = $this->verificaPossuiRelacionamento($sPropriedadeModel)){
                $sTabela = 'projeto.tb'.strtolower($aPropriedade[0]);
                if($aPropriedade[1] == 'codigo'){
                    
                    PersistenciaPadrao::$aRelacionamento = null;
                    
                    $sPersistencia = 'Persistencia'.$aPropriedade[0];
                    $oPersistencia = new $sPersistencia();
                    $oPersistencia->setRelacionamento();
                    
                    $aRelacionamentoAux = PersistenciaPadrao::$aRelacionamento;
                    foreach ($aRelacionamentoAux as $aRelacionamentoNew){
                        if($aRelacionamentoNew['nomeExterno'] == true){
                            $sPadraoColuna = $aRelacionamentoNew['colunaBanco'];
                            break;
                        }
                    }
                    $sSql = 'select '.$aNewRelacionamento['colunaBanco'].', '.$sPadraoColuna.' from '.$sTabela.' order by '.$aNewRelacionamento['colunaBanco'];
                    $aCampoConsulta[] = $this->trocaIndiceColunaBancoByPropriedadeModel($this->getQuery()->selectAll($sSql), $aPropriedade[0]);
               }else{
                    $sSql = 'select '.$aNewRelacionamento['colunaBanco'].' from '.$sTabela.' order by '.$aNewRelacionamento['colunaBanco'];
                    $aCampoConsulta[] = $this->getQuery()->selectAll($sSql);
               }
            }
        }
        
        
        
        return $aCampoConsulta;
    }
    
    private function trocaIndiceColunaBancoByPropriedadeModel($aCampoConsulta, $sNomeClasse){
        $aRelacionamento = PersistenciaPadrao::$aRelacionamento;
        
        $aNewArray = Array();
        $aBruto = Array();
        foreach($aCampoConsulta as $aCampos){
            foreach($aCampos as $sIndice => $sValor){
                $aColunaBanco = Array();
                $aColunaBanco = explode("_", $sIndice);
                $sNomeIndice  = ucfirst($sNomeClasse).'.'.$aColunaBanco[1];
                $aNewArray[$sNomeIndice] = $sValor; 
            }
            $aBruto[] = $aNewArray;
        }
        return $aBruto;
    }
    
    private function padraoColunaBd($sColunaBanco){
        $aColunaBanco = Array();
        $aColunaBanco = explode("_",$sColunaBanco);
        return $aColunaBanco[0];
    }
    
    private function verificaPossuiRelacionamento($sPropriedadeModel){
        
        if(stripos($sPropriedadeModel, '.')){ // verifica se a string $sPropriedadeModel possui '.'
            return explode(".",$sPropriedadeModel);
        }
        return false;
    }
    
    public function insereVenda($aJson){
        
        $aVenda = $aJson[0];
        $aVenda = $this->verificaData($aVenda);
        $aVenda['valorPgto'] = 1;
        
        $iCliente   = $aVenda['Cliente.codigo'];
       
        
        $sSqlVenda = 'insert into projeto.tbvenda (ven_data, cli_codigo, ven_data_pgto, ven_valor_pgto) '
              . 'values(\''.$aVenda['data'].'\',\''.$aVenda['Cliente.codigo'].'\',\''.$aVenda['dataPgto'].'\',\''.$aVenda['valorPgto'].'\')';
        if($this->getQuery()->query($sSqlVenda)){
            unset($aJson[0]);
            $sSqlItemVenda = '';
            foreach($aJson as $aProduto){
                $aProduto = $this->verificaData($aProduto);
                $sSqlItemVenda .= 'insert into projeto.tbitemvenda (pro_codigo, ven_codigo, ven_data, cli_codigo, ite_quantidade, ite_preco) '
                  . 'values(\''.$aProduto['Produto.codigo'].'\', (select max(ven_codigo) as codigo from projeto.tbvenda),\''.$aVenda['data'].'\',\''.$iCliente.'\',\''.$aProduto['ItemVenda.quantidade'].'\',\''.$aProduto['ItemVenda.preco'].'\');';
            
            }
            return $this->getQuery()->query($sSqlItemVenda); 
        }
    }
    
    private function verificaData($aJson){
        foreach($aJson as $sPropriedade => $sValor){
            $sPropriedadeData = substr($sPropriedade, 0, 4); // 4 = data
            if($sPropriedadeData == 'data'){
                if(empty($sValor)){
                    date_default_timezone_set('America/Sao_Paulo');
                    $sData = date('Y-m-d');
                    $aJson[$sPropriedade] = $sData;
                }
            }
        }
        return $aJson;
    }
    
    public function tentativaLogin($sEmailUsuario){
        $sSql = 'update projeto.tbusuario
                    set usu_tentativa_login = (select usu_tentativa_login 
                                                 from projeto.tbusuario 
                                                where usu_email = \''.$sEmailUsuario.'\') + 1
                  where usu_email = \''.$sEmailUsuario.'\'';
        return $this->getQuery()->query($sSql);
    }
    
    public function buscaNumeroTentativaLogin($sEmailUsuario){
        $sSql = 'select usu_tentativa_login 
                   from projeto.tbusuario 
                  where usu_email = \''.$sEmailUsuario.'\'';
        $aUsuario = $this->getQuery()->selectAll($sSql);
        if(!empty($aUsuario)){
            if($aUsuario[0]['usu_tentativa_login'] >= 3){
                $sSql = 'update projeto.tbusuario
                            set usu_status = 2
                          where usu_email = \''.$sEmailUsuario.'\'';
                $this->Query = new Query();
                return $this->getQuery()->query($sSql);
            }
        }
        return false;
    }
    
    public function buscaPermissao($iCodigoUsuario){
        $sSql = 'select * from projeto.tbpermissao where usu_codigo = '.$iCodigoUsuario;
        return $this->getQuery()->selectAll($sSql);
    }
    
}
