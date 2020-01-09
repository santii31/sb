<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Locker as Locker;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class LockerDAO {

		private $connection;
		private $lockerList = array();
		private $tableName = "locker";		

		public function __construct() { }

        					
		public function getById(Locker $locker) {
			try {				
				$chestTemp = null;
				$query = "CALL locker_getById(?)";
				$parameters["id"] = $locker->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$lockerTemp = new Chest();
                    $lockerTemp->setId($row["locker.id"]);
                    $lockerTemp->setChestNumber($row["locker.number"]);
                    $lockerTemp->setPrice($row["locker.price"]);
                    
				}
				return $lockerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		
		public function getAll() {
			try {
				$query = "CALL locker_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$locker = new Locker();
                    $locker->setId($row["locker.id"]);
                    $locker->setChestNumber($row["locker.number"]);
                    $locker->setPrice($row["locker.price"]);
                    
					array_push($this->lockerList, $locker);
				}
				return $this->lockerList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				

    }

 ?>
