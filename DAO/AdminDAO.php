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
						
		public function getByMail(Admin $admin) {
			try {
				// $adminTemp = null;
				$query = "CALL admin_getByMail(?)";
				$parameters["mail"] = $admin->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);						
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setName($row["name"]);
					$admin->setLastName($row["last_name"]);
					$admin->setMail($row["mail"]);
					$admin->setDni($row["dni"]);
					$admin->setPassword($row["password"]);				
					$admin->setIsActive($row["is_active"]);
				}
				return $admin;
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
					$admin->setName($row["name"]);
					$admin->setLastName($row["last_name"]);
					$admin->setMail($row["mail"]);
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
				
		public function enableByEmail(Admin $admin) {
			try {
				$query = "CALL admin_enableByEmail(?)";
				$parameters ["email"] = $admin->getEmail();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableByEmail(Admin $admin) {
			try {
				$query = "CALL admin_disableByEmail(?)";
				$parameters ["email"] = $admin->getEmail();
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
