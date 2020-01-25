<?php

    namespace Controllers;    

    use Models\Staff as Staff;
    use DAO\StaffDAO as StaffDAO;
    use Controllers\AdminController as AdminController;  

    class StaffController {

        private $staffDAO;
        private $adminController;

        public function __construct() {
            $this->staffDAO = new StaffDAO();
            $this->adminController = new AdminController();
        }     
        
        
        private function add($name, $lastName, $position, $salary, $date_start, $date_end, $dni, $address, $phone, $shirt_size, $pant_size) {

            $name_s = filter_var($name, FILTER_SANITIZE_STRING);
            $lastname_s = filter_var($lastName, FILTER_SANITIZE_STRING);
            $position_s = filter_var($position, FILTER_SANITIZE_STRING);
            $address_s = filter_var($address, FILTER_SANITIZE_STRING);

            $staff = new Staff();            
            $staff->setName( strtolower($name_s) );
            $staff->setLastName( strtolower($lastname_s) );
            $staff->setPosition( strtolower($position_s) );
            $staff->setSalary($salary);
            $staff->setDateStart($date_start);
            $staff->setDateEnd($date_end);
            $staff->setDni($dni);
            $staff->setAddress( strtolower($address_s) );
            $staff->setPhone($phone);
            $staff->setShirtSize($shirt_size);
            $staff->setPantSize($pant_size);                        
            
            $register_by = $this->adminController->isLogged();

            if ($this->staffDAO->add($staff, $register_by)) {
                return true;
            } else {
                return false;
            }
        }

        public function addStaff($name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
                                 $address, $phone, $shirt_size, $pant_size) {
           
            // Saves the inputs in case of validation error
            $inputs = array(
                "name"=> $name, 
                "lastName"=> $lastName,
                "position"=> $position,
                "salary"=> $salary,
                "date_start"=> $date_start,
                "date_end"=> $date_end,
                "dni"=> $dni,
                "address"=> $address,
                "phone"=> $phone,
                "shirt_size"=> $shirt_size,
                "pant_size"=> $pant_size
            );

            if ($this->isFormRegisterNotEmpty($name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
                                              $address, $phone, $shirt_size, $pant_size)) {

                $staffTemp = new Staff();
                $staffTemp->setDni($dni);                
                
				if ($this->staffDAO->getByDni($staffTemp) == null) {                                                            
                    if ($this->add($name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
                                   $address, $phone, $shirt_size, $pant_size)) {      

                        return $this->addStaffPath(null, STAFF_ADDED);

                    } else {                        
                        return $this->addStaffPath(DB_ERROR, null, $inputs);        
                    }
                }                
                return $this->addStaffPath(STAFF_ERROR, null, $inputs);
            }                 
            return $this->addStaffPath(EMPTY_FIELDS, null, $inputs);            
        }

        private function isFormRegisterNotEmpty($name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
                                                $address, $phone, $shirt_size, $pant_size) {

            if (empty($name) || 
                empty($lastName) || 
                empty($position) || 
                empty($salary) || 
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

        public function addStaffPath($alert = "", $success = "", $inputs = array()) {
            if ($admin = $this->adminController->isLogged()) {                         
                $title = "Personal - Añadir";
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "add-staff.php");
                require_once(VIEWS_PATH . "footer.php");                
			} else {
				return $this->adminController->userPath();
			}
		}

        public function listStaffPath($showAll = null, $alert = "", $success = "") {
            if ($admin = $this->adminController->isLogged()) {
                $title = "Personal";
                if ($showAll != null) {
                    $staffs = $this->staffDAO->getAll();
                } else {
                    $staffs = $this->staffDAO->getAllActives();                    
                }                 
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "list-staff.php");
                require_once(VIEWS_PATH . "footer.php");
            } else {
                return $this->adminController->userPath();
            }
        } 

        public function searchPath($alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Personal - Buscar";                       
                require_once(VIEWS_PATH . "head.php");
                require_once(VIEWS_PATH . "sidenav.php");
                require_once(VIEWS_PATH . "search-staff.php");
                require_once(VIEWS_PATH . "footer.php");                
            } else {
                return $this->adminController->userPath();
            }   
        }

        public function search($value) {                              
            if ($admin = $this->adminController->isLogged()) { 
                if (!empty($value)) {
                    return $this->searchByName($value);                    
                }
                return $this->searchPath(EMPTY_FIELDS);
            } else {
                return $this->adminController->userPath();
            }           
        }

        private function searchByName($name) {
            if ($admin = $this->adminController->isLogged()) {     
                $title = "Personal - Buscar por nombre";
                $staff = new Staff();
                $staff->setName( strtolower($name) );                       
                $staffs = $this->staffDAO->getByName($staff);
                if (sizeof($staffs) > 0) {
                    require_once(VIEWS_PATH . "head.php");
                    require_once(VIEWS_PATH . "sidenav.php");
                    require_once(VIEWS_PATH . "list-search-staff.php");
                    require_once(VIEWS_PATH . "footer.php");
                } else {
                    return $this->searchPath(SEARCH_STAFF_EMPTY);
                }                
            } else {
                return $this->adminController->userPath();
            } 
        }

        public function enable($id) {
            if ($admin = $this->adminController->isLogged()) {
                $staff = new Staff();
                $staff->setId($id);
                if ($this->staffDAO->enableById($staff, $admin)) {
                    return $this->listStaffPath(null, null, STAFF_ENABLE);
                } else {
                    return $this->listStaffPath(null, DB_ERROR, null);
                }
            } else {
                return $this->adminController->userPath();
            }
        }       

        public function disable($id) {		
            if ($admin = $this->adminController->isLogged()) {
                $staff = new Staff();
                $staff->setId($id);
                if ($this->staffDAO->disableById($staff, $admin)) {
                    return $this->listStaffPath(null, null, STAFF_DISABLE);
                } else {
                    return $this->listStaffPath(null, DB_ERROR, null);
                }              
            } else {
                return $this->adminController->userPath();
            }                
        }

        public function updatePath($id_staff, $alert = "") {
            if ($admin = $this->adminController->isLogged()) {      
                $title = "Personal - Modificar informacion";       
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

        public function update($id, $name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
                               $address, $phone, $shirt_size, $pant_size) {      
            
            if ($this->isFormRegisterNotEmpty($name, $lastName, $position, $salary, $date_start, $date_end, $dni, 
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
                    $staff->setLastName( strtolower($lastname_s) );
                    $staff->setPosition( strtolower($position_s) );
                    $staff->setSalary($salary);
                    $staff->setDateStart($date_start);
                    $staff->setDateEnd($date_end);
                    $staff->setDni($dni);
                    $staff->setAddress( strtolower($address_s) );
                    $staff->setPhone($phone);
                    $staff->setShirtSize($shirt_size);
                    $staff->setPantSize($pant_size);   

                    $update_by = $this->adminController->isLogged();

                    if ($this->staffDAO->update($staff, $update_by)) {                                                
                        return $this->listStaffPath(null, null, STAFF_UPDATE);
                    } else {                        
                        return $this->listStaffPath(null, DB_ERROR, null);        
                    }
                }                
                return $this->updatePath($id, DNI_ERROR);
            }            
            return $this->updatePath($id ,EMPTY_FIELDS);
        }        


        // 
        public function getAllStaff() {
            return $this->staffDAO->getAll();
        }

    }
    
?>