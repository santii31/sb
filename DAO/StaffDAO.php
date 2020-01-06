<?php

namespace DAO;

use \Exception as Exception;
use Models\Staff as Staff;	
use DAO\QueryType as QueryType;
use DAO\Connection as Connection;	

class StaffDAO {

    private $connection;
    private $staffList = array();
    private $tableName = "staff";		

    public function __construct() {

    }

    public function add(Staff $staff) {								
        try {					
            $query = "CALL staff_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $parameters["name"] = $staff->getName();
            $parameters["lastname"] = $staff->getLastName();
            $parameters["position"] = $staff->getPosition();
            $parameters["date_start"] = $staff->getDateStart();
            $parameters["date_end"] = $staff->getDateEnd();
            $parameters["dni"] = $staff->getDni();
            $parameters["address"] = $staff->getAddress();
            $parameters["tel"] = $staff->getPhone();
            $parameters["shirt_size"] = $staff->getShirtSize();
            $parameters["pant_size"] = $staff->getPantSize();
            $parameters["is_active"] = $staff->getIsActive();
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
            return true;
        }
        catch (Exception $e) {
            return false;
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
                $staffTemp->setDateStart($row["date_start"]);
                $staffTemp->setDateEnd($row["date_end"]);
                $staffTemp->setDni($row["dni"]);
                $staffTemp->setAddress($row["address"]);
                $staffTemp->setPhone($row["phone"]);
                $staffTemp->setShirtSize($row["shirt_size"]);
                $staffTemp->setPantSize($row["pant_size"]);
                $staffTemp->setIsActive($row["is_active"]);
            }
            return $staffTemp;
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
                $staffTemp->setDateStart($row["date_start"]);
                $staffTemp->setDateEnd($row["date_end"]);
                $staffTemp->setDni($row["dni"]);
                $staffTemp->setAddress($row["address"]);
                $staffTemp->setPhone($row["phone"]);
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
                $staff->setDateStart($row["date_start"]);
                $staff->setDateEnd($row["date_end"]);
                $staff->setDni($row["dni"]);
                $staff->setAddress($row["address"]);
                $staff->setPhone($row["phone"]);
                $staff->setShirtSize($row["shirt_size"]);
                $staff->setPantSize($row["pant_size"]);
                $staff->setIsActive($row["is_active"]);
                array_push($this->staffList, $staff);
            }
            return $this->staffList;	
        } catch (Exception $e) {
            return false;
        }
    }		
            
    public function enableById(Staff $staff) {
        try {
            $query = "CALL staff_enableById(?)";
            $parameters["id"] = $staff->getId();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function disableById(Staff $staff) {
        try {
            $query = "CALL staff_disableById(?)";
            $parameters["id"] = $staff->getId();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }		

    /*
    public function updateUser(User $user) {
        try {								
            $query = "UPDATE " . $this->tableName . " AS user 
                                                      INNER JOIN profile_users AS p_user ON user.FK_dni =  p_user.dni
                                                     SET
                                                         user.mail = :mail,
                                                         user.password = :password,
                                                         p_user.dni = :dni,
                                                         p_user.first_name = :firstname,
                                                         p_user.last_name = :lastname
                                                      WHERE 
                                                         p_user.dni = :dni";					
            
            $parameters["mail"] = $user->getMail();
            $parameters["password"] = $user->getPassword();
            $parameters["dni"] = $user->getDni();
            $parameters["firstname"] = $user->getFirstName();
            $parameters["lastname"] = $user->getLastName();				

            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);								
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
    */

}

?>
