<?php
	/**
	 * Objeto representa a tabela 'sprint'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Sprint{

	public $id;
	public $titulo;
	public $descricao;
	public $diasUteis;
	public $diasCerimonias;
	public $horasTrabDia;
	public $foco;
	public $dataInicio;
	public $dataConclusao;
	public $status;
	public $idProjeto;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getTitulo() {
		return $this->titulo;
	}
	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}
	public function getDescricao() {
		return $this->descricao;
	}
	public function setDescricao($descricao) {
		$this->descricao = $descricao;
	}
	public function getDiasUteis() {
		return $this->diasUteis;
	}
	public function setDiasUteis($diasUteis) {
		$this->diasUteis = $diasUteis;
	}
	public function getDiasCerimonias() {
		return $this->diasCerimonias;
	}
	public function setDiasCerimonias($diasCerimonias) {
		$this->diasCerimonias = $diasCerimonias;
	}
	public function getHorasTrabDia() {
		return $this->horasTrabDia;
	}
	public function setHorasTrabDia($horasTrabDia) {
		$this->horasTrabDia = $horasTrabDia;
	}
	public function getFoco() {
		return $this->foco;
	}
	public function setFoco($foco) {
		$this->foco = $foco;
	}
	public function getDataInicio() {
		return $this->dataInicio;
	}
	public function setDataInicio($dataInicio) {
		$this->dataInicio = $dataInicio;
	}
	public function getDataConclusao() {
		return $this->dataConclusao;
	}
	public function setDataConclusao($dataConclusao) {
		$this->dataConclusao = $dataConclusao;
	}
	public function getStatus() {
		return $this->status;
	}
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getIdProjeto() {
		return $this->idProjeto;
	}
	public function setIdProjeto($idProjeto) {
		$this->idProjeto = $idProjeto;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Sprint
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Sprint
	* @return: Sprint 
	*/
	public function setSprint(array $sprint){
       
		foreach ($sprint as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
