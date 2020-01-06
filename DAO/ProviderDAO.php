<?php

    namespace DAO;

	use \Exception as Exception;
    use Models\Provider as Provider;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ProviderDAO {

		private $connection;
		private $providerList = array();
		private $tableName = "provider";		

		public function __construct() {

		}

        public function add(Provider $provider) {								
			try {					
				$query = "CALL provider_add(?, ?, ?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $provider->getName();
				$parameters["lastname"] = $provider->getLastName();
				$parameters["tel"] = $provider->getPhone();
				$parameters["email"] = $provider->getEmail();
                $parameters["dni"] = $provider->getDni();
                $parameters["address"] = $provider->getAddress();
                $parameters["cuil"] = $provider->getCuilNumber();
                $parameters["social_reason"] = $provider->getSocialReason();
                $parameters["type_billing"] = $provider->getBilling();                
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;				
			}			
        }
					
		public function getById(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getById(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByDni(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getByDni(?)";
				$parameters["dni"] = $provider->getDni();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

        public function getByEmail(Provider $provider) {
			try {				
				$providerTemp = null;
				$query = "CALL provider_getByEmail(?)";
				$parameters["email"] = $provider->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
				}
				return $providerTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		
		public function getAll() {
			try {
				$query = "CALL provider_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$providerTemp = new Provider();
					$providerTemp->setId($row["id"]);
					$providerTemp->setName($row["name"]);
					$providerTemp->setLastName($row["lastname"]);
                    $providerTemp->setPhone($row["tel"]);
                    $providerTemp->setEmail($row["email"]);
					$providerTemp->setDni($row["dni"]);				
                    $providerTemp->setAddress($row["address"]);
                    $providerTemp->setCuilNumber($row["cuil"]);
                    $providerTemp->setSocialReason($row["social_reason"]);
                    $providerTemp->setBilling($row["type_billing"]);
                    $providerTemp->setIsActive($row["is_active"]);
					array_push($this->providerList, $providerTemp);
				}
				return $this->providerList;	
			} catch (Exception $e) {
				return false;
			}
		}		
				
		public function enableById(Provider $provider) {
			try {
				$query = "CALL provider_enableById(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Provider $provider) {
			try {
				$query = "CALL provider_disableById(?)";
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}	
				
		public function checkEmail(Provider $provider) {
			try {
				$query = "CALL provider_checkEmail(?, ?)";
				$parameters["email"] = $provider->getEmail();
				$parameters["id"] = $provider->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
			}
		}
		
		public function update(Provider $provider) {
			try {								
				$query = "CALL provider_update(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $provider->getName();
				$parameters["lastname"] = $provider->getLastName();
				$parameters["tel"] = $provider->getPhone();
				$parameters["email"] = $provider->getEmail();
                $parameters["dni"] = $provider->getDni();
                $parameters["address"] = $provider->getAddress();
                $parameters["cuil"] = $provider->getCuilNumber();
                $parameters["social_reason"] = $provider->getSocialReason();
				$parameters["type_billing"] = $provider->getBilling(); 			
				$parameters["id"] = $provider->getId(); 	
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
			}
		}
		

    }

 ?>
