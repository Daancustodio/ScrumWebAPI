<?php

/**
 * DAOFactory
 * @author: Daniel Custódio da Silva
 * @Data: ${date}
 */



include_once '/../Dao/ext/EstoriaExtDAO.class.php';
include_once '/../Dao/ext/MembrotimeExtDAO.class.php';
include_once '/../Dao/ext/PapelExtDAO.class.php';
include_once '/../Dao/ext/ProjetoExtDAO.class.php';
include_once '/../Dao/ext/SprintExtDAO.class.php';
include_once '/../Dao/ext/TarefaExtDAO.class.php';
include_once '/../Dao/ext/TimeExtDAO.class.php';
include_once '/../Dao/ext/TipotarefaExtDAO.class.php';
include_once '/../Dao/ext/UsuarioExtDAO.class.php';


class DAOFactory{
	
	/**
	 * @return EstoriaDAO
	 */
	public static function getEstoriaDAO(){
		return new EstoriaExtDAO();
	}

	/**
	 * @return MembrotimeDAO
	 */
	public static function getMembrotimeDAO(){
		return new MembrotimeExtDAO();
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


}
?>