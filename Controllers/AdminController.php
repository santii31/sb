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
        
    	private function add($name, $lastName, $dni, $eemail, $password) {
			$admin = new Admin();
            $admin->setName($name);
            $admin->setLastName($lastName);
            $admin->setDni($dni);
            $admin->setEmail($email);
            $admin->setPassword($password);			
            if ($this->adminDAO->add($admin)) {
                return $admin;
            } else {
                return false;
            }
        }

        /* 
            Sanitizar campos, para evitar que vengan con scripts o algo perjudicial
            (averiguar como hacerlo)
        */
        
        public function register($name, $lastName, $dni, $email, $password) {
			if ($this->isFormRegisterNotEmpty($name, $lastName, $dni, $email, $password) && $this->validateEmailForm($email)) {
                $adminTemp = new admin();
                $adminTemp->setEmail($email);
				if ($this->adminDAO->getByEmail($adminTemp) == null) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $admin = $this->add($name, $lastName, $dni, $email, $passwordHash);
                    if ($admin) {                        
                        return $this->addAdminPath('EXITO');
                    } else {
                        return $this->addAdminPath(DB_ERROR);        
                    }
                }
                return $this->addAdminPath(REGISTER_ERROR);
            }
            return $this->addAdminPath(EMPTY_FIELDS);
		}

        private function isFormRegisterNotEmpty($name, $lastName, $dni, $email, $password) {
            if (empty($name) || empty($lastName) || empty($dni) || empty($email) || empty($password)) {
                return false;
            }
            return true;
        }

        private function validateEmailForm($email) {
            return (filter_var($email, FILTER_VALIDATE_Eemail)) ? true : false;
        } 

        public function login($email, $password) {
            if ($this->isFormLoginNotEmpty($email, $password) && $this->validateEmailForm($email)) {
                $adminTemp = new admin();
                $adminTemp->setEmail($email);
                $admin = $this->adminDAO->getByemail($adminTemp);
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
                // traer admins
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-admins.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->userPath();
            }           
        } 

        public function userPath() {
			$this->homeController = new HomeController();
			return $this->homeController->Index();
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
                
        public function enable($email) {
			$admin = new admin();
			$admin->setEmail($email);
			if ($this->adminDAO->enableByEmail($admin)) {
				return $this->listAdminPath(null, ADMIN_ENABLE);
			} else {
				return $this->listAdminPath(DB_ERROR, null);
			}
        }       

        public function disable($dni) {		
            $admin = $_SESSION["loggedadmin"];
            if ($admin->getEmail() == $email) {
                return $this->listAdminPath(DISABLE_YOURSELF, null);
            } else {
                $admin = new admin();
                $admin->setEmail($email);             
                $this->adminDAO->disableByEmail($admin);
                return $this->listAdminPath(null, ADMIN_DISABLE);
            }
		}

    }

 ?>