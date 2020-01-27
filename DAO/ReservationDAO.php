<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Reservation as Reservation;	
	use Models\Client as Client;
	use Models\Admin as Admin;
	use Models\BeachTent as BeachTent;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationDAO {

		private $connection;
		private $reservationList = array();
		private $tableName = "reservation";		

		public function __construct() { }

		
        public function add(Reservation $reservation, Admin $registerBy) {								
			try {					
				$query = "CALL reservation_add(?, ?, ?, ?, ?, ?, ?, ?, ?, @lastId)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["stay"] = $reservation->getStay();
				$parameters["discount"] = $reservation->getDiscount();
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["FK_id_client"] = $reservation->getClient()->getId();
				$parameters["FK_id_tent"] = $reservation->getBeachTent()->getId();
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
					
		public function getById(Reservation $reservation) {
			try {				
				$reservationTemp = null;
				$query = "CALL reservation_getById(?)";
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					
					$reservationTemp = new Reservation();
					$reservationTemp->setId($row["reservation_id"]);
					$reservationTemp->setDateStart($row["reservation_dateStart"]);
					$reservationTemp->setDateEnd($row["reservation_dateEnd"]);
					$reservationTemp->setStay($row["reservation_stay"]);
					$reservationTemp->setDiscount($row["reservation_discount"]);
					$reservationTemp->setPrice($row["reservation_totalPrice"]);
					
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);

					$reservationTemp->setRegisterBy($admin);
					$reservationTemp->setBeachTent($beachTent);					
				}
				return $reservationTemp;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getAllByClientId($client_id) {
			try {
				$query = "CALL reservation_getAllByClientId(?)";
				$parameters["client_id"] = $client_id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$reservation = new Reservation();
					$reservation->setId($row["reservation_id"]);
					$reservation->setDateStart($row["reservation_dateStart"]);
					$reservation->setStay($row["reservation_stay"]);
					$reservation->setDateEnd($row["reservation_dateEnd"]);
					$reservation->setDiscount($row["reservation_discount"]);
                    $reservation->setPrice($row["reservation_totalPrice"]);
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					
					$reservation->setRegisterBy($admin);
					$reservation->setBeachTent($beachTent);

					array_push($this->reservationList, $reservation);
				}
				return $this->reservationList;
			} catch (Exception $e) {
				return false;
				//echo $e;
			}
		}
		
		public function getByDate($date) {
			try {				
				$rsvList = array();
				$query = "CALL reservation_getByDate(?)";
				$parameters["date"] = $date;
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);

					$reservation->setBeachTent($beachTent);		
					
					$reservation->setRegisterBy($admin);

					array_push($rsvList, $reservation);
				}
				return $rsvList;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getBetweenDates($date_start, $date_end) {
			try {				
				$rsvList = array();
				$query = "CALL reservation_getBetweenDates(?, ?)";
				$parameters["date_start"] = $date_start;
				$parameters["date_end"] = $date_end;
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);

					$reservation->setBeachTent($beachTent);		
					
					$reservation->setRegisterBy($admin);

					array_push($rsvList, $reservation);
				}
				return $rsvList;
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function getAllByAdmin(Admin $admin) {
			try {
				$query = "CALL reservation_getAllByAdmin(?)";
				$parameters["id"] = $admin->getId();
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
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);					
					$reservation->setClient($client);
					
					$beachTent = new BeachTent();					
					$beachTent->setNumber($row["tent_number"]);
										
					$reservation->setBeachTent($beachTent);

					array_push($this->reservationList, $reservation);
				}
				return $this->reservationList;
			} catch (Exception $e) {
				return false;
				//echo $e;
			}
		}

		public function getSalesMonthly() {
			try {
				$salesList = array();
				$query = "CALL reservation_getSalesMonthly()";				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
				foreach ($results as $row) {
					
					$sales = array(
						"year" => $row["year"],
						"month" => $row["month"],
						"subtotal" => $row["subtotal"],
						"reservations" => $row["orders"]
					);
					
					array_push($salesList, $sales);
				}
				return $salesList;
			} catch (Exception $e) {
				return false;
				//echo $e;
			}
		}

		public function getAll() {
			try {
				$reservList = array();
				$query = "CALL reservation_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservation->setBeachTent($beachTent);					
                    
					array_push($reservList, $reservation);
				}
				return $reservList;	
			} catch (Exception $e) {
				return false;
			}
		}		

		public function getAllActives() {
			try {
				$reservList = array();
				$query = "CALL reservation_getAllActives()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservation->setBeachTent($beachTent);					
                    
					array_push($reservList, $reservation);
				}
				return $reservList;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function getAllDisables() {
			try {
				$reservList = array();
				$query = "CALL reservation_getAllDisables()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservation->setBeachTent($beachTent);					
                    
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
				$query = "CALL reservation_getAllWithClients()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $reservation = new Reservation();
					$reservation->setId($row["reservation_id"]);
					$reservation->setDateStart($row["reservation_dateStart"]);
					$reservation->setDateEnd($row["reservation_dateEnd"]);
					$reservation->setStay($row["reservation_stay"]);					
					
					$client = new Client();					
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);					
					$reservation->setBeachTent($beachTent);					
                    
					array_push($reservList, $reservation);
				}
				return $reservList;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function getCount() {
			try {				
				$query = "CALL reservation_getAllRsvWithClientsCount()";				
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
				foreach ($results as $row) {
					return $row["total"];
				}
			}
			catch (Exception $ex) {
				return false;
			}
		}

		public function getAllRsvWithClientsWithLimit($start) {
			try {				
				$list = array();
				$query = "CALL reservation_getAllRsvWithClientsWithLimit(?, ?)";
				$parameters["start"] = $start;
				$parameters["max_items"] = MAX_ITEMS_PAGE;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    $reservation = new Reservation();
					$reservation->setId($row["reservation_id"]);
					$reservation->setDateStart($row["reservation_dateStart"]);
					$reservation->setDateEnd($row["reservation_dateEnd"]);
					$reservation->setStay($row["reservation_stay"]);				
					
					$client = new Client();					
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

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);					
					
					$reservation->setBeachTent($beachTent);	
					
					array_push($list, $reservation);
				}
				return $list;
			}
			catch (Exception $ex) {
				return false;
			}
		}
						
		public function enableById(Reservation $reservation, Admin $enableBy) {
			try {
				$query = "CALL reservation_enableById(?, ?, ?)";
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

		public function disableById(Reservation $reservation, Admin $disableBy) {
			try {
				$query = "CALL reservation_disableById(?, ?, ?)";
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

		
 		public function checkDateStart(Reservation $reservation) {
			try {
				$query = "CALL reservation_checkDateStart(?, ?)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
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

		public function update(Reservation $reservation, Admin $updateBy) {
			try {		
				$query = "CALL reservation_update(?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["stay"] = $reservation->getStay();
				$parameters["discount"] = $reservation->getDiscount();
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

		public function getByIdTent(BeachTent $tent) {
			try {
				$tentReservations = array();
				$query = "CALL reservation_geByIdTent(?)";
				$parameters["id"] = $tent->getId();				
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
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);
                    $client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setPaymentMethod($row["client_paymentMethod"]);
					$client->setAuxiliaryPhone($row["client_auxiliaryPhone"]);
					$client->setVehicleType($row["client_vehicleType"]);
					
					$reservation->setClient($client);
										
					array_push($tentReservations, $reservation);
				}
				return $tentReservations;	
			} catch (Exception $e) {
				return false;			
				//echo $e;					
			}
		}
		
		public function getActiveCount() {
            try {				
                $query = "CALL reservation_getActiveCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getDisableCount() {
            try {				
                $query = "CALL reservation_getDisableCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;                
            }
        }

        public function getAllActiveWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL reservation_getAllActiveWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
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
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);					
					$reservation->setClient($client);

					$beachTent = new BeachTent();					
					$beachTent->setNumber($row["tent_number"]);
					
					$reservation->setBeachTent($beachTent);					
                    
					array_push($list, $reservation);
				}
                return $list;
            }
            catch (Exception $ex) {
				return false;
				// echo $ex;
            }
        }

        public function getAllDisableWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL reservation_getAllDisableWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
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
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);					
					$reservation->setClient($client);

					$beachTent = new BeachTent();					
					$beachTent->setNumber($row["tent_number"]);
					
					$reservation->setBeachTent($beachTent);					
                    
					array_push($list, $reservation);                          
                }
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }
		
    }

 ?>
