<?php

    namespace Controllers;    

    use Models\Staff as Staff;
    use Controllers\AdminController as AdminController;  
    // use DAO\StaffDAO as StaffDAO;

    class StaffController {

        private $staffDAO;
        private $adminController;

        public function __construct() {
            // $this->staffDAO = new StaffDAO();
            $this->adminController = new AdminController();
        }     
        
        private function add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            $staff = new Staff();            
            $staff->setName( strtolower($name) );
            $staff->setLastName( strtolower($lastName) );
            $staff->setPhone($phone);
            $staff->setEmail($email);
            $staff->setDni($dni);
            $staff->setBilling( strtolower($billing) );
            $staff->setCuilNumber($cuil_number);
            $staff->setSocialReason( strtolower($social_reason) );
            $staff->setAddress( strtolower($address) );         
            
            if ($this->staffDAO->add($staff)) {
                return true;
            } else {
                return false;
            }
        }

        public function addStaff($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address) {
            if ($this->isFormRegisterNotEmpty($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address)) {
                $staffTemp = new Staff();
                $staffTemp->setDni($dni);                
                
				if ($this->staffDAO->getByDni($staffTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $phone, $email, $dni, $billing, $cuil_number, $social_reason, $address)) {        
                        return $this->addStaffPath(null, STAFF_ADDED);
                    } else {                        
                        return $this->addStaffPath(DB_ERROR, null);        
                    }
                }                
                return $this->addStaffPath(STAFF_ERROR, null);
            }            
            return $this->addStaffPath(EMPTY_FIELDS, null);            
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

        public function addStaffPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Añadir empleado";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-staff.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
		}

        public function listStaffPath($alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Empleados";
                // $staffs = $this->staffDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-staff.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

    }
    
?>