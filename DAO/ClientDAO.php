<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Client as Client;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ClientDAO {

		private $connection;
		private $clientList = array();
		private $tableName = "client";		

		public function __construct() { }

        public function add(Client $client) {								
			try {					
				$query = "CALL client_add(?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();
                $parameters["city"] = $client->getCity();
				$parameters["address"] = $client->getAddress();
				$parameters["stay_address"] = $client->getStayAddress();                
                $parameters["is_potential"] = $client->getIsPotential();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getById(Client $client) {
			try {				
				$userTemp = null;
				$query = "CALL client_getById(?)";
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Client();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setPhone($row["tel"]);
					$userTemp->setCity($row["city"]);				
					$userTemp->setAddress($row["address"]);
					$userTemp->setStayAddress($row["stay_address"]);
                    $userTemp->setIsActive($row["is_active"]);
                    $userTemp->setIsPotential($row["is_potential"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}


        public function getByEmail(Client $client) {
			try {				
				$userTemp = null;
				$query = "CALL client_getByEmail(?)";
				$parameters["email"] = $client->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Client();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setPhone($row["tel"]);
					$userTemp->setCity($row["city"]);				
					$userTemp->setAddress($row["address"]);
					$userTemp->setStayAddress($row["stay_address"]);
                    $userTemp->setIsActive($row["is_active"]);
                    $userTemp->setIsPotential($row["is_potential"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL client_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$client = new Client();
					$client->setId($row["id"]);
					$client->setName($row["name"]);
					$client->setLastName($row["lastname"]);
					$client->setEmail($row["email"]);
					$client->setPhone($row["tel"]);
					$client->setCity($row["city"]);				
					$client->setAddress($row["address"]);
					$client->setStayAddress($row["stay_address"]);
                    $client->setIsActive($row["is_active"]);
                    $client->setIsPotential($row["is_potential"]);
					array_push($this->clientList, $client);
				}
				return $this->clientList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(Client $client) {
			try {
				$query = "CALL client_enableById(?)";
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Client $client) {
			try {
				$query = "CALL client_disableById(?)";
				$parameters["id"] = $client->getId();
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
