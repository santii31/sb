<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Staff as Staff;	
    use Models\Admin as Admin;	
    use DAO\QueryType as QueryType;
    use DAO\Connection as Connection;	

    class StaffDAO {

        private $connection;
        private $staffList = array();
        private $tableName = "staff";		

        public function __construct() { }

        
        public function add(Staff $staff, Admin $registerBy) {								
            try {					            
                $query = "CALL staff_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $parameters["name"] = $staff->getName();
                $parameters["lastname"] = $staff->getLastName();
                $parameters["position"] = $staff->getPosition();
                $parameters["salary"] = $staff->getSalary();
                $parameters["date_start"] = $staff->getDateStart();
                $parameters["date_end"] = $staff->getDateEnd();
                $parameters["dni"] = $staff->getDni();
                $parameters["address"] = $staff->getAddress();
                $parameters["tel"] = $staff->getPhone();
                $parameters["shirt_size"] = $staff->getShirtSize();
                $parameters["pant_size"] = $staff->getPantSize();          
                $parameters["date_register"] = date("Y-m-d");
                $parameters["register_by"] = $registerBy->getId();  
                $this->connection = Connection::getInstance();
                $this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
                return true;
            }
            catch (Exception $e) {
                return false;
                // echo $e;
            }			
        }
                    
        public function getById(Staff $staff) {
            try {				
                $staffTemp = null;
                $query = "CALL staff_getById(?)";
                $parameters["id"] = $staff->getId();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    $staffTemp = new Staff();
                    $staffTemp->setId($row["id"]);
                    $staffTemp->setName($row["name"]);
                    $staffTemp->setLastName($row["lastname"]);
                    $staffTemp->setPosition($row["position"]);
                    $staffTemp->setSalary($row["salary"]);
                    $staffTemp->setDateStart($row["date_start"]);
                    $staffTemp->setDateEnd($row["date_end"]);
                    $staffTemp->setDni($row["dni"]);
                    $staffTemp->setAddress($row["address"]);
                    $staffTemp->setPhone($row["tel"]);
                    $staffTemp->setShirtSize($row["shirt_size"]);
                    $staffTemp->setPantSize($row["pant_size"]);
                    $staffTemp->setIsActive($row["is_active"]);
                }
                return $staffTemp;
            } catch (Exception $e) {
                return false;
            }
        }

        public function getByName(Staff $staff) {
            try {				
                $staffList = array();
                $query = "CALL staff_getByName(?)";
                $parameters["name"] = $staff->getName();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);    
                    $staff->setIsActive($row["is_active"]);     
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);
                    
                    array_push($staffList, $staff);
                }
                return $staffList;
            } catch (Exception $e) {
                return false;
            }
        }

        public function getByDni(Staff $staff) {
            try {				
                $staffTemp = null;
                $query = "CALL staff_getByDni(?)";
                $parameters["dni"] = $staff->getDni();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    $staffTemp = new Staff();
                    $staffTemp->setId($row["id"]);
                    $staffTemp->setName($row["name"]);
                    $staffTemp->setLastName($row["lastname"]);
                    $staffTemp->setPosition($row["position"]);
                    $staffTemp->setSalary($row["salary"]);
                    $staffTemp->setDateStart($row["date_start"]);
                    $staffTemp->setDateEnd($row["date_end"]);
                    $staffTemp->setDni($row["dni"]);
                    $staffTemp->setAddress($row["address"]);
                    $staffTemp->setPhone($row["tel"]);
                    $staffTemp->setShirtSize($row["shirt_size"]);
                    $staffTemp->setPantSize($row["pant_size"]);
                    $staffTemp->setIsActive($row["is_active"]);
                }
                return $staffTemp;
            } catch (Exception $e) {
                return false;
            }
        }
        
        public function getAll() {
            try {
                $query = "CALL staff_getAll()";
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
                foreach ($results as $row) {
                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);
                    $staff->setIsActive($row["is_active"]);
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);

                    array_push($this->staffList, $staff);
                }
                return $this->staffList;	
            } catch (Exception $e) {
                return false;
            }
        }		

        public function getAllActives() {
            try {
                $list = array();
                $query = "CALL staff_getAllActives()";
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
                foreach ($results as $row) {
                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);
                    $staff->setIsActive($row["is_active"]);
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);

                    array_push($list, $staff);
                }
                return $list;	
            } catch (Exception $e) {
                return false;
            }
        }	
                
        public function getAllDisables() {
            try {
                $list = array();
                $query = "CALL staff_getAllDisables()";
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
                foreach ($results as $row) {
                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);
                    $staff->setIsActive($row["is_active"]);
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);

                    array_push($list, $staff);
                }
                return $list;	
            } catch (Exception $e) {
                return false;
            }
        }

        public function enableById(Staff $staff, Admin $enableBy) {
            try {
                $query = "CALL staff_enableById(?, ?, ?)";
                $parameters["id"] = $staff->getId();
                $parameters["date_enable"] = date("Y-m-d");
                $parameters["enable_by"] = $enableBy->getId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
                return true;
            }
            catch (Exception $e) {
                return false;
            }
        }

        public function disableById(Staff $staff, Admin $disableBy) {
            try {
                $query = "CALL staff_disableById(?, ?, ?)";
                $parameters["id"] = $staff->getId();
                $parameters["date_disable"] = date("Y-m-d");
                $parameters["disable_by"] = $disableBy->getId();
                $this->connection = Connection::GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
                return true;
            }
            catch (Exception $e) {
                return false;
            }
        }		
        
        public function checkDni(Staff $staff) {
            try {
                $query = "CALL staff_checkDni(?, ?)";
                $parameters["dni"] = $staff->getDni();
                $parameters["id"] = $staff->getId();
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            }
            catch (Exception $e) {
                return false;
            }
        }
        
        public function update(Staff $staff, Admin $updateBy) {
            try {								
                $query = "CALL staff_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"; 
                $parameters["name"] = $staff->getName();
                $parameters["lastname"] = $staff->getLastName();
                $parameters["position"] = $staff->getPosition();                
                $parameters["salary"] = $staff->getSalary();
                $parameters["date_start"] = $staff->getDateStart();
                $parameters["date_end"] = $staff->getDateEnd();
                $parameters["dni"] = $staff->getDni();
                $parameters["address"] = $staff->getAddress();
                $parameters["tel"] = $staff->getPhone();
                $parameters["shirt_size"] = $staff->getShirtSize();
                $parameters["pant_size"] = $staff->getPantSize(); 
                $parameters["id"] = $staff->getId(); 	
                $parameters["date_update"] = date("Y-m-d");
                $parameters["update_by"] = $updateBy->getId();
                $this->connection = Connection::GetInstance();
                return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
            } catch (Exception $e) {
                return false;
                // echo $e;
            }            
        }

        public function getActiveCount() {
            try {				
                $query = "CALL staff_getActiveCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getDisableCount() {
            try {				
                $query = "CALL staff_getDisableCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;
                // echo $ex;
            }
        }

        public function getAllActiveStaffWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL staff_getAllActiveStaffWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {

                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);
                    $staff->setIsActive($row["is_active"]);
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);

                    array_push($list, $staff);                                                
                }
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getAllDisableStaffWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL staff_getAllDisableStaffWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {

                    $staff = new Staff();
                    $staff->setId($row["id"]);
                    $staff->setName($row["name"]);
                    $staff->setLastName($row["lastname"]);
                    $staff->setPosition($row["position"]);
                    $staff->setSalary($row["salary"]);
                    $staff->setDateStart($row["date_start"]);
                    $staff->setDateEnd($row["date_end"]);
                    $staff->setDni($row["dni"]);
                    $staff->setAddress($row["address"]);
                    $staff->setPhone($row["tel"]);
                    $staff->setShirtSize($row["shirt_size"]);
                    $staff->setPantSize($row["pant_size"]);
                    $staff->setIsActive($row["is_active"]);
                    
                    $admin = new Admin();
                    $admin->setName($row["admin_name"]);
                    $admin->setLastName($row["admin_lastname"]);

                    $staff->setRegisterBy($admin);

                    array_push($list, $staff);                                                
                }
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }
    }

?>
