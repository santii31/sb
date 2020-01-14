<?php

    namespace Controllers;    

    use Controllers\AdminController as AdminController;

    class HomeController {

        private $adminController;

        public function __construct() {        
            // $this->adminController = new AdminController();
        }

        
        public function Index($alert = "") {        
            if (!$this->ValidateLoggedAdmin()) {    
                $title = 'Bienvenido!';			
                require_once(VIEWS_PATH . "index.php");                         
            } else {
                header("Location: ". FRONT_ROOT ."admin/dashboard");
            }
        }

        private function ValidateLoggedAdmin(){
            $loggedAdmin = false;

            if(isset($_SESSION["loggedAdmin"]))
                $loggedAdmin = true;

            return $loggedAdmin;
        }
        
    }
    
?>
