<?php
/**
 * Rest controller class for  'Papel' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class PapelController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Papel/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getPapelDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Papel/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getPapelDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Papel
	 * @url PUT /Papel/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getPapelDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getPapelDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Papel
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["descricao"])) $arr = DAOFactory::getPapelDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["idUsuario"])) $arr = DAOFactory::getPapelDAO()->queryByIdUsuario($_GET["idUsuario"]);
		else $arr = DAOFactory::getPapelDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
