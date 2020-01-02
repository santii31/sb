<?php

    namespace Controllers;    
    
    use Models\Client as Client;
	use DAO\ClientDAO as ClientDAO;
    use Controllers\AdminController as AdminController; 

    class ClientController {

        private $clientDAO;
        private $adminController;

        public function __construct() {
            // $this->clientDAO = new ClientDAO();
            $this->adminController = new AdminController();
        }        
        
    }
    
?>
