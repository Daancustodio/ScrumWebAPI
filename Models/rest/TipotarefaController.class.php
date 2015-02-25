<?php
/**
 * Rest controller class for  'Tipotarefa' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class TipotarefaController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Tipotarefa/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getTipotarefaDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Tipotarefa/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getTipotarefaDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Tipotarefa
	 * @url PUT /Tipotarefa/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getTipotarefaDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getTipotarefaDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Tipotarefa
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["descricao"])) $arr = DAOFactory::getTipotarefaDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["idUsuario"])) $arr = DAOFactory::getTipotarefaDAO()->queryByIdUsuario($_GET["idUsuario"]);
		else $arr = DAOFactory::getTipotarefaDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
