<?php


class Conexao extends \PDO{

    const HOSTNAME = 'localhost';
    const USERNAME = 'root';
    const PASS = '';
    const DBNAME = 'bancoscrum';

    private static $instance;

    public function __construct() {
        parent::__construct('mysql:host=' . self::HOSTNAME . ';dbname=' . self::DBNAME, self::USERNAME, self::PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
    }
    public static function getInstancia() {
        if(!self::$instance) {
            try {
                self::$instance = new Conexao; 
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);   
                
            } catch (PDOException $e) {
                echo __LINE__ . $e->getMessage();
            }
        }
        return self::$instance;
    }
    
    public static  function iniciarTransacao() {               
        return self::getInstancia()->beginTransaction();
        $this->instance = NULL;
    }
    
    public static function commitTransacao(){
        self::getInstancia()->commitTransacao();
        $this->instance = NULL;
    }
    public static function rollBackTransacao(){
        self::getInstancia()->rollBack();
        $this->instance = NULL;
    }
    
    public static function executeQuery($sqlQueryString) {
        $count = self::getInstancia()->exec($sqlQueryString);
        return $count;
    }
    
    public static function executeSelect($SqlQueryString){
        $rs = self::getInstancia()->query($SqlQueryString);
        return $rs;        
    }

}
