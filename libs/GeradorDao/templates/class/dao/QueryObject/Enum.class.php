<?php

class Enum {
    public function getOperadores() {
        return $this->Operadores;
    }

    public function getNome() {
        return $this->nome;
    }

        
private $Operadores;
private $nome;


private function __construct($Operadores,$nome) {
    $this->Operadores = $Operadores;
    $this->Operadores = $Operadores;
}

private static function a(){
    return new Enum(' LIKE ','Esse é o campo Like');
}
    public static function IGUAL(){
        return new Enum(' = ');
    }
    
    
    
    const ODIFERENTE    = ' <> ';
    const OLIKE         = ' LIKE ';
    const OMAIORQUE     = ' > ';
    const OMENORQUE     = ' < ';
    const OMAIORIGUAL   = ' >= ';
    const OMENORIGUAL   = ' <= ';
    const ONOT          = ' NOT ';
    const OIN           = ' IN ';
    const OAND          = ' AND ';
    const OBETWEEN      = ' BETWEEN ';
    const OOR           = ' OR ';
    const OTODASCOLUNAS = ' * ';
    const OON           = ' ON ';
    const OID           = 'id';
    const OLIMIT        = 'LIMIT';
    const OORDER        = 'ORDER';
    const OOFFSET       = 'OFFSET';

}
