<?php

include_once 'SqlInstrucao.class.php';
include_once 'Shared.class.php';

class SqlUpdate extends SqlInstrucao {

    private $valoresColunas; //Array
    private $criterio; // Objeto Criterio

    public function addColunaValor($coluna, $valor,$funcaoSql = false) {
        if(!$funcaoSql){
        $this->valoresColunas[$coluna] = Shared::TrataTipoDados($valor);
        }else{
            $this->valoresColunas[$coluna] = $valor;
        }
    }

    public function getInstrucaoSql() {
        $this->sql = "UPDATE {$this->getEntidade()}";

        if ($this->valoresColunas) {
            foreach ($this->valoresColunas as $coluna => $valor) {
                $set[] = "{$coluna} = {$valor} ";
            }
        }
        $this->sql .= 'SET ' .implode(', ', $set);

        if ($this->criterio->existeCriterio()) {
            $this->sql .= ' WHERE ' . $this->criterio->getExpressaoSql();
        }
        return $this - sql;
    }

    public function __construct($entidade) {
        $this->setEntidade($entidade);
    }

    public function setCriterio(IExpressao $criterio) {
        $this->criterio = $criterio;
    }

}
