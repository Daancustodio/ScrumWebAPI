<?php
	/**
	 * Objeto representa a tabela 'estoria'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Estoria{

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
	public function getPtsEstimados() {
		return $this->ptsEstimados;
	}

		$this->ptsEstimados = $ptsEstimados;
	}
	public function getDataInicio() {
		return $this->dataInicio;
	}

		$this->dataInicio = $dataInicio;
	}
	public function getDataConclusao() {
		return $this->dataConclusao;
	}

		$this->dataConclusao = $dataConclusao;
	}
	public function getStatus() {
		return $this->status;
	}

		$this->status = $status;
	}
	public function getIdSprint() {
		return $this->idSprint;
	}

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