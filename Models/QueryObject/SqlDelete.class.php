<?php

include_once 'SqlInstrucao.class.php';

class SqlDelete extends SqlInstrucao {

    private $criterio; //Objeto criterio

    public function getInstrucaoSql() {
        $this->sql = "DELETE FROM {$this->getEntidade()}";

        if ($this->criterio->existeCriterio()) {
            return $this->sql . ' WHERE ' . $this->criterio->getExpressaoSql();
        }
    }

    public function __construct($entidade) {
        $this->setEntidade($entidade);
    }

    public function setCriterio(IExpressao $criterio) {
        $this->criterio = $criterio;
    }

}
