<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\ClientPotential as ClientPotential;
	use Models\Admin as Admin;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ClientPotentialDAO {

		private $connection;
		private $clientPotentialList = array();
		private $tableName = "client_potential_potential";		

		public function __construct() { }

		
        public function add(ClientPotential $client, Admin $registerBy) {								
			try {					
				$query = "CALL client_potential_add(?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();
				$parameters["address"] = $client->getAddress();
                $parameters["city"] = $client->getCity();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();				   
				$parameters["num_tent"] = $client->getNumTent();
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

		public function getById(ClientPotential $client) {
			try {				
				$clientP = null;
				$query = "CALL client_potential_getById(?)";
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$clientP = new ClientPotential();
					$clientP->setId($row["id"]);
					$clientP->setName($row["name"]);
					$clientP->setLastName($row["lastname"]);
					$clientP->setAddress($row["address"]);
					$clientP->setCity($row["city"]);				
					$clientP->setEmail($row["email"]);
					$clientP->setPhone($row["tel"]);
					$clientP->setNumTent($row["num_tent"]);
                    $clientP->setIsActive($row["is_active"]);                    
				}
				return $clientP;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByName(ClientPotential $client) {
			try {				
				$clientList = array();
				$query = "CALL client_potential_getByName(?)";
				$parameters["name"] = $client->getName();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$client = new ClientPotential();
					$client->setId($row["id"]);
					$client->setName($row["name"]);
					$client->setLastName($row["lastname"]);
					$client->setAddress($row["address"]);
					$client->setCity($row["city"]);				
					$client->setEmail($row["email"]);
					$client->setPhone($row["tel"]);
					$client->setNumTent($row["num_tent"]);
					$client->setIsActive($row["is_active"]);                    
					array_push($clientList, $client);
				}
				return $clientList;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

        public function getByEmail(ClientPotential $client) {
			try {				
				$clientP = null;
				$query = "CALL client_potential_getByEmail(?)";
				$parameters["email"] = $client->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$clientP = new ClientPotential();
					$clientP->setId($row["id"]);
					$clientP->setName($row["name"]);
					$clientP->setLastName($row["lastname"]);
					$clientP->setAddress($row["address"]);
					$clientP->setCity($row["city"]);				
					$clientP->setEmail($row["email"]);
					$clientP->setPhone($row["tel"]);
					$clientP->setNumTent($row["num_tent"]);
                    $clientP->setIsActive($row["is_active"]); 
				}
				return $clientP;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getAll() {
			try {
				$query = "CALL client_potential_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$clientP = new ClientPotential();
					$clientP->setId($row["id"]);
					$clientP->setName($row["name"]);
					$clientP->setLastName($row["lastname"]);
					$clientP->setAddress($row["address"]);
					$clientP->setCity($row["city"]);				
					$clientP->setEmail($row["email"]);
					$clientP->setPhone($row["tel"]);
					$clientP->setNumTent($row["num_tent"]);
                    $clientP->setIsActive($row["is_active"]); 
					array_push($this->clientPotentialList, $clientP);
				}
				return $this->clientPotentialList;	
			} catch (Exception $e) {
				return false;				
			}
		}

		public function getAllActives() {
			try {
				$list = array();
				$query = "CALL client_potential_getAllActives()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$clientP = new ClientPotential();
					$clientP->setId($row["id"]);
					$clientP->setName($row["name"]);
					$clientP->setLastName($row["lastname"]);
					$clientP->setAddress($row["address"]);
					$clientP->setCity($row["city"]);				
					$clientP->setEmail($row["email"]);
					$clientP->setPhone($row["tel"]);
					$clientP->setNumTent($row["num_tent"]);
                    $clientP->setIsActive($row["is_active"]); 
					array_push($list, $clientP);
				}
				return $list;	
			} catch (Exception $e) {
				return false;				
			}
		}
		
		public function checkEmail(ClientPotential $client) {
			try {
				$query = "CALL client_potential_checkEmail(?, ?)";
				$parameters["email"] = $client->getEmail();
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}
				
		public function enableById(ClientPotential $client, Admin $enableBy) {
			try {
				$query = "CALL client_potential_enableById(?, ?, ?)";
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

		public function disableById(ClientPotential $client, Admin $disableBy) {
			try {
				$query = "CALL client_potential_disableById(?, ?, ?)";
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

		public function update(ClientPotential $client, Admin $updateBy) {
			try {								
				$query = "CALL client_potential_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();
				$parameters["address"] = $client->getAddress();
                $parameters["city"] = $client->getCity();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();				   
				$parameters["num_tent"] = $client->getNumTent();            		
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();	
				$parameters["id"] = $client->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}

		public function getEmails() {
			try {
				$emails = array();
				$query = "CALL client_potential_getEmails()";
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