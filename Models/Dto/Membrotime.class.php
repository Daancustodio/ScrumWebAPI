<?php
	/**
	 * Objeto representa a tabela 'membrotime'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: ${date}	 
	 */

class Membrotime{

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
	* Serializa o array de chave valor para um objeto Membrotime
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Membrotime
	* @return: Membrotime 
	*/
	public function setMembrotime(array $membrotime){
       
		foreach ($membrotime as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}