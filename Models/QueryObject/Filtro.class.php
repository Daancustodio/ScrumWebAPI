<?php

include_once 'IExpressao.class.php';
include_once 'Shared.class.php';

class Filtro implements IExpressao {

    private $coluna;
    private $operador;
    private $valor;

    function __construct($coluna, $operador, $valor, $aspasSimplesEmString = true) {
        $this->coluna = strtolower($coluna);
        $this->operador = $operador;
        $this->valor = strtolower(Shared::TrataTipoDados($valor));
        $this->trateValorPreparoPDO();
        if (!$aspasSimplesEmString) {
            $this->limpaAspasValorParaJoin();
        }
    }

    public function limpaAspasValorParaJoin() {
        if (substr($this->valor, 0, 1) == '\'') {
            $this->valor = substr($this->valor, 1);
            $this->valor = substr($this->valor, 0, (strlen($this->valor) - 1));
        }
    }


    private function trateValorPreparoPDO() {

        if ((trim($this->valor) == '\':' . $this->coluna . '\'') OR ( trim($this->valor) == "'?'" )) {
            $this->limpaAspasValorParaJoin();
        }
    }

    public function getExpressaoSql() {
        $aux = $this->coluna . ' ' . $this->operador . ' ' . $this->valor;
        return $aux;
    }

}
