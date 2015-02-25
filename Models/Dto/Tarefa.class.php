<?php
	/**
	 * Objeto representa a tabela 'tarefa'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Tarefa{

	public $id;
	public $descricao;
	public $horasEstimativa;
	public $horasEfetiva;
	public $dataConclusao;
	public $obs;
	public $status;
	public $dataInicio;
	public $idEstoria;
	public $idTipotarefa;
	public $idUsuarioPapelTime;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getHorasEstimativa() {
		return $this->horasEstimativa;
	}
	public function setHorasEstimativa($horasEstimativa) {
		$this->horasEstimativa = $horasEstimativa;
	}
	public function getHorasEfetiva() {
		return $this->horasEfetiva;
	}
	public function setHorasEfetiva($horasEfetiva) {
		$this->horasEfetiva = $horasEfetiva;
	}
	public function getDataConclusao() {
		return $this->dataConclusao;
	}
	public function setDataConclusao($dataConclusao) {
		$this->dataConclusao = $dataConclusao;
	}
	public function getObs() {
		return $this->obs;
	}
	public function setObs($obs) {
		$this->obs = $obs;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getDataInicio() {
		return $this->dataInicio;
	}
	public function setDataInicio($dataInicio) {
		$this->dataInicio = $dataInicio;
	}
	public function getIdEstoria() {
		return $this->idEstoria;
	}
	public function setIdEstoria($idEstoria) {
		$this->idEstoria = $idEstoria;
	}
	public function getIdTipotarefa() {
		return $this->idTipotarefa;
	}
	public function setIdTipotarefa($idTipotarefa) {
		$this->idTipotarefa = $idTipotarefa;
	}
	public function getIdUsuarioPapelTime() {
		return $this->idUsuarioPapelTime;
	}
	public function setIdUsuarioPapelTime($idUsuarioPapelTime) {
		$this->idUsuarioPapelTime = $idUsuarioPapelTime;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Tarefa
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Tarefa
	* @return: Tarefa 
	*/
	public function setTarefa(array $tarefa){
       
		foreach ($tarefa as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
