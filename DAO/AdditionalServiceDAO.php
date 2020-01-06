<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\AdditionalService as AdditionalService;
    use Models\Reservation as Reservation;
    use Models\Admin as Admin;
    use Models\Client as Client;
    use Models\BeachTent as BeachTent;
    use Models\Parking as Parking;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdditionalServiceDAO {

		private $connection;
		private $additionalServiceList = array();
		private $tableName = "additional_service";		

		public function __construct() { }


		public function add(AdditionalService $additionalService) {
			try {					
				$query = "CALL service_add(?, ?)";
				$parameters["description"] = $additionalService->getDescription();
				$parameters["total"] = $additionalService->getTotal();				
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				throw $e;
			}
		}        				

		public function getById(AdditionalService $additionalService) {
			try {				
				$additionalServiceTemp = null;
				$query = "CALL service_getById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$additionalServiceTemp = new AdditionalService();
                    $additionalServiceTemp->setId($row["service_id"]);
                    $additionalServiceTemp->setDescription($row["service_description"]);
					$additionalServiceTemp->setTotal($row["service_total"]);
					$additionalServiceTemp->setIsActive($row["service_is_active"]);

                    // $reservation = new Reservation();
					// $reservation->setId($row["reservation_id"]);
					// $reservation->setDateStart($row["reservation_dateStart"]);
                    // $reservation->setDateEnd($row["reservation_dateEnd"]);
                    // $reservation->settotal($row["reservation_totaltotal"]);
					// $reservation->setIsActive($row["reservation_isActive"]);
					// $client = new Client();
					// $client->setId($row["client_id"]);
					// $client->setName($row["client_name"]);
					// $client->setLastName($row["client_lastName"]);
					// $client->setEmail($row["client_email"]);
					// $client->setPhone($row["client_tel"]);
					// $client->setCity($row["client_city"]);
					// $client->setAddress($row["client_address"]);
					// $client->setIsPotential($row["client_isPotential"]);
					// $client->setIsActive($row["client_isActive"]);
					// $reservation->setClient($client);

					// $admin = new Admin();
					// $admin->setId($row["admin_id"]);
					// $admin->setName($row["admin_name"]);
					// $admin->setLastName($row["admin_lastName"]);
					// $admin->setDni($row["admin_dni"]);
					// $admin->setEmail($row["admin_email"]);
					// $admin->setPassword($row["admin_password"]);
					// $admin->setIsActive($row["admin_isActive"]);
					// $reservation->setAdmin($admin);

					// $beachTent = new BeachTent();
					// $beachTent->setId($row["tent_id"]);
					// $beachTent->setNumber($row["tent_number"]);
					// $beachTent->settotal($row["tent_total"]);
					// $beachTent->setIsActive($row["tent_isActive"]);
					// $reservation->setBeachTent($beachTent);

					// $parking = new Parking();
					// $parking->setId($row["parking_id"]);
					// $parking->setNumber($row["parking_number"]);
					// $parking->settotal($row["parking_total"]);
					// $parking->setIsActive($row["parking_isActive"]);
					// $reservation->setParking($parking);
                    
                    // $additionalServiceTemp->setReservation($reservation);
				}
				return $additionalServiceTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByDescription(AdditionalService $additionalService) {
			try {				
				$additionalServiceTemp = null;
				$query = "CALL service_getByDescription(?)";
				$parameters["description"] = $additionalService->getDescription();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$additionalServiceTemp = new AdditionalService();
                    $additionalServiceTemp->setId($row["service_id"]);
                    $additionalServiceTemp->setDescription($row["service_description"]);
					$additionalServiceTemp->setTotal($row["service_total"]);        
					$additionalServiceTemp->setIsActive($row["service_is_active"]);           
				}
				return $additionalServiceTemp;
			} catch (Exception $e) {
				return false;
			}
		}		
		
		public function getAll() {
			try {
				$query = "CALL service_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
					$additionalService->setTotal($row["service_total"]);
					$additionalService->setIsActive($row["service_is_active"]);

                    // $reservation = new Reservation();
					// $reservation->setId($row["reservation_id"]);
					// $reservation->setDateStart($row["reservation_dateStart"]);
                    // $reservation->setDateEnd($row["reservation_dateEnd"]);
                    // $reservation->settotal($row["reservation_totaltotal"]);
					// $reservation->setIsActive($row["reservation_isActive"]);
					// $client = new Client();
					// $client->setId($row["client_id"]);
					// $client->setName($row["client_name"]);
					// $client->setLastName($row["client_lastName"]);
					// $client->setEmail($row["client_email"]);
					// $client->setPhone($row["client_tel"]);
					// $client->setCity($row["client_city"]);
					// $client->setAddress($row["client_address"]);
					// $client->setIsPotential($row["client_isPotential"]);
					// $client->setIsActive($row["client_isActive"]);
					// $reservation->setClient($client);

					// $admin = new Admin();
					// $admin->setId($row["admin_id"]);
					// $admin->setName($row["admin_name"]);
					// $admin->setLastName($row["admin_lastName"]);
					// $admin->setDni($row["admin_dni"]);
					// $admin->setEmail($row["admin_email"]);
					// $admin->setPassword($row["admin_password"]);
					// $admin->setIsActive($row["admin_isActive"]);
					// $reservation->setAdmin($admin);

					// $beachTent = new BeachTent();
					// $beachTent->setId($row["tent_id"]);
					// $beachTent->setNumber($row["tent_number"]);
					// $beachTent->settotal($row["tent_total"]);
					// $beachTent->setIsActive($row["tent_isActive"]);
					// $reservation->setBeachTent($beachTent);

					// $parking = new Parking();
					// $parking->setId($row["parking_id"]);
					// $parking->setNumber($row["parking_number"]);
					// $parking->settotal($row["parking_total"]);
					// $parking->setIsActive($row["parking_isActive"]);
					// $reservation->setParking($parking);
                    
                    // $additionalService->setReservation($reservation);
					array_push($this->additionalServiceList, $additionalService);
				}
				return $this->additionalServiceList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(AdditionalService $additionalService) {
			try {
				$query = "CALL service_enableById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(AdditionalService $additionalService) {
			try {
				$query = "CALL service_disableById(?)";
				$parameters["id"] = $additionalService->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}						

		public function update(AdditionalService $additionalService) {
			try {								
				$query = "CALL service_update(?, ?, ?)";		
				$parameters["description"] = $additionalService->getDescription();
				$parameters["total"] = $additionalService->getTotal();				
				$parameters["id"] = $additionalService->getId();				
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);	

			} catch (Exception $e) {
				// return false;				
				echo $e;
			}
		}

    }

 ?>
