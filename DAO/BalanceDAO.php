<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Client as Client;	
    use Models\Balance as Balance;	
    use Models\Reservation as Reservation;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class BalanceDAO {

		private $connection;
		private $categoryList = array();
		private $tableName = "balance";		

		public function __construct() { }


		public function add(Balance $balance) { 
			try {				
				$categoryTemp = null;
                
                $query = "CALL balance_add(?, ?, ?, ?, ?, ?, ?)";
                
                $parameters["date"] = $balance->getDate();
                $parameters["concept"] = $balance->getConcept();
                $parameters["number_receipt"] = $balance->getNumberReceipt();
                $parameters["total"] = $balance->getTotal();
                $parameters["partial"] = $balance->getPartial();
                $parameters["remainder"] = $balance->getRemainder();
                $parameters["FK_id_reservation"] = $balance->getReservation()->getId();
                
                $this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {

                    
				}
				return $categoryTemp;
			} catch (Exception $e) {
				return false;
			}
        }        
					
		public function getById(Balance $balance) {
			try {				
				$categoryTemp = null;
                
                $query = "CALL category_getById(?)";
                
                $parameters["id"] = $category->getId();
                
                $this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {

                    
				}
				return $categoryTemp;
			} catch (Exception $e) {
				return false;
			}
        }
								

    }

 ?>
