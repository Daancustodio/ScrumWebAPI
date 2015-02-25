<?php
/*
<div class="container-fluid">
  <div class="row">
    ...
  </div>
</div>
*/
namespace scrum\libs\bootstrapOO;

include_once '../AutoLoader.php';


use zpt\oobo\Div;
/**
 * Cria um novo Container bootstrap
 * Podendo ser Fluido ou comum
 * @author Daniel Cutódio da Silva - srdaniiel@gmail.com
 * @package default
 */

class Container 
{
	
	private $container;

	/**
	 * Construtor da Classe	
	 * @param Boolean $containerFluid True para container Fluido
	 * @param String $id Identificador da Div HTML identificar o elemento
	 * @param String $class Classe HTML para identificar o elemento
	 * @return Container
	 */

	public function __construct($containerFluid = TRUE, $id = null, $class = '') {
		$this->setContainer( $id, $containerFluid, $class );
	}

	/**
	 * Retorna o Container atual
	 * @return Container
	 */
	
	public function getContainer()
	{
	    return $this->container();
	}
	/**
	 * Altera as propriedades do container.
	 * @param String $id Identificador HTML para identificar o elemento
	 * @param Boolean $containerFluid True para Container Fluido 
	 * @param String $classHTML Classe HTML para identificar o elemento
	 * @return Container
	 */
	public function setContainer($containerFluid, $id , $classHTML)
	{
	    if($containerFluid){	    	
	    	$this->container = new Div($id, 'container-fluid');	    	
	    }else{
	    	$this->container = new Div($id, 'container');	    		    	
	    }

	    if (!empty($classHTML))	{
	    	$this->container->addClass($classHTML);
	    }

	    return $this;	
	}
	
	/**
	 * Exibe o Container
	 * @return Void
	 */
	
	public function show()
	{
		$out = $this->container->__toString();

		echo $out;
	}
}