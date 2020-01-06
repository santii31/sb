<?php

    namespace Controllers;    

    use Models\Provider as Provider;
    use Controllers\AdminController as AdminController;  
    use DAO\ProviderDAO as ProviderDAO;

    class ProviderController {

        private $providerDAO;
        private $adminController;

        public function __construct() {
            $this->providerDAO = new ProviderDAO();
            $this->adminController = new AdminController();
        }     
        
        private function add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            $provider = new Provider();            
            $provider->setName( strtolower($name) );
            $provider->setLastName( strtolower($lastName) );
            $provider->setPhone($phone);
            $provider->setEmail($email);
            $provider->setDni($dni);
            $provider->setBilling( strtolower($billing) );
            $provider->setCuilNumber($cuil_number);
            $provider->setSocialReason( strtolower($social_reason) );
            $provider->setAddress( strtolower($address) );         
            
            if ($this->providerDAO->add($provider)) {
                return true;
            } else {
                return false;
            }
        }

        public function addProvider($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            if ($this->isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address)) {
                $providerTemp = new Provider();
                $providerTemp->setDni($dni);                
                
				if ($this->providerDAO->getByDni($providerTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address)) {            
                        return $this->addProviderPath(null, PROVIDER_ADDED);
                    } else {                        
                        return $this->addProviderPath(DB_ERROR, null);        
                    }
                }                
                return $this->addProviderPath(PROVIDER_ERROR, null);
            }            
            return $this->addProviderPath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            if (empty($name) || 
                empty($lastName) || 
                empty($phone) || 
                empty($email) || 
                empty($dni) || 
                empty($billing) || 
                empty($cuil_number) || 
                empty($social_reason) || 
                empty($address)) {
                    return false;
            }
            return true;
        }         

        public function addProviderPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir proveedor";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-provider.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
		}

        public function listProviderPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Proveedores";
                $providers = $this->providerDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-providers.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $provider = new Provider();
                $provider->setId($id);
                if ($this->providerDAO->enableById($provider)) {
                    return $this->listProviderPath(null, PROVIDER_ENABLE);
                } else {
                    return $this->listProviderPath(DB_ERROR, null);
                }
            } else {
                return $this->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $provider = new Provider();
                $provider->setId($id);
                if ($this->providerDAO->disableById($provider)) {
                    return $this->listProviderPath(null, PROVIDER_DISABLE);
                } else {
                    return $this->listProviderPath(DB_ERROR, null);
                }              
            } else {
                return $this->userPath();
            }                
        }

        public function updatePath($id_provider, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Modificar informacion";       
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

        public function update($id, $name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            
            // validar email?
			if ($this->isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address)) {     
                
                $providerTemp = new Provider();
                $providerTemp->setId($id);                
                $providerTemp->setEmail($email);

				if ($this->providerDAO->checkEmail($providerTemp) == null) {                                                                     

                    $provider = new Provider();
                    $provider->setId($id);
                    $provider->setName( strtolower($name) );
                    $provider->setLastName( strtolower($lastName) );
                    $provider->setPhone($phone);
                    $provider->setEmail($email);
                    $provider->setDni($dni);
                    $provider->setBilling( strtolower($billing) );
                    $provider->setCuilNumber($cuil_number);
                    $provider->setSocialReason( strtolower($social_reason) );
                    $provider->setAddress( strtolower($address) );   

                    if ($this->providerDAO->update($provider)) {                                                
                        return $this->listProviderPath(null, PROVIDER_UPDATE);
                    } else {                        
                        return $this->listProviderPath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, REGISTER_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }         
                
    }
    
?>