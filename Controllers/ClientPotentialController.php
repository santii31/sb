<?php

    namespace Controllers;    
    
    use Models\ClientPotential as ClientPotential;
	use DAO\ClientPotentialDAO as ClientPotentialDAO;
    use Controllers\AdminController as AdminController; 

    class ClientPotentialController {

        private $clientPotentialDAO;
        private $adminController;

        public function __construct() {
            $this->clientPotentialDAO = new ClientPotentialDAO();
            $this->adminController = new AdminController();
        }     
          
        
        private function add($name, $lastName, $address, $city, $email, $phone, $num_tent) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);            

            $client = new ClientPotential();            
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($lastname_s) );
            $client->setAddress( strtolower($address_s) );
            $client->setCity( strtolower($city_s) );
            $client->setEmail($email);
            $client->setPhone($phone);            
            $client->setNumTent($num_tent);     

            $register_by = $this->adminController->isLogged();
            
            if ($this->clientPotentialDAO->add($client, $register_by)) {
                return true;
            } else {
                return false;
            }
        }

        public function addPotentialClient($name, $lastName, $address, $city, $email, $phone, $num_tent) {

            // Saves the inputs in case of validation error
            $inputs = array(
                "name"=> $name, 
                "lastName"=> $lastName,
                "address"=> $address,
                "city"=> $city,
                "email"=> $email,
                "phone"=> $phone,
                "num_tent"=> $num_tent
            );

            if ($this->isFormRegisterNotEmpty($name, $lastName, $address, $city, $email, $phone, $num_tent)) {
                
                $clientTemp = new ClientPotential();
                $clientTemp->setEmail($email);                
                
				if ($this->clientPotentialDAO->getByEmail($clientTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $address, $city, $email, $phone, $num_tent)) {            
                        return $this->addPotentialClientPath(null, CLIENT_ADDED);
                    } else {                        
                        return $this->addPotentialClientPath(DB_ERROR, null, $inputs);        
                    }
                }                
                return $this->addPotentialClientPath(CLIENT_ERROR, null, $inputs);
            }            
            return $this->addPotentialClientPath(EMPTY_FIELDS, null, $inputs);            
        }        
       
        private function isFormRegisterNotEmpty($name, $lastName, $address, $city, $email, $phone, $num_tent) {
            if (empty($name) || 
                empty($lastName) || 
                empty($address) || 
                empty($city) || 
                empty($email) || 
                empty($phone) || 
                empty($num_tent)) {
                    return false;
            }
            return true;
        }

        public function addPotentialClientPath($alert = "", $success = "", $inputs = array()) {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Cliente potencial - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
        
        public function listPotentialClientPath($page = 1, $showDisables = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {

                if ($showDisables == null) {
                    $title = "Clientes Potenciales";
                    $clientsCount = $this->clientPotentialDAO->getActiveCount();         
                    $pages = ceil ($clientsCount / MAX_ITEMS_PAGE);                                                                  
                    $current = 0;                  
    
                    if ($page == 1) {                                        
                        $clients = $this->clientPotentialDAO->getAllActiveWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $clients = $this->clientPotentialDAO->getAllActiveWithLimit($startFrom);                    
                    }
                } else {                    
                    $title = "Clientes Potenciales - Deshabilitados";
                    $d_clientsCount = $this->clientPotentialDAO->getDisableCount();         
                    $d_pages = ceil ($d_clientsCount / MAX_ITEMS_PAGE);                                                                           
                    $d_current = 0;                  
    
                    if ($page == 1) {                                        
                        $clients = $this->clientPotentialDAO->getAllDisableWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $clients = $this->clientPotentialDAO->getAllDisableWithLimit($startFrom);                    
                    }                                      
                }                 
              
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }
        
        public function searchPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Clientes Potenciales - Buscar";                       
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "search-client-potential.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }   
        }

        public function search($value) {                              
            if ($admin = $this->adminController->isLogged()) { 
                if (!empty($value)) {
                    return $this->searchByName($value);                    
                }
                return $this->searchPath(EMPTY_FIELDS);
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function searchByName($name) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Clientes Potenciales - Buscar por nombre";
                $clientTemp = new ClientPotential();
                $clientTemp->setName( strtolower($name) );                       
                $clients = $this->clientPotentialDAO->getByName($clientTemp);
                if (sizeof($clients) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-client-potential.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->searchPath(SEARCH_EMPTY);
                }                
            } else {
                return $this->adminController->userPath();
            } 
        }

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $client = new ClientPotential();
                $client->setId($id);
                if ($this->clientPotentialDAO->enableById($client, $admin)) {
                    return $this->listPotentialClientPath(1, null, null, CLIENT_ENABLE);
                } else {
                    return $this->listPotentialClientPath(1, null, DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $client = new ClientPotential();
                $client->setId($id);
                if ($this->clientPotentialDAO->disableById($client, $admin)) {
                    return $this->listPotentialClientPath(1, null, null, CLIENT_DISABLE);
                } else {
                    return $this->listPotentialClientPath(1, null, DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }        

        public function updatePotentialPath($id_client, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Cliente Potencial - Modificar informacion";       
                $clientTemp = new ClientPotential();
                $clientTemp->setId($id_client);                
                $client = $this->clientPotentialDAO->getById($clientTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-potential-client.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }

        public function update($id, $name, $lastName, $address, $city, $email, $phone, $num_tent) {      
            
            if ($this->isFormRegisterNotEmpty($name, $lastName, $address, $city, $email, $phone, $num_tent)) {     
                
                $clientTemp = new ClientPotential();
                $clientTemp->setId($id);                
                $clientTemp->setEmail($email);

				if ($this->clientPotentialDAO->checkEmail($clientTemp) == null) {                                                                
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                    $address_s = filter_var($address, FILTER_SANITIZE_STRING);
                    $city_s = filter_var($city, FILTER_SANITIZE_STRING);            
        
                    $client = new ClientPotential();            
                    $client->setId($id);
                    $client->setName( strtolower($name_s) );
                    $client->setLastName( strtolower($lastname_s) );
                    $client->setAddress( strtolower($address_s) );
                    $client->setCity( strtolower($city_s) );
                    $client->setEmail($email);
                    $client->setPhone($phone);            
                    $client->setNumTent($num_tent);  
                    
                    $update_by = $this->adminController->isLogged();

                    if ($this->clientPotentialDAO->update($client, $update_by)) {                                                
                        return $this->listPotentialClientPath(1, null, null, CLIENT_UPDATE);
                    } else {                        
                        return $this->listPotentialClientPath(1, null, DB_ERROR, null);        
                    }
                }                
                return $this->updatePotentialPath($id, EMAIL_ERROR);
            }            
            return $this->updatePotentialPath($id ,EMPTY_FIELDS);
        }            
        

        //         
        public function getEmails() {
            return $this->clientPotentialDAO->getEmails();
        }

    }

        
?>