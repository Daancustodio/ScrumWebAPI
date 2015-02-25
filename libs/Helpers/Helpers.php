<?php
/**
 * Class para funções de auxilio 
 *
 * @author: Daniel Custódio da Silva
 * @Data: 28/10/2014
 */

class Helpers {

	public static function formatDateToBR($value){
		return date('d/m/Y', strtotime($value));
	}
}
