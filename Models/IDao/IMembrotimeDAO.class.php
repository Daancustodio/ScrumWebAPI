<?php
/**
 * Interface DAO
 *
 * @author: Daniel CustÃ³dio da Silva
 * @Data: ${date}
 */

interface IMembrotimeDAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @Return Membrotime 
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
 	 * @param membrotime primary key
 	 */
	public function delete($id);
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param Membrotime membrotime
 	 */
	public function insert($membrotime);
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param Membrotime membrotime
 	 */
	public function update($membrotime);	

	/**
 	 * Delete todas as linhas
	 */
	public function clean($id_usuario);

}