<?php

/*
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
  <strong>Warning!</strong> Better check yourself, you're not looking too good.
</div>

*/
namespace scrum\libs\bootstrapOO;

include_once '../AutoLoader.php';
include_once 'TypeAlert.class.php';

use zpt\oobo\Div;
use zpt\oobo\Button;
use zpt\oobo\Span;
use zpt\oobo\ElementComposite;
use zpt\oobo\struct\FlowContent;

class Alert extends ElementComposite implements FlowContent
{
    
    private $alert;
    private $closable;
    private $messagealert;
    private $buttonClose;
    private $typeAlert;
    private $title;
    
    function __construct(TypeAlert $typeAlert, $title = '', $messagealert = '', $closable = false) {
        $this->setAlert($typeAlert, $title, $messagealert, $closable);
    }
    
    public function setClosable($closable) {
        $this->closable = $closable;
        if ($this->closable) {
            $this->setButtonClose();
        }
    }
    
    public function setAlert(TypeAlert $typeAlert, $title, $messagealert, $closable) {
        $this->setClosable($closable);
        $this->setTitle($title);
        $this->setMessageAlert($messagealert);
        $this->setTypeAlert($typeAlert);
    }
    
    public function setTitle($title) {
        $this->title = $title;
    }
    
    public function setTypeAlert(TypeAlert $typeAlert) {
        $this->typeAlert = $typeAlert;
        $this->alert = new Div('alert', ' alert alert-' . $this->typeAlert->getType());
        if ($this->closable) {
            $this->alert->addClass('alert-dismissible');
        }
    }
    
    public function setMessageAlert($messagealert) {
        $this->messagealert = $messagealert;
    }
    
    public function getOutPut() {
        return $this->outPut();
    }
    public function show() {
        echo $this->outPut();
    }
    private function outPut() {
        if ($this->closable) {
            $this->alert->add($this->buttonClose);
        }
        if (!empty($this->title)) {
            $this->alert->add('<strong>' . $this->title . '! </strong>');
        }
        $this->alert->add($this->messagealert);
        $outPut = $this->alert->__toString();
        
        return $outPut;
    }
    
    private function setButtonClose() {
        $spanAria = new Span('&times;');
        $spanAria->setAttribute('aria-hidden', 'true');
        $spanClose = new Span('Close');
        $spanClose->addClass('sr-only');
        $this->buttonClose = new Button();
        $this->buttonClose->addClass('close');
        $this->buttonClose->setData('dismiss', 'alert');
        $this->buttonClose->add($spanAria);
        $this->buttonClose->add($spanClose);
    }
}

/*
$alerta = new Alert(TypeAlert::info(), '','Mensagem de alerta', true);
$alerta->setTitle('Título');
$alerta->show();
*/
