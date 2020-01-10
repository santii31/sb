<?php

    namespace Controllers;    
        
    use Controllers\AdminController as AdminController; 

    class EmailController {
        
        private $adminController;
        
        public function __construct() {
            
            $this->adminController = new AdminController();
        }   

        public function send($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Correo - Enviar";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "send-email.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 
        
        public function sendEmail($title, $msg, $client = "", $client_p = "", $admin = "") {

            echo '<pre>';
            var_dump( '$title - ' . $title);
            var_dump( '$msg - ' . $msg);
            var_dump('$client - ' . $client);
            var_dump('$client_p - ' . $client_p);
            var_dump('$admin - ' . $admin);
            echo '</pre>';

        }

    }
    
?>
