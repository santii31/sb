<?php

    namespace DAO;

	use \Exception as Exception;
	
	use \PDOException as PDOException;

    use Models\Admin as Admin;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdminDAO {

		private $connection;
		private $adminList = array();
		private $tableName = "admin";		

		public function __construct() { }

		
        public function add(Admin $admin, Admin $registerBy) {								
			try {					
				$query = "CALL admin_add(?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $admin->getName();
				$parameters["lastname"] = $admin->getLastName();
				$parameters["email"] = $admin->getEmail();
				$parameters["dni"] = $admin->getDni();
				$parameters["password"] = $admin->getPassword();
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
					
		public function getById(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getById(?)";
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByDni(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getByDni(?)";
				$parameters["dni"] = $admin->getDni();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}		

		public function getByEmail(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getByEmail(?)";
				$parameters["email"] = $admin->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL admin_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);
					$admin->setPassword($row["password"]);				
					$admin->setIsActive($row["is_active"]);
					array_push($this->adminList, $admin);
				}
				return $this->adminList;	
			} catch (Exception $e) {
				return false;
			}
		}		
		
		public function getAllActives() {
			try {
				$list = array();
				$query = "CALL admin_getAllActives()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);
					$admin->setPassword($row["password"]);				
					$admin->setIsActive($row["is_active"]);
					array_push($list, $admin);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function enableById(Admin $admin, Admin $enableBy) {
			try {
				$query = "CALL admin_enableById(?, ?, ?)";
				$parameters["id"] = $admin->getId();
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

		public function disableById(Admin $admin, Admin $disableBy) {
			try {
				$query = "CALL admin_disableById(?, ?, ?)";
				$parameters["id"] = $admin->getId();
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
		
		public function checkEmail(Admin $admin) {
			try {
				$query = "CALL admin_checkEmail(?, ?)";
				$parameters["email"] = $admin->getEmail();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function checkDni(Admin $admin) {
			try {
				$query = "CALL admin_checkDni(?, ?)";
				$parameters["dni"] = $admin->getDni();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function update(Admin $admin, Admin $updateBy) {
			try {								
				$query = "CALL admin_update(?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $admin->getName();
				$parameters["lastname"] = $admin->getLastName();
				$parameters["dni"] = $admin->getDni();
				$parameters["email"] = $admin->getEmail();                	
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}
		
		public function getEmails() {
			try {
				$emails = array();
				$query = "CALL admin_getEmails()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$email =  $row["email"];										
					array_push($emails, $email);
				}
				return $emails;	
			} catch (Exception $e) {
				return false;				
			}
		}		

    }

 ?>
