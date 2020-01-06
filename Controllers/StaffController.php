<?php

    namespace Controllers;    

    use Models\Staff as Staff;
    use Controllers\AdminController as AdminController;  
    use DAO\StaffDAO as StaffDAO;

    class StaffController {

        private $staffDAO;
        private $adminController;

        public function __construct() {
            $this->staffDAO = new StaffDAO();
            $this->adminController = new AdminController();
        }     
        
        private function add($name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size) {
            $staff = new Staff();            
            $staff->setName( strtolower($name) );
            $staff->setLastName( strtolower($lastName) );
            $staff->setPosition($position);
            $staff->setDateStart($date_start);
            $staff->setDateEnd($date_end);
            $staff->setDni($dni);
            $staff->setAddress( strtolower($address) );
            $staff->setPhone($phone);
            $staff->setShirtSize($shirt_size);
            $staff->setPantSize($pant_size);                        
            
            if ($this->staffDAO->add($staff)) {
                return true;
            } else {
                return false;
            }
        }

        public function addStaff($name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size) {
            if ($this->isFormRegisterNotEmpty($name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size)) {

                $staffTemp = new Staff();
                $staffTemp->setDni($dni);                
                
				if ($this->staffDAO->getByDni($staffTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size)) {      
                        return $this->addStaffPath(null, STAFF_ADDED);
                    } else {                        
                        return $this->addStaffPath(DB_ERROR, null);        
                    }
                }                
                return $this->addStaffPath(STAFF_ERROR, null);
            }            
            return $this->addStaffPath(EMPTY_FIELDS, null);            
        }

        private function isFormRegisterNotEmpty($name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size) {
            if (empty($name) || 
                empty($lastName) || 
                empty($position) || 
                empty($date_start) || 
                empty($date_end) || 
                empty($dni) || 
                empty($address) || 
                empty($phone) || 
                empty($shirt_size) || 
                empty($pant_size)) {
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