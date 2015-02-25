<?php

/**
 * DAOFactory
 * @author: Daniel Custódio da Silva
 * @Data: 27/10/2014
 */



include_once '/../Dao/ext/EstoriaExtDAO.class.php';
include_once '/../Dao/ext/PapelExtDAO.class.php';
include_once '/../Dao/ext/ProjetoExtDAO.class.php';
include_once '/../Dao/ext/SprintExtDAO.class.php';
include_once '/../Dao/ext/TarefaExtDAO.class.php';
include_once '/../Dao/ext/TimeExtDAO.class.php';
include_once '/../Dao/ext/TipotarefaExtDAO.class.php';
include_once '/../Dao/ext/UsuarioExtDAO.class.php';
include_once '/../Dao/ext/UsuariopapeltimeExtDAO.class.php';


class DAOFactory{
	
	/**
	 * @return EstoriaDAO
	 */
	public static function getEstoriaDAO(){
		return new EstoriaExtDAO();
	}

	/**
	 * @return PapelDAO
	 */
	public static function getPapelDAO(){
		return new PapelExtDAO();
	}

	/**
	 * @return ProjetoDAO
	 */
	public static function getProjetoDAO(){
		return new ProjetoExtDAO();
	}

	/**
	 * @return SprintDAO
	 */
	public static function getSprintDAO(){
		return new SprintExtDAO();
	}

	/**
	 * @return TarefaDAO
	 */
	public static function getTarefaDAO(){
		return new TarefaExtDAO();
	}

	/**
	 * @return TimeDAO
	 */
	public static function getTimeDAO(){
		return new TimeExtDAO();
	}

	/**
	 * @return TipotarefaDAO
	 */
	public static function getTipotarefaDAO(){
		return new TipotarefaExtDAO();
	}

	/**
	 * @return UsuarioDAO
	 */
	public static function getUsuarioDAO(){
		return new UsuarioExtDAO();
	}

	/**
	 * @return UsuariopapeltimeDAO
	 */
	public static function getUsuariopapeltimeDAO(){
		return new UsuariopapeltimeExtDAO();
	}


}
?>