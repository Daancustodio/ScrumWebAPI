<?php
	/**
	 * Objeto representa a tabela 'tarefa'
	 *
     	 * @author: Daniel Custódio da Silva
     	 * @Data: 27/10/2014	 
	 */

class Tarefa{

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
	public function getHorasEstimativa() {
		return $this->horasEstimativa;
	}

		$this->horasEstimativa = $horasEstimativa;
	}
	public function getHorasEfetiva() {
		return $this->horasEfetiva;
	}

		$this->horasEfetiva = $horasEfetiva;
	}
	public function getDataConclusao() {
		return $this->dataConclusao;
	}

		$this->dataConclusao = $dataConclusao;
	}
	public function getObs() {
		return $this->obs;
	}

		$this->obs = $obs;
	}
	public function getStatus() {
		return $this->status;
	}

		$this->status = $status;
	}
	public function getDataInicio() {
		return $this->dataInicio;
	}

		$this->dataInicio = $dataInicio;
	}
	public function getIdEstoria() {
		return $this->idEstoria;
	}

		$this->idEstoria = $idEstoria;
	}
	public function getIdTipotarefa() {
		return $this->idTipotarefa;
	}

		$this->idTipotarefa = $idTipotarefa;
	}
	public function getIdUsuarioPapelTime() {
		return $this->idUsuarioPapelTime;
	}

		$this->idUsuarioPapelTime = $idUsuarioPapelTime;
	}
		
	/**
	* Serializa o array de chave valor para um objeto Tarefa
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  Tarefa
	* @return: Tarefa 
	*/
	public function setTarefa(array $tarefa){
       
		foreach ($tarefa as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}