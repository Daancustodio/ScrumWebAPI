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
		$filtroID = Filtro('idEstoria', OperadorSql::OIGUAL, $idEstoria);
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
		
		$sql->addColunaValor('descricao', $tarefa->getDescricao());
		$sql->addColunaValor('horasEstimativa', $tarefa->getHorasEstimativa());
		$sql->addColunaValor('horasEfetiva', $tarefa->getHorasEfetiva());
		$sql->addColunaValor('dataConclusao', $tarefa->getDataConclusao());
		$sql->addColunaValor('obs', $tarefa->getObs());
		$sql->addColunaValor('status', $tarefa->getStatus());
		$sql->addColunaValor('dataInicio', $tarefa->getDataInicio());
		$sql->addColunaValor('id_estoria', $tarefa->getIdEstoria());
		$sql->addColunaValor('id_tipotarefa', $tarefa->getIdTipotarefa());
		$sql->addColunaValor('id_usuarioPapelTime', $tarefa->getIdUsuarioPapelTime());
        	
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
		$filtroID = Shared::filtroID($tarefa->getId());
	
		
		$sql->addColunaValor('descricao', $tarefa->getDescricao());
		$sql->addColunaValor('horasEstimativa', $tarefa->getHorasEstimativa());
		$sql->addColunaValor('horasEfetiva', $tarefa->getHorasEfetiva());
		$sql->addColunaValor('dataConclusao', $tarefa->getDataConclusao());
		$sql->addColunaValor('obs', $tarefa->getObs());
		$sql->addColunaValor('status', $tarefa->getStatus());
		$sql->addColunaValor('dataInicio', $tarefa->getDataInicio());
		$sql->addColunaValor('id_estoria', $tarefa->getIdEstoria());
		$sql->addColunaValor('id_tipotarefa', $tarefa->getIdTipotarefa());
		$sql->addColunaValor('id_usuarioPapelTime', $tarefa->getIdUsuarioPapelTime());
        
			
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
		
		$tarefa->id = (property_exists($row, 'id')) ? $row->id : NULL;
		$tarefa->descricao = (property_exists($row, 'descricao')) ? $row->descricao : NULL;
		$tarefa->horasEstimativa = (property_exists($row, 'horasEstimativa')) ? $row->horasEstimativa : NULL;
		$tarefa->horasEfetiva = (property_exists($row, 'horasEfetiva')) ? $row->horasEfetiva : NULL;
		$tarefa->dataConclusao = (property_exists($row, 'dataConclusao')) ? $row->dataConclusao : NULL;
		$tarefa->obs = (property_exists($row, 'obs')) ? $row->obs : NULL;
		$tarefa->status = (property_exists($row, 'status')) ? $row->status : NULL;
		$tarefa->dataInicio = (property_exists($row, 'dataInicio')) ? $row->dataInicio : NULL;
		$tarefa->idEstoria = (property_exists($row, 'id_estoria')) ? $row->id_estoria : NULL;
		$tarefa->idTipotarefa = (property_exists($row, 'id_tipotarefa')) ? $row->id_tipotarefa : NULL;
		$tarefa->idUsuarioPapelTime = (property_exists($row, 'id_usuarioPapelTime')) ? $row->id_usuarioPapelTime : NULL;

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

