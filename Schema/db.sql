DROP DATABASE southbeach;

CREATE DATABASE southbeach;

USE southbeach;

----------------------------- ADMIN -----------------------------

CREATE TABLE admin (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `dni` INT NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE    
);


----------------------------- CLIENT -----------------------------

CREATE TABLE client (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `tel` INT NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `is_potential` BOOLEAN NOT NULL DEFAULT FALSE,    
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE    
);

----------------------------- RESERVATION -----------------------------

CREATE TABLE reservation (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`date_start` DATE NOT NULL,
    `date_end` DATE NOT NULL,
    `total_price` INT NOT NULL,
    `FK_id_client` INT NOT NULL,
    `FK_id_admin` INT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    CONSTRAINT `FK_id_client_reservation` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`),
    CONSTRAINT `FK_id_admin_reservation` FOREIGN KEY (`FK_id_admin`) REFERENCES `admin` (`id`)
);

----------------------------- BEACH-TENT -----------------------------

CREATE TABLE beach_tent (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` INT NOT NULL UNIQUE,    
    `FK_id_reservation` INT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    CONSTRAINT `FK_id_reservation_beach` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`)
);

----------------------------- PARKING -----------------------------

CREATE TABLE parking (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` INT NOT NULL UNIQUE,    
    
    `price` INT NULL,   -- verificar si el estacionamiento tiene un precio

    `FK_id_reservation` INT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    CONSTRAINT `FK_id_reservation_parking` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`)
);

----------------------------- PROVIDER -----------------------------

CREATE TABLE provider (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `tel` INT NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `dni` INT NOT NULL UNIQUE,
    `address` VARCHAR(255) NOT NULL,
    `cuil` INT NOT NULL,
    `social_reason` VARCHAR(255) NOT NULL,
    `billing` VARCHAR(255) NOT NULL,    -- TIPO DE FACTURACION - VERIFICAR
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE 
);

----------------------------- PRODUCT -----------------------------

CREATE TABLE product (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `FK_id_provider` INT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE, 
    CONSTRAINT `FK_id_provider_product` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`)
);