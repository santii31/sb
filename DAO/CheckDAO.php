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
		private $tableName = "checkC";		

		public function __construct() { }
        
        public function add(Check $check) {								
			try {													
				$query = "CALL checkC_add(?, ?, ?, ?, ?, @lastId)";
				$parameters["bank"] = $check->getBank();
				$parameters["account_number"] = $check->getAccountNumber();
				$parameters["check_number"] = $check->getCheckNumber();
				$parameters["payment_date"] = $check->getPaymentDate();
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
				$query = "CALL checkC_getById(?)";
				$parameters["id"] = $check->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$checkTemp = new Check();
                    $checkTemp->setId($row["check_id"]);
                    $checkTemp->setBank($row["check_bank"]);
                    $checkTemp->setAccountNumber($row["check_accountNumber"]);
					$checkTemp->setCheckNumber($row["check_number"]);
					$checkTemp->setCharged($row["check_charged"]);
					$checkTemp->setPaymentDate($row["check_paymentDate"]);
                    $client = new Client();
                    $client->setId($row["client_id"]);
                    $client->setName($row["client_name"]);
                    $client->setLastName($row["client_lastName"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
                    $client->setAddress($row["client_address"]);
                    $client->setIsActive($row["client_isActive"]);
                    $checkTemp->setClient($client);
				}
				return $checkTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL checkC_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$check = new Check();
                    $check->setId($row["check_id"]);
                    $check->setBank($row["check_bank"]);
                    $check->setAccountNumber($row["check_accountNumber"]);
					$check->setCheckNumber($row["check_number"]);
					$check->setCharged($row["check_charged"]);
					$check->setPaymentDate($row["check_paymentDate"]);

                    $client = new Client();
                    $client->setId($row["client_id"]);
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
				// echo $e;
			}
		}		
				
		public function getByClient(Check $check) {
			try {
				$checkTemp = array();
                $query = "CALL checkC_geByClientId(?)";
                $parameters["id"] = $check->getId();			
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$check = new Check();
                    $check->setId($row["checkC_id"]);
                    $check->setBank($row["checkC_bank"]);
                    $check->setAccountNumber($row["checkC_accountNumber"]);
					$check->setCheckNumber($row["check_number"]);
					$check->setCharged($row["check_charged"]);
					$check->setPaymentDate($row["check_paymentDate"]);
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
                $query = "CALL checkC_geByBank(?)";
                $parameters["bank"] = $bank;			
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$check = new Check();
                    $check->setId($row["checkC_id"]);
                    $check->setBank($row["checkC_bank"]);
                    $check->setAccountNumber($row["checkC_accountNumber"]);
					$check->setCheckNumber($row["check_number"]);
					$check->setCharged($row["check_charged"]);
					$check->setPaymentDate($row["check_paymentDate"]);
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
		
		public function update(Check $check) {
			try {								
				$query = "CALL checkC_update(?, ?, ?, ?, ?, ?)";		
				$parameters["bank"] = $check->getBank();
				$parameters["account_number"] = $check->getAccountNumber();
				$parameters["check_number"] = $check->getCheckNumber();
				$parameters["charged"] = $check->getCharged();
				$parameters["payment_date"] = $check->getPaymentDate();
				$parameters["id"] = $check->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}
	
    }

 ?>