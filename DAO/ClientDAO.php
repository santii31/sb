<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Admin as Admin;	
	use Models\Client as Client;	
	use Models\BeachTent as BeachTent;
	use Models\Reservation as Reservation;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ClientDAO {

		private $connection;
		private $clientList = array();
		private $tableName = "client";		

		public function __construct() { }

		
        public function add(Client $client, Admin $registerBy) {								
			try {									
				$query = "CALL client_add(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, @lastId)";
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();				
				$parameters["address"] = $client->getAddress();
				$parameters["city"] = $client->getCity();
				$parameters["cp"] = $client->getCp();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();
				$parameters["family_group"] = $client->getFamilyGroup();
				$parameters["auxiliary_phone"] = $client->getAuxiliaryPhone();
				$parameters["vehicle_type"] = $client->getVehicleType();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();
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
					$userTemp->setAddress($row["address"]);
					$userTemp->setCity($row["city"]);				
					$userTemp->setCp($row["cp"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setPhone($row["tel"]);
					$userTemp->setFamilyGroup($row["family_group"]);
					$userTemp->setAuxiliaryPhone($row["auxiliary_phone"]);
					$userTemp->setPaymentMethod($row["payment_method"]);
					$userTemp->setVehicleType($row["vehicle_type"]);
                    $userTemp->setIsActive($row["is_active"]);                    
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
					$userTemp->setAddress($row["address"]);
					$userTemp->setCity($row["city"]);				
					$userTemp->setCp($row["cp"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setPhone($row["tel"]);
					$userTemp->setFamilyGroup($row["family_group"]);
					$userTemp->setAuxiliaryPhone($row["auxiliary_phone"]);
					$userTemp->setPaymentMethod($row["payment_method"]);
					$userTemp->setVehicleType($row["vehicle_type"]);
                    $userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getByName(Client $client) {
			try {
				$clientsList = array();
				$query = "CALL client_getByName(?)";
				$parameters ["name"] = $client->getName();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {	
					
					$reservation = new Reservation();					
					$reservation->setId($row["reservation_id"]);
					$reservation->setDateStart($row["reservation_dateStart"]);
					$reservation->setDateEnd($row["reservation_dateEnd"]);
					$reservation->setStay($row["reservation_stay"]);
					$reservation->setDiscount($row["reservation_discount"]);
                    $reservation->setPrice($row["reservation_totalPrice"]);
					
					$client = new Client();			
					$client->setId($row["client_id"]);		
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);					
					$client->setAddress($row["client_address"]);
					$client->setCity($row["client_city"]);									
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);					
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setVehicleType($row["client_vehicleType"]);                    
					$reservation->setClient($client);

					$admin = new Admin();					
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$beachTent = new BeachTent();					
					$beachTent->setNumber($row["tent_number"]);					

					$reservation->setBeachTent($beachTent);					

					array_push($clientsList, $reservation);
				}
				return $clientsList;
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getByTentNumber(BeachTent $tent) {
			try {
				$clientsRsv = array();
				$query = "CALL client_getByTentNumber(?)";
				$parameters ["number"] = $tent->getNumber();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {	
					
					$reservation = new Reservation();				
					$reservation->setId($row["reservation_id"]);	
					$reservation->setDateStart($row["reservation_dateStart"]);
					$reservation->setDateEnd($row["reservation_dateEnd"]);
					$reservation->setStay($row["reservation_stay"]);
					$reservation->setDiscount($row["reservation_discount"]);
                    $reservation->setPrice($row["reservation_totalPrice"]);
					
					$client = new Client();				
					$client->setId($row["client_id"]);			
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);					
					$client->setAddress($row["client_address"]);
					$client->setCity($row["client_city"]);									
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);					
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setVehicleType($row["client_vehicleType"]);                    
					$reservation->setClient($client);

					$admin = new Admin();					
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$beachTent = new BeachTent();					
					$beachTent->setNumber($row["tent_number"]);					

					$reservation->setBeachTent($beachTent);					

					array_push($clientsRsv, $reservation);
				}
				return $clientsRsv;
			}
			catch (Exception $e) {
				return false;
				// echo $e;
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
					$client->setAddress($row["address"]);
					$client->setCity($row["city"]);				
					$client->setCp($row["cp"]);
					$client->setEmail($row["email"]);
					$client->setPhone($row["tel"]);
					$client->setFamilyGroup($row["family_group"]);
					$client->setAuxiliaryPhone($row["auxiliary_phone"]);
					$client->setPaymentMethod($row["payment_method"]);
					$client->setVehicleType($row["vehicle_type"]);
                    $client->setIsActive($row["is_active"]);
					array_push($this->clientList, $client);
				}
				return $this->clientList;	
			} catch (Exception $e) {
				return false;
				// echo $e;
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

		public function update(Client $client, Admin $updateBy) {
			try {								
				$query = "CALL client_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";				
				$parameters["name"] = $client->getName();
				$parameters["lastname"] = $client->getLastName();				
				$parameters["address"] = $client->getAddress();
				$parameters["city"] = $client->getCity();
				$parameters["cp"] = $client->getCp();
				$parameters["email"] = $client->getEmail();
				$parameters["tel"] = $client->getPhone();
				$parameters["family_group"] = $client->getFamilyGroup();
				$parameters["auxiliary_phone"] = $client->getAuxiliaryPhone();             
				$parameters["payment_method"] = $client->getPaymentMethod();
				$parameters["vehicle_type"] = $client->getVehicleType();
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
				$query = "CALL client_getEmails()";
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