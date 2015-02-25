<?php
/**
 * Connection properties
 *
 * @author: http://phpdao.com
 * @date: 27.11.2007
 */
class ConnectionProperty{
	private static $host = 'localhost';
	private static $user = 'root';
	private static $password = '';
	private static $database = 'bancoscrum';

	public static function getHost(){
		return self::$host;
	}

	public static function getUser(){
		return self::$user;
	}

	public static function getPassword(){
		return self::$password;
	}

	public static function getDatabase(){
		return self::$database;
	}
}
?>