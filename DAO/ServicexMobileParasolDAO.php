<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ServicexMobileParasol as ServicexMobileParasol;
    use Models\AdditionalService as AdditionalService;
    use Models\MobileParasol as MobileParasol;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ServicexMobileParasolDAO {

		private $connection;
        private $serviceList = array();
        private $mobileParasolList = array();
		private $tableName = "servicexmobileParasol";		

		public function __construct() { }

		
        public function add(ServicexMobileParasol $servicexmobileParasol) {								
			try {					
				$query = "CALL servicexmobileParasol_add(?, ?)";
                $parameters["FK_id_service"] = $servicexmobileParasol->getIdService();
                $parameters["FK_id_mobileParasol"] = $servicexmobileParasol->getIdMobileParasol();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getServiceByMobileParasol($id) {
			try {				
				$query = "CALL servicexmobileParasol_getServiceByMobileParasol(?)";
				$parameters["id_mobileParasol"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);                    
                    $additionalService->setPrice($row["service_total"]);
                    
                    array_push($this->serviceList, $additionalService);
				}
				return $this->serviceList;
			} catch (Exception $e) {
				return false;
            }
		}

        public function getMobileParasolByService($id) {
			try {				
				$mobileParasoles = array();
				$query = "CALL servicexmobileParasol_getMobileParasolByService(?)";
				$parameters["id_service"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $mobileParasol = new MobileParasol();
                    $mobileParasol->setId($row["mobileParasol_id"]);
                    $mobileParasol->setMobileParasolNumber($row["mobileParasol_number"]);
					$mobileParasol->setPrice($row["mobileParasol_price"]);
                    
                    array_push($mobileParasoles, $mobileParasol);
				}
				return $mobileParasoles;
			} catch (Exception $e) {
				return false;
				// echo $e;
            }
		}

		

    }

 ?>
