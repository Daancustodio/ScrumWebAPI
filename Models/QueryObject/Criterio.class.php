<?php

include_once 'IExpressao.class.php';
include_once 'OperadorSql.class.php';
class Criterio implements IExpressao {

    protected $filtros;
    protected $operadores;
    protected $propriedades;

    public function __construct(IExpressao $filtro) {
        $this->filtros[] = $filtro;
        $this->operadores[] = null;
    }

    public function add(IExpressao $filtro, $operador = OperadorSql::OAND) {
        $this->filtros[] = $filtro;
        $this->operadores[] = $operador;
    }

    public function getExpressaoSql() {
        $retorno;

        if (is_array($this->filtros)) {
            $retorno = '';
            foreach ($this->filtros as $i => $filtro) {
                $retorno .= $this->operadores[$i] . $filtro->getExpressaoSql() . ' ';
            }

            $retorno = trim($retorno);
            return "({$retorno})";
        }
    }

    public function setPropriedade($propriedade, $valor) {
        $propriedade = strtoupper($propriedade);
        $this->propriedades[$propriedade] = $valor;
    }

    public function getPropriedade($propriedade) {
        if(!isset($this->propriedades[$propriedade]))
            return;
        return $this->propriedades[$propriedade];

    }

    public function existeCriterio() {
        return (!empty($this->filtros));
    }

    public function existePropriedade() {
        return (!empty($this->propriedades));
    }

}
