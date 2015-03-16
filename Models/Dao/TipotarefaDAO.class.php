<?php
/**
 * Class para manipular a tabela 'tipotarefa'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/ITipotarefaDAO.class.php';
include_once '/../Dto/Tipotarefa.class.php';
include_once '/../QueryObject/IncludeQO.php';

class TipotarefaDAO implements ITipotarefaDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Tipotarefa 
	 */
	public function load($id){
		$sql = new SqlSelect('tipotarefa');
		$filtroID = Shared::filtroID($id);
		$foiExcluido = Shared::filtroFoiExcluido(false);
		$criterio = new Criterio($foiExcluido);
		$criterio->add($filtroID);
		
		$sql->setCriterio($criterio);
		$stm = Conexao::prepare($sql->getInstrucaoSql());
		$stm->execute();
		return $stm->fetch();
	}

	/**
	 * Obtem todos os registros da tabela
	 */
	public function queryAll($idUsuarioLogado){
		$sql = new SqlSelect('tipotarefa');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);
		
		//Crit?rio
		$criterio = new Criterio($foiExcluido);
		if (!is_null($idUsuarioLogado)) {			
			$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);
			$criterio->add($filtroUsuarioLogado);
			$criterio->add($filtroTodos);
		}else{
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);            
			$criterio->add($filtroTodos);
		}
	
		$sql->setCriterio($criterio);		

		$stm = Conexao::prepare($sql->getInstrucaoSql());
		$stm->execute();
		return $stm->fetchAll();
	}
	
	/**
	 * Obtem todos os registros da tabela ordenando por campo
	 *
	 * @param $orderColumn nome da coluna
	 */
	public function queryAllOrderBy($orderColumn,$idUsuarioLogado){

		$sql = new SqlSelect('tipotarefa');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);		
		
		//critério
		$criterio = new Criterio($foiExcluido);
		if (!is_null($idUsuarioLogado)) {			
			$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);
            $criterio->add($filtroUsuarioLogado);
			$criterio->add($filtroTodos);
		}else{
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);            
			$criterio->add($filtroTodos);
		}
		$criterio->setPropriedade(OperadorSql::OORDER, $orderColumn);
		
		$sql->setCriterio($criterio);		

		$stm = Conexao::prepare($sql->getInstrucaoSql());
		$stm->execute();
		return $stm->fetchAll();
	}
	
	/**
 	 * Deletar por chave primária
 	 * @param tipotarefa primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('tipotarefa');
		$sql->addColunaValor('foiExcluido', TRUE);
		$sql->addColunaValor('dataExclusao', 'now()',TRUE);
	
		
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);        
		$criterio = new Criterio($foiExcluido);
		$criterio->add(new Filtro('id', OperadorSql::OIGUAL, $id));  	
	
		$sql->setCriterio($criterio);
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Tipotarefa tipotarefa
 	 */
	public function insert($tipotarefa){
	
		//$tipotarefa = $this->readRow($tipotarefa);
		
		$sql = new SqlInsert('tipotarefa');
		
		$sql->addColunaValor('titulo', $tipotarefa->titulo);
		$sql->addColunaValor('descricao', $tipotarefa->descricao);
		//$sql->addColunaValor('idUsuario', $tipotarefa->idUsuario);
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Tipotarefa tipotarefa
 	 */
	public function update($tipotarefa){
		
		$tipotarefa = $this->readRow($tipotarefa);
		
		$sql = new SqlUpdate('tipotarefa');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($papel->id);
	
		
		$sql->addColunaValor('titulo', $tipotarefa->titulo);
		$sql->addColunaValor('descricao', $tipotarefa->descricao);
		$sql->addColunaValor('idUsuario', $tipotarefa->idUsuario);
        
			
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		$criterio = new Criterio($foiExcluido);
		$criterio->add($filtroID);
	
		$sql->setCriterio($criterio);
	
		$ret = $this->execute($sql->getInstrucaoSql());

		return $ret;
	}

	/**
 	 * Delete todas as linhas
 	 */
	public function clean($idUsuarioLogado){
	
		$sql = new SqlUpdate('tipotarefa');
        
		$sql->addColunaValor('foiExcluido', TRUE);
		$sql->addColunaValor('dataExclusao', 'now()',TRUE);
	
		
	
		$criterio = new Criterio(Shared::filtroFoiExcluido(FALSE));	
		 if (!is_null($idUsuarioLogado)) {			
			$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);
			$criterio->add($filtroUsuarioLogado);
			$criterio->add($filtroTodos);
		}else{
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);            
			$criterio->add($filtroTodos);
		}
		$sql->setCriterio($criterio);
	
		return $this->execute($sql->getInstrucaoSql());
	}

	
	/**
	 * Read row
	 *
	 * @return Tipotarefa 
	 */
	protected function readRow($row){
		$tipotarefa = new Tipotarefa();
		
		$tipotarefa->id = $row->id;
		$tipotarefa->titulo = $row->titulo;
		$tipotarefa->descricao = $row->descricao;
		$tipotarefa->idUsuario = $row->idUsuario;

		return $tipotarefa;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Tipotarefa 
	 */
	protected function getRow($sqlQuery){
		$tabela = Conexao::executeSelect($sqlQuery);
		if(count($tabela)==0){
			return null;
		}
		return $this->readRow($tabela->fetch());		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return Conexao::executeQuery($sqlQuery);
	}
	
		
}

