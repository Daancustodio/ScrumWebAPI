<?php

/**
 * RestFacade
 * @author: http://github.com/hkerem/JournaledPHPDAO/
 * @date: ${date}
 */
class RestDAOFacade {
        public static function register($restserver)
        {
				$restserver->addClass('EstoriaController', '/dao');
		$restserver->addClass('PapelController', '/dao');
		$restserver->addClass('ProjetoController', '/dao');
		$restserver->addClass('SprintController', '/dao');
		$restserver->addClass('TarefaController', '/dao');
		$restserver->addClass('TimeController', '/dao');
		$restserver->addClass('TipotarefaController', '/dao');
		$restserver->addClass('UsuarioController', '/dao');
		$restserver->addClass('UsuariopapeltimeController', '/dao');

        }
}
?>
