<?php
	/**
	 * Objeto representa a tabela 'time'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Time{

	public $id;



	public function getId() {
		return $this->id;
	}

		$this->id = $id;
	}
	public function getDescricao() {
		return $this->descricao;
	}

		$this->descricao = $descricao;
	}
	public function getIdUsuario() {
		return $this->idUsuario;
	}

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