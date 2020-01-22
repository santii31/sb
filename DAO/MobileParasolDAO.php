<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\MobileParasol as MobileParasol;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class MobileParasolDAO {

		private $connection;
		private $mobileParasolList = array();
		private $tableName = "mobile_parasol";		

		public function __construct() { }
		
					
		public function getById(MobileParasol $mobileParasol) {
			try {				
				$mobileParasolTemp = null;
				$query = "CALL mobileParasol_getById(?)";
				$parameters["id"] = $mobileParasol->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$mobileParasolTemp = new MobileParasol();
                    $mobileParasolTemp->setId($row["id"]);
                    $mobileParasolTemp->setMobileParasolNumber($row["mobileParasol_number"]);
                    $mobileParasolTemp->setPrice($row["price"]);                                    					
                    
				}
				return $mobileParasolTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL parasol_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$mobileParasol = new MobileParasol();
                    $mobileParasol->setId($row["id"]);
                    $mobileParasol->setMobileParasolNumber($row["mobileParasol_number"]);
                    $mobileParasol->setPrice($row["price"]);
                    
					array_push($this->mobileParasolList, $mobileParasol);
				}
				return $this->mobileParasolList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		
	
    }

 ?>
