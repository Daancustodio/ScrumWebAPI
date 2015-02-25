<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/tipoTarefa';
	
	/**
	 * Deleta TipoTarefa por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /TipoTarefa/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getTipoTarefaDAO()->delete($id);
        });

	/**
 	 * Salva TipoTarefa no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /TipoTarefa
	 * @url PUT /TipoTarefa/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objTipoTarefa =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objTipoTarefa->id < 1 ){
                    $objTipoTarefa->id = NULL;
                    DAOFactory::getTipoTarefaDAO()->insert($objTipoTarefa);
		} else {                    
                    DAOFactory::getTipoTarefaDAO()->update($objTipoTarefa);                    
		}

		formatJson($objTipoTarefa);

	});
	
		
	/**
	 * Busca Todos os TipoTarefas
	 * @author Daniel Custódio
	 * @url GET /TipoTarefa	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getTipoTarefaDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca TipoTarefa por ID
	 * @author Daniel Custódio
	 * @url GET /TipoTarefa/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getTipoTarefaDAO()->load($id);
                
		formatJson($result);
	});