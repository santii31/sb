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
        
        private function addPotential($name, $lastName, $email, $phone, $city, $address, $stay_address) {

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
            $client->setIsPotential(TRUE);     
            
            if ($this->clientDAO->add($client)) {
                return true;
            } else {
                return false;
            }
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
            
            if ($this->clientDAO->add($client)) {
                return true;
            } else {
                return false;
            }
        }

        public function addPotentialClient($name, $lastName, $email, $phone, $city, $address, $stay_address) {
            if ($this->isFormRegisterNotEmpty($name, $lastName, $email, $phone, $city, $address, $stay_address)) {
                
                $clientTemp = new Client();
                $clientTemp->setEmail($email);                
                
				if ($this->clientDAO->getByEmail($clientTemp) == null) {                                                            
                    if ($this->addPotential($name, $lastName, $email, $phone, $city, $address, $stay_address)) {            
                        return $this->addPotentialClientPath(null, CLIENT_ADDED);
                    } else {                        
                        return $this->addPotentialClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->addPotentialClientPath(CLIENT_ERROR, null);
            }            
            return $this->addPotentialClientPath(EMPTY_FIELDS, null);            
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
    
        private function isFormRegisterNotEmpty($name, $lastName, $email, $phone, $city, $address, $stay_address) {
            if (empty($name) || 
                empty($lastName) || 
                empty($email) || 
                empty($phone) || 
                empty($city) || 
                empty($address) || 
                empty($stay_address)) {
                    return false;
            }
            return true;
        }

        public function addPotentialClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir potencial cliente";
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
                $title = "Potenciales clientes";
                $clients = $this->clientDAO->getAllPotentials();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }

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

        public function enablePotential($id) {
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->enableById($client)) {
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
                if ($this->clientDAO->disableById($client)) {
                    return $this->listPotentialClientPath(null, CLIENT_DISABLE);
                } else {
                    return $this->listPotentialClientPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->enableById($client)) {
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
                if ($this->clientDAO->disableById($client)) {
                    return $this->listClientPath(null, CLIENT_DISABLE);
                } else {
                    return $this->listClientPath(DB_ERROR, null);
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
                    
                    if ($this->clientDAO->update($client)) {                                                
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