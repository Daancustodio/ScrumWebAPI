<?php
/**
 * Intreface DAO
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
	public function load(${pks});

	/**
	 * Obtem todos os registros da tabela
	 */
	public function queryAll($idUsuario);
	
	/**
	 * Obtem todos os registros da tabela ordenando por coluna
	 *
	 * @param $orderColumn nome da coluna
	 */
	public function queryAllOrderBy($orderColumn,$idUsuario);
	
	/**
 	 * Deletar por chave primária
 	 * @param ${var_name} primary key
 	 */
	public function delete(${pks});
	
	/**
 	 * Insere dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function insert(I${dao_clazz_name} $${var_name});
	
	/**
 	 * Update dados na tabela
 	 *
 	 * @param ${dao_clazz_name} ${var_name}
 	 */
	public function update(I${dao_clazz_name} $${var_name});	

	/**
 	 * Delete todas as linhas
	 */
	public function clean($idUsuario);

}