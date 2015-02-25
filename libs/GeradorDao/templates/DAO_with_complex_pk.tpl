<?php
/**
 * Class para manipular a tabela '${table_name}'. Database Mysql.
 *
 * @author: ${autor}
 * @Data: ${date}
 */

include_once '/../IDao/I${dao_clazz_name}DAO.class.php';
include_once '/../Dto/${dao_clazz_name}.class.php';
include_once '/../QueryObject/IncludeQO.php';

class ${dao_clazz_name}DAO implements I${idao_clazz_name}DAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return ${dao_clazz_name} 
	 */
	public function load(${pks}){
		$sql = new SqlSelect('${table_name}');
		${pk_set}
		$citerio = new Criterio(Shared::filtroFoiExcluido(false));
		foreach ($filtros as $filtro){
			$citerio->add($filtro);
		}
		$sql->setCriterio($citerio);
		return $this->getRow($sql->getInstrucaoSql());
	}

	/**
	 * Obtem todos os registros da tabela
	 */
	public function queryAll($idUsuarioLogado){
		$sql = new SqlSelect('${table_name}');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);
		$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
		
		//Critério
		$criterio = new Criterio($foiExcluido);
		$criterio->add($filtroUsuarioLogado);
		
		$sql->setCriterio($criterio);		

		return $this->getList($sql->getInstrucaoSql());
	}
	
	/**
	 * Obtem todos os registros da tabela ordenando por campo
	 *
	 * @param $orderColumn nome da coluna
	 */
	public function queryAllOrderBy($orderColumn,$idUsuarioLogado){

		$sql = new SqlSelect('${table_name}');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);
		$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
		
		//critério
		$criterio = new Criterio($foiExcluido);
		$criterio->add($filtroUsuarioLogado);
		$criterio->setPropriedade(OperadorSql::OORDER, $orderColumn);
		
		$sql->setCriterio($citerio);		

		return $this->getList($sql->getInstrucaoSql());
	}
	
	/**
 	 * Deletar por chave primária
 	 * @param ${var_name} primary key
 	 */
	public function delete(${pks}){
		
		$sql = new SqlUpdate('${table_name}');
        $sql->addColunaValor('foiExcluido', TRUE);
        $sql->addColunaValor('dataExclusao', 'now()',TRUE);
        
        	
        $foiExcluido = Shared::filtroFoiExcluido(FALSE);
        
        $criterio = new Criterio($filtroUsuarioLogado);
        $criterio->add($foiExcluido);
        
        $sql->setCriterio($criterio);
        return $this->executeUpdate($sql->getInstrucaoSql());
	}
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function insert(I${dao_clazz_name} $${var_name}){
		$sql = new SqlInsert('${table_name}');
		${parameter_setter}
        	$sql->addColunaValor(explode(',', '${insert_fields}'),$valores);
        	$sql->addColunaValor('foiExcluido', FALSE);
        	$sql->addColunaValor('dataCriacao', 'now()',TRUE);
        
        	return $this->executeInsert($isql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function update(I${dao_clazz_name} $${var_name}){
		
		$sql = new SqlUpdate('${table_name}');
        
        $foiExcluido = Shared::filtroFoiExcluido(FALSE);
	    $filtroID = Shared::filtroID($papel->getId());
        
        ${pk_set_update}        
        
	    $sql->addColunaValor(explode(',', '${insert_fields2}'), $valores);
	    $sql->addColunaValor('foiExcluido', FALSE);
        $sql->addColunaValor('dataCriacao', 'now()',TRUE);
        
        $criterio = new Criterio($foiExcluido);
	    $criterio->add($filtroID);
        
        $sql->setCriterio($criterio);
        
        $ret = $this->executeUpdate($sql->getInstrucaoSql());

		return $ret;	
	}

	/**
 	 * Delete todas as linhas
 	 */
	public function clean($idUsuarioLogado){
	
		$sql = new SqlUpdate('${table_name}');
        
        	$sql->addColunaValor('foiExcluido', TRUE);
	        $sql->addColunaValor('dataExclusao', 'now()',TRUE);
        
        	$UsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
        
        	$criterio = new Criterio($UsuarioLogado);
	        $criterio->add(Shared::filtroFoiExcluido(FALSE));
             
        	$sql->setCriterio($criterio);
        
	        return $this->executeUpdate($sql->getInstrucaoSql());
	}

	
	/**
	 * Read row
	 *
	 * @return ${dao_clazz_name} 
	 */
	protected function readRow($row){
		$${var_name} = new ${domain_clazz_name}();
		${read_row}
		return $${var_name};
	}
	
	protected function getList($sqlQuery){
		$tabela = Conexao::executeSelect($sqlQuery);
		$retorno = array();
			while ($linha = $tabela->fetch(PDO::FETCH_ASSOC)) {
				$retorno[] = $this->readRow($linha);
		}
		return $retorno;
	}
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return ${dao_clazz_name} 
	 */
	protected function getRow($sqlQuery){
		$tabela = Conexao::executeSelect($sqlQuery);
		if(count($tabela)==0){
			return null;
		}
		return $this->readRow($tabela->fetch(PDO::FETCH_ASSOC));		
	}

	/**
	 * Obtem um valor
	 *
	 * @return ${dao_clazz_name} 
	 */
	protected function getSingleValue($sqlQuery){
		$tabela = Conexao::executeSelect($sqlQuery);
		if(count($tabela)==1 && count($tabela->fetch)==2){
			return $tabela->fetch;
		} else {
			Throw new Exception("Excedeu o numero de campos");
		}
		return $this->readRow($tabela->fetch(PDO::FETCH_ASSOC));		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}

