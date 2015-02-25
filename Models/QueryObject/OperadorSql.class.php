<?php

abstract class OperadorSql {

    const OIGUAL        = ' = ';
    const OISNULL       = ' is null ';
    const OIS           = ' is ';
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
    const OID           = ' id ';
    const OLIMIT        = ' LIMIT ';
    const OORDER        = ' ORDER ';
    const OOFFSET       = ' OFFSET ';

}
