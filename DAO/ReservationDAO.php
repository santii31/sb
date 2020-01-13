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
				$query = "CALL reservation_add(?, ?, ?, ?, ?, ?, ?, ?, @lastId)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
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
		
					
		public function getById($id) {
			try {				
				$reservationTemp = null;
				$query = "CALL reservation_getById(?)";
				$parameters["id"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$reservationTemp = new Reservation();
					$reservationTemp->setId($row["reservation_id"]);
					$reservationTemp->setDateStart($row["reservation_dateStart"]);
					$reservationTemp->setDateEnd($row["reservation_dateEnd"]);
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
					$reservationTemp->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);
					$admin->setDni($row["admin_dni"]);
					$admin->setEmail($row["admin_email"]);
					$admin->setPassword($row["admin_password"]);

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservationTemp->setBeachTent($beachTent);					
				}
				return $reservationTemp;
			} catch (Exception $e) {
				return false;
				//echo $e;
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
					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);
					$admin->setDni($row["admin_dni"]);
					$admin->setEmail($row["admin_email"]);
					$admin->setPassword($row["admin_password"]);

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservation->setBeachTent($beachTent);

					array_push($this->reservationList, $reservation);
				}
				return $this->reservationList;
			} catch (Exception $e) {
				return false;
				//echo $e;
			}
		}


		
		public function getAll() {
			try {
				$query = "CALL reservation_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    $reservation = new Reservation();
					$reservation->setId($row["reservation_id"]);
					$reservation->setDateStart($row["reservation_dateStart"]);
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
					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);
					$admin->setDni($row["admin_dni"]);
					$admin->setEmail($row["admin_email"]);
					$admin->setPassword($row["admin_password"]);

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$reservation->setBeachTent($beachTent);

					
                    
					array_push($this->reservationList, $reservation);
				}
				return $this->reservationList;	
			} catch (Exception $e) {
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
				$query = "CALL reservation_disableById(?)";
				$parameters["id"] = $reservation->getId();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["disable_by"] = $registerBy->getId();
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
				$query = "CALL service_checkDateStart(?, ?)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["id"] = $reservation->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function update(Reservation $reservation, Admin $updateBy) {
			try {								
				$query = "CALL reservation_update(?, ?, ?, ?, ?)";		
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["discount"] = $reservation->getDiscount();
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();  
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);	

			} catch (Exception $e) {
				return false;				
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
					$reservation->setDateStart($row["reservation_dateStart"]);
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
					
					$reservation->setClient($client);
					
					// $beachTent = new BeachTent();
                    // $beachTent->setId($row["id"]);
					// $beachTent->setNumber($row["number"]);
					// $beachTent->setPrice($row["price"]);                    
					// $beachTent->setPosition($row["position"]);      

					// $hall = new Hall();
					// $hall->setNumber($row["hall_number"]);

					// $beachTent->setHall($hall);

					// $reservation->setBeachTent($beachTent);
					array_push($tentReservations, $reservation);
				}
				return $tentReservations;	
			} catch (Exception $e) {
				return false;			
				//echo $e;					
			}
		}		
		
    }

 ?>
