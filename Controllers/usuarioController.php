<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/IDao/DAOFactory.class.php';

	$rota = '/usuario';
	
	/**
	 * Deleta Usuario por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Usuario/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getUsuarioDAO()->delete($id);
        });

	/**
 	 * Salva Usuario no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Usuario
	 * @url PUT /Usuario/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objUsuario =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objUsuario->id < 1 ){
                    $objUsuario->id = NULL;
                    DAOFactory::getUsuarioDAO()->insert($objUsuario);
		} else {                    
                    DAOFactory::getUsuarioDAO()->update($objUsuario);                    
		}

		formatJson($objUsuario);

	});
	
		
	/**
	 * Busca Todos os Usuarios
	 * @author Daniel Custódio
	 * @url GET /Usuario	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getUsuarioDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Usuario por ID
	 * @author Daniel Custódio
	 * @url GET /Usuario/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getUsuarioDAO()->load($id);
                
		formatJson($result);
	});