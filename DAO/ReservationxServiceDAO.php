<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ReservationxService;
    use Models\Reservation as Reservation;
    use Models\Admin as Admin;	
    use Models\Client as Client;
    use Models\BeachTent as BeachTent;
    use Models\Parking as Parking;
    use Models\AdditionalService as AdditionalService;
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationxServiceDAO {

		private $connection;
        private $reservationList = array();
        private $serviceList = array();
		private $tableName = "reservationxservice";		

		public function __construct() { }

		
        public function add(ReservationxService $reservationxservice) {								
			try {					
				$query = "CALL reservationxservice_add(?, ?)";
                $parameters["FK_id_reservation"] = $reservationxservice->getIdReservation();
                $parameters["FK_id_service"] = $reservationxservice->getIdService();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getReservationByService($id) {
			try {				
				$query = "CALL providerxproduct_getReservationByService(?)";
				$parameters["id"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    $reservation = new Reservation();

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
                    
                    array_push($reservationList, $reservation);
				}
				return $reservationList;
			} catch (Exception $e) {
				return false;
            }
		}

        public function getServiceByReservation($id) {
			try {				
				$query = "CALL providerxproduct_getProductByProvider(?)";
				$parameters["id"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    $additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
                    $additionalService->setPrice($row["service_total"]);
                    
                    array_push($serviceList, $additionalService);
				}
				return $serviceList;
			} catch (Exception $e) {
				return false;
            }
		}

		public function getAll() {
			try {
				$query = "CALL reservationxservice_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$reservationxservice = new ReservationxService();
					$reservationxserviceTemp->setIdReservation($row["reservationxservice.FK_id_reservation"]);
					$reservationxserviceTemp->setIdService($row["reservationxservice.FK_id_service"]);
                    
					array_push($this->reservationxserviceList, $reservationxserviceTemp);
				}
				return $this->reservationxserviceList;	
			} catch (Exception $e) {
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
