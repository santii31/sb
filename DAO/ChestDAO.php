<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Chest as Chest;
    use Models\AdditionalService as AdditionalService;
    use Models\Reservation as Reservation;
    use Models\Admin as Admin;
    use Models\Client as Client;
    use Models\BeachTent as BeachTent;
    use Models\Parking as Parking;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ChestDAO {

		private $connection;
		private $chestList = array();
		private $tableName = "chest";		

		public function __construct() { }

        
					
		public function getById(Chest $chest) {
			try {				
				$chestTemp = null;
				$query = "CALL chest_getById(?)";
				$parameters["id"] = $chest->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$chestTemp = new Chest();
                    $chestTemp->setId($row["chest_id"]);
                    $chestTemp->setChestNumber($row["chest_number"]);
                    $chestTemp->setPrice($row["chest_price"]);
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
                    $additionalService->setPrice($row["service_total"]);

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
                    
                    $additionalService->setReservation($reservation);
                    $chestTemp->setAdditionalService($additionalService);
				}
				return $chestTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		
		public function getAll() {
			try {
				$query = "CALL chest_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$chest = new Chest();
                    $chest->setId($row["chest_id"]);
                    $chest->setChestNumber($row["chest_number"]);
                    $chest->setPrice($row["chest_price"]);
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
                    $additionalService->setPrice($row["service_total"]);

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
                    
                    $additionalService->setReservation($reservation);
                    $chest->setAdditionalService($additionalService);
					array_push($this->chestList, $chest);
				}
				return $this->chestList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				

    }

 ?>
