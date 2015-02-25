<?php
/*
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>
*/



namespace scrum\libs\bootstrapOO;

include_once '/../../AutoLoader.php';

use zpt\oobo\Div;
use zpt\oobo\Heading;


Class Panel {
	
	private $heading;
	private $body;
	private $panel;
	
	const PRIMARY	= " panel panel-primary ";
	const SUCCESS	= " panel panel-success ";
	const INFO		= " panel panel-info ";
	const WARNING	= " panel panel-warning ";
	const DANGER	= " panel panel-danger ";
	const TITLE		= " panel-title ";
	const DEFUALTP	= " panel panel-default ";
	
	function __construct(Heading $title = null , $content = null, $id = null, $type = self::DEFAULTP){
				
		$this->panel = new Div($id, $type);
		$this->heading = new Div(null, ' panel-heading ');
		if(!is_null($title)){
			$this->setHeading($title);
		}
		$this->body = new Div(null,' panel-body ');
		$this->addContent($content);		
	
	}
	
	public function setHeading(Heading $title){		
		$this->heading = new Div(null, ' panel-heading ');
		$title->setClass(' panel-title ');
		$this->heading->add($title);
	}
	
	public function setType($type){
		$this->panel->setClass($type);
	}
	
	
	public function addContent($element){
		$this->body->add($element);
	}
	
	public function setContent($element){
		$this->body = new Div(null,' panel-body ');
		$this->body->add($element);
	}
		
	public function show(){
		$this->panel->add($this->heading);
		$this->panel->add($this->body);		
		$show = $this->panel->__toString();		
		//var_dump($show);		
		echo $show ;	
	}
}
/*
$alerta = new Alert(TypeAlert::info(), '','Mensagem de alerta', true);
$alerta->setTitle('Título');
$panel  = new Panel(null, null,New Heading(5,'Tittulo'),'Conteudo');
$panel->addContent($alerta->getOutPut());
$panel->show();*/