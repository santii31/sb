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
        
        public function sendEmail($check, $title, $msg) {

            if (sizeof($check) > 0) {
                if ( in_array("client", $check) ) {
                    echo 'cliente si <br>';
                }
                if ( in_array("client_p", $check) ) {
                    echo 'cliente potencial si <br>';
                }
                if ( in_array("admin", $check) ) {
                    echo 'admin si <br>';
                }

            }

        }

    }
    
?>
