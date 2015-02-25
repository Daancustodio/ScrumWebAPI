<?php
/**
 * Interface DAO
 *
 * @author: ${autor}
 * @Data: ${date}
 */

interface I${dao_clazz_name}DAO{

	/**
	 * Obtem registro por ID
	 *
	 * @param String $id primary key
	 * @Return ${dao_clazz_name} 
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
 	 * @param ${var_name} primary key
 	 */
	public function delete($${pk});
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function insert($${var_name});
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function update($${var_name});	

	/**
 	 * Delete todas as linhas
	 */
	public function clean($id_usuario);

}