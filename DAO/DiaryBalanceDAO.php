<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Admin as Admin;
    use Models\DiaryBalance as DiaryBalance;	        
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class DiaryBalanceDAO {

		private $connection;
		private $categoryList = array();
		private $tableName = "diary_balance";		

		public function __construct() { }


		public function add(DiaryBalance $diaryBalance, Admin $admin) { 
			try {								
                $query = "CALL diary_balance_add(?, ?, ?, ?, ?, ?, ?)";                
                $parameters["date"] = $diaryBalance->getDate();
                $parameters["type"] = $diaryBalance->getType();
                $parameters["payment"] = $diaryBalance->getPayment();
                $parameters["detail"] = $diaryBalance->getDetail();
                $parameters["total"] = $diaryBalance->getTotal();
                $parameters["date_register"] = date("Y-m-d");
                $parameters["register_by"] = $admin->getId();
                $this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);									
			} catch (Exception $e) {
				return false;
			}
        }        
					
		public function getByDate($date) {
			try {				
				$diaryList = array();                
                $query = "CALL diary_balance_getByDate(?)";                
                $parameters["date"] = $date;                
                $this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);											
				foreach ($results as $row) {
                    
                    $diary = new DiaryBalance();
                    $diary->setId($row["id"]);
                    $diary->setDate($row["date"]);
                    $diary->setType($row["type"]);
                    $diary->setPayment($row["payment"]);
                    $diary->setDetail($row["detail"]);
                    $diary->setTotal($row["total"]);

                    $admin = new Admin();
                    $admin->setId($row["register_by"]);

                    $diary->setRegisterBy($admin);

                    array_push($diaryList, $diary);
				}
				return $diaryList;
			} catch (Exception $e) {
				return false;
			}
        }
								

    }

 ?>
