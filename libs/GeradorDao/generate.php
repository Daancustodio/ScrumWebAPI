<?php

require_once('templates/class/dao/sql/Connection.class.php');
require_once('templates/class/dao/sql/ConnectionFactory.class.php');
require_once('templates/class/dao/sql/ConnectionProperty.class.php');
require_once('templates/class/dao/sql/QueryExecutor.class.php');
require_once('templates/class/dao/sql/Transaction.class.php');
require_once('templates/class/dao/sql/SqlQuery.class.php');
require_once('templates/class/Template.php');
$data = Date('d/m/Y');
$autor = 'Daniel Custódio da Silva';

function generate(){
	init();
	$sql = 'SHOW TABLES';
	$ret = QueryExecutor::execute(new SqlQuery($sql));
	getnerateDomainObjects($ret);
	getnerateDAOObjects($ret);
	getnerateDAOExtObjects($ret);
	getnerateIDAOObjects($ret);
	getnerateRestControllers($ret);
	createIncludeFile($ret);
	createDAOFactory($ret);
	createRestFacade($ret);
}

function init(){
	@mkdir("generated");
	@mkdir("generated/class");
	@mkdir("generated/class/Dto");
	@mkdir("generated/class/Dao");
	@mkdir("generated/class/Dao/ext");
	@mkdir("generated/class/IDao");
	@mkdir("generated/class/core");
	@mkdir("generated/class/rest");
	@mkdir("generated/class/QueryObject")/
	//copyr('templates/class/dao/sql/Connection.class.php', 'generated/class/sql/Connection.class.php');
	//copy('templates/class/dao/sql/ConnectionFactory.class.php', 'generated/class/sql/ConnectionFactory.class.php');
	//copy('templates/class/dao/sql/ConnectionProperty.class.php', 'generated/class/sql/ConnectionProperty.class.php');
	//copy('templates/class/dao/sql/QueryExecutor.class.php', 'generated/class/sql/QueryExecutor.class.php');
	//copy('templates/class/dao/sql/Transaction.class.php', 'generated/class/sql/Transaction.class.php');
	//copy('templates/class/dao/sql/SqlQuery.class.php', 'generated/class/sql/SqlQuery.class.php');
	//copy('templates/class/dao/core/ArrayList.class.php', 'generated/class/core/ArrayList.class.php');
	copyr('templates/class/dao/QueryObject','generated/class/QueryObject');
}

function createIncludeFile($ret){
	$str ="\n";
	for($i=0;$i<count($ret);$i++){
		$tableName = $ret[$i][0];
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$clazzName = getClazzName($tableName);
		$str .= "\trequire_once('Models/IDao/".$clazzName."DAO.class.php');\n";
		$str .= "\trequire_once('Models/Dto/".getDTOName($clazzName).".class.php');\n";
		$str .= "\trequire_once('Models/Dao/".$clazzName."DAO.class.php');\n";
		$str .= "\trequire_once('Models/Dao/ext/".$clazzName."ExtDAO.class.php');\n";
		$str .= "\trequire_once('Models/rest/".$clazzName."Controller.class.php');\n";
	}
	$template = new Template('templates/include_dao.tpl');
	$template->set('include', $str);
	$template->set('date', Date('d/m/Y'));
	$template->set('autor', 'Daniel Custódio da Silva');
	$template->write('generated/includeModels.php');
}

function doesTableContainPK($row){
	$row = getFields($row[0]);
	for($j=0;$j<count($row);$j++){
		if($row[$j][3]=='PRI'){
			return true;
		}
	}
	return false;
}

function createDAOFactory($ret){
	$str ="\n";
	$includes = PHP_EOL;
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName);
		$str .= "\t/**\n";
		$str .= "\t * @return ".$clazzName."DAO\n";
		$str .= "\t */\n";
		$str .= "\tpublic static function get".$clazzName."DAO(){\n";
		$str .= "\t\treturn new ".$clazzName."ExtDAO();\n";
		$str .= "\t}\n\n";
		$includes .= "include_once '/../Dao/ext/".$clazzName."ExtDAO.class.php';".PHP_EOL;
	}
	$template = new Template('templates/DAOFactory.tpl');
	$template->set('content', $str);
	$template->set('date', Date('d/m/Y'));
	$template->set('autor', 'Daniel Custódio da Silva');
	$template->set('campos_include',$includes);
	$template->write('generated/class/IDao/DAOFactory.class.php');
}

