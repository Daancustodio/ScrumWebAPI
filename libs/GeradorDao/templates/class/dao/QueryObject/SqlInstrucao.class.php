<?php

abstract class SqlInstrucao {

    protected $sql;
    protected $entidade;

    abstract function getInstrucaoSql();

    final public function setEntidade($entidade) {
        $this->entidade = $entidade;
    }

    final public function getEntidade() {
        return $this->entidade;
    }

}
