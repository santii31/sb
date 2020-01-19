<?php

    namespace Models;
    
    class Config {
        
        private $date_end_season;
        private $price_tent_season;
        private $price_tent_day;
        private $price_tent_january;
        private $price_tent_rest;
        private $price_tent_period;
        private $price_tent_fortnigh;
        private $price_parasol;
        private $price_parking;


        public getDateEndSeason() {
            return $this->date_end_season;
        }

        public setDateEndSeason($date_end_season) {
            $this->date_end_season = $date_end_season;
        }

        public getPriceTentSeason() {
            return $this->price_tent_season;
        }

        public setPriceTentSeason($price_tent_season) {
            $this->price_tent_season = $price_tent_season;
        }

        public getPriceTentDay() {
            return $this->price_tent_day;
        }

        public setPriceTentDay($price_tent_day) {
            $this->price_tent_day = $price_tent_day;
        }

        public getPriceTentJanuary() {
            return $this->price_tent_january;
        }

        public setPriceTentJanuary($price_tent_january) {
            $this->price_tent_january = $price_tent_january;
        }

        public getPriceTentRest() {
            return $this->price_tent_rest;
        }

        public setPriceTentRest($price_tent_rest) {
            $this->price_tent_rest = $price_tent_rest;
        }

        public getPriceTentPeriod() {
            return $this->price_tent_period;
        }

        public setPriceTentPeriod($price_tent_period) {
            $this->price_tent_period = $price_tent_period;
        }

        public getPriceTentFortnigh() {
            return $this->price_tent_fortnigh;
        }

        public setPriceTentFortnigh($price_tent_fortnigh) {
            $this->price_tent_fortnigh = $price_tent_fortnigh;
        }

        public getPriceParasol() {
            return $this->price_parasol;
        }

        public setPriceParasol($price_parasol) {
            $this->price_parasol = $price_parasol;
        }

        public getPriceParking() {
            return $this->price_parking;
        }

        public setPriceParking($price_parking) {
            $this->price_parking = $price_parking;
        }

    }

?>