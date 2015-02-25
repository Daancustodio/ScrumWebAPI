<?php

include_once 'SqlInstrucao.class.php';
include_once 'Shared.class.php';
final class SqlInsert extends SqlInstrucao {
	
	private $ValoresColunas; //Array
	
	public function addColunaValor($coluna, $valor) 
	{
		$this->ValoresColunas[$coluna] = Shared::TrataTipoDados($valor);	
	}
	
	public function getInstrucaoSql()
	{
		$this->sql = "INSERT INTO {$this->entidade} (";
		$colunas = implode(', ', array_keys($this->ValoresColunas));
		$valores = implode(', ', array_values($this->ValoresColunas));
		
		$this->sql .= $colunas . ')';
		$this->sql .= "VALUES ({$valores})"; 
		
		return $this->sql;
	}
	
	public function __construct($entidade)
	{
		$this->setEntidade($entidade);
	}

}