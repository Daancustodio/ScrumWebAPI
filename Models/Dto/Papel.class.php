<?php
	/**
	 * Objeto representa a tabela 'papel'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: ${date}	 
	 */

class Papel{

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
	* Serializa o array de chave valor para um objeto Papel
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Papel
	* @return: Papel 
	*/
	public function setPapel(array $papel){
       
		foreach ($papel as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
