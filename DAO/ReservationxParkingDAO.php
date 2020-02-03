<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Admin as Admin;	    
    use Models\Client as Client;	    
    use Models\Parasol as Parasol;	
    use Models\Parking as Parking;
    use Models\BeachTent as BeachTent;	    
    use Models\Reservation as Reservation;    
    use Models\ReservationxParking as ReservationxParking;  

    use DAO\ParasolDAO as ParasolDAO;
    use DAO\BeachTentDAO as BeachTentDAO;

	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationxParkingDAO {

        private $connection;
        private $tentDAO;
        private $parasolDAO;
        private $reservationList = array();
        private $serviceList = array();			

		public function __construct() { }

		
        public function add(ReservationxParking $reservationxParking) {								
			try {		                        
				$query = "CALL reservationxparking_add(?, ?)";
                $parameters["FK_id_reservation"] = $reservationxParking->getReservation()->getId();
                $parameters["FK_id_parking"] = $reservationxParking->getParking()->getId();
				$this->connection = Connection::getInstance();
				$this->connection->executeNonQuery($query, $parameters, QueryType::StoredProcedure);
				return true;
			}
			catch (Exception $e) {
                return false;
                // echo $e;
			}			
        }

        public function getAll() {
			try {
				$query = "CALL reservationxparking_getAll()";
				$this->connection = Connection::GetInstance();
				$results = $this->connection->Execute($query, array(), QueryType::StoredProcedure);
				foreach ($results as $row) {
                    
                    $reservationxParking = new ReservationxParking();

                    $reservation = new Reservation();
                    $reservation->setId($row["reservation_id"]);
                    $reservation->setDateStart($row["reservation_date_start"]);
                    $reservation->setDateEnd($row["reservation_date_end"]);

                    $client = new Client();
                    $client->setName($row["client_name"]);
                    $client->setLastname($row["client_lastname"]);

                    $reservation->setClient($client);

                    $parking = new Parking();
                    $parking->setId($row["parking_id"]);
                    $parking->setNumber($row["parking_number"]);
                    $parking->setPrice($row["parking_price"]);
                    
                    $reservationxParking->setReservation($reservation);
                    $reservationxParking->setParking($parking);

					array_push($this->reservationList, $reservationxParking);
				}
				return $this->reservationList;	
			} catch (Exception $e) {
				return false;
			}
        }

        public function getAllByParkingId(Parking $parking) {
            try {
                $reservationxParkingList = array();
                $query = "CALL reservationxparking_getByIdParking(?)";
                $parameters["id"] = $parking->getId();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach ($results as $row) {
                    
                    $reservationxParking = new ReservationxParking();

                    $reservation = new Reservation();
                    $reservation->setId($row["reservation_id"]);
                    $reservation->setDateStart($row["reservation_date_start"]);
                    $reservation->setDateEnd($row["reservation_date_end"]);
                    $reservation->setStay($row["reservation_stay"]);


                    if ($row["reservation_fk_id_tent"] != null) {
                        
                        $this->tentDAO = new BeachTentDAO();                    
                        $tent = new BeachTent();                        
                        $tent->setId($row["reservation_fk_id_tent"]);

                        $reservation->setBeachTent( $this->tentDAO->getById($tent) );

                    } elseif ($row["reservation_fk_id_parasol"] != null) {
                        
                        $this->parasolDAO = new ParasolDAO();                        
                        $parasol = new Parasol();                        
                        $parasol->setId($row["reservation_fk_id_parasol"]);

                        $reservation->setParasol( $this->parasolDAO->getById($parasol) );
                    }                    

                    $client = new Client();
                    $client->setName($row["client_name"]);
                    $client->setLastname($row["client_lastname"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);

                    $reservation->setClient($client);

                    $parking = new Parking();
                    $parking->setId($row["parking_id"]);
                    $parking->setNumber($row["parking_number"]);
                    $parking->setPrice($row["parking_price"]);
                    
                    $reservationxParking->setReservation($reservation);
                    $reservationxParking->setParking($parking);      
                    
                    array_push($reservationxParkingList, $reservationxParking);
                }
                
                return $reservationxParkingList;	

            } catch (Exception $e) {
                // return false;
                echo $e;
            }        
        }

        public function getAllByParkingNumber(Parking $parking) {
            try {
                $reservationxParkingList = array();
                $query = "CALL reservationxparking_getByNumberParking(?)";
                $parameters["id"] = $parking->getNumber();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);

                foreach ($results as $row) {
                    
                    $reservationxParking = new ReservationxParking();

                    $reservation = new Reservation();
                    $reservation->setId($row["reservation_id"]);
                    $reservation->setDateStart($row["reservation_date_start"]);
                    $reservation->setDateEnd($row["reservation_date_end"]);
                    $reservation->setStay($row["reservation_stay"]);

                    if ($row["reservation_fk_id_tent"] != null) {
                        
                        $this->tentDAO = new BeachTentDAO();                    
                        $tent = new BeachTent();                        
                        $tent->setId($row["reservation_fk_id_tent"]);

                        $reservation->setBeachTent( $this->tentDAO->getById($tent) );

                    } elseif ($row["reservation_fk_id_parasol"] != null) {
                        
                        $this->parasolDAO = new ParasolDAO();                        
                        $parasol = new Parasol();                        
                        $parasol->setId($row["reservation_fk_id_parasol"]);

                        $reservation->setParasol( $this->parasolDAO->getById($parasol) );
                    }                    

                    $client = new Client();
                    $client->setName($row["client_name"]);
                    $client->setLastname($row["client_lastname"]);
                    $client->setEmail($row["client_email"]);
                    $client->setPhone($row["client_tel"]);

                    $reservation->setClient($client);

                    $parking = new Parking();
                    $parking->setId($row["parking_id"]);
                    $parking->setNumber($row["parking_number"]);
                    $parking->setPrice($row["parking_price"]);
                    
                    $reservationxParking->setReservation($reservation);
                    $reservationxParking->setParking($parking);      
                    
                    array_push($reservationxParkingList, $reservationxParking);
                }
                
                return $reservationxParkingList;	

            } catch (Exception $e) {
                return false;
                // echo $e;
            }        
        }

        public function getAllByReservationId(Reservation $reservation) {
            try {
                $reservationxParkingList = array();
                $query = "CALL reservationxparking_getByIdReserve_tent(?)";
                $parameters["id"] = $reservation->getId();
                $this->connection = Connection::GetInstance();
                $results = $this->connection->Execute($query, $parameters, QueryType::StoredProcedure);
                foreach ($results as $row) {
                    
                    $reservationxParking = new ReservationxParking();

                    $reservation = new Reservation();
                    $reservation->setId($row["reservation_id"]);
                    $reservation->setDateStart($row["reservation_date_start"]);
                    $reservation->setDateEnd($row["reservation_date_end"]);
                    $reservation->setStay($row["reservation_stay"]);

					if ($row["reservation_fk_id_tent"] != null) {
                        
						$this->tentDAO = new BeachTentDAO();                    
						$beachTent = new BeachTent();                        
						$beachTent->setId($row["reservation_fk_id_tent"]);
			
						$reservation->setBeachTent( $this->tentDAO->getById($beachTent) );
			
					} elseif ($row["reservation_fk_id_parasol"] != null) {
						
						$this->parasolDAO = new ParasolDAO();                        
						$parasol = new Parasol();                        
						$parasol->setId($row["reservation_fk_id_parasol"]);
			
						$reservation->setParasol( $this->parasolDAO->getById($parasol) );
					}

                    $client = new Client();
                    $client->setName($row["client_name"]);
                    $client->setLastname($row["client_lastname"]);                    

                    $reservation->setClient($client);

                    $parking = new Parking();
                    $parking->setId($row["parking_id"]);
                    $parking->setNumber($row["parking_number"]);                    
                    
                    $reservationxParking->setReservation($reservation);

                    $reservationxParking->setParking($parking);      
                    
                    array_push($reservationxParkingList, $reservationxParking);
                }
                
                return $reservationxParkingList;	

            } catch (Exception $e) {
                return false;
                // echo $e;
            }        
        }    

    }

?>