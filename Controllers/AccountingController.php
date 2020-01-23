<?php

    namespace Controllers;    
    
    use Controllers\AdminController as AdminController; 

    class AccountingController {

        private $adminController;        

        public function __construct() {            
            $this->adminController = new AdminController();
        }       
        

        public function diary() {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Contabilidad - Caja diaria";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "accounting-diary.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
    }
    
?>
