<?php

include_once 'IExpressao.class.php';
include_once 'Criterio.class.php';
include_once 'OperadorSql.class.php';

class Join extends Criterio implements IExpressao {

    private $tipoJoin;
    private $entidade;

    const INNER = ' INNER JOIN ';
    const LEFT = ' LEFT JOIN ';
    const RIGHT = ' RIGHT JOIN ';

    public function __construct($tipoJoin, $entidade, IExpressao $filtro, $manterAspas = false) {
        $this->setTipoJoin($tipoJoin);
        if (!$manterAspas) {
            $filtro->limpaAspasValorParaJoin();
        }
        $this->setEntidade($entidade);
        parent::__construct($filtro);
    }

    public function getExpressaoSql() {
        /* @var $retorno String */
        $retorno = '';

        if (is_array($this->filtros)) {
            foreach ($this->filtros as $i => $objFiltro) {
                $retorno .= $this->operadores[$i];
                $retorno .= $objFiltro->getExpressaoSql() . ' ';
            }

            $retorno = trim($retorno);
            return $this->tipoJoin . ' ' . $this->getEntidade() . OperadorSql::OON . "({$retorno})";
        }
    }

    public function setTipoJoin($tipoJoin) {
        $this->tipoJoin = $tipoJoin;
    }

    final public function setEntidade($entidade) {
        $this->entidade = $entidade;
    }

    final public function getEntidade() {
        return $this->entidade;
    }

}
