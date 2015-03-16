<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/membroTime';
	
	/**
	 * Deleta Usuariopapeltime por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Usuariopapeltime/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getMembroTimeDAO()->delete($id);
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
                    DAOFactory::getMembroTimeDAO()->insert($objUsuariopapeltime);
		} else {                    
                    DAOFactory::getMembroTimeDAO()->update($objUsuariopapeltime);                    
		}

		formatJson($objUsuariopapeltime);

	});
	
		
	/**
	 * Busca Todos os Usuariopapeltimes
	 * @author Daniel Custódio
	 * @url GET /Usuariopapeltime	 
	 */
	$app->get($rota, function($idUser = null){
		if($idUser == null){
			$idUser = 1;
		}
		$result = DAOFactory::getMembroTimeDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Usuariopapeltime por ID
	 * @author Daniel Custódio
	 * @url GET /Usuariopapeltime/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getMembroTimeDAO()->load($id);
                
		formatJson($result);
	});

	



