<?php
/**
 * Class para manipular a tabela 'estoria'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/IEstoriaDAO.class.php';
include_once '/../Dto/Estoria.class.php';
include_once '/../QueryObject/IncludeQO.php';

class EstoriaDAO implements IEstoriaDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Estoria 
	 */
	public function load($id){
		$sql = new SqlSelect('estoria');
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
	 * @param String $idSprint 
	 * @return Estoria Array 
	 */
	public function loadBySprint($idSprint){
		$sql = new SqlSelect('estoria');
		$filtroID = new Filtro('idSprint', OperadorSql::OIGUAL, $idSprint);
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
		$sql = new SqlSelect('estoria');
		
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

		$sql = new SqlSelect('estoria');
		
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
 	 * @param estoria primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('estoria');
		$sql->addColunaValor('foiExcluido', TRUE);
		$sql->addColunaValor('dataExclusao', 'now()',TRUE);
	
		
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);        
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
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Estoria estoria
 	 */
	public function insert($estoria){
	
		//$estoria = $this->readRow($estoria);
		
		$sql = new SqlInsert('estoria');
		
		$sql->addColunaValor('titulo', $estoria->titulo);
		$sql->addColunaValor('descricao', $estoria->descricao);
		$sql->addColunaValor('pontosEstimados', $estoria->pontosEstimados);
		// $sql->addColunaValor('dataInicio', $estoria->dataInicio);
		// $sql->addColunaValor('dataConclusao', $estoria->dataConclusao);
		$sql->addColunaValor('status', $estoria->status);
		$sql->addColunaValor('idSprint', $estoria->idSprint);
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Estoria estoria
 	 */
	public function update($estoria){
		
		$estoria = $this->readRow($estoria);
		
		$sql = new SqlUpdate('estoria');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($papel->id);
	
		
		$sql->addColunaValor('titulo', $estoria->titulo);
		$sql->addColunaValor('descricao', $estoria->descricao);
		$sql->addColunaValor('pontosEstimados', $estoria->pontosEstimados);
		$sql->addColunaValor('dataInicio', $estoria->dataInicio);
		$sql->addColunaValor('dataConclusao', $estoria->dataConclusao);
		$sql->addColunaValor('status', $estoria->status);
		$sql->addColunaValor('idSprint', $estoria->idSprint);
        
			
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
	
		$sql = new SqlUpdate('estoria');
        
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
	 * @return Estoria 
	 */
	protected function readRow($row){
		$estoria = new Estoria();
		
		$estoria->id = $row->id;
		$estoria->titulo = $row->titulo;
		$estoria->descricao = $row->descricao;
		$estoria->pontosEstimados = $row->pontosEstimados;
		$estoria->dataInicio = $row->dataInicio;
		$estoria->dataConclusao = $row->dataConclusao;
		$estoria->status = $row->status;
		$estoria->idSprint = $row->idSprint;

		return $estoria;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Estoria 
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

