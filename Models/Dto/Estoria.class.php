<?php
	/**
	 * Objeto representa a tabela 'estoria'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: ${date}	 
	 */

class Estoria{

	public $id;
	public $titulo;
	public $descricao;
	public $pontosEstimados;
	public $dataInicio;
	public $dataConclusao;
	public $status;
	public $idSprint;

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
	public function getPontosEstimados() {
		return $this->pontosEstimados;
	}
	public function setPontosEstimados($pontosEstimados) {
		$this->pontosEstimados = $pontosEstimados;
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
	public function getIdSprint() {
		return $this->idSprint;
	}
	public function setIdSprint($idSprint) {
		$this->idSprint = $idSprint;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Estoria
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Estoria
	* @return: Estoria 
	*/
	public function setEstoria(array $estoria){
       
		foreach ($estoria as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
