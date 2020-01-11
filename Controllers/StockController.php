<?php

    namespace Controllers;    
    
    use Models\Product as Product;    
    use Controllers\AdminController as AdminController; 

    class StockController {
        
        private $adminController;
        
        public function __construct() {
            $this->adminController = new AdminController();
        }   

        public function listStockPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Stock";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "stock.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 
        
    }
    
?>