function createRestFacade($ret){
	$str = "";
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName);
		$str .= "\t\t".'$restserver'."->addClass('$clazzName"."Controller', '/dao');\n";
	}
	$template = new Template('templates/RestDAOFacade.tpl');
	$template->set('content', $str);
	$template->write('generated/class/IDao/RestDAOFacade.class.php');
}

/**
 * Enter description here...
 *
 * @param unknown_type $ret
 * @return
 */
function getnerateDomainObjects($ret){
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName);
		if($clazzName[strlen($clazzName)-1]=='s'){
			$clazzName = substr($clazzName, 0, strlen($clazzName)-1);
		}
		$template = new Template('templates/Domain.tpl');
		$template->set('domain_class_name', $clazzName);
		$template->set('table_name', $tableName);
		$tab = getFields($tableName);
		$fields = "\r\n";
		for($j=0;$j<count($tab);$j++){
			$fields .= "\tpublic $".getVarNameWithS($tab[$j][0]).";\n\r";
		}
		//Editado Daniel
		
		for($j=0;$j<count($tab);$j++){
			//Gera métodos get
			$fields .= "\r\n";
			$fields .= "\tpublic function get".ucwords(getVarNameWithS($tab[$j][0]))."() {".PHP_EOL;
			$fields .= '		return $this->'.getVarNameWithS($tab[$j][0]).";".PHP_EOL;
			$fields .= "	}\n\r";
			
			//Gera métodos set
			$fields .= "\tpublic function set".ucwords(getVarNameWithS($tab[$j][0])).'($'.getVarNameWithS($tab[$j][0]).") {".PHP_EOL;
			$fields .= '		$this->'.getVarNameWithS($tab[$j][0])." = $".getVarNameWithS($tab[$j][0]).";".PHP_EOL;
			$fields .= "	}";			
		}
		// fim
		$template->set('variables', $fields);
		$template->set('date', Date('d/m/Y'));
		$template->set('autor', 'Daniel Custódio da Silva');
		$template->write('generated/class/Dto/'.$clazzName.'.class.php');
	}
}

