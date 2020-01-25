<?php

    namespace Controllers;    
    
    use Models\Admin as Admin;
    use Models\Client as Client;
    use Models\BeachTent as BeachTent;    
	use DAO\ClientDAO as ClientDAO;
    use Controllers\AdminController as AdminController; 
    use Controllers\ReservationController as ReservationController; 
    
    class ClientController {

        private $clientDAO;
        private $adminController;
        private $reservationController;

        public function __construct() {
            $this->clientDAO = new ClientDAO();
            $this->adminController = new AdminController();
        }       
        
        
        private function add($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address, $tel_stay) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $stay_s = filter_var($stay, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);
            $city_s = filter_var($city, FILTER_SANITIZE_STRING);
            $family_group_s = filter_var($family_group, FILTER_SANITIZE_STRING);
            $stay_address_s = filter_var($stay_address, FILTER_SANITIZE_STRING);

            $client = new Client();            
            $client->setName( strtolower($name_s) );
            $client->setLastName( strtolower($lastname_s) );
            $client->setStay( strtolower($stay_s) );
            $client->setAddress( strtolower($address_s) );
            $client->setCity( strtolower($city_s) );
            $client->setCp($cp);
            $client->setEmail($email);
            $client->setPhone($phone);
            $client->setFamilyGroup( strtolower($family_group_s) );
            $client->setStayAddress( strtolower($stay_address_s) );
            $client->setPhoneStay($tel_stay);
            
            $register_by = $this->adminController->isLogged();

            if ($this->clientDAO->add($client, $register_by)) {
                return true;
            } else {
                return false;
            }
        }     

        public function addClient($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address, $tel_stay) {
            if ($this->isFormRegisterNotEmpty($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address, $tel_stay)) {
                
                $clientTemp = new Client();
                $clientTemp->setEmail($email);                
                
                if ($this->clientDAO->getByEmail($clientTemp) == null) {                                                            
                    if ($this->add($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address, $tel_stay)) {      
                        return $this->addClientPath(null, CLIENT_ADDED);
                    } else {                        
                        return $this->addClientPath(DB_ERROR, null);        
                    }
                }                
                return $this->addClientPath(CLIENT_ERROR, null);
            }            
            return $this->addClientPath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address,                                                $tel_stay) {         
            if (empty($name) || 
                empty($lastname) || 
                empty($stay) || 
                empty($address) || 
                empty($city) || 
                empty($cp) || 
                empty($email) || 
                empty($tel) || 
                empty($family_group) || 
                empty($stay_address) || 
                empty($tel_stay)) {
                    return false;
            }
            return true;
        }
        
        public function addClientPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "Clientes - Añadir";                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-client.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }
                
        public function listClientPath($page = 1, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Clientes";                
                
                $this->reservationController = new ReservationController();                                
                $rsvClientsCount = $this->reservationController->getRsvClientsCount();         

                $pages = ceil ($rsvClientsCount / MAX_ITEMS_PAGE);  
                
                // This variable will contain the number of the current page
                $current = 0;                  

                if ($page == 1) {                                        
                    $rsv = $this->reservationController->getAllReservationsWithClients(0);
                } else {
                    $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                    $rsv = $this->reservationController->getAllReservationsWithClients($startFrom);
                }

                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-clients.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        }        

        public function searchPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Clientes - Buscar";                       
                $filter = true;
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "search-client.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }   
        }

        public function search($option, $value) {                              
            if ($admin = $this->adminController->isLogged()) { 
                if (!empty($value)) {
                    if ($option == 'name') {
                        return $this->searchByName($value);
                    } elseif ($option == 'tent') {                    
                        return $this->searchByTentNumber($value);
                    }                
                    return $this->searchPath('error inesperado');
                }
                return $this->searchPath(EMPTY_FIELDS);
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function searchByName($name) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Clientes - Buscar por nombre";
                $clientTemp = new Client();
                $clientTemp->setName( strtolower($name) );                       
                $rsvClients = $this->clientDAO->getByName($clientTemp);
                if (sizeof($rsvClients) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-client.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->searchPath(SEARCH_EMPTY);
                }                
            } else {
                return $this->adminController->userPath();
            } 
        }

        private function searchByTentNumber($tent) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Clientes - Buscar por Nº de carpa";
                $tentTemp = new BeachTent();
                $tentTemp->setNumber( strtoupper($tent) );
                $rsvClients = $this->clientDAO->getByTentNumber($tentTemp);
                if (sizeof($rsvClients) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-client.php");
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
                $client = new Client();
                $client->setId($id);
                if ($this->clientDAO->enableById($client, $admin)) {
                    return $this->listClientPath(null, null, CLIENT_ENABLE);
                } else {
                    return $this->listClientPath(null, DB_ERROR, null);
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
                    return $this->listClientPath(null, null, CLIENT_DISABLE);
                } else {
                    return $this->listClientPath(null, DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }       

        public function updatePath($id_client, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Cliente - Modificar informacion";       
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

        public function update($id, $name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address, $tel_stay) {      
            
            if ($this->isFormRegisterNotEmpty($name, $lastname, $stay, $address, $city, $cp, $email, $tel, $family_group, $stay_address,                                            $tel_stay)) {    
                
                $clientTemp = new Client();
                $clientTemp->setId($id);                
                $clientTemp->setEmail($email);

				if ($this->clientDAO->checkDni($clientTemp) == null) {               
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                    $stay_s = filter_var($stay, FILTER_SANITIZE_STRING);
                    $address_s = filter_var($address, FILTER_SANITIZE_STRING);
                    $city_s = filter_var($city, FILTER_SANITIZE_STRING);
                    $family_group_s = filter_var($family_group, FILTER_SANITIZE_STRING);
                    $stay_address_s = filter_var($stay_address, FILTER_SANITIZE_STRING);
        
                    $client = new Client();    
                    $client->setId($Id);
                    $client->setName( strtolower($name_s) );
                    $client->setLastName( strtolower($lastname_s) );
                    $client->setStay( strtolower($stay_s) );
                    $client->setAddress( strtolower($address_s) );
                    $client->setCity( strtolower($city_s) );
                    $client->setCp($cp);
                    $client->setEmail($email);
                    $client->setPhone($phone);
                    $client->setFamilyGroup( strtolower($family_group_s) );
                    $client->setStayAddress( strtolower($stay_address_s) );
                    $client->setPhoneStay($tel_stay);
                    
                    $update_by = $this->adminController->isLogged();

                    if ($this->clientDAO->update($client, $update_by)) {                                                
                        return $this->listClientPath(null, null, CLIENT_UPDATE);
                    } else {                        
                        return $this->listClientPath(null, DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, EMAIL_ERROR);
            }            
            return $this->updatePath($id, EMPTY_FIELDS);
        }        
        
        // 
        public function getEmails() {
            return $this->clientDAO->getEmails();
        }

        public function addObj(Client $client, Admin $admin) {
            return $this->clientDAO->add($client, $admin);
        }



        // SACAR ESTO
        // prueba ajax
        public function getAllNames() {            
            $clients = $this->clientDAO->getAll();
            $fullName_list = array();

            $c = new Client();

            foreach ($clients as $client) {
                $c->setName($client->getName());
                $c->setLastName($client->getLastName());
                // $fullName = $client->getName() . ' ' . $client->getLastName();
                array_push($fullName_list, $c);                
            }
  
            $jsonFullNames = json_encode($fullName_list, JSON_PRETTY_PRINT);

            echo '<pre>';
            var_dump($jsonFullNames);
            echo '</pre>';

            return $jsonFullNames;
        }

        public function ajaxPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                       
                $title = "ajax test";
                require_once(VIEWS_PATH . "head.php");                
                require_once(VIEWS_PATH . "ajax.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
        }

        public function searchFullNames($query) {                    
            $clients = $this->clientDAO->getAll();            

            // echo '<pre>';
            // var_dump($clients);
            // echo '</pre>';

            $hint = "";

            if ($query !== "") {
            
                $query = strtolower($query);
                $len = strlen($query);
                                
                foreach ($clients as $client) {      
                    
                    // echo '<pre>';
                    // echo '------<br>';
                    // var_dump($client);
                    // echo '------';
                    // echo '</pre>';                    
                    // var_dump($f_name_temp);
                    // $f_name = $client->getName() . ' ' . $client->getLastName();                                        

                    $f_name_temp = $client->getName() . ' ' . $client->getLastName();

                    echo '<pre>';
                    var_dump($f_name_temp);
                    echo '<br>-----<br>';
                    var_dump($query);
                    echo '</pre>';

                    if (stristr($query, substr($f_name_temp, 0, $len))) {
                        // if ($hint === "") {
                        //     $hint = $f_name_temp;
                        // } else {
                        //     $hint .= ", $f_name_temp";
                        // }
                    }

                }
            }

            // Output "no suggestion" if no hint was found or output correct values
            echo $hint === "" ? "no suggestion" : $hint;
        }

    }
        
?>