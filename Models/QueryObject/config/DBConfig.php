<?php

/**
* Conficurações de conexao com o banco
*/
class DBConfig
{
	//private static $host 	= 'localhost';
        private static $host = 'localhost:3306';
        private static $dbName 	= 'bancoscrum';
	private static $pass 	= '';
	private static $user 	= 'root';
	
	/**
	 * Obtem o nome do banco
	 * @return String
	 */
	public static function getDbName()
	{
	    return self::$dbName;
	}
	
	/**
	 * Obtem Senha do banco
	 * @return string
	 */
	public static function getPass()
	{
	    return self::$pass;
	}
	
	/**
	 * Obtem Usuario
	 * @return string
	 */
	public static function getUser()
	{
	    return self::$user;
	}
	
	/**
	 * Obtem Host
	 * @return string
	 */
	public static function getHost()
	{
	    return self::$host;
	}
	
	

}

