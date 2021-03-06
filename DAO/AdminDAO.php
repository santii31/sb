<?php

    namespace DAO;

	use \Exception as Exception;
	use \PDOException as PDOException;
	use Models\Admin as Admin;	
	use Models\Reservation as Reservation;	
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class AdminDAO {

		private $connection;
		private $adminList = array();
		private $tableName = "admin";		

		public function __construct() { }

		
        public function add(Admin $admin, Admin $registerBy) {								
			try {					
				$query = "CALL admin_add(?, ?, ?, ?, ?, ?, ?)";
				$parameters["name"] = $admin->getName();
				$parameters["lastname"] = $admin->getLastName();
				$parameters["email"] = $admin->getEmail();
				$parameters["dni"] = $admin->getDni();
				$parameters["password"] = $admin->getPassword();
				$parameters["date_register"] = date("Y-m-d");
				$parameters["register_by"] = $registerBy->getId();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}						
			catch (Exception $e) {
				return false;
				// echo $e;
			}	
        }
					
		public function getById(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getById(?)";
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}

		public function getByDni(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getByDni(?)";
				$parameters["dni"] = $admin->getDni();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}		

		public function getByEmail(Admin $admin) {
			try {				
				$userTemp = null;
				$query = "CALL admin_getByEmail(?)";
				$parameters["email"] = $admin->getEmail();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								
				foreach ($results as $row) {
					$userTemp = new Admin();
					$userTemp->setId($row["id"]);
					$userTemp->setName($row["name"]);
					$userTemp->setLastName($row["lastname"]);
					$userTemp->setEmail($row["email"]);
					$userTemp->setDni($row["dni"]);
					$userTemp->setPassword($row["password"]);				
					$userTemp->setIsActive($row["is_active"]);
				}
				return $userTemp;
			} catch (Exception $e) {
				return false;
			}
		}
		
		public function getAll() {
			try {
				$query = "CALL admin_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);								
					$admin->setIsActive($row["is_active"]);
					array_push($this->adminList, $admin);
				}
				return $this->adminList;	
			} catch (Exception $e) {
				return false;
			}
		}		
		
		public function getAllActives() {
			try {
				$list = array();
				$query = "CALL admin_getAllActives()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);								
					$admin->setIsActive($row["is_active"]);
					array_push($list, $admin);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function enableById(Admin $admin, Admin $enableBy) {
			try {
				$query = "CALL admin_enableById(?, ?, ?)";
				$parameters["id"] = $admin->getId();
				$parameters["date_enable"] = date("Y-m-d");
				$parameters["enable_by"] = $enableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}

		public function disableById(Admin $admin, Admin $disableBy) {
			try {
				$query = "CALL admin_disableById(?, ?, ?)";
				$parameters["id"] = $admin->getId();
				$parameters["date_disable"] = date("Y-m-d");
				$parameters["disable_by"] = $disableBy->getId();
				$this->connection = Connection::GetInstance();
				$this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
				return false;
			}
		}	
		
		public function checkEmail(Admin $admin) {
			try {
				$query = "CALL admin_checkEmail(?, ?)";
				$parameters["email"] = $admin->getEmail();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function checkDni(Admin $admin) {
			try {
				$query = "CALL admin_checkDni(?, ?)";
				$parameters["dni"] = $admin->getDni();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);
			}
			catch (Exception $e) {
				return false;
				// echo $e;
			}
		}

		public function update(Admin $admin, Admin $updateBy) {
			try {								
				$query = "CALL admin_update(?, ?, ?, ?, ?, ?, ?)";		
				$parameters["name"] = $admin->getName();
				$parameters["lastname"] = $admin->getLastName();
				$parameters["dni"] = $admin->getDni();
				$parameters["email"] = $admin->getEmail();                	
				$parameters["date_update"] = date("Y-m-d");
				$parameters["update_by"] = $updateBy->getId();
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				return $this->connection->ExecuteNonQuery($query, $parameters, QueryType::StoredProcedure);		
			} catch (Exception $e) {
				return false;
				// echo $e;
			}
		}
		
		public function getEmails() {
			try {
				$emails = array();
				$query = "CALL admin_getEmails()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$email =  $row["email"];										
					array_push($emails, $email);
				}
				return $emails;	
			} catch (Exception $e) {
				return false;				
			}
		}	
		
		public function getAllWithRsv() {
			try {
				$list = array();
				$query = "CALL admin_getAllWithRsv()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["admin_id"]);
					$admin->setName($row["admin_name"]);
					$admin->setLastName($row["admin_lastname"]);										
					$admin->setIsActive($row["admin_is_active"]);
					array_push($list, $admin);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function getAllCountRsvById(Admin $admin) {
			try {				
				$query = "CALL admin_getAllCountRsvById(?)";
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);	
				foreach ($results as $row) {					
					return $row["total"];
				}							
			} catch (Exception $e) {				
				return false;		
				// echo $e;		
			}
		}

		public function getAllRsvById(Admin $admin) {
			try {
				$list = array();
				$query = "CALL admin_getAllRsvById(?)";
				$parameters["id"] = $admin->getId();
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);	
				foreach ($results as $row) {
					$reservation = new Reservation();
					$reservation->setPrice($row["total"]);
					array_push($list, $reservation);
				}
				return $list;	
			} catch (Exception $e) {
				return false;
			}
		}

		public function getActiveCount() {
            try {				
                $query = "CALL admin_getActiveCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getDisableCount() {
            try {				
                $query = "CALL admin_getDisableCount()";				
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);								
                foreach ($results as $row) {
                    return $row["total"];
                }
            }
            catch (Exception $ex) {
                return false;                
            }
        }

        public function getAllActiveWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL admin_getAllActiveWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);								
					$admin->setIsActive($row["is_active"]);
					array_push($list, $admin);
				}
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }

        public function getAllDisableWithLimit($start) {
            try {				
                $list = array();
                $query = "CALL admin_getAllDisableWithLimit(?, ?)";
                $parameters["start"] = $start;
                $parameters["max_items"] = MAX_ITEMS_PAGE;
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);								          
                foreach ($results as $row) {
					$admin = new Admin();
					$admin->setId($row["id"]);
					$admin->setName($row["name"]);
					$admin->setLastName($row["lastname"]);
					$admin->setEmail($row["email"]);
					$admin->setDni($row["dni"]);								
					$admin->setIsActive($row["is_active"]);
					array_push($list, $admin);                                          
                }
                return $list;
            }
            catch (Exception $ex) {
                return false;
            }
        }			

    }

 ?>
