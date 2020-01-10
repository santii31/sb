<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ServicexParking as ServicexParking;
    use Models\AdditionalService as AdditionalService;
    use Models\Parking as Parking;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ServicexParkingDAO {

		private $connection;
        private $serviceList = array();
        private $parkingList = array();
		private $tableName = "servicexparking";		

		public function __construct() { }

		
        public function add(ServicexParking $servicexparking) {								
			try {					
				$query = "CALL servicexparking_add(?, ?)";
                $parameters["FK_id_service"] = $servicexparking->getIdService();
                $parameters["FK_id_parking"] = $servicexparking->getIdParking();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getServiceByParking($id) {
			try {				
				$query = "CALL servicexparking_getServiceByParking(?)";
				$parameters["id_parking"] = $id;
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

        public function getParkingByService($id) {
			try {				
				$query = "CALL servicexparking_getParkingByService(?)";
				$parameters["id_service"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $parking = new Parking();
                    $parking->setId($row["parking_id"]);
                    $parking->setNumber($row["parking_number"]);
                    $parking->setPrice($row["parking_price"]);
                    
                    array_push($parkingList, $parking);
				}
				return $parkingList;
			} catch (Exception $e) {
				return false;
            }
		}

		

    }

 ?>
