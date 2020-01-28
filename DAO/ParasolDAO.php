<?php

    namespace DAO;

    use \Exception as Exception;
	use Models\Admin as Admin;	
	use Models\Client as Client;	
	use Models\Parasol as Parasol;	
	use Models\ParasolReservation as ParasolReservation;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ParasolDAO {

		private $connection;
		private $parasolList = array();
		private $tableName = "parasol";		

		public function __construct() { }

		
		public function getN_row($row) {
			try {
				$parasolTemp = array();
				$query = "CALL parasol_getN_row(?)";
				$parameters["start"] = $row;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {					
					$parasol = new Parasol();
                    $parasol->setId($row["id"]);
                    $parasol->setParasolNumber($row["parasol_number"]);
                    $parasol->setPrice($row["price"]);                                    					
					$parasol->setPosition($row["position"]);
					array_push($parasolTemp, $parasol);
				}
				return $parasolTemp;	
			} catch (Exception $e) {
				return false;								
			}
		}

		// ParasolReservation			
        public function add(ParasolReservation $reservation, Admin $registerBy) {								
			try {					
				$query = "CALL parasol_reservation_add(?, ?, ?, ?, ?, ?, ?, ?, @lastId)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["stay"] = $reservation->getStay();				
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["FK_id_client"] = $reservation->getClient()->getId();
				$parameters["FK_id_parasol"] = $reservation->getParasol()->getId();
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
					
		public function getById(ParasolReservation $reservation) {
			try {				
				$reservationTemp = null;
				$query = "CALL parasol_reservation_getById(?)";
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					
					$reservationTemp = new ParasolReservation();
					$reservationTemp->setId($row["parasol_reservation_id"]);
					$reservationTemp->setDateStart($row["parasol_reservation_dateStart"]);
					$reservationTemp->setDateEnd($row["parasol_reservation_dateEnd"]);
					$reservationTemp->setStay($row["parasol_reservation_stay"]);					
					$reservationTemp->setPrice($row["parasol_reservation_totalPrice"]);
					
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setVehicleType($row["client_vehicleType"]);

					$reservationTemp->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$parasol = new Parasol();
					$parasol->setId($row["parasol_id"]);
					$parasol->setParasolNumber($row["parasol_number"]);					

					$reservationTemp->setRegisterBy($admin);

					$reservationTemp->setParasol($parasol);					
				}
				return $reservationTemp;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getAll() {
			try {
				$reservList = array();
				$query = "CALL parasol_reservation_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {

					$reservation = new ParasolReservation();
					$reservation->setId($row["parasol_reservation_id"]);
					$reservation->setDateStart($row["parasol_reservation_dateStart"]);
					$reservation->setDateEnd($row["parasol_reservation_dateEnd"]);
					$reservation->setStay($row["parasol_reservation_stay"]);					
					$reservation->setPrice($row["parasol_reservation_totalPrice"]);
					
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setVehicleType($row["client_vehicleType"]);

					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$parasol = new Parasol();
					$parasol->setId($row["parasol_id"]);
					$parasol->setParasolNumber($row["parasol_number"]);					

					$reservation->setRegisterBy($admin);

					$reservation->setParasol($parasol);		
                  				
					array_push($reservList, $reservation);
				}
				return $reservList;	
			} catch (Exception $e) {
				return false;
			}
		}			

		public function getAllRsvWithClients() {
			try {
				$reservList = array();
				$query = "CALL parasol_reservation_getAllWithClients()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					
					$reservation = new ParasolReservation();
					$reservation->setId($row["parasol_reservation_id"]);
					$reservation->setDateStart($row["parasol_reservation_dateStart"]);
					$reservation->setDateEnd($row["parasol_reservation_dateEnd"]);
					$reservation->setStay($row["parasol_reservation_stay"]);					
					$reservation->setPrice($row["parasol_reservation_totalPrice"]);
					
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setVehicleType($row["client_vehicleType"]);

					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$parasol = new Parasol();
					$parasol->setId($row["parasol_id"]);
					$parasol->setParasolNumber($row["parasol_number"]);					

					$reservation->setRegisterBy($admin);

					$reservation->setParasol($parasol);		
                    
					array_push($reservList, $reservation);
				}
				return $reservList;	
			} catch (Exception $e) {
				return false;
			}
		}
						
		public function enableById(ParasolReservation $reservation, Admin $enableBy) {
			try {
				$query = "CALL parasol_reservation_enableById(?, ?, ?)";
				$parameters["id"] = $reservation->getId();
				$parameters["date_enable"] = date("Y-m-d");
				$parameters["register_by"] = $enableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(ParasolReservation $reservation, Admin $disableBy) {
			try {
				$query = "CALL parasol_reservation_disableById(?, ?, ?)";
				$parameters["id"] = $reservation->getId();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["disable_by"] = $disableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;				
			}
		}		
		
 		public function checkDateStart(ParasolReservation $reservation) {
			try {
				$query = "CALL parasol_reservation_checkDateStart(?, ?)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function update(ParasolReservation $reservation, Admin $updateBy) {
			try {		
				$query = "CALL parasol_reservation_update(?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["stay"] = $reservation->getStay();				
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();  
				$parameters["id"] = $reservation->getId();  				
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);	
			} catch (Exception $e) {
				return false;		
				// echo $e;		
			}
		}

		public function getByIdParasol($parasol) {
			try {
				$parasolReservations = array();
				$query = "CALL parasol_reservation_geByIdParasol(?)";
				$parameters["id"] = $parasol;				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);				
				foreach ($results as $row) {		
					
					$reservation = new ParasolReservation();
					$reservation->setId($row["parasol_reservation_id"]);
					$reservation->setDateStart($row["parasol_reservation_dateStart"]);
					$reservation->setDateEnd($row["parasol_reservation_dateEnd"]);
					$reservation->setStay($row["parasol_reservation_stay"]);					
					$reservation->setPrice($row["parasol_reservation_totalPrice"]);
					
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setVehicleType($row["client_vehicleType"]);

					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);

					$parasol = new Parasol();
					$parasol->setId($row["parasol_id"]);
					$parasol->setParasolNumber($row["parasol_number"]);					

					$reservation->setRegisterBy($admin);
					$reservation->setParasol($parasol);		
					$reservation->setClient($client);
										
					array_push($parasolReservations, $reservation);
				}
				return $parasolReservations;	
			} catch (Exception $e) {
				return false;			
				// echo $e;					
			}
		}
		
    }

 ?>
