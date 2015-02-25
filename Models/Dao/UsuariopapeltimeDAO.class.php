<?php
/**
 * Class para manipular a tabela 'usuariopapeltime'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/IUsuariopapeltimeDAO.class.php';
include_once '/../Dto/Usuariopapeltime.class.php';
include_once '/../QueryObject/IncludeQO.php';

class UsuariopapeltimeDAO implements IUsuariopapeltimeDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Usuariopapeltime 
	 */
	public function load($id){
		$sql = new SqlSelect('usuariopapeltime');
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
		$sql = new SqlSelect('usuariopapeltime');
		
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

		$sql = new SqlSelect('usuariopapeltime');
		
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
 	 * @param usuariopapeltime primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('usuariopapeltime');
		
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
 	 * @param Usuariopapeltime usuariopapeltime
 	 */
	public function insert($usuariopapeltime){
	
		$usuariopapeltime = $this->readRow($usuariopapeltime);
		
		$sql = new SqlInsert('usuariopapeltime');
		
		$sql->addColunaValor('id_papel', $usuariopapeltime->getIdPapel());
		$sql->addColunaValor('id_time', $usuariopapeltime->getIdTime());
		$sql->addColunaValor('id_usuario', $usuariopapeltime->getIdUsuario());
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Usuariopapeltime usuariopapeltime
 	 */
	public function update($usuariopapeltime){
		
		$usuariopapeltime = $this->readRow($usuariopapeltime);
		
		$sql = new SqlUpdate('usuariopapeltime');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($usuariopapeltime->getId());
	
		
		$sql->addColunaValor('id_papel', $usuariopapeltime->getIdPapel());
		$sql->addColunaValor('id_time', $usuariopapeltime->getIdTime());
		$sql->addColunaValor('id_usuario', $usuariopapeltime->getIdUsuario());
        
			
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
	
		$sql = new SqlUpdate('usuariopapeltime');
        
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
	 * @return Usuariopapeltime 
	 */
	protected function readRow($row){
		$usuariopapeltime = new Usuariopapeltime();
		
		$usuariopapeltime->id = (property_exists($row, 'id')) ? $row->id : NULL;
		$usuariopapeltime->idPapel = (property_exists($row, 'id_papel')) ? $row->id_papel : NULL;
		$usuariopapeltime->idTime = (property_exists($row, 'id_time')) ? $row->id_time : NULL;
		$usuariopapeltime->idUsuario = (property_exists($row, 'id_usuario')) ? $row->id_usuario : NULL;

		return $usuariopapeltime;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Usuariopapeltime 
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

