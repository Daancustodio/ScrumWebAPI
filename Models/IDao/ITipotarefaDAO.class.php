<?php
/**
 * Interface DAO
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: 27/10/2014
 */

interface ITipotarefaDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @Return Tipotarefa 
	 */
	public function load($id);

	/**
	 * Obtem todos os registros da tabela
	 */
	public function queryAll($id_usuario);
	
	/**
	 * Obtem todos os registros da tabela ordenando por coluna
	 *
	 * @param $orderColumn nome da coluna
	 */
	public function queryAllOrderBy($orderColumn,$id_usuario);
	
	/**
 	 * Deletar por chave primária
 	 * @param tipotarefa primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Tipotarefa tipotarefa
 	 */
	public function insert($tipotarefa);
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Tipotarefa tipotarefa
 	 */
	public function update($tipotarefa);	

	/**
 	 * Delete todas as linhas
	 */
	public function clean($id_usuario);

}