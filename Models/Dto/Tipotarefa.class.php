<?php
	/**
	 * Objeto representa a tabela 'tipotarefa'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Tipotarefa{

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