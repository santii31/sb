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

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $position_s = filter_var($position, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);

            $staff = new Staff();            
            $staff->setName( strtolower($name_s) );
            $staff->setLastName( strtolower($lastName_s) );
            $staff->setPosition( strtolower($position_s) );
            $staff->setDateStart($date_start);
            $staff->setDateEnd($date_end);
            $staff->setDni($dni);
            $staff->setAddress( strtolower($address_s) );
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
           
            if ($this->isFormRegisterNotEmpty($name, $lastName, $position, $date_start, $date_end, $dni, 
                                                $address, $phone, $shirt_size, $pant_size)) {

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

        private function isFormRegisterNotEmpty($name, $lastName, $position, $date_start, $date_end, $dni, 
                                                $address, $phone, $shirt_size, $pant_size) {

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
                $staffs = $this->staffDAO->getAll();
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-staff.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $staff = new Staff();
                $staff->setId($id);
                if ($this->staffDAO->enableById($staff)) {
                    return $this->listStaffPath(null, STAFF_ENABLE);
                } else {
                    return $this->listStaffPath(DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $staff = new Staff();
                $staff->setId($id);
                if ($this->staffDAO->disableById($staff)) {
                    return $this->listStaffPath(null, STAFF_DISABLE);
                } else {
                    return $this->listStaffPath(DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }

        public function updatePath($id_staff, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Modificar informacion";       
                $staffTemp = new Staff();
                $staffTemp->setId($id_staff);                
                $staff = $this->staffDAO->getById($staffTemp);                    
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "update-staff.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }           
        }        

        public function update($id, $name, $lastName, $position, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size) {      
            
            if ($this->isFormRegisterNotEmpty($name, $lastName, $position, $date_start, $date_end, $dni, 
                                                $address, $phone, $shirt_size, $pant_size)) {     
                
                $staffTemp = new Staff();
                $staffTemp->setId($id);                
                $staffTemp->setDni($dni);

				if ($this->staffDAO->checkDni($staffTemp) == null) {                                                                             
                    
                    $name_s = filter_var($name, FILTER_SANITIZE_STRING);
                    $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
                    $position_s = filter_var($position, FILTER_SANITIZE_STRING);
                    $address_s = filter_var($address, FILTER_SANITIZE_STRING);

                    $staff = new Staff();
                    $staff->setId($id);  
                    $staff->setName( strtolower($name_s) );
                    $staff->setLastName( strtolower($lastName_s) );
                    $staff->setPosition( strtolower($position_s) );
                    $staff->setDateStart($date_start);
                    $staff->setDateEnd($date_end);
                    $staff->setDni($dni);
                    $staff->setAddress( strtolower($address_s) );
                    $staff->setPhone($phone);
                    $staff->setShirtSize($shirt_size);
                    $staff->setPantSize($pant_size);   

                    if ($this->staffDAO->update($staff)) {                                                
                        return $this->listStaffPath(null, STAFF_UPDATE);
                    } else {                        
                        return $this->listStaffPath(DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, DNI_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }        

    }
    
?>