
<?php 
    /**
    * Cria um Menu DropDown
    */

    class DropDronMenu
    {
        private $opcoes;
        private $menu;
        private $li = '';
        function __construct($action = "#", $titulo = null)
        {   
            $this->setMenu($action, $titulo);
        }

        function setMenu($action, $titulo){
            $opt = new StdClass();
            $opt->a = $action;
            $opt->t = $titulo;
            $this->opcoes[] = $opt;

            return $this;
        }
        
        function show(){
            $this->criaMenu();
            echo $this->menu;
        }

        function getMenu(){
            $this->criaMenu();
            return $this->menu;
        }

        private function criaMenu(){
            foreach ($this->opcoes as $value) {
                $this->li .= '<li><a href=' . $value->a . '>' . $value->t . '</a>';
            }

            $this->menu = '<div class="pull-left">
                <div class="btn-group">
                <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">Menu
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">' . $this->li . '</ul></div></div>';
        }
    };
    
    
    // class Opt
    // {
    //     $action;
    //     $titulo;
    //     function __construct($action = "#", $titulo = null)
    //     {   
    //         $this->setMenu($action, $titulo);
    //     }

    //     function setMenu($action, $titulo){
    //         $this->action = $action;
    //         $this->titulo = $titulo;

    //     }
    // }



?>


