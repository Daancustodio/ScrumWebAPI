<?php
/**
 * Rest controller class for  'Time' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class TimeController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Time/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getTimeDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Time/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getTimeDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Time
	 * @url PUT /Time/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getTimeDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getTimeDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Time
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["descricao"])) $arr = DAOFactory::getTimeDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["idUsuario"])) $arr = DAOFactory::getTimeDAO()->queryByIdUsuario($_GET["idUsuario"]);
		else $arr = DAOFactory::getTimeDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
