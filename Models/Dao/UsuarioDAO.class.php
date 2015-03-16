<?php
/**
 * Class para manipular a tabela 'usuario'. Database Mysql.
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 28/10/2014
 */
include_once '/../IDao/IUsuarioDAO.class.php';
include_once '/../Dto/Usuario.class.php';
include_once '/../QueryObject/IncludeQO.php';

class UsuarioDAO implements IUsuarioDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @return Usuario 
	 */
	public function load($id){
		$sql = new SqlSelect('usuario');
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
		$sql = new SqlSelect('usuario');
		
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

		$sql = new SqlSelect('usuario');
		
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
 	 * @param usuario primary key
 	 */
	public function delete($id){
		
		$sql = new SqlUpdate('usuario');
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
 	 * @param Usuario usuario
 	 */
	public function insert($usuario){
	
		$usuario = $this->readRow($usuario);
		
		$sql = new SqlInsert('usuario');
		
		$sql->addColunaValor('email', $usuario->email);
		$sql->addColunaValor('senha', $usuario->senha);
		$sql->addColunaValor('nome', $usuario->nome);
		$sql->addColunaValor('foto', $usuario->foto);
        	
		$sql->addColunaValor('foiExcluido', FALSE);
		$sql->addColunaValor('dataCriacao', 'now()',TRUE);
	
		return $this->execute($sql->getInstrucaoSql());
	}
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Usuario usuario
 	 */
	public function update($usuario){
		
		$usuario = $this->readRow($usuario);
		
		$sql = new SqlUpdate('usuario');
        
		$foiExcluido = Shared::filtroFoiExcluido(FALSE);
		$filtroID = Shared::filtroID($papel->id);
	
		
		$sql->addColunaValor('email', $usuario->email);
		$sql->addColunaValor('senha', $usuario->senha);
		$sql->addColunaValor('nome', $usuario->nome);
		$sql->addColunaValor('foto', $usuario->foto);
        
			
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
	
		$sql = new SqlUpdate('usuario');
        
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
	 * @return Usuario 
	 */
	protected function readRow($row){
		$usuario = new Usuario();
		
		$usuario->id = $row->id;
		$usuario->email = $row->email;
		$usuario->senha = $row->senha;
		$usuario->nome = $row->nome;
		$usuario->foto = $row->foto;

		return $usuario;
	}
	
	
	/**
	 * Obtem uma Linha da consulta
	 *
	 * @return Usuario 
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

