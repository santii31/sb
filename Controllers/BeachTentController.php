<?php

    namespace Controllers;    

    class BeachTentController {
        
        public function addReservePath() {            
            $title = 'Añadir reserva';			
            require_once(VIEWS_PATH . "head.php");                         
            require_once(VIEWS_PATH . "sidenav.php");                         
            require_once(VIEWS_PATH . "add-reserve.php");      
            require_once(VIEWS_PATH . "footer.php");    
        }

    }
    
?>
