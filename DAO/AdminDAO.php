<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Admin as Admin;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdminDAO {

		private $connection;
		private $adminList = array();
		private $tableName = "admin";		

		public function __construct() {

		}

        public function add(Admin $admin) {								
			try {					
				$query = "CALL admin_add(?, ?, ?, ?, ?)";
				$parameters["name"] = $admin->getName();
				$parameters["lastname"] = $admin->getLastName();
				$parameters["email"] = $admin->getEmail();
				$parameters["dni"] = $admin->getDni();
				$parameters["password"] = $admin->getPassword();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
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
				
		public function enableById(Admin $admin) {
			try {
				$query = "CALL admin_enableById(?)";
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Admin $admin) {
			try {
				$query = "CALL admin_disableById(?)";
				$parameters["id"] = $admin->getId();
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
