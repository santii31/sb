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
                $query = "CALL balance_add(?, ?, ?, ?, ?, ?, ?)";                
                $parameters["date"] = $balance->getDate();
                $parameters["concept"] = $balance->getConcept();
                $parameters["number_receipt"] = $balance->getNumberReceipt();
                $parameters["total"] = $balance->getTotal();
                $parameters["partial"] = $balance->getPartial();
                $parameters["remainder"] = $balance->getRemainder();
                $parameters["FK_id_reservation"] = $balance->getReservation()->getId();                
                $this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);									
			} catch (Exception $e) {
				return false;
			}
        }        
					
		public function getByReservationId(Reservation $reservation) {
			try {				
				$balanceList = array();                
                $query = "CALL balance_getByReservationId(?)";                
                $parameters["id"] = $reservation->getId();                
                $this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);											
				foreach ($results as $row) {
					$balance = new Balance();
					$balance->setDate($row["balance_date"]);
					$balance->setConcept($row["balance_concept"]);
					$balance->setNumberReceipt($row["balance_number_receipt"]);
					$balance->setTotal($row["balance_total"]);
					$balance->setPartial($row["balance_partial"]);
					$balance->setRemainder($row["balance_remainder"]);					
                    array_push($balanceList, $balance);
				}
				return $balanceList;

			} catch (Exception $e) {
				return false;
			}
        }
								

    }

 ?>
