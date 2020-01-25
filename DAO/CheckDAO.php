<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Check as Check;	
    use Models\Client as Client;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class CheckDAO {

		private $connection;
		private $checkList = array();
		private $tableName = "check";		

		public function __construct() { }
        
        public function add(Check $check) {								
			try {													
				$query = "CALL check_add(?, ?, ?, ?, @lastId)";
				$parameters["bank"] = $check->getBank();
				$parameters["account_number"] = $check->getAccountNumber();
				$parameters["check_number"] = $check->getCheckNumber();
				$parameters["FK_id_client"] = $check->getClient()->getId();
				
				$this->connection = Connection::getInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

				foreach ($results as $row) {
                    $lastId = $row['lastId'];                
                }
				return $lastId;
			}
			catch (Exception $e) {
				return false;				
				// echo $e;
			}			
        }
					
		public function getById(Check $check) {
			try {				
				$checkTemp = null;
				$query = "CALL check_getById(?)";
				$parameters["id"] = $check->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$checkTemp = new Check();
                    $checkTemp->setId($row["id"]);
                    $checkTemp->setBank($row["bank"]);
                    $checkTemp->setAccountNumber($row["account_number"]);
                    $checkTemp->setCheckNumber($row["check_number"]);
                    $client = new Client();
                    $client->set($row["client_id"]);
                    $client->setName($row["client_name"]);
                    $client->setLastName($row["client_lastName"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
                    $client->setAddress($row["client_address"]);
                    $client->setIsActive($row["client_isActive"]);
                    $checkTemp->setClient($client);
				}
				return $clientTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL check_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$check = new Check();
                    $check->setId($row["id"]);
                    $check->setBank($row["bank"]);
                    $check->setAccountNumber($row["account_number"]);
                    $check->setCheckNumber($row["check_number"]);
                    $client = new Client();
                    $client->set($row["client_id"]);
                    $client->setName($row["client_name"]);
                    $client->setLastName($row["client_lastName"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
                    $client->setAddress($row["client_address"]);
                    $client->setIsActive($row["client_isActive"]);
                    $check->setClient($client);
                    
					array_push($this->checkList, $check);
				}
				return $this->checkList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function getByClient(Check $check) {
			try {
				$checkTemp = array();
                $query = "CALL check_geByClientId(?)";
                $parameters["id"] = $check->getId();			
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$check = new Check();
                    $check->setId($row["id"]);
                    $check->setBank($row["bank"]);
                    $check->setAccountNumber($row["account_number"]);
                    $check->setCheckNumber($row["check_number"]);
                    $client = new Client();
                    $client->set($row["client_id"]);
                    $client->setName($row["client_name"]);
                    $client->setLastName($row["client_lastName"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
                    $client->setAddress($row["client_address"]);
                    $client->setIsActive($row["client_isActive"]);
                    $check->setClient($client);
					array_push($checkTemp, $check);
				}
				return $checkTemp;	
			} catch (Exception $e) {
				return false;								
			}
        }
        
        public function getByBank($bank) {
			try {
				$checkTemp = array();
                $query = "CALL check_geByBank(?)";
                $parameters["bank"] = $bank;			
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$check = new Check();
                    $check->setId($row["id"]);
                    $check->setBank($row["bank"]);
                    $check->setAccountNumber($row["account_number"]);
                    $check->setCheckNumber($row["check_number"]);
                    $client = new Client();
                    $client->set($row["client_id"]);
                    $client->setName($row["client_name"]);
                    $client->setLastName($row["client_lastName"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
                    $client->setAddress($row["client_address"]);
                    $client->setIsActive($row["client_isActive"]);
                    $check->setClient($client);
					array_push($checkTemp, $check);
				}
				return $checkTemp;	
			} catch (Exception $e) {
				return false;								
			}
        }
	
    }

 ?>