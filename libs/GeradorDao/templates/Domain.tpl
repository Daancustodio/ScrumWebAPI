<?php
	/**
	 * Objeto representa a tabela '${table_name}'
	 *
     	 * @author: ${autor}
     	 * @Data: ${date}	 
	 */

class ${domain_class_name}{
${variables}
		
	/**
	* Serializa o array de chave valor para um objeto ${domain_class_name}
	*
	* @param: Array com chaves iguais aos nomes das propriedades da classe  ${domain_class_name}
	* @return: ${domain_class_name} 
	*/
	public function set${domain_class_name}(array $${table_name}){
       
		foreach ($${table_name} as $propriedade => $valor) {
			$setFunction = 'set' . ucfirst($propriedade);
			if (method_exists($this, $setFunction)){
				call_user_func(array($this, $setFunction),$valor );
			}
		}        
		return $this;
	}
}
