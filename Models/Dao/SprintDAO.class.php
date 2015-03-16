<?php
/**
 * Class para manipular a tabela 'sprint'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/ISprintDAO.class.php';
include_once '/../Dto/Sprint.class.php';
include_once '/../QueryObject/IncludeQO.php';

class SprintDAO implements ISprintDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Sprint 
	 */
	public function load($id){
		$sql = new SqlSelect('sprint');
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
		$sql = new SqlSelect('sprint');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);
		
		//Crit?rio
		$criterio = new Criterio($foiExcluido);
		/*if (!is_null($idUsuarioLogado)) {			
			$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);
			$criterio->add($filtroUsuarioLogado);
			$criterio->add($filtroTodos);
		}else{
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);            
			$criterio->add($filtroTodos);
		}*/
	
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

		$sql = new SqlSelect('sprint');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);		
		
		//critério
		$criterio = new Criterio($foiExcluido);
		/*if (!is_null($idUsuarioLogado)) {			
			$filtroUsuarioLogado = Shared::filtroUsuarioLogado($idUsuarioLogado);
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);
            $criterio->add($filtroUsuarioLogado);
			$criterio->add($filtroTodos);
		}else{
			$filtroTodos = Shared::filtroUsuarioLogado(NULL);            
			$criterio->add($filtroTodos);
		}*/
		$criterio->setPropriedade(OperadorSql::OORDER, $orderColumn);
		
		$sql->setCriterio($criterio);		

		$stm = Conexao::prepare($sql->getInstrucaoSql());
		$stm->execute();
		return $stm->fetchAll();
	}
	
	/**
 	 * Deletar por chave primária
 	 * @param sprint primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('sprint');
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
 	 * @param Sprint sprint
 	 */
	public function insert($sprint){
	
		//$sprint = $this->readRow($sprint);
		
		$sql = new SqlInsert('sprint');
		
		$sql->addColunaValor('titulo', $sprint->titulo);
		$sql->addColunaValor('descricao', $sprint->descricao);
		$sql->addColunaValor('diasUteis', $sprint->diasUteis);
		$sql->addColunaValor('diasCerimonias', $sprint->diasCerimonias);
		$sql->addColunaValor('horasTrabDia', $sprint->horasTrabDia);
		$sql->addColunaValor('foco', $sprint->foco);
		$sql->addColunaValor('dataInicio', $sprint->dataInicio);
		$sql->addColunaValor('dataConclusao', $sprint->dataConclusao);
		$sql->addColunaValor('status', $sprint->status);
		$sql->addColunaValor('idProjeto', $sprint->idProjeto);
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Sprint sprint
 	 */
	public function update($sprint){
		
		$sprint = $this->readRow($sprint);
		
		$sql = new SqlUpdate('sprint');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($papel->id);
	
		
		$sql->addColunaValor('titulo', $sprint->titulo);
		$sql->addColunaValor('descricao', $sprint->descricao);
		$sql->addColunaValor('diasUteis', $sprint->diasUteis);
		$sql->addColunaValor('diasCerimonias', $sprint->diasCerimonias);
		$sql->addColunaValor('horasTrabDia', $sprint->horasTrabDia);
		$sql->addColunaValor('foco', $sprint->foco);
		$sql->addColunaValor('dataInicio', $sprint->dataInicio);
		$sql->addColunaValor('dataConclusao', $sprint->dataConclusao);
		$sql->addColunaValor('status', $sprint->status);
		$sql->addColunaValor('idProjeto', $sprint->idProjeto);
        
			
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
	
		$sql = new SqlUpdate('sprint');
        
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
	 * @return Sprint 
	 */
	protected function readRow($row){
		$sprint = new Sprint();
		
		$sprint->id = $row->id;
		$sprint->titulo = $row->titulo;
		$sprint->descricao = $row->descricao;
		$sprint->diasUteis = $row->diasUteis;
		$sprint->diasCerimonias = $row->diasCerimonias;
		$sprint->horasTrabDia = $row->horasTrabDia;
		$sprint->foco = $row->foco;
		$sprint->dataInicio = $row->dataInicio;
		$sprint->dataConclusao = $row->dataConclusao;
		$sprint->status = $row->status;
		$sprint->idProjeto = $row->idProjeto;

		return $sprint;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Sprint 
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

