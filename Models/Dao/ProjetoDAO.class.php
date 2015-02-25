<?php
/**
 * Class para manipular a tabela 'projeto'. Database Mysql.
 *
 * @author: Daniel Custódio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/IProjetoDAO.class.php';
include_once '/../Dto/Projeto.class.php';
include_once '/../QueryObject/IncludeQO.php';

class ProjetoDAO implements IProjetoDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Projeto 
	 */
	public function load($id){
		$sql = new SqlSelect('projeto');
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
		$sql = new SqlSelect('projeto');
		
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

		$sql = new SqlSelect('projeto');
		
		//filtros
		$foiExcluido = Shared::filtroFoiExcluido(false);		
		
		//crit�rio
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
 	 * Deletar por chave prim�ria
 	 * @param projeto primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('projeto');
		
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
 	 * @param Projeto projeto
 	 */
	public function insert($projeto){
	
		$projeto = $this->readRow($projeto);
		
		$sql = new SqlInsert('projeto');
		
		$sql->addColunaValor('titulo', $projeto->getTitulo());
		$sql->addColunaValor('descricao', $projeto->getDescricao());
		$sql->addColunaValor('id_usuario', $projeto->getIdUsuario());
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Projeto projeto
 	 */
	public function update($projeto){
		
		$projeto = $this->readRow($projeto);
		
		$sql = new SqlUpdate('projeto');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($projeto->getId());
	
		
		$sql->addColunaValor('titulo', $projeto->getTitulo());
		$sql->addColunaValor('descricao', $projeto->getDescricao());
		$sql->addColunaValor('id_usuario', $projeto->getIdUsuario());
        
			
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
	
		$sql = new SqlUpdate('projeto');
        
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
	 * @return Projeto 
	 */
	protected function readRow($row){
		$projeto = new Projeto();
		
		$projeto->id = (property_exists($row, 'id')) ? $row->id : NULL;
		$projeto->titulo = (property_exists($row, 'titulo')) ? $row->titulo : NULL;
		$projeto->descricao = (property_exists($row, 'descricao')) ? $row->descricao : NULL;
		$projeto->idUsuario = (property_exists($row, 'id_usuario')) ? $row->id_usuario : NULL;

		return $projeto;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Projeto 
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

