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

DROP procedure IF EXISTS `admin_add`;
DELIMITER $$
CREATE PROCEDURE admin_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN dni VARCHAR(255),
                                IN email VARCHAR(255),
                                IN password VARCHAR(255)
                                IN is_active BOOLEAN)
BEGIN
	INSERT INTO admin (
			admin.name,
			admin.lastname,
			admin.dni,
			admin.email,
			admin.password,
			admin.is_active
	)
    VALUES
        (name,lastname,dni,email,password,is_active);
END$$

DROP procedure IF EXISTS `admin_getById`;
DELIMITER $$
CREATE PROCEDURE admin_getById (IN id INT)
BEGIN
	SELECT * FROM `admin` WHERE `admin`.`id` = id;
END$$

DROP procedure IF EXISTS `admin_getAll`;
DELIMITER $$
CREATE PROCEDURE admin_getAll ()
BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
END$$




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

DROP procedure IF EXISTS `client_add`;
DELIMITER $$
CREATE PROCEDURE client_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN email VARCHAR(255) NOT NULL UNIQUE,
                                IN tel INT,
                                IN city VARCHAR(255),
                                IN address VARCHAR(255),
                                IN is_potential BOOLEAN,
                                IN is_active BOOLEAN)
BEGIN
	INSERT INTO client (
			client.name,
			client.lastname,
			client.email,
            client.tel,
            client.city,
            client.address,
            client.is_potential,
			client.is_active
	)
    VALUES
        (name,lastname,email,tel,city,address,is_potential,is_active);
END$$

DROP procedure IF EXISTS `client_getById`;
DELIMITER $$
CREATE PROCEDURE client_getById (IN id INT)
BEGIN
	SELECT * FROM `client` WHERE `client`.`id` = id;
END$$

DROP procedure IF EXISTS `client_getAll`;
DELIMITER $$
CREATE PROCEDURE client_getAll ()
BEGIN
	SELECT * FROM `client` ORDER BY name ASC;
END$$

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

DROP procedure IF EXISTS `reservation_add`;
DELIMITER $$
CREATE PROCEDURE reservation_add (
                                IN date_start DATE,
                                IN date_end DATE,
                                IN total_price int,
                                IN FK_id_client INT,
                                IN FK_id_admin int,
                                IN is_active BOOLEAN)
BEGIN
	INSERT INTO reservation (
			reservation.date_start,
            reservation.date_end,
            reservation.total_price,
            reservation.FK_id_client,
            reservation.FK_id_admin,
            reservation.is_active
	)
    VALUES
        (date_start,date_end,total_price,FK_id_client,FK_id_admin,is_active);
END$$


DROP procedure IF EXISTS `reservation_getById`;
DELIMITER $$
CREATE PROCEDURE reservation_getById (IN id INT)
BEGIN
	SELECT * FROM `reservation` WHERE `reservation`.`id` = id;
END$$

DROP procedure IF EXISTS `reservation_getAll`;
DELIMITER $$
CREATE PROCEDURE reservation_getAll ()
BEGIN
	SELECT * FROM `reservation` ORDER BY date_start ASC;
END$$
----------------------------- BEACH-TENT -----------------------------

CREATE TABLE beach_tent (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` INT NOT NULL UNIQUE,    
    `FK_id_reservation` INT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    CONSTRAINT `FK_id_reservation_beach` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`)
);



DROP procedure IF EXISTS `tent_getById`;
DELIMITER $$
CREATE PROCEDURE tent_getById (IN id INT)
BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`id` = id;
END$$

DROP procedure IF EXISTS `tent_getAll`;
DELIMITER $$
CREATE PROCEDURE tent_getAll ()
BEGIN
	SELECT * FROM `beach_tent` ORDER BY number ASC;
END$$
----------------------------- PARKING -----------------------------

CREATE TABLE parking (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` INT NOT NULL UNIQUE,    
    
    `price` INT NULL,   -- verificar si el estacionamiento tiene un precio

    `FK_id_reservation` INT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    CONSTRAINT `FK_id_reservation_parking` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`)
);



DROP procedure IF EXISTS `parking_getById`;
DELIMITER $$
CREATE PROCEDURE parking_getById (IN id INT)
BEGIN
	SELECT * FROM `parking` WHERE `parking`.`id` = id;
END$$

DROP procedure IF EXISTS `parking_getAll`;
DELIMITER $$
CREATE PROCEDURE parking_getAll ()
BEGIN
	SELECT * FROM `parking` ORDER BY number ASC;
END$$
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


DROP procedure IF EXISTS `provider_add`;
DELIMITER $$
CREATE PROCEDURE provider_add (
                                IN name VARCHAR(255),
                                IN lastname(255),
                                IN tel int,
                                IN email VARCHAR(255),
                                IN dni int,
                                IN address VARCHAR(255),
                                IN cuil int,
                                IN social_reason VARCHAR(255),
                                IN is_active BOOLEAN)
