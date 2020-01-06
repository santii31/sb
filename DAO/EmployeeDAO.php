a<?php

namespace DAO;

use \Exception as Exception;
use Models\Employee as Employee;	
use DAO\QueryType as QueryType;
use DAO\Connection as Connection;	

class EmployeeDAO {

    private $connection;
    private $employeeList = array();
    private $tableName = "employee";		

    public function __construct() {

    }

    public function add(Employee $employee) {								
        try {					
            $query = "CALL employee_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $parameters["name"] = $employee->getName();
            $parameters["lastname"] = $employee->getLastName();
            $parameters["position"] = $employee->getPosition();
            $parameters["date_start"] = $employee->getDateStart();
            $parameters["date_end"] = $employee->getDateEnd();
            $parameters["dni"] = $employee->getDni();
            $parameters["address"] = $employee->getAddress();
            $parameters["tel"] = $employee->getPhone();
            $parameters["shirt_size"] = $employee->getShirtSize();
            $parameters["pant_size"] = $employee->getPantSize();
            $parameters["is_active"] = $employee->getIsActive();
            $this->connection = Connection::getInstance();
            $this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
            return true;
        }
        catch (Exception $e) {
            return false;
        }			
    }
                
    public function getById(Employee $employee) {
        try {				
            $employeeTemp = null;
            $query = "CALL employee_getById(?)";
            $parameters["id"] = $employee->getId();
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
            foreach ($results as $row) {
                $employeeTemp = new Employee();
                $employeeTemp->setId($row["id"]);
                $employeeTemp->setName($row["name"]);
                $employeeTemp->setLastName($row["lastname"]);
                $employeeTemp->setPosition($row["position"]);
                $employeeTemp->setDateStart($row["date_start"]);
                $employeeTemp->setDateEnd($row["date_end"]);
                $employeeTemp->setDni($row["dni"]);
                $employeeTemp->setAddress($row["address"]);
                $employeeTemp->setPhone($row["phone"]);
                $employeeTemp->setShirtSize($row["shirt_size"]);
                $employeeTemp->setPantSize($row["pant_size"]);
                $employeeTemp->setIsActive($row["is_active"]);
            }
            return $userTemp;
        } catch (Exception $e) {
            return false;
        }
    }


    public function getByDni(Employee $employee) {
        try {				
            $employeeTemp = null;
            $query = "CALL employee_getByDni(?)";
            $parameters["dni"] = $employee->getDni();
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
            foreach ($results as $row) {
                $employeeTemp = new Employee();
                $employeeTemp->setId($row["id"]);
                $employeeTemp->setName($row["name"]);
                $employeeTemp->setLastName($row["lastname"]);
                $employeeTemp->setPosition($row["position"]);
                $employeeTemp->setDateStart($row["date_start"]);
                $employeeTemp->setDateEnd($row["date_end"]);
                $employeeTemp->setDni($row["dni"]);
                $employeeTemp->setAddress($row["address"]);
                $employeeTemp->setPhone($row["phone"]);
                $employeeTemp->setShirtSize($row["shirt_size"]);
                $employeeTemp->setPantSize($row["pant_size"]);
                $employeeTemp->setIsActive($row["is_active"]);
            }
            return $userTemp;
        } catch (Exception $e) {
            return false;
        }
    }

    
    public function getAll() {
        try {
            $query = "CALL employee_getAll()";
            $this->connection = Connection::GetInstance();
            $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
            foreach ($results as $row) {
                $employee = new Employee();
                $employee->setId($row["id"]);
                $employee->setName($row["name"]);
                $employee->setLastName($row["lastname"]);
                $employee->setPosition($row["position"]);
                $employee->setDateStart($row["date_start"]);
                $employee->setDateEnd($row["date_end"]);
                $employee->setDni($row["dni"]);
                $employee->setAddress($row["address"]);
                $employee->setPhone($row["phone"]);
                $employee->setShirtSize($row["shirt_size"]);
                $employee->setPantSize($row["pant_size"]);
                $employee->setIsActive($row["is_active"]);
                array_push($this->employeeList, $employee);
            }
            return $this->employeeList;	
        } catch (Exception $e) {
            return false;
        }
    }		
            
    public function enableById(Employee $employee) {
        try {
            $query = "CALL employee_enableById(?)";
            $parameters["id"] = $employee->getId();
            $this->connection = Connection::GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }

    public function disableById(Employee $employee) {
        try {
            $query = "CALL employee_disableById(?)";
            $parameters["id"] = $employee->getId();
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