function getnerateDAOExtObjects($ret){
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName).'Ext';
		$clazzNameSup = getClazzName($tableName);
		$template = new Template('templates/DAOExt.tpl');
		$template->set('dao_clazz_sup_name', $clazzNameSup );
		$template->set('dao_clazz_name', $clazzName );
		$template->set('domain_clazz_name', getDTOName($tableName) );
		$template->set('idao_clazz_name', getClazzName($tableName));
		$template->set('table_name', $tableName);
		$template->set('var_name', getVarName($tableName));
		$tab = getFields($tableName);
		$parameterSetter = "\n";
		$insertFields = "";
		$updateFields = "";
		$questionMarks = "";
		$readRow = "\n";
		$pk = '';
		$queryByField = '';
		$deleteByField = '';
		for($j=0;$j<count($tab);$j++){
			if($tab[$j][3]=='PRI'){
				$pk = $tab[$j][0];
			}else{
				$insertFields .= $tab[$j][0].", ";
				$updateFields .= $tab[$j][0]." = ?, ";
				$questionMarks .= "?, ";
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter .= "\t\t\$sqlQuery->setNumber($".getVarName($tableName)."->get".ucwords(getVarNameWithS($tab[$j][0])).");\n";
				}else{
					$parameterSetter .= "\t\t\$sqlQuery->set($".getVarName($tableName)."->get".ucwords(getVarNameWithS($tab[$j][0])).");\n";
				}
				$parameterSetter2 = '';
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter2 .= "Number";
				}
				$queryByField .= "	public function queryBy".getClazzName($tab[$j][0])."(\$value){
		\$sql = 'SELECT * FROM ".$tableName." WHERE foiExcluido = FALSE AND ".$tab[$j][0]." = ?';
		\$sqlQuery = new SqlQuery(\$sql);
		\$sqlQuery->set".$parameterSetter2."(\$value);
		return \$this->getList(\$sqlQuery);
	}\n\n";
				$deleteByField .= "	public function deleteBy".getClazzName($tab[$j][0])."(\$value){
		\$sql = 'UPDATE ".$tableName." SET foiExcluido = TRUE, dataExclusao=unix_timestamp(now()) WHERE ".$tab[$j][0]." = ? AND foiExcluido = FALSE';
		\$sqlQuery = new SqlQuery(\$sql);
		\$sqlQuery->set".$parameterSetter2."(\$value);
		return \$this->executeUpdate(\$sqlQuery);
	}\n\n";
			}
			$readRow .= "\t\t\$".getVarName($tableName).'->set'.ucwords(getVarNameWithS($tab[$j][0]))." = \$row['".$tab[$j][0]."'];\n";
		}
		if($pk==''){
			continue;
		}
		$insertFields = substr($insertFields,0, strlen($insertFields)-2);
		$updateFields = substr($updateFields,0, strlen($updateFields)-2);
		$questionMarks = substr($questionMarks,0, strlen($questionMarks)-2);
		$template->set('pk', $pk);
		$template->set('pk_php', getVarNameWithS($pk));		
		$template->set('insert_fields', $insertFields);
		$template->set('read_row', $readRow);
		$template->set('update_fields', $updateFields);
		$template->set('question_marks', $questionMarks);
		$template->set('parameter_setter',$parameterSetter);
		$template->set('read_row',$readRow);
		$template->set('date', Date('d/m/Y'));
		$template->set('autor', 'Daniel Custódio da Silva');
		$template->set('queryByFieldFunctions',$queryByField);		
		$template->set('deleteByFieldFunctions',$deleteByField);	
		$file = 'generated/class/Dao/ext/'.$clazzName.'DAO.class.php';
		if(!file_exists($file)){
			$template->write('generated/class/Dao/ext/'.$clazzName.'DAO.class.php');
		}
	}
}

