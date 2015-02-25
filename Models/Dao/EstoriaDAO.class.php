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
		$criterio->add(new Filtro('id', OperadorSql::OIGUAL, $id));  	
	
		$sql->setCriterio($criterio);
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Estoria estoria
 	 */
	public function insert($estoria){
	
		$estoria = $this->readRow($estoria);
		
		$sql = new SqlInsert('estoria');
		
		$sql->addColunaValor('descricao', $estoria->getDescricao());
		$sql->addColunaValor('ptsEstimados', $estoria->getPtsEstimados());
		$sql->addColunaValor('dataInicio', $estoria->getDataInicio());
		$sql->addColunaValor('dataConclusao', $estoria->getDataConclusao());
		$sql->addColunaValor('status', $estoria->getStatus());
		$sql->addColunaValor('id_sprint', $estoria->getIdSprint());
        	
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
		$filtroID = Shared::filtroID($estoria->getId());
	
		
		$sql->addColunaValor('descricao', $estoria->getDescricao());
		$sql->addColunaValor('ptsEstimados', $estoria->getPtsEstimados());
		$sql->addColunaValor('dataInicio', $estoria->getDataInicio());
		$sql->addColunaValor('dataConclusao', $estoria->getDataConclusao());
		$sql->addColunaValor('status', $estoria->getStatus());
		$sql->addColunaValor('id_sprint', $estoria->getIdSprint());
        
			
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
		
		$estoria->id = (property_exists($row, 'id')) ? $row->id : NULL;
		$estoria->descricao = (property_exists($row, 'descricao')) ? $row->descricao : NULL;
		$estoria->ptsEstimados = (property_exists($row, 'ptsEstimados')) ? $row->ptsEstimados : NULL;
		$estoria->dataInicio = (property_exists($row, 'dataInicio')) ? $row->dataInicio : NULL;
		$estoria->dataConclusao = (property_exists($row, 'dataConclusao')) ? $row->dataConclusao : NULL;
		$estoria->status = (property_exists($row, 'status')) ? $row->status : NULL;
		$estoria->idSprint = (property_exists($row, 'id_sprint')) ? $row->id_sprint : NULL;

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

