<?php
	/**
	 * Objeto representa a tabela 'usuario'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Usuario{

	public $id;
	public $email;
	public $senha;
	public $nome;
	public $foto;

	public function getId() {
		return $this->id;
	}
	public function setId($id) {
		$this->id = $id;
	}
	public function getEmail() {
		return $this->email;
	}
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getSenha() {
		return $this->senha;
	}
	public function setSenha($senha) {
		$this->senha = $senha;
	}
	public function getNome() {
		return $this->nome;
	}
	public function setNome($nome) {
		$this->nome = $nome;
	}
	public function getFoto() {
		return $this->foto;
	}
	public function setFoto($foto) {
		$this->foto = $foto;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Usuario
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Usuario
	* @return: Usuario 
	*/
	public function setUsuario(array $usuario){
       
		foreach ($usuario as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
