<?php
	/**
	 * Objeto representa a tabela 'sprint'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Sprint{

	public $id;











	public function getId() {
		return $this->id;
	}

		$this->id = $id;
	}
	public function getTitulo() {
		return $this->titulo;
	}

		$this->titulo = $titulo;
	}
	public function getDescricao() {
		return $this->descricao;
	}

		$this->descricao = $descricao;
	}
	public function getDiasUteis() {
		return $this->diasUteis;
	}

		$this->diasUteis = $diasUteis;
	}
	public function getDiasCerimonias() {
		return $this->diasCerimonias;
	}

		$this->diasCerimonias = $diasCerimonias;
	}
	public function getHorasTrabDia() {
		return $this->horasTrabDia;
	}

		$this->horasTrabDia = $horasTrabDia;
	}
	public function getFoco() {
		return $this->foco;
	}

		$this->foco = $foco;
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
	public function getIdProjeto() {
		return $this->idProjeto;
	}

		$this->idProjeto = $idProjeto;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Sprint
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Sprint
	* @return: Sprint 
	*/
	public function setSprint(array $sprint){
       
		foreach ($sprint as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}