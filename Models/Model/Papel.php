<?php

include_once '/../Models/IDao/DAOFactory.class.php';
include_once '/../Models/Dto/Papel.class.php';


	function load($id){
		$transaction = new Transaction();
		$object = DAOFactory::getPapelDAO()->load($id);
		$transaction->commit();
		return $object;
	}

	/**
	 * Delete Domain object by primary key
	 *
	 * @noAuth
	 * @url DELETE /Papel/$id
	 */
	function delete($id){
		$transaction = new Transaction();
		$ret = DAOFactory::getPapelDAO()->delete($id);
		$transaction->commit();
		return $ret;
	}

	/**
 	 * Save object to database
 	 *
	 * @noAuth
	 * @url POST /Papel
	 * @url PUT /Papel/$id
 	 */
	 
	function save($data,$id = null){
		
		$objPapel = new Papel();
		$objPapel->setPapel($data);               
                
		if ($id == null) {                        
                    DAOFactory::getPapelDAO()->insert($objPapel);
                        
		} else {
			$objPapel->id = $id;
			DAOFactory::getPapelDAO()->update($objPapel);
		}
		
		return $objPapel;
	}

	
	function listAll($idUser = null)	{
		$dao = new PapelDAO();
		$result = $dao->queryAll($idUser);
		var_dump($result);
	}	
	
	$app->get('/papel', 'listAll');
	
	$app->get('/papel/:id', function($id){
		$dao = new PapelDAO();
		$result = $dao->load($id);
		var_dump($result);
	});


?>
