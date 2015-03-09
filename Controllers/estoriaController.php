<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/estoria';
	
	/**
	 * Deleta Estoria por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Estoria/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getEstoriaDAO()->delete($id);
        });

	/**
 	 * Salva Estoria no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Estoria
	 * @url PUT /Estoria/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objEstoria =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objEstoria->id < 1 ){
                    $objEstoria->id = NULL;
                    DAOFactory::getEstoriaDAO()->insert($objEstoria);
		} else {                    
                    DAOFactory::getEstoriaDAO()->update($objEstoria);                    
		}

		formatJson($objEstoria);

	});
	
		
	/**
	 * Busca Todos os Estorias
	 * @author Daniel Custódio
	 * @url GET /Estoria	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getEstoriaDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	
	/**
	 * Busca Estoria por ID
	 * @author Daniel Custódio
	 * @url GET /Estoria/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getEstoriaDAO()->load($id);
                
		formatJson($result);
	});

	$app->get('/estoriasBySprint/:id', function($id){		
		
		$result = DAOFactory::getEstoriaDAO()->loadBySprint($id);
                
		formatJson($result);
	});