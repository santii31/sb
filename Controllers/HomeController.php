<?php

    namespace Controllers;    

    class HomeController {

        public function Index() {            
            $title = 'Bienvenido!';			
            require_once(VIEWS_PATH . "index.php");                         
        }
        
    }
    
?>
