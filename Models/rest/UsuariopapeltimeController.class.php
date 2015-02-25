<?php
/**
 * Rest controller class for  'Usuariopapeltime' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class UsuariopapeltimeController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Usuariopapeltime/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getUsuariopapeltimeDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Usuariopapeltime/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getUsuariopapeltimeDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Usuariopapeltime
	 * @url PUT /Usuariopapeltime/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getUsuariopapeltimeDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getUsuariopapeltimeDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Usuariopapeltime
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["idPapel"])) $arr = DAOFactory::getUsuariopapeltimeDAO()->queryByIdPapel($_GET["idPapel"]);
		else if (isset($_GET["idTime"])) $arr = DAOFactory::getUsuariopapeltimeDAO()->queryByIdTime($_GET["idTime"]);
		else if (isset($_GET["idUsuario"])) $arr = DAOFactory::getUsuariopapeltimeDAO()->queryByIdUsuario($_GET["idUsuario"]);
		else $arr = DAOFactory::getUsuariopapeltimeDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
