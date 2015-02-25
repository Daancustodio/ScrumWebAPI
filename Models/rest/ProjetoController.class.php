<?php
/**
 * Rest controller class for  'Projeto' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class ProjetoController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Projeto/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getProjetoDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Projeto/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getProjetoDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Projeto
	 * @url PUT /Projeto/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getProjetoDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getProjetoDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Projeto
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["titulo"])) $arr = DAOFactory::getProjetoDAO()->queryByTitulo($_GET["titulo"]);
		else if (isset($_GET["descricao"])) $arr = DAOFactory::getProjetoDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["idUsuario"])) $arr = DAOFactory::getProjetoDAO()->queryByIdUsuario($_GET["idUsuario"]);
		else $arr = DAOFactory::getProjetoDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
