<?php

    namespace Controllers;    
    
    use Models\Balance as Balance;
	use DAO\BalanceDAO as BalanceDAO;   
    use Controllers\AdminController as AdminController; 

    class BalanceController {

        private $adminController;        
        private $balanceDAO;        

        public function __construct() {            
            $this->adminController = new AdminController();
            $this->balanceDAO = new BalanceDAO();
        }       
        

        public function addBalancePath($reservation) {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Cliente - Saldo";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "balance.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
    }
    
?>