// TODO: There are lots of redundant lines, should be cleaned
function getnerateRestControllers($ret){
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName).'MySql';

		$tab = getFields($tableName);
		$parameterSetter = "\n";
		$insertFields = "";
		$updateFields = "";
		$questionMarks = "";
		$readRow = "\n";
		$pk = '';
		$pks = array();
		$queryByField = '';
		$queryByFieldControls = '';
		$deleteByField = '';
		$pk_type='';
		for($j=0;$j<count($tab);$j++){
			if($tab[$j][3]=='PRI' || $tab[$j][0]=='id'){
				$pk = $tab[$j][0];
				$c = count($pks);
				$pks[$c] = $tab[$j][0];
				$pk_type = $tab[$j][1];
			}else{
				$insertFields .= $tab[$j][0].", ";
				$updateFields .= $tab[$j][0]." = ?, ";
				$questionMarks .= "?, ";
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter .= "\t\t\$sqlQuery->setNumber($".getVarName($tableName)."->".getVarNameWithS($tab[$j][0]).");\n";
				}else{
					$parameterSetter .= "\t\t\$sqlQuery->set($".getVarName($tableName)."->".getVarNameWithS($tab[$j][0]).");\n";
				}
				$parameterSetter2 = '';
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter2 .= "Number";
				}
				$queryByFieldControls .= 'if (isset($_GET["'.getVarNameWithS($tab[$j][0]).'"])) $arr = DAOFactory::get'.getClazzName($tableName).'DAO()->queryBy'.getClazzName($tab[$j][0]).'($_GET["'.getVarNameWithS($tab[$j][0]).'"]);
		else ';
			}
			$readRow .= "\t\t\$".getVarName($tableName)."->".getVarNameWithS($tab[$j][0])." = \$row['".$tab[$j][0]."'];\n";
		}
		if($pk==''){
			continue;
		}
		if(count($pks)==1){
			$template = new Template('templates/RestController.tpl');
			echo '$pk_type '.$pk_type.'<br/>'."\n";
			if(isColumnTypeNumber($pk_type)){
				$template->set('pk_number', 'Number');
			}else{
				$template->set('pk_number', '');
			}
		}else{			
			//Throw new Exception("Cannot have more than one PK"); 
			continue;
		}
		$template->set('dao_clazz_name', $clazzName );
		$template->set('domain_clazz_name', getDTOName($tableName) );
		$template->set('idao_clazz_name', getClazzName($tableName));
		$template->set('table_name', $tableName);
		$template->set('var_name', getVarName($tableName));
		
		$insertFields = substr($insertFields,0, strlen($insertFields)-2);
		$updateFields = substr($updateFields,0, strlen($updateFields)-2);
		$questionMarks = substr($questionMarks,0, strlen($questionMarks)-2);
		$template->set('pk', $pk);
		$s = '';
		$s2 = '';
		$s3 = '';
		$s4 = '';
		$insertFields2 = $insertFields;
		$questionMarks2 = $questionMarks;
		for($z=0;$z<count($pks);$z++){
			$questionMarks2.=', ?';			
			if($z>0){
				$s.=', ';								
				$s2.=' AND ';
				$s3.= "\t\t";
			}			
			$insertFields2.=', '.$pks[$z];
			$s .= '$'.getVarNameWithS($pks[$z]);
			$s2 .= $pks[$z].' = ? ';
			$s3 .= '$sqlQuery->setNumber($'.getVarNameWithS($pks[$z]).');';			
			$s3 .= "\n";
			$s4 .= "\n\t\t";
			$s4 .= '$sqlQuery->setNumber($'.getVarName($tableName).'->'.getVarNameWithS($pks[$z]).');';
			$s4 .= "\n";
		}
		if($s[0]==',')$s = substr($s,1);
		if($questionMarks2[0]==',')$questionMarks2= substr($questionMarks2,1);
		if($insertFields2[0]==',')$insertFields2= substr($insertFields2,1);
		$template->set('question_marks2', $questionMarks2);
		$template->set('insert_fields2', $insertFields2);
		$template->set('pk_set_update', $s4);
		$template->set('pk_set', $s3);		
		$template->set('pk_where', $s2);
		$template->set('pks', $s);
		$template->set('pk_php', getVarNameWithS($pk));		
		$template->set('insert_fields', $insertFields);
		$template->set('read_row', $readRow);
		$template->set('update_fields', $updateFields);
		$template->set('question_marks', $questionMarks);
		$template->set('parameter_setter',$parameterSetter);
		$template->set('read_row',$readRow);
		$template->set('date', date("Y-m-d H:i"));
		$template->set('queryByFieldControls',$queryByFieldControls);		
		$template->write('generated/class/rest/'.getClazzName($tableName).'Controller.class.php');
	}
}

