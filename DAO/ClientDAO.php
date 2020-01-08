<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Client as Client;
	use Models\Admin as Admin;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ClientDAO {

		private $connection;
		private $clientList = array();
		private $tableName = "client";		

		public function __construct() { }

		
        public function add(Client $client, Admin $registerBy) {								
			try {					
				$query = "CALL client_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();
                $parameters["city"] = $client->getCity();
				$parameters["address"] = $client->getAddress();
				$parameters["stay_address"] = $client->getStayAddress();                
				$parameters["is_potential"] = $client->getIsPotential();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();
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

		public function getByIdPotential(Client $client) {
			try {				
				$userTemp = null;
				$query = "CALL client_getByIdPotential(?)";
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

		public function getByEmailPotential(Client $client) {
			try {				
				$userTemp = null;
				$query = "CALL client_getByEmailPotential(?)";
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
		
		public function getAllPotentials() {
			try {
				$query = "CALL client_getAllPotentials()";
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

		public function checkEmail(Client $client) {
			try {
				$query = "CALL client_checkEmail(?, ?)";
				$parameters["email"] = $client->getEmail();
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}
				
		public function enableById(Client $client, Admin $enableBy) {
			try {
				$query = "CALL client_enableById(?, ?, ?)";
				$parameters["id"] = $client->getId();
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

		public function disableById(Client $client, Admin $disableBy) {
			try {
				$query = "CALL client_disableById(?, ?, ?)";
				$parameters["id"] = $client->getId();
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

		public function update(Client $client, Admin $update_by) {
			try {								
				$query = "CALL client_update(?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();
                $parameters["city"] = $client->getCity();
				$parameters["address"] = $client->getAddress();
				$parameters["stay_address"] = $client->getStayAddress();                
				$parameters["is_potential"] = $client->getIsPotential(); 
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();	
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}
	
    }

 ?>