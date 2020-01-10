<?php

    namespace Controllers;    
    
    use Models\Stock as Stock;
    use DAO\StockDAO as StockDAO; 
    use Controllers\AdminController as AdminController; 

    class StockController {

        // private $stockDAO;
        private $adminController;
        
        public function __construct() {
            // $this->stockDAO = new StockDAO();
            $this->adminController = new AdminController();
        }   


        public function listStockPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Stock";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                // require_once(VIEWS_PATH . "list-providers.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 
        
    }
    
?>
