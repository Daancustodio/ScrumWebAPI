<?php
/**
 * Interface DAO
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: ${date}
 */

interface ISprintDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @Return Sprint 
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
 	 * @param sprint primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Sprint sprint
 	 */
	public function insert($sprint);
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Sprint sprint
 	 */
	public function update($sprint);	

	/**
 	 * Delete todas as linhas
	 */
	public function clean($id_usuario);

}