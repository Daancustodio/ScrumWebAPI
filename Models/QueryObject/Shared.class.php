<?php

include_once 'Filtro.class.php';
include_once '/../../libs/AutoLoaderBiblioteca.php';
use zpt\oobo\form\SelectOption;
use zpt\oobo\form\Select;

abstract Class Shared {
    /*
      Recebe um valor e trata para que seja compatível com o banco de dados
     */

    public static function TrataTipoDados($valor) {

        $retorno;

        if (is_array($valor)) {
            // se for array percorre as posições e trata os valores.
            foreach ($valor as $x) {
                if (is_numeric($x)) {
                    $foo[] = $x;
                } else {
                    $foo[] = "'" . $x . "'"; //Adiciona Aspas simples
                }
            }
            //Converte em String separado por virgula
            $retorno = '(' . implode(',', $foo) . ')';
        } else if (is_string($valor)) {
            $retorno = "'" . $valor . "'"; //Adiciona Aspas simples
        } else if (is_null($valor)) {
            //Armazena NULL
            $retorno = 'NULL';
        } else if (is_bool($valor)) {
            $retorno = $valor ? 'TRUE' : 'FALSE';
        } else {
            $retorno = $valor;
        }
        return $retorno;
    }

    public static function filtroFoiExcluido($bol) {
        return new Filtro('foiExcluido', OperadorSql::OIGUAL, $bol);
    }

    public static function filtroUsuarioLogado($idUsuarioLogado) {
        $operador;
        if(is_null($idUsuarioLogado)){
            $operador = OperadorSql::OIS;            
        }else {
            $operador = OperadorSql::OIGUAL;
        }
        return new Filtro('idUsuario', $operador, $idUsuarioLogado);
    }
    
    public static function filtroID($id) {
        return new Filtro('id', OperadorSql::OIGUAL, $id);
    }
    /**
     * Carrega combo com Id e Descrição
     * @param Objeto $objDTO Objeto de qualquer classe com atributo ID e Descrição
     * @param Select Select $cboSelect Objeto Select
     * @param int [OPCIONAL] $selectedItem ID do item selecionado
     * @return Select Preenchido com SelectOption
     */
    public static function loadCombo($objDTO, Select $cboSelect, $selectedItem = null){
        
        $arrayOBJ = $objDTO->queryAll(NULL);        
        //var_dump($arrayOBJ);
        foreach ($arrayOBJ as $value) {
            $selected = false;
            if(!is_null($selectedItem)){
                $selected = ($value->getID() == $selectedItem);
            }
            //var_dump($value->getID());
            if(method_exists($value, 'getTitulo')){
                $valorSelect = new SelectOption($value->getID(),$value->getTitulo(), $selected);
            }
            elseif(method_exists($value, 'getNome')){
                $valorSelect = new SelectOption($value->getID(),$value->getNome(), $selected);
			}else { 
                $valorSelect = new SelectOption($value->getID(),$value->getDescricao(), $selected);
            }
			//var_dump($valorSelect);
            
			$cboSelect->add($valorSelect);
        }
        //var_dump($cboSelect);
        return $cboSelect;
    }
  
}
