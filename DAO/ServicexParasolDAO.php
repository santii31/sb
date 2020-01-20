<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\ServicexParasol as ServicexParasol;
    use Models\AdditionalService as AdditionalService;
    use Models\Parasol as Parasol;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ServicexParasolDAO {

		private $connection;
        private $serviceList = array();
        private $parasolList = array();
		private $tableName = "servicexparasol";		

		public function __construct() { }

		
        public function add(ServicexParasol $servicexparasol) {								
			try {					
				$query = "CALL servicexparasol_add(?, ?)";
                $parameters["FK_id_service"] = $servicexparasol->getIdService();
                $parameters["FK_id_parasol"] = $servicexparasol->getIdParasol();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}			
        }
					
		public function getServiceByParasol($id) {
			try {				
				$query = "CALL servicexparasol_getServiceByParasol(?)";
				$parameters["id_parasol"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $additionalService = new AdditionalService();
                    $additionalService->setId($row["service_id"]);
                    $additionalService->setDescription($row["service_description"]);
                    $additionalService->setPrice($row["service_total"]);
                    
                    array_push($this->serviceList, $additionalService);
				}
				return $this->serviceList;
			} catch (Exception $e) {
				return false;
            }
		}

        public function getParasolByService($id) {
			try {				
				$parasoles = array();
				$query = "CALL servicexparasol_getParasolByService(?)";
				$parameters["id_service"] = $id;
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
                    
                    $parasol = new Parasol();
                    $parasol->setId($row["parasol_id"]);
                    $parasol->setParasolNumber($row["parasol_number"]);
					$parasol->setPrice($row["parasol_price"]);
                    
                    array_push($parasoles, $parasol);
				}
				return $parasoles;
			} catch (Exception $e) {
				return false;
            }
		}

		

    }

 ?>
