<?php

include_once 'SqlInstrucao.class.php';

class SqlSelect extends SqlInstrucao {

    private $colunas; //Array
    private $criterio; // object
    private $joins;
    private $order;
    private $limit;
    private $offSet;
    private $subSelect;

    public function __construct($entidade) {
        $this->setEntidade($entidade);
    }

    public function setCriterio(IExpressao $criterio) {
        $this->criterio = $criterio;
    }

    public function setJoin(Join $join) {
        $this->joins[] = $join;
    }

    public function addColuna($coluna) {
        if (is_array($coluna)) {
            foreach ($coluna as $c) {
                $this->colunas[] = $c;
            }
        } else {
            $this->colunas[] = $coluna;
        }
    }
	
	public function addSubSelect(SqlSelect $subSelect, $nomeParaColuna){
		$this->colunas[] = $subSelect;
		$this->subSelect[count($this->colunas)-1] = $nomeParaColuna;		
	}

    public function getInstrucaoSql() {
        $this->sql = 'SELECT ';
        if (!empty($this->colunas)) {
            
		    $total = count($this->colunas);
			//Se no Array de colunas existir uma instrução de sub select, monta a consulta.
			for($i = 0; $i < $total;$i++){
				if($this->colunas[$i] instanceof SqlSelect){
					$this->colunas[$i] = '('.$this->colunas[$i]->getInstrucaoSql().') AS '.$this->subSelect[$i];
				}
			}   
		   
            $this->sql .= implode(', ', $this->colunas);
        } else {
            $this->sql .= ' * ';
        }
        $this->sql .= ' FROM ' . $this->getEntidade();

        if (!empty($this->joins)) {
            foreach ($this->joins as $join) {
                $this->sql .= $join->getExpressaoSql();
            }
        }

        if ($this->criterio) {
            $this->sql .= ' WHERE ' . $this->criterio->getExpressaoSql();
        }

        if ($this->criterio) {
            if ($this->criterio->existePropriedade()) {
                $this->order = $this->criterio->getPropriedade(OperadorSql::OORDER);
                $this->limit = $this->criterio->getPropriedade(OperadorSql::OLIMIT);
                $this->offSet = $this->criterio->getPropriedade(OperadorSql::OOFFSET);
            }

            if (!empty($this->order)) {
                $this->sql .= ' ' . OperadorSql::OORDER . ' BY ' . $this->order;
            }
            if (!empty($this->limit)) {
                $this->sql .= ' ' . OperadorSql::OLIMIT . ' ' . $this->limit;
            }
            if (!empty($this->offSet)) {
                $this->sql .= ' ' . OperadorSql::OOFFSET . ' ' . $this->offSet;
            }
        }
        return $this->sql;
    }

}
