<?php

    namespace Controllers;
    
    use Models\Admin as Admin;
	use DAO\AdminDAO as AdminDAO;   
    use Controllers\BeachTentController as BeachTentController;        
    
    class AdminController {

        private $adminDAO;

        public function __construct() {            
            $this->adminDAO = new AdminDAO();
        }
        
        
		public function addAdminPath($alert = "", $success = "", $inputs = array()) {
            if ($admin = $this->isLogged()) {                                       
                $title = "Administrador - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-admin.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->userPath();
			}
        }         
        
    	private function add($name, $lastName, $email, $dni, $password) {
            
            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);

			$admin = new Admin();
            $admin->setName( strtolower($name_s) );
            $admin->setLastName( strtolower($lastname_s) );
            $admin->setEmail($email_s);  
            $admin->setDni($dni);
            $admin->setPassword($password);		

            $register_by = $this->isLogged();
            
            if ($this->adminDAO->add($admin, $register_by)) {
                return $admin;
            } else {
                return false;
            }
        }
  
        public function register($name, $lastName, $email, $dni, $password) {

            // Saves the inputs in case of validation error
            $inputs = array(
                "name"=> $name, 
                "lastName"=> $lastName,
                "email"=> $email,
                "dni"=> $dni
            );

			if ($this->isFormRegisterNotEmpty($name, $lastName, $email, $dni, $password) && $this->validateEmailForm($email)) {     
                $adminTemp = new Admin();
                $adminTemp->setEmail($email);

				if ($this->adminDAO->getByEmail($adminTemp) == null) {                    
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);                                                        
                    $adminTemp->setDni($dni);
                    if ($this->adminDAO->getByDni($adminTemp) == null) {                        
                        if ($this->add($name, $lastName, $dni, $email, $passwordHash)) {                                                
                            return $this->addAdminPath(null, ADMIN_ADDED);
                        } else {                        
                            return $this->addAdminPath(DB_ERROR, null, $inputs);        
                        }
                    }
                    return $this->addAdminPath(DNI_ERROR, null, $inputs);
                }                
                return $this->addAdminPath(REGISTER_ERROR, null, $inputs);
            }            
            return $this->addAdminPath(EMPTY_FIELDS, null, $inputs);
		}

        private function isFormRegisterNotEmpty($name, $lastName, $email, $dni, $password) {
            if (empty($name) || 
                empty($lastName) || 
                empty($email) || 
                empty($dni) || 
                empty($password)) {
                    return false;
            }
            return true;
        }

        private function isFormUpdateNotEmpty($name, $lastName, $email, $dni) {
            if (empty($name) || 
                empty($lastName) || 
                empty($email) || 
                empty($dni)) {
                    return false;
            }
            return true;
        }
        
        public function validateEmailForm($email) {
            return (filter_var($email, FILTER_VALIDATE_EMAIL));
        } 

        public function login($email, $password) {
            if ($this->isFormLoginNotEmpty($email, $password) && $this->validateEmailForm($email)) {
                $adminTemp = new Admin();
                $adminTemp->setEmail($email);
                $admin = $this->adminDAO->getByEmail($adminTemp);                                                      
                if (($admin != null) && (password_verify($password, $admin->getPassword()))) {
                    if ($admin->getIsActive()) {
                        $_SESSION["loggedAdmin"] = $admin;                        
                        return $this->dashboard();                        
                    } else {
                        return $this->userPath(ACCOUNT_DISABLE);        
                    }
                }
                return $this->userPath(LOGIN_ERROR);
            }
            return $this->userPath(EMPTY_FIELDS);
        }        

        private function isFormLoginNotEmpty($email, $password) {
            if (empty($email) || empty($password)) {
                return false;
            }
            return true;
        }       

        public function dashboard() {
            if ($admin = $this->isLogged()) {                      
                $beachTentController = new BeachTentController();                
                return $beachTentController->showMap();                                
            } else {
                return $this->userPath();
            }
        }   

        public function listAdminPath($showAll = null, $alert = "", $success = "") {
            if ($admin = $this->isLogged()) {      
                $title = "Administradores";
                if ($showAll != null) {
                    $admins = $this->adminDAO->getAll();
                } else {
                    $admins = $this->adminDAO->getAllActives();                    
                }
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-admins.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->userPath();
            }           
        } 

        public function updatePath($id_user, $alert = "") {
            if ($admin = $this->isLogged()) {      
                $title = "Administrador - Modificar informacion";       
                $admTemp = new Admin();
                $admTemp->setId($id_user);                
                $adm = $this->adminDAO->getById($admTemp);
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-admin.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->userPath();
            }           
        }        

        public function update($id, $name, $lastName, $email, $dni) {

			if ($this->isFormUpdateNotEmpty($name, $lastName, $email, $dni) && $this->validateEmailForm($email)) {     

                $adminTemp = new Admin();
                $adminTemp->setId($id);
                $adminTemp->setEmail($email);
                $adminTemp->setDni($dni);

				if ($this->adminDAO->checkEmail($adminTemp) == null && $this->adminDAO->checkDni($adminTemp) == null) {         
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                    $email_s = filter_var($email, FILTER_SANITIZE_EMAIL);
        
                    $admin = new Admin();
                    $admin->setId($id);
                    $admin->setName( strtolower($name_s) );
                    $admin->setLastName( strtolower($lastname_s) );
                    $admin->setEmail($email_s);  
                    $admin->setDni($dni);                    	
        
                    $update_by = $this->isLogged();

                    if ($this->adminDAO->update($admin, $update_by)) {
                        return $this->listAdminPath(null, null, ADMIN_UPDATE);
                    } else {
                        return $this->listAdminPath(null, DB_ERROR, null);        
                    }                                        
                }                
                return $this->updatePath($id, REGISTER_ERROR);
            }                        
            return $this->updatePath($id, EMPTY_FIELDS);
        }

        public function userPath($alert = "") {
			$this->homeController = new HomeController();
			return $this->homeController->Index($alert);
        }        

        public function isLogged() {
            if (isset($_SESSION["loggedAdmin"])) {
                return $_SESSION["loggedAdmin"];
            }
            return false;
        }

        public function logout() {
            $_SESSION["loggedAdmin"] = null;
            $_SESSION = [];
            session_destroy();            
			return $this->userPath();
        }        
                
        public function enable($id) {
            if ($admin = $this->isLogged()) {
                $admin_enable = new Admin();
                $admin_enable->setId($id);
                if ($this->adminDAO->enableById($admin_enable, $admin)) {
                    return $this->listAdminPath(null, null, ADMIN_ENABLE);
                } else {
                    return $this->listAdminPath(null, DB_ERROR, null);
                }
            } else {
                return $this->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->isLogged()) {
                $admin = $_SESSION["loggedAdmin"];
                if ($admin->getId() == $id) {                
                    return $this->listAdminPath(null, DISABLE_YOURSELF, null);
                } else {
                    $admin_disable = new Admin();
                    $admin_disable->setId($id);           
                    if ($this->adminDAO->disableById($admin_disable, $admin)) {
                        return $this->listAdminPath(null, null, ADMIN_DISABLE);
                    } else {
                        return $this->listAdminPath(null, DB_ERROR, null);
                    }                     
                }
            } else {
                return $this->userPath();
            }                
        }
        
        
        // 
        public function getEmails() {
            return $this->adminDAO->getEmails();
        }

        public function getAllWithRsv() {
            return $this->adminDAO->getAllWithRsv();
        }

        public function getAllCountRsvByAdmin(Admin $admin) {
            return $this->adminDAO->getAllCountRsvById($admin);            
        }

        public function getTotalRsvById(Admin $admin) {
            $listRsv = $this->adminDAO->getAllRsvById($admin);    
            $total = 0;  
            foreach ($listRsv as $rsv) {
                $total += $rsv->getPrice();
            }                   
            return $total;
        }

    }

 ?>