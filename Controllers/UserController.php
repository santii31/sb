<?php

    namespace Controllers;

    // use Models\Role as Role;
    // use Models\User as User;
	// use DAO\UserDAO as UserDAO;
    // use Controllers\HomeController as HomeController;
    // use Controllers\RoleController as RoleController;    
    // use Controllers\MovieController as MovieController;
    // use Controllers\ImageController as ImageController;    
    // use Controllers\PurchaseController as PurchaseController;    
    
    class UserController {

        private $userDAO;

        public function __construct() {
            // $this->userDAO = new UserDAO();
        }

/* 	
    	public function add($role, $firstName, $lastName, $dni, $mail, $password) {
			$user = new User();
            $user->setFirstName($firstName);
            $user->setLastName($lastName);
            $user->setDni($dni);
            $user->setMail($mail);
            $user->setPassword($password);
			$user->setRole($role);
            if ($this->userDAO->add($user)) {
                return $user;
            } else {
                return false;
            }
        }
                
        public function validateRegister($firstName, $lastName, $dni, $mail, $password) {
			if ($this->isFormRegisterNotEmpty($firstName, $lastName, $dni, $mail, $password) && $this->validateMailForm($mail)) {
                $userTemp = new User();
                $userTemp->setMail($mail);
				if ($this->userDAO->getByMail($userTemp) == null) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $user = $this->add(0, $firstName, $lastName, $dni, $mail, $passwordHash);
                    if ($user) {
                        $_SESSION["loggedUser"] = $user;
                        return $this->userPath();
                    } else {
                        return $this->registerPath(DB_ERROR);        
                    }
                }
                return $this->registerPath(REGISTER_ERROR);
            }
            return $this->registerPath(EMPTY_FIELDS);
		}

        private function isFormRegisterNotEmpty($firstName, $lastName, $dni, $email, $password) {
            if (empty($firstName) || empty($lastName) || empty($dni) || empty($email) || empty($password)) {
                return false;
            }
            return true;
        }
 */

        public function listAdminPath($alert = "", $success = "") {
            // if (isset($_SESSION["loggedUser"])) {
            //     $admin = $_SESSION["loggedUser"];
            //     if ($admin->getRole() == 1) {
            //         $users = $this->userDAO->getAll();
            //         if ($users) {
                        $title = "Administradores";
                        require_once(VIEWS_PATH . "head.php");
                        require_once(VIEWS_PATH . "sidenav.php");
                        require_once(VIEWS_PATH . "list-admins.php");
                        require_once(VIEWS_PATH . "footer.php");
            //         } else {
            //             return $this->adminPath();
            //         }
            //     } else {
            //         return $this->userPath();
            //     }
            // } else {
            //     return $this->userPath();
            // }
        } 

        public function validateLogin($mail, $password) {
            if ($this->isFormLoginNotEmpty($mail, $password) && $this->validateMailForm($mail)) {
                // $userTemp = new User();
                // $userTemp->setMail($mail);
                // $user = $this->userDAO->getByMail($userTemp);
                // if (($user != null) && (password_verify($password, $user->getPassword()))) {
                    // if ($user->getIsActive()) {
                        // $_SESSION["loggedUser"] = $user;
                        // if ($user->getRole() == 1) {
                            return $this->adminPath();
                //         }
                //         else if ($user->getRole() == 0) {
                //             return $this->userPath();
                //         }
                //     } else {
                //         return $this->loginPath(ACCOUNT_DISABLE);        
                //     }
                // }
                // return $this->loginPath(LOGIN_ERROR);
            }
            // return $this->loginPath(EMPTY_FIELDS);
        }        

        private function isFormLoginNotEmpty($mail, $password) {
            if (empty($mail) || empty($password)) {
                return false;
            }
            return true;
        }

        private function validateMailForm($mail) {
            return (filter_var($mail, FILTER_VALIDATE_EMAIL)) ? true : false;
        }        

        public function adminPath() {
			// if (!isset($_SESSION["loggedUser"])) {
                // $admin = $_SESSION["loggedUser"];
                // if ($admin->getRole() == 1) {
                    $title = "Dashboard";
				    require_once(VIEWS_PATH . "head.php");
				    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "dashboard.php");
                    require_once(VIEWS_PATH . "footer.php");
            //     } else {
            //         return $this->userPath();
            //     }
			// } else {
            //     return $this->userPath();
            // }
        }

		public function addAdminPath($alert = "", $success = "") {
			// if (isset($_SESSION["loggedUser"])) {
            //     $admin = $_SESSION["loggedUser"];
            //     if ($admin->getRole() == 1) {
            //         $roleController = new RoleController();
            //         $roles = $roleController->getAllRoles();
            //         if ($roles) {
                        $title = "Dashboard";
                        require_once(VIEWS_PATH . "head.php");
                        require_once(VIEWS_PATH . "sidenav.php");
                        require_once(VIEWS_PATH . "add-admin.php");
                        require_once(VIEWS_PATH . "footer.php");
            //         } else {
            //             return $this->adminPath();
            //         }
            //     } else {
            //         return $this->userPath();
            //     }
			// }
			// else {
			// 	return $this->userPath();
			// }
		}

/* 		public function adminAdd($role, $firstName, $lastName, $dni, $mail, $password) { 
            if ($this->isFormRegisterNotEmpty($firstName, $lastName, $dni, $mail, $password) && $this->validateMailForm($mail)) {
                $userTemp = new User();
                $userTemp->setMail($mail);
                if ($this->userDAO->getByMail($userTemp) == null) {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    if ($this->add($role, $firstName, $lastName, $dni, $mail, $passwordHash)) {
                        return $this->listUserPath(null, USER_ADDED);
                    } else {
                        return $this->listUserPath(DB_ERROR, null);
                    }
                }
                return $this->listUserPath(REGISTER_ERROR, null);
            }
            return $this->addUser(EMPTY_FIELDS, null);
		}  */       

        public function userPath() {
			$homeController = new HomeController();
			return $movieController->Index();
        }        

        public function logoutPath() {
            session_destroy();
            $_SESSION["loggedUser"] = null;
			return $this->userPath();
        }        

        // public function enable($dni) {
		// 	$user = new User();
		// 	$user->setDni($dni);
		// 	if ($this->userDAO->enableByDni($user)) {
		// 		return $this->listUserPath(null, USER_ENABLE);
		// 	} else {
		// 		return $this->listUserPath(DB_ERROR, null);
		// 	}
        // }
        
        // public function disable($dni) {		
        //     $admin = $_SESSION["loggedUser"];
        //     if ($admin->getDni() == $dni) {
        //         return $this->listUserPath(ELIMINATE_YOURSELF, null);
        //     } else {
        //         $user = new User();
        //         $user->setDni($dni);                
        //         $this->userDAO->disableByDni($user);
        //         return $this->listUserPath(null, USER_DISABLE);
        //     }
		// }


    }

 ?>




