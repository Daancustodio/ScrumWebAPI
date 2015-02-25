<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/sprint';
	
	/**
	 * Deleta Sprint por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Sprint/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getSprintDAO()->delete($id);
        });

	/**
 	 * Salva Sprint no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Sprint
	 * @url PUT /Sprint/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objSprint =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objSprint->id < 1 ){
                    $objSprint->id = NULL;
                    DAOFactory::getSprintDAO()->insert($objSprint);
		} else {                    
                    DAOFactory::getSprintDAO()->update($objSprint);                    
		}

		formatJson($objSprint);

	});
	
		
	/**
	 * Busca Todos os Sprints
	 * @author Daniel Custódio
	 * @url GET /Sprint	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getSprintDAO()->queryAllOrderBy(' id desc ',$idUser);
		foreach ($result as $value) {
			$value->dataInicio = date('d/m/Y', strtotime($value->dataInicio));
        	$value->dataConclusao = date('d/m/Y', strtotime($value->dataConclusao));	
		}
		formatJson($result);
	});
	
	/**
	 * Busca Sprint por ID
	 * @author Daniel Custódio
	 * @url GET /Sprint/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getSprintDAO()->load($id);
        $result->dataInicio = date('Y-m-d', strtotime($result->dataInicio));
        $result->dataConclusao = date('Y-m-d', strtotime($result->dataConclusao));

		formatJson($result);
	});

	



