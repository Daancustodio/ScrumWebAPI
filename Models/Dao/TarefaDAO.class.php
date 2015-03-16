<?php
/**
 * Class para manipular a tabela 'tarefa'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/ITarefaDAO.class.php';
include_once '/../Dto/Tarefa.class.php';
include_once '/../QueryObject/IncludeQO.php';

class TarefaDAO implements ITarefaDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Tarefa 
	 */
	public function load($id){
		$sql = new SqlSelect('tarefa');
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
	 * Obtem registro por ID
	 *
	 * @param String $idEstoria 
	 * @return Tarefa Array 
	 */
	public function loadByEstoria($idEstoria){
		$sql = new SqlSelect('tarefa');
		$filtroID = new Filtro('idEstoria', OperadorSql::OIGUAL, $idEstoria);
		$foiExcluido = Shared::filtroFoiExcluido(false);
		$criterio = new Criterio($foiExcluido);
		$criterio->add($filtroID);
		
		$sql->setCriterio($criterio);
		$stm = Conexao::prepare($sql->getInstrucaoSql());
		$stm->execute();
		return $stm->fetchAll();
	}

	/**
	 * Obtem todos os registros da tabela
	 */
	public function queryAll($idUsuarioLogado){
		$sql = new SqlSelect('tarefa');
		
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

		$sql = new SqlSelect('tarefa');
		
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
 	 * @param tarefa primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('tarefa');
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
 	 * @param Tarefa tarefa
 	 */
	public function insert($tarefa){
	
		$tarefa = $this->readRow($tarefa);
		
		$sql = new SqlInsert('tarefa');
		
		$sql->addColunaValor('titulo', $tarefa->titulo);
		$sql->addColunaValor('descricao', $tarefa->descricao);
		$sql->addColunaValor('horasEstimativa', $tarefa->horasEstimativa);
		$sql->addColunaValor('horasEfetiva', $tarefa->horasEfetiva);
		$sql->addColunaValor('dataConclusao', $tarefa->dataConclusao);
		$sql->addColunaValor('obs', $tarefa->obs);
		$sql->addColunaValor('status', $tarefa->status);
		$sql->addColunaValor('dataInicio', $tarefa->dataInicio);
		$sql->addColunaValor('idEstoria', $tarefa->idEstoria);
		$sql->addColunaValor('idTipotarefa', $tarefa->idTipotarefa);
		$sql->addColunaValor('idUsuarioPapelTime', $tarefa->idUsuarioPapelTime);
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Tarefa tarefa
 	 */
	public function update($tarefa){
		
		$tarefa = $this->readRow($tarefa);
		
		$sql = new SqlUpdate('tarefa');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($papel->id);
	
		
		$sql->addColunaValor('titulo', $tarefa->titulo);
		$sql->addColunaValor('descricao', $tarefa->descricao);
		$sql->addColunaValor('horasEstimativa', $tarefa->horasEstimativa);
		$sql->addColunaValor('horasEfetiva', $tarefa->horasEfetiva);
		$sql->addColunaValor('dataConclusao', $tarefa->dataConclusao);
		$sql->addColunaValor('obs', $tarefa->obs);
		$sql->addColunaValor('status', $tarefa->status);
		$sql->addColunaValor('dataInicio', $tarefa->dataInicio);
		$sql->addColunaValor('idEstoria', $tarefa->idEstoria);
		$sql->addColunaValor('idTipotarefa', $tarefa->idTipotarefa);
		$sql->addColunaValor('idUsuarioPapelTime', $tarefa->idUsuarioPapelTime);
        
			
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
	
		$sql = new SqlUpdate('tarefa');
        
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
	 * @return Tarefa 
	 */
	protected function readRow($row){
		$tarefa = new Tarefa();
		
		$tarefa->id = $row->id;
		$tarefa->titulo = $row->titulo;
		$tarefa->descricao = $row->descricao;
		$tarefa->horasEstimativa = $row->horasEstimativa;
		$tarefa->horasEfetiva = $row->horasEfetiva;
		$tarefa->dataConclusao = $row->dataConclusao;
		$tarefa->obs = $row->obs;
		$tarefa->status = $row->status;
		$tarefa->dataInicio = $row->dataInicio;
		$tarefa->idEstoria = $row->idEstoria;
		$tarefa->idTipotarefa = $row->idTipotarefa;
		$tarefa->idUsuarioPapelTime = $row->idUsuarioPapelTime;

		return $tarefa;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Tarefa 
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

