<?php

    namespace DAO;

	use \Exception as Exception;    
	use Models\Admin as Admin;
	use Models\Config as Config;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ConfigDAO {

		private $connection;		
		private $tableName = "config";		

		public function __construct() { }
        					
		public function get() {
			try {
				$query = "CALL config_get()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {					
					$config = new Config();
					$config->setDateStartSeason($row["date_start_season"]);
					$config->setDateEndSeason($row["date_end_season"]);
					$config->setPriceTentSeason($row["price_tent_season"]);
					$config->setPriceTentJanuary($row["price_tent_january"]);
					$config->setPriceTentJanuaryDay($row["price_tent_january_day"]);
					$config->setPriceTentJanuaryFortnigh($row["price_tent_january_fortnigh"]);
					$config->setPriceTentFebruary($row["price_tent_february"]);
					$config->setPriceTentFebruaryDay($row["price_tent_february_day"]);
					$config->setPriceTentFebruaryFirstFortnigh($row["price_tent_february_first_fortnigh"]);
					$config->setPriceTentFebruarySecondFortnigh($row["price_tent_february_second_fortnigh"]);
					$config->setPriceParasol($row["price_parasol"]);
				}
				return $config;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function update(Config $config, Admin $updateBy) {
			try {								
				$query = "CALL config_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";					
				$parameters["date_start_season"] = $config->getDateStartSeason();
                $parameters["date_end_season"] = $config->getDateEndSeason();
                $parameters["price_tent_season"] = $config->getPriceTentSeason();
                $parameters["price_tent_january"] = $config->getPriceTentJanuary();
                $parameters["price_tent_january_day"] = $config->getPriceTentJanuaryDay();
                $parameters["price_tent_january_fortnigh"] = $config->getPriceTentJanuaryFortnigh();
                $parameters["price_tent_february"] = $config->getPriceTentFebruary();
                $parameters["price_tent_february_day"] = $config->getPriceTentFebruaryDay();
                $parameters["price_tent_february_first_fortnigh"] = $config->getPriceTentFebruaryFirstFortnigh();
                $parameters["price_tent_february_second_fortnigh"] = $config->getPriceTentFebruarySecondFortnigh();
                $parameters["price_parasol"] = $config->getPriceParasol();				
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();				
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

    }

 ?>