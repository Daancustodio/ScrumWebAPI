<?php

include_once 'SqlInstrucao.class.php';
include_once 'Shared.class.php';
final class SqlInsert extends SqlInstrucao {
	
	private $valoresColunas; //Array
	
	public function addColunaValor($coluna, $valor, $funcaoSql = false) 
	{
            if(!$funcaoSql){
            $this->valoresColunas[$coluna] = Shared::TrataTipoDados($valor);
            }else{
                $this->valoresColunas[$coluna] = $valor;
            }
	}
	
	public function getInstrucaoSql()
	{
		$this->sql = "INSERT INTO {$this->entidade} (";
		$colunas = implode(', ', array_keys($this->valoresColunas));
		$valores = implode(', ', array_values($this->valoresColunas));
		
		$this->sql .= $colunas . ')';
		$this->sql .= "VALUES ({$valores})"; 
		
		return $this->sql;
	}
	
	public function __construct($entidade)
	{
		$this->setEntidade($entidade);
	}

}