function getnerateDAOObjects($ret){
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName);

		$tab = getFields($tableName);
		$parameterSetter = "\n";
		$insertFields = "";
		$updateFields = "";
		$questionMarks = "";
		$readRow = "\n";
		$pk = '';
		$pks = array();
		$queryByField = '';
		$deleteByField = '';
		$pk_type='';
		for($j=0;$j<count($tab);$j++){
			if($tab[$j][3]=='PRI'){
				$pk = $tab[$j][0];
				$c = count($pks);
				$pks[$c] = $tab[$j][0];
				$pk_type = $tab[$j][1];
			}else{
				$insertFields .= $tab[$j][0].", ";
				$updateFields .= $tab[$j][0]." = ?, ";
				$questionMarks .= "?, ";
				$parameterSetter .= "\t\t\$sql->addColunaValor('" . $tab[$j][0]."', $".getVarName($tableName)."->".getVarNameWithS($tab[$j][0]).");\n";
				$parameterSetter2 = '';
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter2 .= "Number";
				}
				$queryByField .= "	public function queryBy".getClazzName($tab[$j][0])."(\$value){
		\$sql = 'SELECT * FROM ".$tableName." WHERE foiExcluido = FALSE AND ".$tab[$j][0]." = ?';
		\$sqlQuery = new SqlQuery(\$sql);
		\$sqlQuery->set".$parameterSetter2."(\$value);
		return \$this->getList(\$sqlQuery);
	}\n\n";
				$deleteByField .= "	public function deleteBy".getClazzName($tab[$j][0])."(\$value){
		\$sql = 'UPDATE ".$tableName." SET foiExcluido = TRUE, dataExclusao=unix_timestamp(now()) WHERE ".$tab[$j][0]." = ? AND foiExcluido = FALSE';
		\$sqlQuery = new SqlQuery(\$sql);
		\$sqlQuery->set".$parameterSetter2."(\$value);
		return \$this->executeUpdate(\$sqlQuery);
	}\n\n";
			}//Editado daniel custodio
			//$readRow .= "\t\t\$".getVarName($tableName).'->set'.ucwords(getVarNameWithS($tab[$j][0]))."(\$row['".$tab[$j][0]."']);\n";
			
			$readRow .= "\t\t\$".getVarName($tableName)."->".getVarNameWithS($tab[$j][0])." = \$row->".$tab[$j][0].";\n";
			//fim edição
		}
		if($pk==''){
			continue;
		}
		if(count($pks)==1){
			$template = new Template('templates/DAO.tpl');
			echo '$pk_type '.$pk_type.'<br/>';
			if(isColumnTypeNumber($pk_type)){
				$template->set('pk_number', 'Number');
			}else{
				$template->set('pk_number', '');
			}
		}else{			
			$template = new Template('templates/DAO_with_complex_pk.tpl');
		}
		$template->set('dao_clazz_name', $clazzName );
		$template->set('domain_clazz_name', getDTOName($tableName) );
		$template->set('idao_clazz_name', getClazzName($tableName));
		$template->set('table_name', $tableName);
		$template->set('var_name', getVarName($tableName));
		//daniel
		$template->set('date', Date('d/m/Y'));
		$template->set('autor', 'Daniel Custódio da Silva');
		//fim
		$insertFields = substr($insertFields,0, strlen($insertFields)-2);
		$updateFields = substr($updateFields,0, strlen($updateFields)-2);
		$questionMarks = substr($questionMarks,0, strlen($questionMarks)-2);
		$template->set('pk', $pk);
		$s = '';
		$s2 = '';
		$s3 = '';
		$s4 = '';
		$insertFields2 = $insertFields;
		$questionMarks2 = $questionMarks;
		for($z=0;$z<count($pks);$z++){
			$questionMarks2.=', ?';			
			if($z>0){
				$s.=', ';								
				$s2.=' AND ';
				$s3.= "\t\t";
			}			
			$insertFields2.=', '.$pks[$z];
			$s .= '$'.getVarNameWithS($pks[$z]);
			$s2 .= $pks[$z].' = ? ';
			$s3 .= '$filtros[] = new Filtro(\''.$pks[$z].'\', Operador::OIGUAL,$'.getVarNameWithS($pks[$z]).');';			
			$s3 .= "\n";
			$s4 .= "\n\t\t";
			$s4 .= '$valores[] = $'.getVarName($tableName).'->get'.ucwords(getVarNameWithS($pks[$z])).'();';
			//$s4 .= "\n";
		}
		if($s[0]==',')$s = substr($s,1);
		if($questionMarks2[0]==',')$questionMarks2= substr($questionMarks2,1);
		if($insertFields2[0]==',')$insertFields2= substr($insertFields2,1);
		$template->set('question_marks2', $questionMarks2);
		$template->set('insert_fields2', $insertFields2);
		$template->set('pk_set_update', $s4);
		$template->set('pk_set', $s3);		
		$template->set('pk_where', $s2);
		$template->set('pks', $s);
		$template->set('pk_php', ucwords(getVarNameWithS($pk)));		
		$template->set('insert_fields', $insertFields);
		$template->set('read_row', $readRow);
		$template->set('update_fields', $updateFields);
		$template->set('question_marks', $questionMarks);
		$template->set('parameter_setter',$parameterSetter);
		$template->set('read_row',$readRow);
		$template->set('queryByFieldFunctions',$queryByField);		
		$template->set('deleteByFieldFunctions',$deleteByField);	
		$template->write('generated/class/Dao/'.$clazzName.'DAO.class.php');
	}
}

