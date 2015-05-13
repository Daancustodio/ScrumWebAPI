<?php

/**
* Conficurações de conexao com o banco
*/
class DBConfig
{
	
	/*private static $host = 'localhost:3306';
    private static $dbName 	= 'bancoscrum';
	private static $pass 	= '';
	private static $user 	= 'root';
	*/
	/*000webhost
	private static $host = "mysql7.000webhost.com";
	private static $dbName = "a6373706_scrum";
	private static $user = "a6373706_scrum";
    private static $pass = "8120scrum";
	*/
	
	//hostinger
	private static $host = "mysql.hostinger.com.br";
	private static $dbName = "u200640578_scrum";
	private static $user = "u200640578_scrum";
    private static $pass = "8120scrum";
	
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

