<?php
/**
 * Rest controller class for  'Tarefa' DAO.
 *
 * @author: http://github.com/hkerem/JournaledPHPDAO
 * @date: 2014-10-12 23:50
 */
class TarefaController {

	/**
	 * Get Domain object by primary key
	 *
	 * @noAuth
	 * @url GET /Tarefa/$id
	 */
	public function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getTarefaDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Tarefa/$id
	 */
	public function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getTarefaDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Tarefa
	 * @url PUT /Tarefa/$id
 	 */
	public function save($id = null, $data){
		$transaction = new Transaction();
		if ($id == null) {
			DAOFactory::getTarefaDAO()->insert($data);
		} else {
			$data->id = $id;
			DAOFactory::getTarefaDAO()->update($data);
		}
		$transaction->commit();
		return $data;
	}

	/**
	 * List domain objects
	 *
	 * @noAuth
	 * @url GET /Tarefa
	 */
	public function listAll(){
		$transaction = new Transaction();
		if (isset($_GET["descricao"])) $arr = DAOFactory::getTarefaDAO()->queryByDescricao($_GET["descricao"]);
		else if (isset($_GET["horasEstimativa"])) $arr = DAOFactory::getTarefaDAO()->queryByHorasEstimativa($_GET["horasEstimativa"]);
		else if (isset($_GET["horasEfetiva"])) $arr = DAOFactory::getTarefaDAO()->queryByHorasEfetiva($_GET["horasEfetiva"]);
		else if (isset($_GET["dataConclusao"])) $arr = DAOFactory::getTarefaDAO()->queryByDataConclusao($_GET["dataConclusao"]);
		else if (isset($_GET["obs"])) $arr = DAOFactory::getTarefaDAO()->queryByObs($_GET["obs"]);
		else if (isset($_GET["status"])) $arr = DAOFactory::getTarefaDAO()->queryByStatus($_GET["status"]);
		else if (isset($_GET["dataInicio"])) $arr = DAOFactory::getTarefaDAO()->queryByDataInicio($_GET["dataInicio"]);
		else if (isset($_GET["idEstoria"])) $arr = DAOFactory::getTarefaDAO()->queryByIdEstoria($_GET["idEstoria"]);
		else if (isset($_GET["idTipotarefa"])) $arr = DAOFactory::getTarefaDAO()->queryByIdTipotarefa($_GET["idTipotarefa"]);
		else if (isset($_GET["idUsuarioPapelTime"])) $arr = DAOFactory::getTarefaDAO()->queryByIdUsuarioPapelTime($_GET["idUsuarioPapelTime"]);
		else $arr = DAOFactory::getTarefaDAO()->queryAll();
		$transaction->commit();
		return $arr;
	}

}
?>