function isColumnTypeNumber($columnType){
	echo $columnType.'<br/>';
	if(strtolower(substr($columnType,0,3))=='int' || strtolower(substr($columnType,0,7))=='tinyint'){
		return true;
	}
	return false;
}

function getnerateIDAOObjects($ret){
	for($i=0;$i<count($ret);$i++){
		if(!doesTableContainPK($ret[$i])){
			continue;
		}
		$tableName = $ret[$i][0];
		$clazzName = getClazzName($tableName);
		$tab = getFields($tableName);
		$parameterSetter = "\n";
		$insertFields = "";
		$updateFields = "";
		$questionMarks = "";
		$readRow = "\n";
		$pk = '';
		$pks = array();
		$queryByField = '';
		$deleteByField = '';
		for($j=0;$j<count($tab);$j++){
			if($tab[$j][3]=='PRI'){
				$pk = $tab[$j][0];
				$c = count($pks);
				$pks[$c] = $tab[$j][0];
			}else{
				$insertFields .= $tab[$j][0].", ";
				$updateFields .= $tab[$j][0]." = ?, ";
				$questionMarks .= "?, ";
				if(isColumnTypeNumber($tab[$j][1])){
					$parameterSetter .= "\t\t\$sqlQuery->setNumber($".getVarName($tableName)."->".getVarNameWithS($tab[$j][0]).");\n";
				}else{
					$parameterSetter .= "\t\t".'$sqlQuery->set($'.getVarName($tab[$j][0]).');'."\n";
				}
				$queryByField .= "\tpublic function queryBy".getClazzName($tab[$j][0])."(\$value);\n\n";
				$deleteByField .= "\tpublic function deleteBy".getClazzName($tab[$j][0])."(\$value);\n\n";
			}
			$readRow .= "\t\t\$".getVarName($tableName)."->".getVarNameWithS($tab[$j][0])." = \$row['".$tab[$j][0]."'];\n";
		}
		if($pk==''){
			continue;
		}
		
		if(count($pks)==1){
			$template = new Template('templates/IDAO.tpl');
		}else{			
			$template = new Template('templates/IDAO_with_complex_pk.tpl');
		}
		
		$template->set('dao_clazz_name', $clazzName );
		$template->set('table_name', $tableName);
		$template->set('var_name', getVarName($tableName));
		$template->set('date', Date('d/m/Y'));
		$template->set('autor', 'Daniel Custódio da Silva');
		$s = '';
		$s2 = '';
		$s3 = '';
		$s4 = '';
		$insertFields2 = $insertFields;
		$questionMarks2 = $questionMarks;
		for($z=0;$z<count($pks);$z++){
			$questionMarks2.=', ?';			
			if($z>0){
				$s.=', ';								
				$s2.=' AND ';
				$s3.= "\t\t";
			}			
			$insertFields2.=', '.getVarNameWithS($pks[$z]);
			$s .= '$'.getVarNameWithS($pks[$z]);
			$s2 .= getVarNameWithS($pks[$z]).' = ? ';
			$s3 .= '$sqlQuery->setNumber('.getVarName($pks[$z]).');';			
			$s3 .= "\n";
			$s4 .= "\n\t\t";
			$s4 .= '$sqlQuery->setNumber($'.getVarName($tableName).'->'.getVarNameWithS($pks[$z]).');';
			$s4 .= "\n";
		}
		$template->set('question_marks2', $questionMarks2);
		$template->set('insert_fields2', $insertFields2);
		$template->set('pk_set_update', $s4);
		$template->set('pk_set', $s3);		
		$template->set('pk_where', $s2);
		$template->set('pks', $s);
		
		$insertFields = substr($insertFields,0, strlen($insertFields)-2);
		$updateFields = substr($updateFields,0, strlen($updateFields)-2);
		$questionMarks = substr($questionMarks,0, strlen($questionMarks)-2);
		$template->set('pk', $pk);
		$template->set('insert_fields', $insertFields);
		$template->set('read_row', $readRow);
		$template->set('update_fields', $updateFields);
		$template->set('question_marks', $questionMarks);
		$template->set('parameter_setter',$parameterSetter);
		$template->set('read_row',$readRow);
		$template->set('queryByFieldFunctions',$queryByField);
		$template->set('deleteByFieldFunctions',$deleteByField);		
		$template->write('generated/class/IDao/I'.$clazzName.'DAO.class.php');
	}
}


