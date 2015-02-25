<?php

namespace scrum\libs\bootstrapOO;

class TypeAlert {
	
	private $typeAlert;
	
	private function __construct( $typeAlert){
		$this->typeAlert = $typeAlert;
	}
	
	
	public static function success(){
		return new TypeAlert('success');	
	}
	
	public static function info(){
		return new TypeAlert('info');	
	}
	
	public static function warning(){
		return new TypeAlert('warning');	
	}
	
	public static function danger(){
		return new TypeAlert('danger');	
	}
	
	public function getType(){
		return $this->typeAlert;
	}

}