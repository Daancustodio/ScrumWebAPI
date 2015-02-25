<?php
/**
 * Rest controller class for  'Sprint' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class SprintController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Sprint/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getSprintDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Sprint/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getSprintDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Sprint
	 * @url PUT /Sprint/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getSprintDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getSprintDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Sprint
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["titulo"])) $arr = DAOFactory::getSprintDAO()->queryByTitulo($_GET["titulo"]);
		else if (isset($_GET["descricao"])) $arr = DAOFactory::getSprintDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["diasUteis"])) $arr = DAOFactory::getSprintDAO()->queryByDiasUteis($_GET["diasUteis"]);
		else if (isset($_GET["diasCerimonias"])) $arr = DAOFactory::getSprintDAO()->queryByDiasCerimonias($_GET["diasCerimonias"]);
		else if (isset($_GET["horasTrabDia"])) $arr = DAOFactory::getSprintDAO()->queryByHorasTrabDia($_GET["horasTrabDia"]);
		else if (isset($_GET["foco"])) $arr = DAOFactory::getSprintDAO()->queryByFoco($_GET["foco"]);
		else if (isset($_GET["dataInicio"])) $arr = DAOFactory::getSprintDAO()->queryByDataInicio($_GET["dataInicio"]);
		else if (isset($_GET["dataConclusao"])) $arr = DAOFactory::getSprintDAO()->queryByDataConclusao($_GET["dataConclusao"]);
		else if (isset($_GET["status"])) $arr = DAOFactory::getSprintDAO()->queryByStatus($_GET["status"]);
		else if (isset($_GET["idProjeto"])) $arr = DAOFactory::getSprintDAO()->queryByIdProjeto($_GET["idProjeto"]);
		else $arr = DAOFactory::getSprintDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