function getFields($table){
	$sql = 'DESC '.$table;
	$rettab = array();
	$r=0;
	$origtab = QueryExecutor::execute(new SqlQuery($sql));
	for($i=0;$i<count($origtab);$i++) {
		$fieldname = $origtab[$i][0];
		$row = $origtab[$i];
		switch ($fieldname) {
			case 'rid': break;
			case 'foiExcluido': break;
			case 'dataCriacao': break;
			case 'dataExclusao': break;
			default: $rettab[$r++] = $row; break;
		}
	}

	return $rettab;
}


function getClazzName($tableName){
	$tableName = strtoupper($tableName[0]).substr($tableName,1);
	for($i=0;$i<strlen($tableName);$i++){
		if($tableName[$i]=='_'){
			$tableName = substr($tableName, 0, $i).strtoupper($tableName[$i+1]).substr($tableName, $i+2);
		}
	}
	return $tableName;
}

function getDTOName($tableName){
	$name = getClazzName($tableName);
	if($name[strlen($name)-1]=='s'){
		$name = substr($name, 0, strlen($name)-1);
	}
	return $name;
}

function getVarName($tableName){
	$tableName = strtolower($tableName[0]).substr($tableName,1);
	for($i=0;$i<strlen($tableName);$i++){
		if($tableName[$i]=='_'){
			$tableName = substr($tableName, 0, $i).strtoupper($tableName[$i+1]).substr($tableName, $i+2);
		}
	}
	if($tableName[strlen($tableName)-1]=='s'){
		$tableName = substr($tableName, 0, strlen($tableName)-1);
	}
	return $tableName;
}


function getVarNameWithS($tableName){
	$tableName = strtolower($tableName[0]).substr($tableName,1);
	for($i=0;$i<strlen($tableName);$i++){
		if($tableName[$i]=='_'){
			$tableName = substr($tableName, 0, $i).strtoupper($tableName[$i+1]).substr($tableName, $i+2);
		}
	}
	//if($tableName[strlen($tableName)-1]=='s'){
	//	$tableName = substr($tableName, 0, strlen($tableName)-1);
	//}
	return $tableName;
}

/*
* Copiar todos os arquivos e subdiretórios dentro de um diretório
*
* @Autor: Aidan Lister <aidan ARROBA php.net>
* @Tradução: Tiago Passos <voxtiago ARROBA gmail.com>
* @versão 1.0.1
* @parâmetro de origem: $source
* @parâmetro de destino: $dest
* @retorna TRUE se houver sucesso e FALSE se houver erro
* @Exemplo de uso: copyr("site","backup_site");
*/

function copyr($source, $dest)
{
   // COPIA UM ARQUIVO
   if (is_file($source)) {
      return copy($source, $dest);
   }

   // CRIA O DIRETÓRIO DE DESTINO
   if (!is_dir($dest)) {
      mkdir($dest);
      echo "DIRET&Oacute;RIO $dest CRIADO<br />";
   }

   // FAZ LOOP DENTRO DA PASTA
   $dir = dir($source);
   while (false !== $entry = $dir->read()) {
      // PULA "." e ".."
      if ($entry == '.' || $entry == '..') {
         continue;
      }

      // COPIA TUDO DENTRO DOS DIRETÓRIOS
      if ($dest !== "$source/$entry") {
         copyr("$source/$entry", "$dest/$entry");
         echo "COPIANDO $entry de $source para $dest <br />";
      }
   }

   $dir->close();
   return true;

}
generate();



?>