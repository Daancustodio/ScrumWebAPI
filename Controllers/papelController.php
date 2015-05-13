<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/IDao/DAOFactory.class.php';

	$rota = '/papel';
	
	/**
	 * Deleta Papel por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Papel/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getPapelDAO()->delete($id);
        });

	/**
 	 * Salva Papel no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Papel
	 * @url PUT /Papel/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objPapel =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objPapel->id < 1 ){
                    $objPapel->id = NULL;
                    DAOFactory::getPapelDAO()->insert($objPapel);
		} else {                    
                    DAOFactory::getPapelDAO()->update($objPapel);                    
		}

		formatJson($objPapel);

	});
	
		
	/**
	 * Busca Todos os Papels
	 * @author Daniel Custódio
	 * @url GET /Papel	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getPapelDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Papel por ID
	 * @author Daniel Custódio
	 * @url GET /Papel/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getPapelDAO()->load($id);
                
		formatJson($result);
	});



