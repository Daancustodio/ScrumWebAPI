<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/usuariopapeltime';
	
	/**
	 * Deleta Usuariopapeltime por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Usuariopapeltime/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getUsuariopapeltimeDAO()->delete($id);
        });

	/**
 	 * Salva Usuariopapeltime no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Usuariopapeltime
	 * @url PUT /Usuariopapeltime/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objUsuariopapeltime =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objUsuariopapeltime->id < 1 ){
                    $objUsuariopapeltime->id = NULL;
                    DAOFactory::getUsuariopapeltimeDAO()->insert($objUsuariopapeltime);
		} else {                    
                    DAOFactory::getUsuariopapeltimeDAO()->update($objUsuariopapeltime);                    
		}

		formatJson($objUsuariopapeltime);

	});
	
		
	/**
	 * Busca Todos os Usuariopapeltimes
	 * @author Daniel Custódio
	 * @url GET /Usuariopapeltime	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getUsuariopapeltimeDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Usuariopapeltime por ID
	 * @author Daniel Custódio
	 * @url GET /Usuariopapeltime/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getUsuariopapeltimeDAO()->load($id);
                
		formatJson($result);
	});

	



