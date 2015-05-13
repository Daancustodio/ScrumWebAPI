<?php
$pathh = $_SERVER['DOCUMENT_ROOT'] . '/Models/IDao/DAOFactory.class.php';

include_once ($pathh);

	$rota = '/time';
	
	/**
	 * Deleta Time por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Time/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getTimeDAO()->delete($id);
        });

	/**
 	 * Salva Time no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Time
	 * @url PUT /Time/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objTime =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objTime->id < 1 ){
                    $objTime->id = NULL;
                    DAOFactory::getTimeDAO()->insert($objTime);
		} else {                    
                    DAOFactory::getTimeDAO()->update($objTime);                    
		}

		formatJson($objTime);

	});
	
		
	/**
	 * Busca Todos os Times
	 * @author Daniel Custódio
	 * @url GET /Time	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getTimeDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Time por ID
	 * @author Daniel Custódio
	 * @url GET /Time/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getTimeDAO()->load($id);
                
		formatJson($result);
	});



