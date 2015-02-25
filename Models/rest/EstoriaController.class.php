<?php
/**
 * Rest controller class for  'Estoria' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class EstoriaController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Estoria/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getEstoriaDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Estoria/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getEstoriaDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Estoria
	 * @url PUT /Estoria/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getEstoriaDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getEstoriaDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Estoria
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["descricao"])) $arr = DAOFactory::getEstoriaDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["ptsEstimados"])) $arr = DAOFactory::getEstoriaDAO()->queryByPtsEstimados($_GET["ptsEstimados"]);
		else if (isset($_GET["dataInicio"])) $arr = DAOFactory::getEstoriaDAO()->queryByDataInicio($_GET["dataInicio"]);
		else if (isset($_GET["dataConclusao"])) $arr = DAOFactory::getEstoriaDAO()->queryByDataConclusao($_GET["dataConclusao"]);
		else if (isset($_GET["status"])) $arr = DAOFactory::getEstoriaDAO()->queryByStatus($_GET["status"]);
		else if (isset($_GET["idSprint"])) $arr = DAOFactory::getEstoriaDAO()->queryByIdSprint($_GET["idSprint"]);
		else $arr = DAOFactory::getEstoriaDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
