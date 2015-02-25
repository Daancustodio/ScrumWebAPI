<?php

include_once '/../Models/IDao/DAOFactory.class.php';

	$rota = '/projeto';
	
	/**
	 * Deleta Projeto por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Projeto/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getProjetoDAO()->delete($id);
        });

	/**
 	 * Salva Projeto no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Projeto
	 * @url PUT /Projeto/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objProjeto =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objProjeto->id < 1 ){
                    $objProjeto->id = NULL;
                    DAOFactory::getProjetoDAO()->insert($objProjeto);
		} else {                    
                    DAOFactory::getProjetoDAO()->update($objProjeto);                    
		}

		formatJson($objProjeto);

	});
	
		
	/**
	 * Busca Todos os Projetos
	 * @author Daniel Custódio
	 * @url GET /Projeto	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getProjetoDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Projeto por ID
	 * @author Daniel Custódio
	 * @url GET /Projeto/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getProjetoDAO()->load($id);
                
		formatJson($result);
	});