BEGIN
	INSERT INTO provider (
            provider.name,
            provider.lastname,
            provider.tel,
            provider.email,
            provider.dni,
            provider.address,
            provider.cuil,
            provider.social_reason,
            provider.is_active
	)
    VALUES
        (name,lastname,tel,email,dni,address,cuil,social_reason,is_active);
END$$


DROP procedure IF EXISTS `provider_getById`;
DELIMITER $$
CREATE PROCEDURE provider_getById (IN id INT)
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$

DROP procedure IF EXISTS `provider_getAll`;
DELIMITER $$
CREATE PROCEDURE provider_getAll ()
BEGIN
	SELECT * FROM `provider` ORDER BY lastname ASC;
END$$

----------------------------- PRODUCT -----------------------------

CREATE TABLE product (
	`id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `price` INT NOT NULL,
    `FK_id_provider` INT NOT NULL,
    'FK_id_category' INT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE, 
    CONSTRAINT `FK_id_provider_product` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`),
    CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`)
);


DROP procedure IF EXISTS `product_add`;
DELIMITER $$
CREATE PROCEDURE product_add (
                                IN name VARCHAR(255),
                                IN price int,
                                IN FK_id_provider int,
                                IN FK_id_category int,
                                IN is_active BOOLEAN)
BEGIN
	INSERT INTO product (
			product.name,
            product.price,
            product.FK_id_provider,
            product.FK_id_category,
            product is_active
	)
    VALUES
        (name,price,FK_id_provider,FK_id_category,is_active);
END$$


DROP procedure IF EXISTS `product_getById`;
DELIMITER $$
CREATE PROCEDURE product_getById (IN id INT)
BEGIN
	SELECT * FROM `product` WHERE `product`.`id` = id;
END$$

DROP procedure IF EXISTS `product_getAll`;
DELIMITER $$
CREATE PROCEDURE product_getAll ()
BEGIN
	SELECT * FROM `product` ORDER BY price ASC;
END$$
----------------------------- CATEGORY -----------------------------



------------------------- ADDITIONAL SERVICE ---------------------

CREATE TABLE additional_service (
    'id' int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    'description' VARCHAR(255) NOT NULL,
    'price' int NOT NULL,
    'FK_id_reservation' int NOT NULL,
    'is_active' BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT 'FK_id_reservation_service' FOREIGN KEY ('FK_id_reservation') REFERENCES 'reservation' ('id')

);



DROP procedure IF EXISTS `service_getById`;
DELIMITER $$
CREATE PROCEDURE service_getById (IN id INT)
BEGIN
	SELECT * FROM `service` WHERE `service`.`id` = id;
END$$

DROP procedure IF EXISTS `service_getAll`;
DELIMITER $$
CREATE PROCEDURE service_getAll ()
BEGIN
	SELECT * FROM `service` ORDER BY price ASC;
END$$

---------------------------- CHEST ---------------------------

CREATE TABLE chest (
    'id' int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    'chest_number' int NOT NULL UNIQUE,
    'price' int NOT NULL,
    'FK_id_service' int NOT NULL,
    'is_active' BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT 'FK_id_service_chest' FOREIGN KEY ('FK_id_service') REFERENCES 'additional_service'('id')

);



DROP procedure IF EXISTS `chest_getById`;
DELIMITER $$
CREATE PROCEDURE chest_getById (IN id INT)
BEGIN
	SELECT * FROM `chest` WHERE `chest`.`id` = id;
END$$

DROP procedure IF EXISTS `chest_getAll`;
DELIMITER $$
CREATE PROCEDURE chest_getAll ()
BEGIN
	SELECT * FROM `chest` ORDER BY price ASC;
END$$

---------------------------- UMBRELLA ---------------------------

CREATE TABLE umbrella (
    'id' int NOT NULL AUTO_INCREMENT PRIMARY KEY,
    'umbrella_number' int NOT NULL UNIQUE,
    'price' int NOT NULL,
    'FK_id_service' int NOT NULL,
    'is_active' BOOLEAN NOT NULL DEFAULT TRUE,
    CONSTRAINT 'FK_id_service_umbrella' FOREIGN KEY ('FK_id_service') REFERENCES 'additional_service'('id')

);



DROP procedure IF EXISTS `umbrella_getById`;
DELIMITER $$
CREATE PROCEDURE umbrella_getById (IN id INT)
BEGIN
	SELECT * FROM `umbrella` WHERE `umbrella`.`id` = id;
END$$

DROP procedure IF EXISTS `umbrella_getAll`;
DELIMITER $$
CREATE PROCEDURE umbrella_getAll ()
BEGIN
	SELECT * FROM `umbrella` ORDER BY price ASC;
END$$
