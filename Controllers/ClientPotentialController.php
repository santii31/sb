<?php

    namespace Controllers;    
    
    use Models\ClientPotential as ClientPotential;
	use DAO\ClientPotentialDAO as ClientPotentialDAO;
    use Controllers\AdminController as AdminController; 

    class ClientPotentialController {

        private $clientPotentialDAO;
        private $adminController;

        public function __construct() {
            $this->clientDAO = new ClientDAO();
            $this->adminController = new AdminController();
        }       
        
        private function addPotential($name, $lastName, $address, $city, $email, $phone) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);            

            $client = new Client();            
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($lastname_s) );
            $client->setAddress( strtolower($address_s) );
            $client->setCity( strtolower($city_s) );
            $client->setEmail($email);
            $client->setPhone($phone);            
            $client->setIsPotential(true);     

            $register_by = $this->adminController->isLogged();
            
            if ($this->clientDAO->add($client, $register_by)) {
                return true;
            } else {
                return false;
            }
        }

        public function addPotentialClient($name, $lastName, $address, $city, $email, $phone) {
            if ($this->isFormRegisterPotentialNotEmpty($name, $lastName, $address, $city, $email, $phone)) {
                
                $clientTemp = new Client();
                $clientTemp->setEmail($email);                
                
				if ($this->clientDAO->getByEmail($clientTemp) == null) {                                                            
                    if ($this->addPotential($name, $lastName, $address, $city, $email, $phone)) {            
                        return $this->addPotentialClientPath(null, CLIENT_ADDED);
                    } else {                        
                        return $this->addPotentialClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->addPotentialClientPath(CLIENT_ERROR, null);
            }            
            return $this->addPotentialClientPath(EMPTY_FIELDS, null);            
        }        
       
        private function isFormRegisterPotentialNotEmpty($name, $lastName, $address, $city, $email, $phone) {
            if (empty($name) || 
                empty($lastName) || 
                empty($address) || 
                empty($city) || 
                empty($email) || 
                empty($phone)) {
                    return false;
            }
            return true;
        }

        public function addPotentialClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir cliente potencial";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listPotentialClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Clientes Potenciales";
                $clients = $this->clientDAO->getAllPotentials();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }
        
        public function enablePotential($id) {
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->enableById($client, $admin)) {
                    return $this->listPotentialClientPath(null, CLIENT_ENABLE);
                } else {
                    return $this->listPotentialClientPath(DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disablePotential($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->disableById($client, $admin)) {
                    return $this->listPotentialClientPath(null, CLIENT_DISABLE);
                } else {
                    return $this->listPotentialClientPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }        

        public function updatePotentialPath($id_client, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Modificar informacion";       
                $clientTemp = new Client();
                $clientTemp->setId($id_client);                
                $client = $this->clientDAO->getByIdPotential($clientTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function updatePotential($name, $lastName, $email, $phone, $city, $address, $stay_address) {      
            
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
                    $client->setIsPotential(TRUE);  
                    
                    if ($this->clientDAO->updatePotential($client)) {                                                
                        return $this->listPotentialClientPath(null, CLIENT_UPDATE);
                    } else {                        
                        return $this->listPotentialClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePotentialPath($id, EMAIL_ERROR);
            }            
            return $this->updatePotentialPath($id ,EMPTY_FIELDS);
        }               

    }

        
?>