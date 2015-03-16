<?php
	/**
	 * Objeto representa a tabela 'tipotarefa'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: ${date}	 
	 */

class Tipotarefa{

	public $id;
	public $titulo;
	public $descricao;
	public $idUsuario;

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
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Tipotarefa
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Tipotarefa
	* @return: Tipotarefa 
	*/
	public function setTipotarefa(array $tipotarefa){
       
		foreach ($tipotarefa as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
