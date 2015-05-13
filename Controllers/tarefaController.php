<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/Models/IDao/DAOFactory.class.php';

	$rota = '/tarefa';
	
	/**
	 * Deleta Tarefa por chave primaria
	 *
	 * @author Daniel Custódio
	 * @url DELETE /Tarefa/$id
	 */
	$app->delete($rota . "/:id",function ($id){
            DAOFactory::getTarefaDAO()->delete($id);
        });

	/**
 	 * Salva Tarefa no banco
 	 *
	 * @author Daniel Custódio
	 * @url POST /Tarefa
	 * @url PUT /Tarefa/$id
 	 */	 
	$app->post($rota . "/", function (){

		$objTarefa =json_decode(\Slim\Slim::getInstance()->request()->getBody());
		
		if ($objTarefa->id < 1 ){
                    $objTarefa->id = NULL;
                    DAOFactory::getTarefaDAO()->insert($objTarefa);
		} else {                    
                    DAOFactory::getTarefaDAO()->update($objTarefa);                    
		}

		formatJson($objTarefa);

	});
	
		
	/**
	 * Busca Todos os Tarefas
	 * @author Daniel Custódio
	 * @url GET /Tarefa	 
	 */
	$app->get($rota, function($idUser = null){
		
		$result = DAOFactory::getTarefaDAO()->queryAllOrderBy(' id desc ',$idUser);
		
		formatJson($result);
	});
	
	/**
	 * Busca Tarefa por ID
	 * @author Daniel Custódio
	 * @url GET /Tarefa/:id
	 */
	$app->get($rota . '/:id', function($id){		
		
		$result = DAOFactory::getTarefaDAO()->load($id);
                
		formatJson($result);
	});

	$app->get('/tarefasByEstoria/:id', function($idEstoria){		
		
		$result = DAOFactory::getTarefaDAO()->loadByEstoria($idEstoria);
		formatJson($result);
	});

	



