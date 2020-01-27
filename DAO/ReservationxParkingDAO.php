<?php

    namespace DAO;

    use \Exception as Exception;
    use Models\Admin as Admin;	    
    use Models\Client as Client;	    
    use Models\Parking as Parking;
    use Models\BeachTent as BeachTent;	    
    use Models\Reservation as Reservation;    
    use Models\ReservationxParking as ReservationxParking;  
	use DAO\QueryType as QueryType;
	use DAO\Connection as Connection;	

    class ReservationxParkingDAO {

		private $connection;
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
                // return false;
                echo $e;
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

                    $tent = new BeachTent();
                    $tent->setNumber($row["beach_tent_number"]);

                    $reservation->setBeachTent($tent);

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



    }

?>