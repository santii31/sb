<?php

    namespace Controllers;    
    
    use Models\Client as Client;
	use DAO\ClientDAO as ClientDAO;
    use Controllers\AdminController as AdminController; 
    
    class ClientController {

        private $clientDAO;
        private $adminController;

        public function __construct() {
            $this->clientDAO = new ClientDAO();
            $this->adminController = new AdminController();
        }       
        

        private function add($name, $lastName, $email, $phone, $city, $address, $stay_address) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);
            $stay_address_s = filter_var($stay_address, FILTER_SANITIZE_STRING);

            $client = new Client();            
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($lastname_s) );
            $client->setEmail($email);
            $client->setPhone($phone);
            $client->setCity( strtolower($city_s) );
            $client->setAddress( strtolower($address_s) );
            $client->setStayAddress( strtolower($stay_address_s) );  
            $client->setIsPotential(FALSE);  
            
            $register_by = $this->adminController->isLogged();

            if ($this->clientDAO->add($client, $register_by)) {
                return true;
            } else {
                return false;
            }
        }     

        public function addClient($name, $lastName, $email, $phone, $city, $address, $stay_address) {
            if ($this->isFormRegisterNotEmpty($name, $lastName, $email, $phone, $city, $address, $stay_address)) {
                
                $clientTemp = new Client();
                $clientTemp->setEmail($email);                
                
                if ($this->clientDAO->getByEmail($clientTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $email, $phone, $city, $address, $stay_address)) {            
                        return $this->addClientPath(null, CLIENT_ADDED);
                    } else {                        
                        return $this->addClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->addClientPath(CLIENT_ERROR, null);
            }            
            return $this->addClientPath(EMPTY_FIELDS, null);            
        }

        // clientes normales
/*         private function isFormRegisterNotEmpty() {
            if (empty() || 
                empty() || 
                empty() || 
                empty() || 
                empty() || 
                empty()) {
                    return false;
            }
            return true;
        } */
        
        public function addClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir cliente";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-client.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Clientes";
                $clients = $this->clientDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-client.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }        

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->enableById($client, $admin)) {
                    return $this->listClientPath(null, CLIENT_ENABLE);
                } else {
                    return $this->listClientPath(DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->disableById($client, $admin)) {
                    return $this->listClientPath(null, CLIENT_DISABLE);
                } else {
                    return $this->listClientPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }       

        public function updatePath($id_client, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Modificar informacion";       
                $clientTemp = new Client();
                $clientTemp->setId($id_client);                
                $client = $this->clientDAO->getById($clientTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-client.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function update($name, $lastName, $email, $phone, $city, $address, $stay_address) {      
            
            if ($this->isFormRegisterNotEmpty($name, $lastName, $email, $phone, $city, $address, $stay_address)) {     
                
                $clientTemp = new Client();
                $clientTemp->setId($id);                
                $clientTemp->setEmail($email);

				if ($this->clientDAO->checkDni($clientTemp) == null) {                                                                           
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                    $city_s = filter_var($city, FILTER_SANITIZE_STRING);
                    $address_s = filter_var($address, FILTER_SANITIZE_STRING);
                    $stay_address_s = filter_var($stay_address, FILTER_SANITIZE_STRING);
        
                    $client = new Client();            
                    $client->setId($id);  
                    $client->setName( strtolower($name_s) );
                    $client->setLastName( strtolower($lastname_s) );
                    $client->setEmail($email);
                    $client->setPhone($phone);
                    $client->setCity( strtolower($city_s) );
                    $client->setAddress( strtolower($address_s) );
                    $client->setStayAddress( strtolower($stay_address_s) );  
                    
                    $update_by = $this->adminController->isLogged();

                    if ($this->clientDAO->update($client, $update_by)) {                                                
                        return $this->listClientPath(null, CLIENT_UPDATE);
                    } else {                        
                        return $this->listClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, EMAIL_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }

    }

        
?>