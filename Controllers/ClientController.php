<?php

    namespace Controllers;    
    
    use Models\Admin as Admin;
    use Models\Client as Client;
    use Models\Parasol as Parasol;    
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
        
                            
        public function listClientPath($page = 1, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Clientes";                
                
                $this->reservationController = new ReservationController();                                
                $rsvClientsCount = $this->reservationController->getRsvClientsCount();         

                $pages = ceil ($rsvClientsCount / MAX_ITEMS_PAGE);                  
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
                    } elseif ($option == 'parasol') {
                        return $this->searchByParasolNumber($value);
                    }                 
                    return $this->searchPath(DB_ERROR);
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

        private function searchByParasolNumber($parasol) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Clientes - Buscar por Nº de sombrilla";
                $parasolTemp = new Parasol();
                $parasolTemp->setParasolNumber( strtoupper($parasol) );
                $rsvClients = $this->clientDAO->getByParasolNumber($parasolTemp);
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

        private function isFormUpdateNotEmpty($name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle) {         
            if (empty($name) || 
                empty($l_name) || 
                empty($addr) || 
                empty($city) || 
                empty($cp) || 
                empty($email) || 
                empty($phone) || 
                empty($fam) || 
                empty($auxiliary_phone) ||                  
                empty($vehicle)) {
                    return false;
            }
            return true;
        }

        public function update($id, $name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle) {      
            
            if ($this->isFormUpdateNotEmpty($name, $l_name, $addr, $city, $cp, $email, $phone, $fam, $auxiliary_phone, $vehicle)) {    
                    
                $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                $l_name_s = filter_var($l_name, FILTER_SANITIZE_STRING);
                $addr_s = filter_var($addr, FILTER_SANITIZE_STRING);
                $city_s = filter_var($city, FILTER_SANITIZE_STRING);
                $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);     
                $vehicle_s = filter_var($vehicle, FILTER_SANITIZE_STRING);      

                $client = new Client();
                $client->setId($id);
                $client->setName( strtolower($name_s) );
                $client->setLastName( strtolower($l_name_s) );
                $client->setAddress( strtolower($addr_s) );            
                $client->setCity( strtolower($city_s) );
                $client->setCp($cp);
                $client->setEmail($email_s);
                $client->setPhone($phone);
                $client->setFamilyGroup( strtolower($fam) );
                $client->setAuxiliaryPhone($auxiliary_phone);
                $client->setVehicleType( strtolower($vehicle_s) );   
                
                $update_by = $this->adminController->isLogged();

                if ($this->clientDAO->updateFromList($client, $update_by)) {                                                                  
                    return $this->listClientPath(1, null, "Cliente actualizado con éxito.");
                } else {                        
                    return $this->listClientPath(1, DB_ERROR, null);        
                }
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

        public function getAll() {
            return $this->clientDAO->getAll();
        }

    }
        
?>