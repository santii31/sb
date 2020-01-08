<?php

    namespace DAO;

	use \Exception as Exception;
	use Models\Reservation as Reservation;	
	use Models\Client as Client;
	use Models\Admin as Admin;
	use Models\BeachTent as BeachTent;
	use Models\Parking as Parking;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationDAO {

		private $connection;
		private $reservationList = array();
		private $tableName = "reservation";		

		public function __construct() { }

		
        public function add(Reservation $reservation, Admin $registerBy) {								
			try {					
				$query = "CALL reservation_add(?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["date_start"] = $reservation->getDateStart();
				$parameters["date_end"] = $reservation->getDateEnd();
				$parameters["total_price"] = $reservation->getPrice();
				$parameters["FK_id_client"] = $reservation->getClient()->getId();
				$parameters["FK_id_tent"] = $reservation->getBeachTent()->getId();
				$parameters["FK_id_parking"] = $reservation->getParking()->getId();
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
                    $reservationTemp->setPrice($row["reservation_totalPrice"]);
					$reservationTemp->setIsActive($row["reservation_isActive"]);
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setIsPotential($row["client_isPotential"]);
					$client->setIsActive($row["client_isActive"]);
					$reservationTemp->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);
					$admin->setDni($row["admin_dni"]);
					$admin->setEmail($row["admin_email"]);
					$admin->setPassword($row["admin_password"]);
					$admin->setIsActive($row["admin_isActive"]);
					$reservationTemp->setAdmin($admin);

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$beachTent->setIsActive($row["tent_isActive"]);
					$reservationTemp->setBeachTent($beachTent);

					$parking = new Parking();
					$parking->setId($row["parking_id"]);
					$parking->setNumber($row["parking_number"]);
					$parking->setPrice($row["parking_price"]);
					$parking->setIsActive($row["parking_isActive"]);
					$reservationTemp->setParking($parking);


				}
				return $reservationTemp;
			} catch (Exception $e) {
				return false;
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
                    $reservation->setPrice($row["reservation_totalPrice"]);
					$reservation->setIsActive($row["reservation_isActive"]);
					$client = new Client();
					$client->setId($row["client_id"]);
					$client->setName($row["client_name"]);
					$client->setLastName($row["client_lastName"]);
					$client->setEmail($row["client_email"]);
					$client->setPhone($row["client_tel"]);
					$client->setCity($row["client_city"]);
					$client->setAddress($row["client_address"]);
					$client->setIsPotential($row["client_isPotential"]);
					$client->setIsActive($row["client_isActive"]);
					$reservation->setClient($client);

					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastName"]);
					$admin->setDni($row["admin_dni"]);
					$admin->setEmail($row["admin_email"]);
					$admin->setPassword($row["admin_password"]);
					$admin->setIsActive($row["admin_isActive"]);
					$reservation->setAdmin($admin);

					$beachTent = new BeachTent();
					$beachTent->setId($row["tent_id"]);
					$beachTent->setNumber($row["tent_number"]);
					$beachTent->setPrice($row["tent_price"]);
					$beachTent->setIsActive($row["tent_isActive"]);
					$reservation->setBeachTent($beachTent);

					$parking = new Parking();
					$parking->setId($row["parking_id"]);
					$parking->setNumber($row["parking_number"]);
					$parking->setPrice($row["parking_price"]);
					$parking->setIsActive($row["parking_isActive"]);
					$reservation->setParking($parking);
                    
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
