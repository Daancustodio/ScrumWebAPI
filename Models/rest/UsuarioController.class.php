<?php
/**
 * Rest controller class for  'Usuario' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class UsuarioController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Usuario/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getUsuarioDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Usuario/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getUsuarioDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Usuario
	 * @url PUT /Usuario/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getUsuarioDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getUsuarioDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Usuario
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["email"])) $arr = DAOFactory::getUsuarioDAO()->queryByEmail($_GET["email"]);
		else if (isset($_GET["senha"])) $arr = DAOFactory::getUsuarioDAO()->queryBySenha($_GET["senha"]);
		else if (isset($_GET["nome"])) $arr = DAOFactory::getUsuarioDAO()->queryByNome($_GET["nome"]);
		else if (isset($_GET["foto"])) $arr = DAOFactory::getUsuarioDAO()->queryByFoto($_GET["foto"]);
		else $arr = DAOFactory::getUsuarioDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
