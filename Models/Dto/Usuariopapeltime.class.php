<?php
	/**
	 * Objeto representa a tabela 'usuariopapeltime'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Usuariopapeltime{

	public $id;




	public function getId() {
		return $this->id;
	}

		$this->id = $id;
	}
	public function getIdPapel() {
		return $this->idPapel;
	}

		$this->idPapel = $idPapel;
	}
	public function getIdTime() {
		return $this->idTime;
	}

		$this->idTime = $idTime;
	}
	public function getIdUsuario() {
		return $this->idUsuario;
	}

		$this->idUsuario = $idUsuario;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Usuariopapeltime
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Usuariopapeltime
	* @return: Usuariopapeltime 
	*/
	public function setUsuariopapeltime(array $usuariopapeltime){
       
		foreach ($usuariopapeltime as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}