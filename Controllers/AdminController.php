<?php

    namespace Controllers;
    
    use Models\Admin as Admin;
	use DAO\AdminDAO as AdminDAO;
    use Controllers\HomeController as HomeController;    
    
    class AdminController {

        private $adminDAO;
        private $homeController;

        public function __construct() {
            $this->adminDAO = new AdminDAO();
        }
        
		public function addAdminPath($alert = "", $success = "") {
            if ($admin = $this->isLogged()) {                                       
                $title = "Añadir administrador";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-admin.php");
                require_once(VIEWS_PATH . "footer.php");                    
			} else {                
                return $this->userPath();
			}
        }         
        
    	private function add($name, $lastName, $email, $dni, $password) {
			$admin = new Admin();
            $admin->setName( strtolower($name) );
            $admin->setLastName( strtolower($lastName) );
            $admin->setEmail($email);  
            $admin->setDni($dni);
            $admin->setPassword($password);		

            if ($this->adminDAO->add($admin)) {
                return $admin;
            } else {
                return false;
            }
        }
  
        public function register($name, $lastName, $email, $dni, $password) {
			if ($this->isFormRegisterNotEmpty($name, $lastName, $dni, $email, $password) && $this->validateEmailForm($email)) {     
                $adminTemp = new Admin();
                $adminTemp->setEmail($email);

				if ($this->adminDAO->getByEmail($adminTemp) == null) {                    
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);                    
                    // arreglar - si ingresa un dni ya existente, no agrega en la DB [porque el campo DNI es UNIQUE], pero muestra mensaje exitoso
                    if ($this->add($name, $lastName, $dni, $email, $passwordHash)) {                                                
                        return $this->addAdminPath(null, ADMIN_ADDED);
                    } else {                        
                        return $this->addAdminPath(DB_ERROR, null);        
                    }
                }                
                return $this->addAdminPath(REGISTER_ERROR, null);
            }            
            return $this->addAdminPath(EMPTY_FIELDS, null);
		}

        private function isFormRegisterNotEmpty($name, $lastName, $dni, $email, $password) {
            if (empty($name) || 
                empty($lastName) || 
                empty($dni) || 
                empty($email) || 
                empty($password)) {
                    return false;
            }
            return true;
        }
        
        private function validateEmailForm($email) {
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
                $title = "Dashboard";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "dashboard.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->userPath();
            }
        }   

        public function listAdminPath($alert = "", $success = "") {
            if ($admin = $this->isLogged()) {      
                $title = "Administradores";
                $admins = $this->adminDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-admins.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->userPath();
            }           
        } 

        public function updatePath($id_user) {
            if ($admin = $this->isLogged()) {      
                $title = "Actualizar informacion";       
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

        public function update() {

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
                $admin = new Admin();
                $admin->setId($id);
                if ($this->adminDAO->enableById($admin)) {
                    return $this->listAdminPath(null, ADMIN_ENABLE);
                } else {
                    return $this->listAdminPath(DB_ERROR, null);
                }
            } else {
                return $this->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->isLogged()) {
                $admin = $_SESSION["loggedAdmin"];
                if ($admin->getId() == $id) {                
                    return $this->listAdminPath(DISABLE_YOURSELF, null);
                } else {
                    $admin = new admin();
                    $admin->setId($id);           
                    $this->adminDAO->disableById($admin);
                    return $this->listAdminPath(null, ADMIN_DISABLE);
                }
            } else {
                return $this->userPath();
            }                
		}

    }

 ?>