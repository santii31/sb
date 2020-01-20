<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ServicexLocker as ServicexLocker;
    use Models\AdditionalService as AdditionalService;
    use Models\Locker as Locker;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ServicexLockerDAO {

		private $connection;
        private $serviceList = array();
        private $lockerList = array();
		private $tableName = "servicexlocker";		

		public function __construct() { }

		
        public function add(ServicexLocker $servicexlocker) {								
			try {					
				$query = "CALL servicexlocker_add(?, ?)";
                $parameters["FK_id_service"] = $servicexlocker->getIdService();
                $parameters["FK_id_locker"] = $servicexlocker->getIdLocker();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getServiceByLocker($id) {
			try {				
				$query = "CALL servicexlocker_getServiceByLocker(?)";
				$parameters["id_locker"] = $id;
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

        public function getLockerByService($id) {
			try {				
				$lockers = array();
				$query = "CALL servicexlocker_getLockerByService(?)";
				$parameters["id_service"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $locker = new Locker();
                    $locker->setId($row["locker_id"]);
                    $locker->setLockerNumber($row["locker_number"]);
					$locker->setPrice($row["locker_price"]);
					$locker->setSex($row["locker_sex"]);
                    
                    array_push($lockers, $locker);
				}
				return $lockers;
			} catch (Exception $e) {
				return false;
            }
		}

		

    }

 ?>
