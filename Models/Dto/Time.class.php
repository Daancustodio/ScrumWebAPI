<?php
	/**
	 * Objeto representa a tabela 'time'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: ${date}	 
	 */

class Time{

	public $id;
	public $nome;
	public $idUsuario;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getIdUsuario() {
		return $this->idUsuario;
	}
	public function setIdUsuario($idUsuario) {
		$this->idUsuario = $idUsuario;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Time
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Time
	* @return: Time 
	*/
	public function setTime(array $time){
       
		foreach ($time as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
