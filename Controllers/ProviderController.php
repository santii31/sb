<?php

    namespace Controllers;    

    use Models\Provider as Provider;
    use DAO\ProviderDAO as ProviderDAO;
    use Controllers\AdminController as AdminController;  

    class ProviderController {

        private $providerDAO;
        private $adminController;

        public function __construct() {
            $this->providerDAO = new ProviderDAO();
            $this->adminController = new AdminController();
        }     
        
        
        private function add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);
            $social_reason_s = filter_var($social_reason, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);
            $item_s = filter_var($item, FILTER_SANITIZE_STRING);

            $provider = new Provider();            
            $provider->setName( strtolower($name_s) );
            $provider->setLastName( strtolower($lastname_s) );
            $provider->setPhone($phone);
            $provider->setEmail($email_s);
            $provider->setDni($dni);
            $provider->setBilling( strtolower($billing) );
            $provider->setCuilNumber($cuil_number);
            $provider->setSocialReason( strtolower($social_reason_s) );
            $provider->setAddress( strtolower($address_s) );
            $provider->setItem( strtolower($item_s) );         
            
            $register_by = $this->adminController->isLogged();

            if ($this->providerDAO->add($provider, $register_by)) {
                return true;
            } else {
                return false;
            }
        }

        public function addProvider($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item) {
            
            // Saves the inputs in case of validation error
            $inputs = array(
                "name"=> $name, 
                "lastName"=> $lastName,
                "phone"=> $phone,
                "email"=> $email,
                "dni"=> $dni,
                "billing"=> $billing,
                "cuil_number"=> $cuil_number,
                "social_reason"=> $social_reason,
                "address"=> $address,
                "item"=> $item
            );

            if ($this->isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item)) {
                $providerTemp = new Provider();
                $providerTemp->setDni($dni);                                
                $providerTemp->setEmail($email);      
				if ($this->providerDAO->getByDni($providerTemp) == null) {     
                    if ($this->providerDAO->getByEmail($providerTemp) == null) { 
                        if ($this->add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item)) {            
                            return $this->addProviderPath(null, PROVIDER_ADDED);
                        } else {                        
                            return $this->addProviderPath(DB_ERROR, null, $inputs);        
                        }
                    }
                    return $this->addProviderPath(REGISTER_ERROR, null, $inputs);        

                }                
                return $this->addProviderPath(PROVIDER_ERROR, null, $inputs);
            }            
            return $this->addProviderPath(EMPTY_FIELDS, null, $inputs);            
        }

        private function isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item) {
            if (empty($name) || 
                empty($lastName) || 
                empty($phone) || 
                empty($email) || 
                empty($dni) || 
                empty($billing) || 
                empty($cuil_number) || 
                empty($social_reason) || 
                empty($item) ||
                empty($address)) {
                    return false;
            }
            return true;
        }         

        public function addProviderPath($alert = "", $success = "", $inputs = array()) {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Proveedor - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-provider.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
		}

        public function listProviderPath($page = 1, $showDisables = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {

                if ($showDisables == null) {
                    $title = "Proveedores";
                    $providersCount = $this->providerDAO->getActiveCount();         
                    $pages = ceil ($providersCount / MAX_ITEMS_PAGE);                                                                  

                    // This variable will contain the number of the current page
                    $current = 0;                  
    
                    if ($page == 1) {                                        
                        $providers = $this->providerDAO->getAllActiveWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $providers = $this->providerDAO->getAllActiveWithLimit($startFrom);                    
                    }
                } else {                    
                    $title = "Proveedores - Deshabilitados";
                    $d_providersCount = $this->providerDAO->getDisableCount();         
                    $d_pages = ceil ($d_providersCount / MAX_ITEMS_PAGE);                                                                         

                    // This variable will contain the number of the current page
                    $d_current = 0;                  
    
                    if ($page == 1) {                                        
                        $providers = $this->providerDAO->getAllDisableWithLimit(0);
                    } else {
                        $startFrom = ($page - 1) * MAX_ITEMS_PAGE;                    
                        $providers = $this->providerDAO->getAllDisableWithLimit($startFrom);                    
                    }                                      
                }
                
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-providers.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

        public function searchPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Proveedor - Buscar";                       
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "search-provider.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }   
        }

        public function search($value) {                              
            if ($admin = $this->adminController->isLogged()) { 
                if (!empty($value)) {
                    return $this->searchByItem($value);                    
                }
                return $this->searchPath(EMPTY_FIELDS);
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function searchByItem($item) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Proveedor - Buscar por rubro";
                $provider = new Provider();
                $provider->setItem( strtolower($item) );                       
                $providers = $this->providerDAO->getByItem($provider);
                if (sizeof($providers) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-provider.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->searchPath(SEARCH_PROVIDER_EMPTY);
                }                
            } else {
                return $this->adminController->userPath();
            } 
        }

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $provider = new Provider();
                $provider->setId($id);
                if ($this->providerDAO->enableById($provider, $admin)) {
                    return $this->listProviderPath(1, null, null, PROVIDER_ENABLE);
                } else {
                    return $this->listProviderPath(1, null, DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $provider = new Provider();
                $provider->setId($id);
                if ($this->providerDAO->disableById($provider, $admin)) {
                    return $this->listProviderPath(1, null, null, PROVIDER_DISABLE);
                } else {
                    return $this->listProviderPath(1, null, DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }

        public function updatePath($id_provider, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Proveedor - Modificar informacion";       
                $providerTemp = new Provider();
                $providerTemp->setId($id_provider);                
                $provider = $this->providerDAO->getById($providerTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-provider.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }        

        public function update($id, $name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item) {
                        
            if ($this->isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address, $item) 
                && $this->adminController->validateEmailForm($email)) {     
                
                $providerTemp = new Provider();
                $providerTemp->setId($id);                
                $providerTemp->setEmail($email);

				if ($this->providerDAO->checkEmail($providerTemp) == null) {                                                                     
                    
                    $providerTemp->setDni($dni);

                    if ($this->providerDAO->checkDni($providerTemp) == null) { 

                        $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                        $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                        $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);
                        $social_reason_s = filter_var($social_reason, FILTER_SANITIZE_STRING);
                        $address_s = filter_var($address, FILTER_SANITIZE_STRING);
                        $item_s = filter_var($item, FILTER_SANITIZE_STRING);

                        $provider = new Provider();
                        $provider->setId($id);
                        $provider->setName( strtolower($name_s) );
                        $provider->setLastName( strtolower($lastname_s) );
                        $provider->setPhone($phone);
                        $provider->setEmail($email_s);
                        $provider->setDni($dni);
                        $provider->setBilling( strtolower($billing) );
                        $provider->setCuilNumber($cuil_number);
                        $provider->setSocialReason( strtolower($social_reason_s) );
                        $provider->setAddress( strtolower($address_s) );
                        $provider->setItem( strtolower($item_s) );   

                        $update_by = $this->adminController->isLogged();

                        if ($this->providerDAO->update($provider, $update_by)) {                                                
                            return $this->listProviderPath(1, null, null, PROVIDER_UPDATE);
                        } else {                        
                            return $this->listProviderPath(1, null, DB_ERROR, null);        
                        }
                    }
                    return $this->updatePath($id, DNI_ERROR);
                }                
                return $this->updatePath($id, REGISTER_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }         


        // 
        public function getProviders() {
            return $this->providerDAO->getAllActives();
        }
                
    }
    
?>