DROP DATABASE southbeach;

CREATE DATABASE southbeach;

USE southbeach;


----------------------------- CONFIG -----------------------------

INSERT INTO config (date_start_season,date_end_season,price_tent_season,price_tent_january,price_tent_january_day,price_tent_january_fortnigh,price_tent_february,price_tent_february_day,price_tent_february_first_fortnigh,price_tent_february_second_fortnigh,price_parasol) VALUES ('2020-01-01' , '2020-03-01' , 50000.00 , 35000.00 , 2500.00 , 20000.00 , 25000.00 , 2000.00, 20000.00, 13000.00, 1800.00);

CREATE TABLE config (    
    `date_start_season` DATE NOT NULL,    
    `date_end_season` DATE NOT NULL,    
    `price_tent_season` FLOAT NOT NULL,    
    `price_tent_january` FLOAT NOT NULL,
    `price_tent_january_day` FLOAT NOT NULL,
    `price_tent_january_fortnigh` FLOAT NOT NULL,
    `price_tent_february` FLOAT NOT NULL,
    `price_tent_february_day` FLOAT NOT NULL,
    `price_tent_february_first_fortnigh` FLOAT NOT NULL,    
    `price_tent_february_second_fortnigh` FLOAT NOT NULL,    
    `price_parasol` FLOAT NOT NULL,

    `date_update` DATE DEFAULT NULL,    
    `update_by` INT DEFAULT NULL,
    
    CONSTRAINT `FK_config_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
)


DROP procedure IF EXISTS `config_get`;
DELIMITER $$
CREATE PROCEDURE config_get ()
BEGIN
	SELECT * FROM `config`;
END$$


DROP procedure IF EXISTS `config_update`;
DELIMITER $$
CREATE PROCEDURE config_update (
                                    IN date_start_season DATE,
                                    IN date_end_season DATE,
                                    IN price_tent_season FLOAT,                                   
                                    IN price_tent_january FLOAT,                                   
                                    IN price_tent_january_day FLOAT,                                   
                                    IN price_tent_january_fortnigh FLOAT,                                   
                                    IN price_tent_february FLOAT,                                   
                                    IN price_tent_february_day FLOAT,                                   
                                    IN price_tent_february_first_fortnigh FLOAT,                                   
                                    IN price_tent_february_second_fortnigh FLOAT,                                   
                                    IN price_parasol FLOAT,     
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `config` 
    SET 
        `config`.`date_start_season` = date_start_season,   
        `config`.`date_end_season` = date_end_season,
        `config`.`price_tent_season` = price_tent_season,
        `config`.`price_tent_january` = price_tent_january,
        `config`.`price_tent_january_day` = price_tent_january_day,
        `config`.`price_tent_january_fortnigh` = price_tent_january_fortnigh,
        `config`.`price_tent_february` = price_tent_february,
        `config`.`price_tent_february_day` = price_tent_february_day,
        `config`.`price_tent_february_first_fortnigh` = price_tent_february_first_fortnigh,
        `config`.`price_tent_february_second_fortnigh` = price_tent_february_second_fortnigh,
        `config`.`price_parasol` = price_parasol,
        `config`.`date_update` = date_update,
        `config`.`update_by` = update_by;        
END$$



----------------------------- ADMIN -----------------------------

CREATE TABLE admin (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `dni` INT NOT NULL UNIQUE,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,

    `date_register` DATE NOT NULL,
    `register_by` INT DEFAULT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,    
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,    
    `date_update` DATE DEFAULT NULL,    
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_admin_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_admin_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_admin_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_admin_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
);


DROP procedure IF EXISTS `admin_add`;
DELIMITER $$
CREATE PROCEDURE admin_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN dni VARCHAR(255),
                                IN email VARCHAR(255),
                                IN password VARCHAR(255),
                                IN date_register DATE,
                                IN register_by INT
                            )
BEGIN
	INSERT INTO admin (
			admin.name,
			admin.lastname,
			admin.dni,
			admin.email,
			admin.password,
            admin.date_register,			
            admin.register_by
	)
    VALUES
        (name, lastname, dni, email, password, date_register, register_by);
END$$



DROP procedure IF EXISTS `admin_getById`;
DELIMITER $$
CREATE PROCEDURE admin_getById (IN id INT)
BEGIN
	SELECT * FROM `admin` WHERE `admin`.`id` = id;
END$$


DROP procedure IF EXISTS `admin_getByDni`;
DELIMITER $$
CREATE PROCEDURE admin_getByDni (IN dni INT)
BEGIN
	SELECT * FROM `admin` WHERE `admin`.`dni` = dni;
END$$


DROP procedure IF EXISTS `admin_getByEmail`;
DELIMITER $$
CREATE PROCEDURE admin_getByEmail (IN email VARCHAR(255))
BEGIN
	SELECT * FROM `admin` WHERE `admin`.`email` = email;
END$$


DROP procedure IF EXISTS `admin_getEmails`;
DELIMITER $$
CREATE PROCEDURE admin_getEmails ()
BEGIN
	SELECT `admin`.`email` FROM `admin`;
END$$


DROP procedure IF EXISTS `admin_getAll`;
DELIMITER $$
CREATE PROCEDURE admin_getAll ()
BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `admin_getAllActives`;
DELIMITER $$
CREATE PROCEDURE admin_getAllActives ()
BEGIN
	SELECT * FROM `admin` WHERE `admin`.`is_active` = true ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `admin_getAllWithRsv`;
DELIMITER $$
CREATE PROCEDURE admin_getAllWithRsv ()
BEGIN
	SELECT * 
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    GROUP BY `admin`.`id`;
END$$


DROP procedure IF EXISTS `admin_getAllCountRsvById`;
DELIMITER $$
CREATE PROCEDURE admin_getAllCountRsvById (IN id INT)
BEGIN
	SELECT count(`admin`.`id`) AS total
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    WHERE `admin`.`id` = id
    GROUP BY `admin`.`id`;
END$$


DROP procedure IF EXISTS `admin_getAllRsvById`;
DELIMITER $$
CREATE PROCEDURE admin_getAllRsvById (IN id INT)
BEGIN
	SELECT `reservation`.`total_price` AS total
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    WHERE `admin`.`id` = id;    
END$$


DROP procedure IF EXISTS `admin_disableById`;
DELIMITER $$
CREATE PROCEDURE admin_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
	UPDATE `admin` 
    SET 
        `admin`.`is_active` = false,
        `admin`.`date_disable` = date_disable,
        `admin`.`disable_by` = disable_by    
    WHERE `admin`.`id` = id;
END$$


DROP procedure IF EXISTS `admin_enableById`;
DELIMITER $$
CREATE PROCEDURE admin_enableById  (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `admin` 
    SET 
        `admin`.`is_active` = true,
        `admin`.`date_enable` = date_enable,
        `admin`.`enable_by` = enable_by          
    WHERE `admin`.`id` = id;	
END$$


DROP procedure IF EXISTS `admin_checkEmail`;
DELIMITER $$
CREATE PROCEDURE admin_checkEmail (
                                        IN id INT,
                                        IN email VARCHAR(255)
                                    )
BEGIN
    SELECT `admin`.`id` FROM `admin` WHERE `admin`.`email` = email AND `admin`.`id` != id;	
END$$


DROP procedure IF EXISTS `admin_checkDni`;
DELIMITER $$
CREATE PROCEDURE admin_checkDni (
                                        IN id INT,
                                        IN dni INT
                                    )
BEGIN
    SELECT `admin`.`id` FROM `admin` WHERE `admin`.`dni` = dni AND `admin`.`id` != id;	
END$$


DROP procedure IF EXISTS `admin_update`;
DELIMITER $$
CREATE PROCEDURE admin_update (
                                    IN name VARCHAR(255),
                                    IN lastname VARCHAR(255),
                                    IN dni INT,
                                    IN email VARCHAR(255),                                    
                                    IN date_update DATE,
                                    IN update_by INT,
                                    IN id INT
                                )
BEGIN
    UPDATE `admin` 
    SET 
        `admin`.`name` = name, 
        `admin`.`lastname` = lastname,
        `admin`.`dni` = dni,
        `admin`.`email` = email,        
        `admin`.`date_update` = date_update,
        `admin`.`update_by` = update_by    
    WHERE 
        `admin`.`id` = id;	
END$$


DROP procedure IF EXISTS `admin_getAllActiveWithLimit`;
DELIMITER $$
CREATE PROCEDURE admin_getAllActiveWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `admin`.*         
    FROM `admin`     
    WHERE `admin`.`is_active` = true
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `admin_getAllDisableWithLimit`;
DELIMITER $$
CREATE PROCEDURE admin_getAllDisableWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `admin`.*         
    FROM `admin`     
    WHERE `admin`.`is_active` = false
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `admin_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE admin_getActiveCount ()
BEGIN
	SELECT count(admin.id) AS total 
    FROM `admin`
    WHERE `admin`.`is_active` = true;
END$$


DROP procedure IF EXISTS `admin_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE admin_getDisableCount ()
BEGIN
	SELECT count(admin.id) AS total 
    FROM `admin`
    WHERE `admin`.`is_active` = false;
END$$



----------------------------- CLIENT -----------------------------

CREATE TABLE client (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,        
    `address` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `cp` INT NOT NULL,  -- cp
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `tel` INT NOT NULL,
    `family_group` VARCHAR(255) NOT NULL,   
    `auxiliary_phone` INT NOT NULL,
    `payment_method` VARCHAR(255) NOT NULL,
    `vehicle_type` VARCHAR(255) NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,    
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,
    CONSTRAINT `FK_client_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
);


DROP PROCEDURE IF EXISTS `client_add`;
DELIMITER $$
CREATE PROCEDURE client_add(
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),                                
                                IN address VARCHAR(255),
                                IN city VARCHAR(255),
                                IN cp INT,
                                IN email VARCHAR(255),
                                IN tel INT,
                                IN family_group VARCHAR(255),
                                IN auxiliary_phone INT,
                                IN vehicle_type VARCHAR(255),                                
                                IN date_register DATE,
                                IN register_by INT,
                                OUT lastId int
							)
BEGIN
    INSERT INTO client (
			client.name,
			client.lastname,            
            client.address,
            client.city,
            client.cp,
			client.email,
            client.tel,
            client.family_group,
            client.auxiliary_phone,
            client.vehicle_type,
            client.date_register,			
            client.register_by
	)
    VALUES (name, lastname, address, city, cp, email, tel, family_group, auxiliary_phone, vehicle_type, date_register, register_by);
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
END$$



DROP procedure IF EXISTS `client_getById`;
DELIMITER $$
CREATE PROCEDURE client_getById (IN id INT)
BEGIN
	SELECT * FROM `client` WHERE `client`.`id` = id;
END$$


DROP procedure IF EXISTS `client_getByEmail`;
DELIMITER $$
CREATE PROCEDURE client_getByEmail (IN email VARCHAR(255))
BEGIN
	SELECT * FROM `client` WHERE `client`.`email` = email;
END$$


DROP procedure IF EXISTS `client_getByName`;
DELIMITER $$
CREATE PROCEDURE client_getByName (IN name VARCHAR(255))
BEGIN
	SELECT             
            reservation.id AS reservation_id,
            reservation.date_start AS reservation_dateStart,
            reservation.date_end AS reservation_dateEnd,
            reservation.stay AS reservation_stay,
            reservation.discount AS reservation_discount,
            reservation.total_price AS reservation_totalPrice, 
            client.id AS client_id,                      
            client.name AS client_name,
            client.lastname AS client_lastName,
            client.email AS client_email,
            client.tel AS client_tel,
            client.city AS client_city,
            client.address AS client_address,
            client.payment_method AS client_paymentMethod,
            client.auxiliary_phone AS client_auxiliaryPhone,
            client.vehicle_type AS client_vehicleType,
            admin.name AS admin_name,
            admin.lastname AS admin_lastName,            
            beach_tent.number AS tent_number            
	FROM `client` 	
    INNER JOIN `reservation` ON `client`.`id` = `reservation`.`FK_id_client`
    INNER JOIN `admin` ON `admin`.`id` = `reservation`.`register_by`
    INNER JOIN `beach_tent` ON `beach_tent`.`id` = `reservation`.`FK_id_tent`
	WHERE `client`.`name` LIKE CONCAT('%', name , '%');
END$$


DROP procedure IF EXISTS `client_getByTentNumber`;
DELIMITER $$
CREATE PROCEDURE client_getByTentNumber (IN number VARCHAR(255))
BEGIN
	SELECT             
            reservation.id AS reservation_id,
            reservation.date_start AS reservation_dateStart,
            reservation.date_end AS reservation_dateEnd,
            reservation.stay AS reservation_stay,
            reservation.discount AS reservation_discount,
            reservation.total_price AS reservation_totalPrice,                       
            client.id AS client_id,
            client.name AS client_name,
            client.lastname AS client_lastName,
            client.email AS client_email,
            client.tel AS client_tel,
            client.city AS client_city,
            client.address AS client_address,
            client.payment_method AS client_paymentMethod,
            client.auxiliary_phone AS client_auxiliaryPhone,
            client.vehicle_type AS client_vehicleType,
            admin.name AS admin_name,
            admin.lastname AS admin_lastName,            
            beach_tent.number AS tent_number            
	FROM `client` 	
    INNER JOIN `reservation` ON `client`.`id` = `reservation`.`FK_id_client`
    INNER JOIN `admin` ON `admin`.`id` = `reservation`.`register_by`
    INNER JOIN `beach_tent` ON `beach_tent`.`id` = `reservation`.`FK_id_tent`
	WHERE `beach_tent`.`number` LIKE CONCAT('%', number , '%');
END$$


DROP procedure IF EXISTS `client_getEmails`;
DELIMITER $$
CREATE PROCEDURE client_getEmails ()
BEGIN
	SELECT `client`.`email` FROM `client`;
END$$


DROP procedure IF EXISTS `client_getAll`;
DELIMITER $$
CREATE PROCEDURE client_getAll ()
BEGIN
	SELECT * FROM `client` ORDER BY id ASC;
END$$


DROP procedure IF EXISTS `client_disableById`;
DELIMITER $$
CREATE PROCEDURE client_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
	UPDATE `client` 
    SET 
        `client`.`is_active` = false, 
        `client`.`date_disable` = date_disable,
        `client`.`disable_by` = disable_by
    WHERE `client`.`id` = id;
END$$


DROP procedure IF EXISTS `client_enableById`;
DELIMITER $$
CREATE PROCEDURE client_enableById (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `client` 
    SET 
        `client`.`is_active` = true,
        `client`.`date_enable` = date_enable,
        `client`.`enable_by` = enable_by 
    WHERE `client`.`id` = id;	
END$$


DROP procedure IF EXISTS `client_checkEmail`;
DELIMITER $$
CREATE PROCEDURE client_checkEmail (
                                        IN dni INT,
                                        IN email VARCHAR(255)
                                    )
BEGIN
    SELECT `client`.`id` FROM `client` WHERE `client`.`email` = email AND `client`.`id` != id;	
END$$


DROP procedure IF EXISTS `client_update`;
DELIMITER $$
CREATE PROCEDURE client_update (
                                    IN name VARCHAR(255),
                                    IN lastname VARCHAR(255),                                    
                                    IN address VARCHAR(255),
                                    IN city VARCHAR(255),
                                    IN cp INT,
                                    IN email VARCHAR(255),
                                    IN tel INT,
                                    IN family_group VARCHAR(255),
                                    IN auxiliary_phone INT,
                                    IN payment_method VARCHAR(255),
                                    IN vehicle_type VARCHAR(255),
                                    IN id INT,                              
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `client` 
    SET 
        `client`.`name` = name, 
        `client`.`lastname` = lastname,        
        `client`.`address` = address,
        `client`.`city` = city,
        `client`.`cp` = cp,
        `client`.`email` = email,
        `client`.`tel` = tel,
        `client`.`family_group` = family_group,
        `client`.`auxiliary_phone` = auxiliary_phone,
        `client`.`payment_method` = payment_method,
        `client`.`vehicle_type` = vehicle_type,
        `client`.`date_update` = date_update,
        `client`.`update_by` = update_by    
    WHERE 
        `client`.`id` = id;	
END$$



----------------------------- CLIENT POTENTIAL -----------------------------

CREATE TABLE client_potential (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `tel` INT NOT NULL,    
    `num_tent` INT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
    
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,
    CONSTRAINT `FK_client_potential_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_potential_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_potential_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_client_potential_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
);


DROP procedure IF EXISTS `client_potential_add`;
DELIMITER $$
CREATE PROCEDURE client_potential_add (
                                        IN name VARCHAR(255),
                                        IN lastname VARCHAR(255),
                                        IN address VARCHAR(255),
                                        IN city VARCHAR(255),
                                        IN email VARCHAR(255),
                                        IN tel INT,  
                                        IN num_tent INT,                                                          
                                        IN date_register DATE,
                                        IN register_by INT
                                    )
BEGIN
	INSERT INTO client_potential (
			client_potential.name,
			client_potential.lastname,
            client_potential.address,                        
            client_potential.city,
			client_potential.email,
            client_potential.tel,
            client_potential.num_tent,
            client_potential.date_register,			
            client_potential.register_by
	)
    VALUES
        (name, lastname, address, city, email, tel, num_tent, date_register, register_by);
END$$


DROP procedure IF EXISTS `client_potential_getById`;
DELIMITER $$
CREATE PROCEDURE client_potential_getById (IN id INT)
BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`id` = id;
END$$


DROP procedure IF EXISTS `client_potential_getByName`;
DELIMITER $$
CREATE PROCEDURE client_potential_getByName (IN name VARCHAR(255))
BEGIN
	SELECT * FROM `client_potential` 
    WHERE `client_potential`.`name` LIKE CONCAT('%', name , '%');
END$$


DROP procedure IF EXISTS `client_potential_getByEmail`;
DELIMITER $$
CREATE PROCEDURE client_potential_getByEmail (IN email VARCHAR(255))
BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`email` = email;
END$$


DROP procedure IF EXISTS `client_potential_getEmails`;
DELIMITER $$
CREATE PROCEDURE client_potential_getEmails ()
BEGIN
	SELECT `client_potential`.`email` FROM `client_potential`;
END$$


DROP procedure IF EXISTS `client_potential_getAll`;
DELIMITER $$
CREATE PROCEDURE client_potential_getAll ()
BEGIN
	SELECT * FROM `client_potential` ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `client_potential_getAllActives`;
DELIMITER $$
CREATE PROCEDURE client_potential_getAllActives ()
BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`is_active` = true ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `client_potential_disableById`;
DELIMITER $$
CREATE PROCEDURE client_potential_disableById (
                                                IN id INT,
                                                IN date_disable DATE,
                                                IN disable_by INT
                                            )
BEGIN
	UPDATE `client_potential` 
    SET 
        `client_potential`.`is_active` = false, 
        `client_potential`.`date_disable` = date_disable,
        `client_potential`.`disable_by` = disable_by
    WHERE `client_potential`.`id` = id;
END$$


DROP procedure IF EXISTS `client_potential_enableById`;
DELIMITER $$
CREATE PROCEDURE client_potential_enableById (
                                                IN id INT,
                                                IN date_enable DATE,
                                                IN enable_by INT
                                            )
BEGIN
    UPDATE `client_potential` 
    SET 
        `client_potential`.`is_active` = true,
        `client_potential`.`date_enable` = date_enable,
        `client_potential`.`enable_by` = enable_by 
    WHERE `client_potential`.`id` = id;	
END$$


DROP procedure IF EXISTS `client_checkEmail`;
DELIMITER $$
CREATE PROCEDURE client_potential_checkEmail (
                                                IN id INT,
                                                IN email VARCHAR(255)
                                            )
BEGIN
    SELECT `client_potential`.`id` FROM `client_potential` WHERE `client_potential`.`email` = email AND `client_potential`.`id` != id;	
END$$


DROP procedure IF EXISTS `client_potential_update`;
DELIMITER $$
CREATE PROCEDURE client_potential_update (
                                            IN name VARCHAR(255),
                                            IN lastname VARCHAR(255),
                                            IN address VARCHAR(255),
                                            IN city VARCHAR(255),
                                            IN email VARCHAR(255),
                                            IN tel INT, 
                                            IN num_tent INT,                                                           
                                            IN date_update DATE,
                                            IN update_by INT,
                                            IN id INT
                                        )
BEGIN
    UPDATE `client_potential` 
    SET 
        `client_potential`.`name` = name, 
        `client_potential`.`lastname` = lastname,
        `client_potential`.`address` = address,
        `client_potential`.`city` = city,
        `client_potential`.`email` = email,
        `client_potential`.`tel` = tel,        
        `client_potential`.`num_tent` = num_tent,     
        `client_potential`.`date_update` = date_update,
        `client_potential`.`update_by` = update_by    
    WHERE 
        `client_potential`.`id` = id;	
END$$


DROP procedure IF EXISTS `client_potential_getAllActiveWithLimit`;
DELIMITER $$
CREATE PROCEDURE client_potential_getAllActiveWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `client_potential`.*         
    FROM `client_potential`     
    WHERE `client_potential`.`is_active` = true
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `client_potential_getAllDisableWithLimit`;
DELIMITER $$
CREATE PROCEDURE client_potential_getAllDisableWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `client_potential`.*         
    FROM `client_potential`     
    WHERE `client_potential`.`is_active` = false
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `client_potential_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE client_potential_getActiveCount ()
BEGIN
	SELECT count(client_potential.id) AS total 
    FROM `client_potential`
    WHERE `client_potential`.`is_active` = true;
END$$


DROP procedure IF EXISTS `client_potential_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE client_potential_getDisableCount ()
BEGIN
	SELECT count(client_potential.id) AS total 
    FROM `client_potential`
    WHERE `client_potential`.`is_active` = false;
END$$



----------------------------- HALLS -----------------------------

CREATE TABLE hall (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL
)



----------------------------- PARKING HALL -----------------------------

CREATE TABLE parking_hall (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `number` INT NOT NULL
)



----------------------------- BEACH-TENT -----------------------------

CREATE TABLE beach_tent (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` VARCHAR(50) NOT NULL UNIQUE,
    `price` FLOAT NOT NULL,
    `position` INT NOT NULL,
    `sea` BOOLEAN NOT NULL DEFAULT FALSE,
    `FK_id_hall` INT NOT NULL,
    CONSTRAINT `FK_id_hall_beach_tent` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`)
);


DROP procedure IF EXISTS `beach_tent_add`;
DELIMITER $$
CREATE PROCEDURE beach_tent_add (
                                    IN number INT,
                                    IN price FLOAT,
                                    IN position INT,
                                    IN sea BOOLEAN,
                                    IN FK_id_hall INT                                
                                )
BEGIN
	INSERT INTO beach_tent (
			beach_tent.number,
            beach_tent.price,
            beach_tent.position,
            beach_tent.sea,
            beach_tent.FK_id_hall          
	)
    VALUES
        (number, price, position, sea, FK_id_hall);
END$$


DROP procedure IF EXISTS `tent_getById`;
DELIMITER $$
CREATE PROCEDURE tent_getById (IN id INT)
BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`id` = id;
END$$


DROP procedure IF EXISTS `tent_getByNumber`;
DELIMITER $$
CREATE PROCEDURE tent_getByNumber (IN number INT)
BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`number` = number;
END$$


DROP procedure IF EXISTS `tent_getAll`;
DELIMITER $$
CREATE PROCEDURE tent_getAll ()
BEGIN
	SELECT * FROM `beach_tent` ORDER BY number ASC;    
END$$


DROP procedure IF EXISTS `tent_getAllWithActualReservation`;
DELIMITER $$
CREATE PROCEDURE tent_getAllWithActualReservation (IN today DATE)
BEGIN
	SELECT count(*) AS total
    FROM `beach_tent` 
    INNER JOIN `reservation` ON `beach_tent`.`id` = `reservation`.`FK_id_tent`
    WHERE today BETWEEN `reservation`.`date_start` AND `reservation`.`date_end`;
END$$

-- fix
DROP procedure IF EXISTS `tent_getAllWithoutReservation`;
DELIMITER $$
CREATE PROCEDURE tent_getAllWithoutReservation (IN today DATE)
BEGIN
	SELECT count(*) AS total
    FROM `beach_tent` 
    INNER JOIN `reservation` ON `beach_tent`.`id` = `reservation`.`FK_id_tent`
    WHERE today NOT BETWEEN `reservation`.`date_start` AND `reservation`.`date_end`;
END$$


DROP procedure IF EXISTS `tent_getN_row`;
DELIMITER $$
CREATE PROCEDURE tent_getN_row (IN start INT)
BEGIN
	SELECT         
        `beach_tent`.*, 
        `hall`.`number` AS hall_number 
    FROM `beach_tent` 
    INNER JOIN `hall` ON `beach_tent`.`FK_id_hall` = `hall`.`id`
    WHERE (`beach_tent`.`FK_id_hall` = start ) AND  (`beach_tent`.`sea` = 0)
    ORDER BY `beach_tent`.`position` ASC;     
END$$


DROP procedure IF EXISTS `tent_getSea_N_row`;
DELIMITER $$
CREATE PROCEDURE tent_getSea_N_row (IN start INT)
BEGIN
	SELECT         
        `beach_tent`.*, 
        `hall`.`number` AS hall_number 
    FROM `beach_tent` 
    INNER JOIN `hall` ON `beach_tent`.`FK_id_hall` = `hall`.`id`
    WHERE (`beach_tent`.`FK_id_hall` = start ) AND  (`beach_tent`.`sea` = 1)
    ORDER BY `beach_tent`.`position` ASC;     
END$$



----------------------------- PARKING -----------------------------

CREATE TABLE parking (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`number` VARCHAR(50) NOT NULL UNIQUE, 
    `price` FLOAT NULL,
    `position` INT NOT NULL,
    `FK_id_hall` INT NOT NULL,
    CONSTRAINT `FK_id_hall_parking` FOREIGN KEY (`FK_id_hall`) REFERENCES `parking_hall` (`id`)    
);


DROP procedure IF EXISTS `parking_getById`;
DELIMITER $$
CREATE PROCEDURE parking_getById (IN id INT)
BEGIN
	SELECT * FROM `parking` WHERE `parking`.`id` = id;
END$$


DROP procedure IF EXISTS `parking_getByNumber`;
DELIMITER $$
CREATE PROCEDURE parking_getByNumber (IN number INT)
BEGIN
	SELECT * FROM `parking` WHERE `parking`.`number` = number;
END$$


DROP procedure IF EXISTS `parking_getAll`;
DELIMITER $$
CREATE PROCEDURE parking_getAll ()
BEGIN
	SELECT * FROM `parking` ORDER BY number ASC;    
END$$


DROP procedure IF EXISTS `parking_getN_row`;
DELIMITER $$
CREATE PROCEDURE parking_getN_row (IN start INT)
BEGIN
	SELECT         
        `parking`.*, 
        `parking_hall`.`number` AS hall_number 
    FROM `parking` 
    INNER JOIN `parking_hall` ON `parking`.`FK_id_hall` = `parking_hall`.`id`
    WHERE `parking`.`FK_id_hall` = start 
    ORDER BY `parking`.`position` ASC;     
END$$



----------------------------- RESERVATION -----------------------------

CREATE TABLE reservation (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date_start` DATE NOT NULL,
    `date_end` DATE NOT NULL,
    `stay` VARCHAR(255) NOT NULL,
    `discount` FLOAT NOT NULL,
    `total_price` FLOAT NOT NULL,
    `FK_id_client` INT NOT NULL,    
    `FK_id_tent` INT NOT NULL,
    `is_reserved` BOOLEAN DEFAULT NULL,    
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,        
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,
    CONSTRAINT `FK_id_client_reservation` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`),    
    CONSTRAINT `FK_id_tent_reservation` FOREIGN KEY (`FK_id_tent`) REFERENCES `beach_tent` (`id`),    
    CONSTRAINT `FK_reservation_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_reservation_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_reservation_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_reservation_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
);


DROP PROCEDURE IF EXISTS `reservation_add`;
DELIMITER $$
CREATE PROCEDURE reservation_add(
								    IN date_start DATE,
                                    IN date_end DATE,
                                    IN stay VARCHAR(255),
                                    IN discount FLOAT,
                                    IN total_price FLOAT,
                                    IN FK_id_client INT,                            
                                    IN FK_id_tent INT,                              
                                    IN date_register DATE,
                                    IN register_by INT,
								    OUT lastId int
							)
BEGIN
    INSERT INTO reservation (
			reservation.date_start,
            reservation.date_end,
            reservation.stay,
            reservation.discount,
            reservation.total_price,
            reservation.FK_id_client,            
            reservation.FK_id_tent,            
            reservation.date_register,
            reservation.register_by
	)
    VALUES (date_start, date_end, stay, discount, total_price, FK_id_client, FK_id_tent, date_register, register_by);
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
END$$


DROP procedure IF EXISTS `reservation_getById`;
DELIMITER $$
CREATE PROCEDURE reservation_getById (IN id INT)
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `admin` ON `reservation`.`register_by` = `admin`.`id`
    INNER JOIN `beach_tent` ON `reservation`.`FK_id_tent` = `beach_tent`.`id`
    WHERE `reservation`.`id` = id;
END$$


DROP procedure IF EXISTS `reservation_getByDate`;
DELIMITER $$
CREATE PROCEDURE reservation_getByDate (IN date DATE)
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,		   
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `admin` ON `reservation`.`register_by` = `admin`.`id`
    INNER JOIN `beach_tent` ON `reservation`.`FK_id_tent` = `beach_tent`.`id`
    WHERE `reservation`.`date_register` = date;
END$$


DROP procedure IF EXISTS `reservation_getBetweenDates`;
DELIMITER $$
CREATE PROCEDURE reservation_getBetweenDates (IN date_start DATE, IN date_end DATE)
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,		   
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `admin` ON `reservation`.`register_by` = `admin`.`id`
    INNER JOIN `beach_tent` ON `reservation`.`FK_id_tent` = `beach_tent`.`id`
    WHERE (`reservation`.`date_register` >= date_start) AND (`reservation`.`date_register` <= date_end);
END$$


DROP procedure IF EXISTS `reservation_getAll`;
DELIMITER $$
CREATE PROCEDURE reservation_getAll ()
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id    
    ORDER BY date_start ASC;
END$$


DROP procedure IF EXISTS `reservation_getSalesMonthly`;
DELIMITER $$
CREATE PROCEDURE reservation_getSalesMonthly ()
BEGIN
    SET lc_time_names = 'es_ES';
	SELECT
        YEAR(date_register) AS `year`,
        MONTHNAME(date_register) AS `month`,
        SUM(total_price) AS `subtotal`,
        count(*) AS orders
    FROM reservation
    GROUP BY YEAR(date_register), MONTH(date_register);
    -- WHERE date_register BETWEEN '2020-01-21' AND '2020-01-24'
END$$


DROP procedure IF EXISTS `reservation_getAllActives`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllActives ()
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id   
    WHERE `reservation`.`is_active` = true
    ORDER BY date_start ASC;
END$$


DROP procedure IF EXISTS `reservation_getAllDisables`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllDisables ()
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id   
    WHERE `reservation`.`is_active` = false
    ORDER BY date_start ASC;
END$$


DROP procedure IF EXISTS `reservation_getAllWithClients`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllWithClients ()
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,                                 
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,         
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,  
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number           
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    ORDER BY date_start ASC;
END$$


DROP procedure IF EXISTS `reservation_getAllRsvWithClientsWithLimit`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllRsvWithClientsWithLimit (
                                                                IN start INT,
                                                                IN max_items INT
                                                            )
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,                                 
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,         
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,  
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number           
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    ORDER BY date_start ASC
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `reservation_getAllRsvWithClientsCount`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllRsvWithClientsCount ()
BEGIN
	SELECT count(reservation.id) AS total
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id;    
END$$


DROP procedure IF EXISTS `reservation_getAllByClientId`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllByClientId(IN client_id INT)
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.stay AS reservation_stay,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.payment_method AS client_paymentMethod,
           client.auxiliary_phone AS client_auxiliaryPhone,
           client.vehicle_type AS client_vehicleType,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    WHERE `reservation`.`FK_id_client` = client_id;
END$$


DROP procedure IF EXISTS `reservation_getAllByAdmin`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllByAdmin(IN id INT)
BEGIN
	SELECT 
            reservation.id AS reservation_id,
            reservation.date_start AS reservation_dateStart,
            reservation.date_end AS reservation_dateEnd,
            reservation.stay AS reservation_stay,
            reservation.discount AS reservation_discount,
            reservation.total_price AS reservation_totalPrice,                        
            client.name AS client_name,
            client.lastname AS client_lastName,                                                            
            beach_tent.number AS tent_number            
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    WHERE `reservation`.`register_by` = id;
END$$


DROP procedure IF EXISTS `reservation_disableById`;
DELIMITER $$
CREATE PROCEDURE reservation_disableById (
                                            IN id INT,
                                            IN date_disable DATE,
                                            IN disable_by INT                                            
                                        )
BEGIN
	UPDATE `reservation` 
    SET 
        `reservation`.`is_active` = false, 
        `reservation`.`date_disable` = date_disable,
        `reservation`.`disable_by` = disable_by
    WHERE `reservation`.`id` = id;
END$$


DROP procedure IF EXISTS `reservation_enableById`;
DELIMITER $$
CREATE PROCEDURE reservation_enableById (
                                            IN id INT,
                                            IN date_enable DATE,
                                            IN enable_by INT
                                        )
BEGIN
    UPDATE `reservation` 
    SET 
        `reservation`.`is_active` = true,
        `reservation`.`date_enable` = date_enable,
        `reservation`.`enable_by` = enable_by 
    WHERE `reservation`.`id` = id;	
END$$


DROP procedure IF EXISTS `reservation_checkDateStart`;
DELIMITER $$
CREATE PROCEDURE reservation_checkDateStart (
                                        IN date_start DATE,
                                        IN id INT
                                    )
BEGIN
    SELECT `reservation`.`id` FROM `reservation` WHERE `reservation`.`date_start` = date_start AND `reservation`.`id` != id;	
END$$


DROP procedure IF EXISTS `reservation_update`;
DELIMITER $$
CREATE PROCEDURE reservation_update (
                                    IN date_start DATE,
                                    IN date_end DATE,
                                    IN stay VARCHAR(255),
                                    IN discount FLOAT,
                                    IN total_price FLOAT,
                                    IN date_update DATE,                                    
                                    IN update_by INT,
                                    IN id INT
                                )
BEGIN
    UPDATE `reservation` 
    SET 
        `reservation`.`date_start` = date_start, 
        `reservation`.`date_end` = date_end,
        `reservation`.`stay` = stay,
        `reservation`.`discount` = discount,
        `reservation`.`total_price` = total_price,
        `reservation`.`date_update` = date_update,
        `reservation`.`update_by` = update_by,
        `reservation`.`id` = id    
    WHERE 
        `reservation`.`id` = id;	
END$$


DROP procedure IF EXISTS reservation_geByIdTent;
DELIMITER $$
CREATE PROCEDURE reservation_geByIdTent (IN id INT)
BEGIN
    SELECT        
        reservation.id AS reservation_id,
        reservation.date_start AS reservation_dateStart,
        reservation.date_end AS reservation_dateEnd,
        reservation.stay AS reservation_stay,
        reservation.discount AS reservation_discount,
        reservation.total_price AS reservation_totalPrice,
        client.id AS client_id,
        client.name AS client_name,
        client.lastname AS client_lastName,
        client.email AS client_email,
        client.tel AS client_tel,
        client.city AS client_city,
        client.address AS client_address,
        client.payment_method AS client_paymentMethod,
        client.auxiliary_phone AS client_auxiliaryPhone,
        client.vehicle_type AS client_vehicleType
    FROM reservation         
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    WHERE beach_tent.id = id;    
END$$


DROP procedure IF EXISTS `reservation_getAllActiveWithLimit`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllActiveWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
            reservation.id AS reservation_id,
            reservation.date_start AS reservation_dateStart,
            reservation.date_end AS reservation_dateEnd,
            reservation.stay AS reservation_stay,
            reservation.discount AS reservation_discount,
            reservation.total_price AS reservation_totalPrice,                        
            client.name AS client_name,
            client.lastname AS client_lastName,                                                            
            beach_tent.number AS tent_number 
    FROM reservation         
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN client ON reservation.FK_id_client = client.id            
    WHERE `reservation`.`is_active` = true
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `reservation_getAllDisableWithLimit`;
DELIMITER $$
CREATE PROCEDURE reservation_getAllDisableWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
            reservation.id AS reservation_id,
            reservation.date_start AS reservation_dateStart,
            reservation.date_end AS reservation_dateEnd,
            reservation.stay AS reservation_stay,
            reservation.discount AS reservation_discount,
            reservation.total_price AS reservation_totalPrice,                        
            client.name AS client_name,
            client.lastname AS client_lastName,                                                            
            beach_tent.number AS tent_number 
    FROM reservation         
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN client ON reservation.FK_id_client = client.id     
    WHERE `reservation`.`is_active` = false
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `reservation_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE reservation_getActiveCount ()
BEGIN
	SELECT count(reservation.id) AS total 
    FROM `reservation`
    WHERE `reservation`.`is_active` = true;
END$$


DROP procedure IF EXISTS `reservation_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE reservation_getDisableCount ()
BEGIN
	SELECT count(reservation.id) AS total 
    FROM `reservation`
    WHERE `reservation`.`is_active` = false;
END$$



------------------------- BALANCE ---------------------

CREATE table balance (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date` DATE NOT NULL,
    `concept` VARCHAR(255) NOT NULL,
    `number_receipt` VARCHAR(255) NOT NULL,
    `total` FLOAT NOT NULL,
    `partial` FLOAT NOT NULL,
    `remainder` FLOAT NOT NULL,
    `FK_id_reservation` INT NOT NULL,
    CONSTRAINT `FK_id_reservation_balance` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`FK_id_client`)
);


DROP PROCEDURE IF EXISTS `balance_add`;
DELIMITER $$
CREATE PROCEDURE balance_add(
                                IN date DATE,                                    
                                IN concept VARCHAR(255),
                                IN number_receipt VARCHAR(255),
                                IN total FLOAT,
                                IN partial FLOAT,
                                IN remainder FLOAT,
                                IN FK_id_reservation INT
							)
BEGIN
    INSERT INTO balance (
            balance.date,
            balance.concept,
            balance.number_receipt,
            balance.total,
            balance.partial,
            balance.remainder,
            balance.FK_id_reservation
	)
    VALUES (date, concept, number_receipt, total, partial, remainder, FK_id_reservation);	
END$$


DROP procedure IF EXISTS balance_getByReservationId;
DELIMITER $$
CREATE PROCEDURE balance_getByReservationId (IN id INT)
BEGIN
    SELECT        
        balance.date AS balance_date,
        balance.concept AS balance_concept,
        balance.number_receipt AS balance_number_receipt,
        balance.total AS balance_total,
        balance.partial AS balance_partial,
        balance.remainder AS balance_remainder     
    FROM balance             
    WHERE balance.FK_id_reservation = id;    
END$$



------------------------- RESERVATION_X_PARKING ---------------------

CREATE TABLE reservationxparking (
	`FK_id_reservation` INT NOT NULL,
    `FK_id_parking` INT NOT NULL,
    CONSTRAINT `FK_id_reservation_reservationxparking` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`),
    CONSTRAINT `FK_id_parking_reservationxparking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking` (`id`)
);


DROP procedure IF EXISTS `reservationxparking_add`;
DELIMITER $$
CREATE PROCEDURE reservationxparking_add (
								IN FK_id_reservation INT,
								IN FK_id_parking INT
							 )
BEGIN
	INSERT INTO reservationxparking (
			reservationxparking.FK_id_reservation,
            reservationxparking.FK_id_parking
	)
    VALUES
        (FK_id_reservation, FK_id_parking);
END$$


DROP procedure IF EXISTS `reservationxparking_getAll`;
DELIMITER $$
CREATE PROCEDURE reservationxparking_getAll ()
BEGIN
    SELECT 
        reservation.id as reservation_id,
        reservation.date_start as reservation_date_start,
        reservation.date_end as reservation_date_end,
        client.name as client_name,
        client.lastname as client_lastname,
        parking.id as parking_id,
        parking.number as parking_number,
        parking.price as parking_price        
    FROM `reservationxparking` 
    INNER JOIN `reservation` ON `reservationxparking`.`FK_id_reservation` = `reservation`.`id`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `parking` ON `reservationxparking`.`FK_id_parking` = `parking`.`id`;
    -- ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `reservationxparking_getByIdParking`;
DELIMITER $$
CREATE PROCEDURE reservationxparking_getByIdParking (IN id INT)
BEGIN
    SELECT 
        reservation.id as reservation_id,
        reservation.date_start as reservation_date_start,
        reservation.date_end as reservation_date_end,
        reservation.stay as reservation_stay,
        beach_tent.number as beach_tent_number,
        client.name as client_name,
        client.lastname as client_lastname,
        client.email as client_email,
        client.tel as client_tel,
        parking.id as parking_id,
        parking.number as parking_number,
        parking.price as parking_price        
    FROM `reservationxparking` 
    INNER JOIN `reservation` ON `reservationxparking`.`FK_id_reservation` = `reservation`.`id`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `parking` ON `reservationxparking`.`FK_id_parking` = `parking`.`id`
    INNER JOIN `beach_tent` ON `reservation`.`FK_id_tent` = `beach_tent`.`id`
    WHERE `reservationxparking`.`FK_id_parking` = id;
END$$



----------------------------- PROVIDER -----------------------------

CREATE TABLE provider (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `tel` INT NOT NULL,
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `dni` INT NOT NULL UNIQUE,
    `address` VARCHAR(255) NOT NULL,
    `cuil` INT NOT NULL,
    `social_reason` VARCHAR(255) NOT NULL,
    `type_billing` VARCHAR(255) NOT NULL,  
    `item` VARCHAR(255) NOT NULL, 
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
    
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_provider_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_provider_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_provider_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_provider_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)    
);


DROP procedure IF EXISTS `provider_add`;
DELIMITER $$
CREATE PROCEDURE provider_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN tel int,
                                IN email VARCHAR(255),
                                IN dni int,
                                IN address VARCHAR(255),
                                IN cuil int,
                                IN social_reason VARCHAR(255),
                                IN type_billing VARCHAR(255),
                                IN item VARCHAR(255),
                                IN date_register DATE,
                                IN register_by INT
                            )
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
            provider.type_billing,
            provider.item,
            provider.date_register,
            provider.register_by
	)
    VALUES
        (name, lastname, tel, email, dni, address, cuil, social_reason, type_billing, item, date_register, register_by);
END$$


DROP procedure IF EXISTS `provider_getById`;
DELIMITER $$
CREATE PROCEDURE provider_getById (IN id INT)
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$


DROP procedure IF EXISTS `provider_getByItem`;
DELIMITER $$
CREATE PROCEDURE provider_getByItem (IN item VARCHAR(255))
BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`    
    WHERE `provider`.`item` LIKE CONCAT('%', item , '%');    
END$$


DROP procedure IF EXISTS `provider_getByDni`;
DELIMITER $$
CREATE PROCEDURE provider_getByDni (IN dni INT)
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`dni` = dni;
END$$


DROP procedure IF EXISTS `provider_getByEmail`;
DELIMITER $$
CREATE PROCEDURE provider_getByEmail (IN email VARCHAR(255))
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`email` = email;
END$$


DROP procedure IF EXISTS `provider_getAllActives`;
DELIMITER $$
CREATE PROCEDURE provider_getAllActives ()
BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`
    WHERE `provider`.`is_active` = true
    ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `provider_getAll`;
DELIMITER $$
CREATE PROCEDURE provider_getAll ()
BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`    
    ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `provider_disableById`;
DELIMITER $$
CREATE PROCEDURE provider_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
	UPDATE `provider` 
    SET 
        `provider`.`is_active` = false, 
        `provider`.`date_disable` = date_disable,
        `provider`.`disable_by` = disable_by
    WHERE `provider`.`id` = id;
END$$


DROP procedure IF EXISTS `provider_enableById`;
DELIMITER $$
CREATE PROCEDURE provider_enableById (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `provider` 
    SET 
        `provider`.`is_active` = true, 
        `provider`.`date_enable` = date_enable,
        `provider`.`enable_by` = enable_by
    WHERE `provider`.`id` = id;	
END$$


DROP procedure IF EXISTS `provider_checkEmail`;
DELIMITER $$
CREATE PROCEDURE provider_checkEmail (
                                        IN email VARCHAR(255),
                                        IN id INT
                                    )
BEGIN
    SELECT `provider`.`id` FROM `provider` WHERE `provider`.`email` = email AND `provider`.`id` != id;	
END$$


DROP procedure IF EXISTS `provider_checkDni`;
DELIMITER $$
CREATE PROCEDURE provider_checkDni (
                                        IN dni INT,
                                        IN id INT
                                    )
BEGIN
    SELECT `provider`.`id` FROM `provider` WHERE `provider`.`dni` = dni AND `provider`.`id` != id;	
END$$


DROP procedure IF EXISTS `provider_update`;
DELIMITER $$
CREATE PROCEDURE provider_update (
                                    IN name VARCHAR(255),
                                    IN lastname VARCHAR(255),
                                    IN tel INT,
                                    IN email VARCHAR(255),
                                    IN dni INT,
                                    IN address VARCHAR(255),
                                    IN cuil INT,
                                    IN social_reason VARCHAR(255),
                                    IN type_billing VARCHAR(255),
                                    IN item VARCHAR(255),
                                    IN id INT,
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `provider` 
    SET 
        `provider`.`name` = name, 
        `provider`.`lastname` = lastname,
        `provider`.`tel` = tel,
        `provider`.`email` = email,
        `provider`.`dni` = dni,
        `provider`.`address` = address,
        `provider`.`cuil` = cuil,
        `provider`.`social_reason` = social_reason,
        `provider`.`type_billing` = type_billing,
        `provider`.`item` = item,
        `provider`.`date_update` = date_update,
        `provider`.`update_by` = update_by    
    WHERE 
        `provider`.`id` = id;	
END$$


DROP procedure IF EXISTS `provider_getAllActiveWithLimit`;
DELIMITER $$
CREATE PROCEDURE provider_getAllActiveWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname   
    FROM `provider`     
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`
    WHERE `provider`.`is_active` = true
    ORDER BY name ASC
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `provider_getAllDisableWithLimit`;
DELIMITER $$
CREATE PROCEDURE provider_getAllDisableWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname  
    FROM `provider`     
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`
    WHERE `provider`.`is_active` = false
    ORDER BY name ASC
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `provider_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE provider_getActiveCount ()
BEGIN
	SELECT count(provider.id) AS total 
    FROM `provider`
    WHERE `provider`.`is_active` = true;
END$$


DROP procedure IF EXISTS `provider_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE provider_getDisableCount ()
BEGIN
	SELECT count(provider.id) AS total 
    FROM `provider`
    WHERE `provider`.`is_active` = false;
END$$



----------------------------- CATEGORY -----------------------------

CREATE TABLE category (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL
);


DROP procedure IF EXISTS `category_add`;
DELIMITER $$
CREATE PROCEDURE category_add (
                                IN name VARCHAR(255)
                            )
BEGIN
	INSERT INTO category (
			category.name
	)
    VALUES
        (name);
END$$


DROP procedure IF EXISTS `category_getById`;
DELIMITER $$
CREATE PROCEDURE category_getById (IN id INT)
BEGIN
	SELECT * FROM `category` WHERE `category`.`id` = id;
END$$


DROP procedure IF EXISTS `category_getByName`;
DELIMITER $$
CREATE PROCEDURE category_getByName (IN Name VARCHAR(255))
BEGIN
	SELECT * FROM `category` WHERE `category`.`name` = name;
END$$


DROP procedure IF EXISTS `category_getAll`;
DELIMITER $$
CREATE PROCEDURE category_getAll ()
BEGIN
	SELECT * FROM `category` ORDER BY name ASC;
END$$



----------------------------- PRODUCT -----------------------------

CREATE TABLE product (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL,
    `quantity` INT NOT NULL,
    `FK_id_category` INT NOT NULL,    
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE, 
    
    `date_add` DATE DEFAULT NULL,
    `add_by` INT DEFAULT NULL, 
    `date_remove` DATE DEFAULT NULL,    
    `remove_by` INT DEFAULT NULL,

    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_product_add_by` FOREIGN KEY (`add_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_remove_by` FOREIGN KEY (`remove_by`) REFERENCES `admin` (`id`),

    CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`),    
    CONSTRAINT `FK_product_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`) 
);


DROP PROCEDURE IF EXISTS `product_add`;
DELIMITER $$
CREATE PROCEDURE product_add(
                                IN name VARCHAR(255),
                                IN price INT,
                                IN quantity INT,
                                IN FK_id_category INT,
                                IN date_register DATE,
                                IN register_by INT,
								OUT lastId int
							)
BEGIN
	INSERT INTO product (
			product.name,
            product.price,
            product.quantity,            
            product.FK_id_category,         
            product.date_register,
            product.register_by
	)
    VALUES
        (name, price, quantity, FK_id_category, date_register, register_by);    
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
END$$


DROP procedure IF EXISTS `product_getById`;
DELIMITER $$
CREATE PROCEDURE product_getById (IN id INT)
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`id` = id;
END$$


DROP procedure IF EXISTS `product_getByCategory`;
DELIMITER $$
CREATE PROCEDURE product_getByCategory (IN id_category INT)
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`FK_id_category` = id_category;
END$$


DROP procedure IF EXISTS `product_getByName`;
DELIMITER $$
CREATE PROCEDURE product_getByName (IN name VARCHAR(255))
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`name` = name;
END$$


DROP procedure IF EXISTS `product_getAll`;
DELIMITER $$
CREATE PROCEDURE product_getAll ()
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            product.date_register AS product_date_register,
            category.id AS category_id,
            category.name AS category_name            
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`is_active` = true
    ORDER BY product.price ASC;
END$$


DROP procedure IF EXISTS `product_disableById`;
DELIMITER $$
CREATE PROCEDURE product_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
	UPDATE `product` 
    SET 
        `product`.`is_active` = false, 
        `product`.`date_disable` = date_disable,
        `product`.`disable_by` = disable_by
    WHERE `product`.`id` = id;
END$$


DROP procedure IF EXISTS `product_enableById`;
DELIMITER $$
CREATE PROCEDURE product_enableById (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `product` 
    SET 
        `product`.`is_active` = true, 
        `product`.`date_enable` = date_enable,
        `product`.`enable_by` = enable_by
    WHERE `product`.`id` = id;	
END$$


DROP procedure IF EXISTS `product_update`;
DELIMITER $$
CREATE PROCEDURE product_update (
                                    IN name VARCHAR(255),
                                    IN price INT,
                                    IN quantity INT,
                                    IN FK_id_category INT,
                                    IN date_update DATE,
                                    IN update_by INT,
                                    IN id INT
                                )
BEGIN
    UPDATE `product` 
    SET 
        `product`.`name` = name, 
        `product`.`price` = price,
        `product`.`quantity` = quantity,
        `product`.`FK_id_category` = FK_id_category,    
        `product`.`date_update` = date_update,
        `product`.`update_by` = update_by
    WHERE 
        `product`.`id` = id;	
END$$


DROP procedure IF EXISTS `product_add_quantity`;
DELIMITER $$
CREATE PROCEDURE product_add_quantity (
                                    IN quantity INT,                                    
                                    IN date_add DATE,
                                    IN add_by INT,
                                    IN id INT
                                )
BEGIN
    UPDATE `product` 
    SET         
        `product`.`quantity` = quantity,        
        `product`.`date_add` = date_add,
        `product`.`add_by` = add_by
    WHERE 
        `product`.`id` = id;	
END$$


DROP procedure IF EXISTS `product_remove_quantity`;
DELIMITER $$
CREATE PROCEDURE product_remove_quantity (
                                    IN quantity INT,                                    
                                    IN date_remove DATE,
                                    IN remove_by INT,
                                    IN id INT
                                )
BEGIN
    UPDATE `product` 
    SET         
        `product`.`quantity` = quantity,        
        `product`.`date_remove` = date_remove,
        `product`.`remove_by` = remove_by
    WHERE 
        `product`.`id` = id;	
END$$


DROP procedure IF EXISTS `product_getAllActiveWithLimit`;
DELIMITER $$
CREATE PROCEDURE product_getAllActiveWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            product.date_register AS product_date_register,
            category.id AS category_id,
            category.name AS category_name            
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id       
    WHERE `product`.`is_active` = true
    ORDER BY `product`.`name` ASC
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `product_getAllDisableWithLimit`;
DELIMITER $$
CREATE PROCEDURE product_getAllDisableWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.quantity AS product_quantity,
            product.is_active AS product_isActive,
            product.date_register AS product_date_register,
            category.id AS category_id,
            category.name AS category_name            
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`is_active` = false
    ORDER BY `product`.`name` ASC
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `product_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE product_getActiveCount ()
BEGIN
	SELECT count(product.id) AS total 
    FROM `product`
    WHERE `product`.`is_active` = true;
END$$


DROP procedure IF EXISTS `product_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE product_getDisableCount ()
BEGIN
	SELECT count(product.id) AS total 
    FROM `product`
    WHERE `product`.`is_active` = false;
END$$



------------------------- PROVIDER_X_PRODUCT ---------------------

CREATE TABLE providerxproduct (
	`FK_id_provider` INT NOT NULL,
    `FK_id_product` INT NOT NULL,
    CONSTRAINT `FK_id_provider_providerxproduct` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`),
    CONSTRAINT `FK_id_product_providerxproduct` FOREIGN KEY (`FK_id_product`) REFERENCES `product` (`id`)
);


DROP procedure IF EXISTS `providerxproduct_add`;
DELIMITER $$
CREATE PROCEDURE providerxproduct_add (
								IN FK_id_provider INT,
								IN FK_id_product INT
							 )
BEGIN
	INSERT INTO providerxproduct (
			providerxproduct.FK_id_provider,
            providerxproduct.FK_id_product
	)
    VALUES
        (FK_id_provider, FK_id_product);
END$$


DROP procedure IF EXISTS `providerxproduct_getProductByProvider`;					    
DELIMITER $$
CREATE PROCEDURE providerxproduct_getProductByProvider (IN id_provider INT)
BEGIN
	SELECT 	product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
	FROM providerxproduct
	INNER JOIN product ON providerxproduct.FK_id_product = product.id
	INNER JOIN category ON product.FK_id_category = category.id
	WHERE (providerxproduct.FK_id_provider = id_provider)
	GROUP BY product.id;
END$$


DROP procedure IF EXISTS `providerxproduct_getProviderByProduct`;					    
DELIMITER $$
CREATE PROCEDURE providerxproduct_getProviderByProduct (IN id_product INT)
BEGIN
	SELECT 	provider.id AS provider_id,
            provider.name AS provider_name,
            provider.lastname AS provider_lastName,
            provider.tel AS provider_tel,
            provider.email AS provider_email,
            provider.dni AS provider_dni,
            provider.address AS provider_address,
            provider.cuil AS provider_cuil,
            provider.social_reason AS provider_socialReason,
            provider.type_billing AS provider_typeBilling,
            provider.is_active AS provider_isActive
	FROM providerxproduct
	INNER JOIN provider ON providerxproduct.FK_id_provider = provider.id 
	WHERE (providerxproduct.FK_id_product = id_product)
	GROUP BY provider.id;
END$$


DROP procedure IF EXISTS `providerxproduct_getAll`;					    
DELIMITER $$
CREATE PROCEDURE providerxproduct_getAll ()
BEGIN
	SELECT 	provider.id AS provider_id,
            provider.name AS provider_name,
            provider.lastname AS provider_lastName,
            provider.tel AS provider_tel,
            provider.email AS provider_email,
            provider.dni AS provider_dni,
            provider.address AS provider_address,
            provider.cuil AS provider_cuil,
            provider.social_reason AS provider_socialReason,
            provider.type_billing AS provider_typeBilling,
            provider.is_active AS provider_isActive,
            product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
	FROM providerxproduct
	INNER JOIN provider ON providerxproduct.FK_id_provider = provider.id
    INNER JOIN product ON providerxproduct.FK_id_product = product.id 
	INNER JOIN category ON product.FK_id_category = category.id
	WHERE (providerxproduct.FK_id_product = id_product)
	GROUP BY provider.id;
END$$



---------------------------- PARASOL ---------------------------

CREATE TABLE parasol (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `parasol_number` INT NOT NULL UNIQUE,
    `price` FLOAT NOT NULL,
    `position` INT NOT NULL,    
    `FK_id_hall` INT NOT NULL,
    CONSTRAINT `FK_id_hall_parasol` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`)
);


DROP procedure IF EXISTS `parasol_getById`;
DELIMITER $$
CREATE PROCEDURE parasol_getById (IN id INT)
BEGIN
	SELECT *             
    FROM `parasol` 
    WHERE `parasol`.`id` = id;
END$$


DROP procedure IF EXISTS `parasol_getAll`;
DELIMITER $$
CREATE PROCEDURE parasol_getAll ()
BEGIN
	SELECT *
    FROM `parasol` 
    ORDER BY parasol_number ASC;
END$$


DROP procedure IF EXISTS `parasol_getN_row`;
DELIMITER $$
CREATE PROCEDURE parasol_getN_row (IN start INT)
BEGIN
	SELECT *
    FROM `parasol` 
    WHERE `parasol`.`FK_id_hall` = start
    ORDER BY `parasol`.`position` ASC;
END$$
    

INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (1, 100, 1, 1);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (2, 100, 2, 1);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (3, 100, 3, 1);

INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (4, 100, 4, 2);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (5, 100, 5, 2);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (6, 100, 6, 2);

INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (7, 100, 7, 3);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (8, 100, 8, 3);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (9, 100, 9, 3);

INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (10, 100, 10, 4);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (11, 100, 11, 4);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (12, 100, 12, 4);

INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (13, 100, 13, 5);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (14, 100, 14, 5);
INSERT INTO `parasol`(`parasol_number`, `price`, `position`, `FK_id_hall`) VALUES (15, 100, 15, 5);


---------------------------- MOBILE PARASOL ---------------------------

INSERT INTO mobile_parasol (id,mobileParasol_number,price)  VALUES (1,1,0.00),(2,2,0.00),(3,3,0.00),(4,4,0.00),(5,5,0.00),(6,6,0.00)

CREATE TABLE mobile_parasol (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `mobileParasol_number` INT NOT NULL,
    `price` FLOAT NOT NULL
);

DROP procedure IF EXISTS `mobileParasol_getById`;
DELIMITER $$
CREATE PROCEDURE mobileParasol_getById (IN id INT)
BEGIN
	SELECT * 
    FROM `mobile_parasol` 
    WHERE `mobile_parasol`.`id` = id;
END$$


DROP procedure IF EXISTS `mobileParasol_getAll`;
DELIMITER $$
CREATE PROCEDURE mobileParasol_getAll ()
BEGIN
	SELECT *
    FROM `mobile_parasol`
    ORDER BY id ASC;
END$$


---------------------------- SERVICEXMOBILEPARASOL ---------------------------

CREATE TABLE servicexmobileParasol (
    `FK_id_service` INT NOT NULL,
    `FK_id_mobileParasol` INT NOT NULL,
    CONSTRAINT `FK_id_service_servicexmobileParasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`),
    CONSTRAINT `FK_id_parasol_servicexmobileParasol` FOREIGN KEY (`FK_id_mobileParasol`) REFERENCES `mobile_parasol`(`id`)
);


DROP procedure IF EXISTS `servicexmobileParasol_add`;
DELIMITER $$
CREATE PROCEDURE servicexmobileParasol_add (
                                            IN FK_id_service INT,                                
                                            IN FK_id_mobileParasol INT
                                        )
BEGIN
	INSERT INTO servicexmobileParasol (
			servicexmobileParasol.FK_id_service,
            servicexmobileParasol.FK_id_mobileParasol                   
	)
    VALUES
        (FK_id_service, FK_id_mobileParasol);
END$$


DROP procedure IF EXISTS `servicexmobileParasol_getServiceByMobileParasol`;					    
DELIMITER $$
CREATE PROCEDURE servicexmobileParasol_getServiceByMobileParasol (IN id_mobileParasol INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexmobileParasol
	INNER JOIN additional_service ON servicexmobileParasol.FK_id_service = additional_service.id
	
	WHERE (servicexmobileParasol.FK_id_mobileParasol = id_mobileParasol)
	GROUP BY additional_service.id;
END$$


DROP procedure IF EXISTS `servicexmobileParasol_getMobileParasolByService`;					    
DELIMITER $$
CREATE PROCEDURE servicexmobileParasol_getMobileParasolByService (IN id_service INT)
BEGIN
	SELECT mobile_parasol.id AS mobileParasol_id,
           mobile_parasol.mobileParasol_number AS mobileParasol_number,
           mobile_parasol.price AS mobileParasol_price
	FROM servicexmobileParasol
	INNER JOIN mobile_parasol ON servicexmobileParasol.FK_id_mobileParasol = mobile_parasol.id
	
	WHERE (servicexmobileParasol.FK_id_service = id_service)
	GROUP BY mobile_parasol.id;
END$$

---------------------------- LOCKER ---------------------------


CREATE TABLE locker (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `locker_number` INT NOT NULL,
    `sex` VARCHAR(255) NOT NULL,
    `price` FLOAT NOT NULL
);

INSERT INTO `locker` (id, locker_number, price, sex) VALUES (1, 1, 0,"mujer"),(2, 2, 0,"mujer"),(3, 3, 0,"mujer"),(4, 4, 0,"mujer"),(5, 5, 0,"mujer"),(6, 6, 0,"mujer"),(7, 7, 0,"mujer"),(8, 8, 0,"mujer"),(9, 9, 0,"mujer"),(10, 10, 0,"mujer"),(11, 11, 0,"mujer"),(12, 12, 0,"mujer"),(13, 13, 0,"mujer"),(14, 14, 0,"mujer"),(15, 15, 0,"mujer"),(16, 16, 0,"mujer"),(17, 17, 0,"mujer"),(18, 18, 0,"mujer"),(19, 19, 0,"mujer"),(20, 20, 0,"mujer"),(21, 21, 0,"mujer"),(22, 22, 0,"mujer"),(23, 23, 0,"mujer"),(24, 24, 0,"mujer"),(25, 25, 0,"mujer"),(26, 26, 0,"mujer"),(27, 27, 0,"mujer"),(28, 28, 0,"mujer"),(29, 29, 0,"mujer"),(30, 30, 0,"mujer"),(31, 31, 0,"mujer"),(32, 32, 0,"mujer"),(33, 33, 0,"mujer"),(34, 34, 0,"mujer"),(35, 35, 0,"mujer"),(36, 36, 0,"mujer"),(37, 37, 0,"mujer"),(38, 38, 0,"mujer"),(39, 39, 0,"mujer"),(40, 40, 0,"mujer"),(41, 41, 0,"mujer"),(42, 42, 0,"mujer"),(43, 43, 0,"mujer"),(44, 44, 0,"mujer"),(45, 45, 0,"mujer"),(46, 46, 0,"mujer"),(47, 47, 0,"mujer"),(48, 48, 0,"mujer"),(49, 49, 0,"mujer"),(50, 50, 0,"mujer"),(51, 51, 0,"mujer"),(52, 52, 0,"mujer"),(53, 53, 0,"mujer"),(54, 54, 0,"mujer"),(55, 55, 0,"mujer"),(56, 56, 0,"mujer"),(57, 57, 0,"mujer"),(58, 58, 0,"mujer"),(59, 59, 0,"mujer"),(60, 60, 0,"mujer"),(61, 61, 0,"mujer"),(62, 62, 0,"mujer"),(63, 63, 0,"mujer"),(64, 64, 0,"mujer"),(65, 65, 0,"mujer"),(66, 66, 0,"mujer"),(67, 67, 0,"mujer"),(68, 68, 0,"mujer"),(69, 69, 0,"mujer"),(70,70, 0,"mujer"),(71,71, 0,"mujer"),(72,72, 0,"mujer"),(73,73, 0,"mujer"),(74,74, 0,"mujer"),(75,75, 0,"mujer"),(76,76, 0,"mujer"),(77,77, 0,"mujer"),(78,78, 0,"mujer"),(79,79, 0,"mujer"),(80,80, 0,"mujer"),(81,81, 0,"mujer"),(82,82, 0,"mujer"),(83,83, 0,"mujer"),(84,84, 0,"mujer"),(85,85, 0,"mujer"),(86,86, 0,"mujer"),(87,87, 0,"mujer"),(88,88, 0,"mujer"),(89,89, 0,"mujer"),(90,90, 0,"mujer"),(91,91, 0,"mujer"),(92,92, 0,"mujer"),(93,93, 0,"mujer"),(94,94, 0,"mujer"),(95,95, 0,"mujer"),(96,96, 0,"mujer"),(97,97, 0,"mujer"),(98,98, 0,"mujer"),(99,99, 0,"mujer"),(100,100, 0,"mujer"),(101,101, 0,"mujer"),(102,102, 0,"mujer"),(103,103, 0,"mujer"),(104,104, 0,"mujer"),(105,105, 0,"mujer"),(106,106, 0,"mujer"),(107,107, 0,"mujer"),(108,108, 0,"mujer"),(109,109, 0,"mujer"),(110,110, 0,"mujer"),(111,111, 0,"mujer"),(112,112, 0,"mujer"),(113,113, 0,"mujer"),(114,114, 0,"mujer"),(115,115, 0,"mujer"),(116,116, 0,"mujer"),(117,117, 0,"mujer"),(118,118, 0,"mujer"),(119,119, 0,"mujer"),(120,120, 0,"mujer"),(121,121, 0,"mujer"),(122,122, 0,"mujer"),(123,123, 0,"mujer"),(124,124, 0,"mujer"),(125,125, 0,"mujer"),(126,126, 0,"mujer"),(127,127, 0,"mujer"),(128,128, 0,"mujer"),(129,129, 0,"mujer"),(130,130, 0,"mujer"),(131,131, 0,"mujer"),(132,132, 0,"mujer"),(133,133, 0,"mujer"),(134,134, 0,"mujer"),(135,135, 0,"mujer"),(136,136, 0,"mujer"),(137,1, 0,"hombres"),(138,2, 0,"hombres"),(139,3, 0,"hombres"),(140,4, 0,"hombres"),(141,5, 0,"hombres"),(142,6, 0,"hombres"),(143,7, 0,"hombres"),(144,8, 0,"hombres"),(145,9, 0,"hombres"),(146,10, 0,"hombres"),(147,11, 0,"hombres"),(148,12, 0,"hombres"),(149,13, 0,"hombres"),(150,14, 0,"hombres"),(151,15, 0,"hombres"),(152,16, 0,"hombres"),(153,17, 0,"hombres"),(154,18, 0,"hombres"),(155,19, 0,"hombres"),(156,20, 0,"hombres"),(157,21, 0,"hombres"),(158,22, 0,"hombres");


DROP procedure IF EXISTS `locker_getById`;
DELIMITER $$
CREATE PROCEDURE locker_getById (IN id INT)
BEGIN
	SELECT * 
    FROM `locker` 
    WHERE `locker`.`id` = id;
END$$


DROP procedure IF EXISTS `locker_getAll`;
DELIMITER $$
CREATE PROCEDURE locker_getAll ()
BEGIN
	SELECT *
    FROM `locker`
    ORDER BY id ASC;
END$$



------------------------- ADDITIONAL SERVICE ---------------------

CREATE TABLE additional_service (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `description` VARCHAR(255) NOT NULL,
    `total` FLOAT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,
    
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_additional_service_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_additional_service_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_additional_service_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_additional_service_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`) 
);


DROP PROCEDURE IF EXISTS `service_add`;
DELIMITER $$
CREATE PROCEDURE service_add(
								IN description VARCHAR(255),                                
                                IN total FLOAT,
                                IN date_register DATE,
                                IN register_by INT,
								OUT lastId int
							)
BEGIN
    INSERT INTO additional_service (
			additional_service.description,
            additional_service.total,                   
            additional_service.date_register,
            additional_service.register_by
	)
    VALUES (description, total, date_register, register_by);
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
END$$


DROP procedure IF EXISTS `service_getById`;
DELIMITER $$
CREATE PROCEDURE service_getById (IN id INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active 
           
    FROM `additional_service` WHERE `additional_service`.`id` = id;
END$$


DROP procedure IF EXISTS `service_getAll`;
DELIMITER $$
CREATE PROCEDURE service_getAll()
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active        
    FROM `additional_service` 
    WHERE `additional_service`.`is_active` = true;
END$$


DROP procedure IF EXISTS `service_getByDescription`;
DELIMITER $$
CREATE PROCEDURE service_getByDescription (IN description VARCHAR(255))
BEGIN
	SELECT  
        additional_service.id AS service_id,
        additional_service.description AS service_description,
        additional_service.total AS service_total,
        additional_service.is_active AS service_is_active        
    FROM `additional_service`     
    WHERE `additional_service`.`description` = description;
END$$


DROP procedure IF EXISTS `service_enableById`;
DELIMITER $$
CREATE PROCEDURE service_enableById (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `additional_service` 
    SET 
        `additional_service`.`is_active` = true,
        `additional_service`.`date_enable` = date_enable,
        `additional_service`.`enable_by` = enable_by  
    WHERE `additional_service`.`id` = id;	
END$$


DROP procedure IF EXISTS `service_disableById`;
DELIMITER $$
CREATE PROCEDURE service_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
    UPDATE `additional_service` 
    SET 
        `additional_service`.`is_active` = false, 
        `additional_service`.`date_disable` = date_disable,
        `additional_service`.`disable_by` = disable_by
    WHERE `additional_service`.`id` = id;	
END$$


DROP procedure IF EXISTS `service_checkDescription`;
DELIMITER $$
CREATE PROCEDURE service_checkDescription (
                                            IN description VARCHAR(255),
                                            IN id INT
                                        )
BEGIN
    SELECT `additional_service`.`id` FROM `additional_service` WHERE `additional_service`.`description` = description AND `additional_service`.`id` != id;	
END$$


DROP procedure IF EXISTS `service_update`;
DELIMITER $$
CREATE PROCEDURE service_update (
                                    IN description VARCHAR(255),
                                    IN total INT,
                                    IN id INT,
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `additional_service` 
    SET 
        `additional_service`.`description` = description,
        `additional_service`.`total` = total,
        `additional_service`.`id` = id,    
        `additional_service`.`date_update` = date_update,
        `additional_service`.`update_by` = update_by
    WHERE 
        `additional_service`.`id` = id;	
END$$


---------------------------- SERVICEXPARKING ---------------------------


CREATE TABLE servicexparking (
    `FK_id_service` INT NOT NULL,
    `FK_id_parking` INT NOT NULL,
    CONSTRAINT `FK_id_service_servicexparking` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`),
    CONSTRAINT `FK_id_parking_servicexparking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking`(`id`)
);


DROP procedure IF EXISTS `servicexparking_add`;
DELIMITER $$
CREATE PROCEDURE servicexparking_add (
                                            IN FK_id_service INT,                                
                                            IN FK_id_parking INT
                                        )
BEGIN
	INSERT INTO servicexparking (
			servicexparking.FK_id_service,
            servicexparking.FK_id_parking                   
	)
    VALUES
        (FK_id_service, FK_id_parking);
END$$


DROP procedure IF EXISTS `servicexparking_getServiceByParking`;					    
DELIMITER $$
CREATE PROCEDURE servicexparking_getServiceByParking (IN id_parking INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexparking
	INNER JOIN additional_service ON servicexparking.FK_id_service = additional_service.id
	
	WHERE (servicexparking.FK_id_parking = id_parking)
	GROUP BY additional_service.id;
END$$


DROP procedure IF EXISTS `servicexparking_getParkingByService`;					    
DELIMITER $$
CREATE PROCEDURE servicexparking_getParkingByService (IN id_service INT)
BEGIN
	SELECT parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price
	FROM servicexparking
	INNER JOIN parking ON servicexparking.FK_id_parking = parking.id
	
	WHERE (servicexparking.FK_id_service = id_service)
	GROUP BY parking.id;
END$$


---------------------------- SERVICEXPARASOL ---------------------------

CREATE TABLE servicexparasol (
    `FK_id_service` INT NOT NULL,
    `FK_id_parasol` INT NOT NULL,
    CONSTRAINT `FK_id_service_servicexparasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`),
    CONSTRAINT `FK_id_parasol_servicexparasol` FOREIGN KEY (`FK_id_parasol`) REFERENCES `parasol`(`id`)
);


DROP procedure IF EXISTS `servicexparasol_add`;
DELIMITER $$
CREATE PROCEDURE servicexparasol_add (
                                            IN FK_id_service INT,                                
                                            IN FK_id_parasol INT
                                        )
BEGIN
	INSERT INTO servicexparasol (
			servicexparasol.FK_id_service,
            servicexparasol.FK_id_parasol                   
	)
    VALUES
        (FK_id_service, FK_id_parasol);
END$$


DROP procedure IF EXISTS `servicexparasol_getServiceByParasol`;					    
DELIMITER $$
CREATE PROCEDURE servicexparasol_getServiceByParasol (IN id_parasol INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexparasol
	INNER JOIN additional_service ON servicexparasol.FK_id_service = additional_service.id
	
	WHERE (servicexparasol.FK_id_parasol = id_parasol)
	GROUP BY additional_service.id;
END$$


DROP procedure IF EXISTS `servicexparasol_getParasolByService`;					    
DELIMITER $$
CREATE PROCEDURE servicexparasol_getParasolByService (IN id_service INT)
BEGIN
	SELECT parasol.id AS parasol_id,
           parasol.parasol_number AS parasol_number,
           parasol.price AS parasol_price
	FROM servicexparasol
	INNER JOIN parasol ON servicexparasol.FK_id_parasol = parasol.id
	
	WHERE (servicexparasol.FK_id_service = id_service)
	GROUP BY parasol.id;
END$$



---------------------------- SERVICEXLOCKER ---------------------------

CREATE TABLE servicexlocker (
    `FK_id_service` INT NOT NULL,
    `FK_id_locker` INT NOT NULL,
    CONSTRAINT `FK_id_service_servicexlocker` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`),
    CONSTRAINT `FK_id_locker_servicexlocker` FOREIGN KEY (`FK_id_locker`) REFERENCES `locker`(`id`)
);


DROP procedure IF EXISTS `servicexlocker_add`;
DELIMITER $$
CREATE PROCEDURE servicexlocker_add (
                                            IN FK_id_service INT,                                
                                            IN FK_id_locker INT
                                        )
BEGIN
	INSERT INTO servicexlocker (
			servicexlocker.FK_id_service,
            servicexlocker.FK_id_locker                   
	)
    VALUES
        (FK_id_service, FK_id_locker);
END$$


DROP procedure IF EXISTS `servicexlocker_getServiceByLocker`;					    
DELIMITER $$
CREATE PROCEDURE servicexlocker_getServiceByLocker (IN id_locker INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexlocker
	INNER JOIN additional_service ON servicexlocker.FK_id_service = additional_service.id
	
	WHERE (servicexlocker.FK_id_locker = id_locker)
	GROUP BY additional_service.id;
END$$


DROP procedure IF EXISTS `servicexlocker_getLockerByService`;					    
DELIMITER $$
CREATE PROCEDURE servicexlocker_getLockerByService (IN id_service INT)
BEGIN
	SELECT locker.id AS locker_id,
           locker.locker_number AS locker_number,
           locker.price AS locker_price,
           locker.sex AS locker_sex
	FROM servicexlocker
	INNER JOIN locker ON servicexlocker.FK_id_locker = locker.id
	
	WHERE (servicexlocker.FK_id_service = id_service)
	GROUP BY locker.id;
END$$



---------------------------- RESERVATIONXSERVICE ---------------------------

CREATE TABLE `reservationxservice` (
    `FK_id_reservation` INT NOT NULL,
    `FK_id_service` INT NOT NULL,
    CONSTRAINT `FK_id_reservation_reservationxservice` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`),
    CONSTRAINT `FK_id_service_reservationxservice` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`)
);


DROP procedure IF EXISTS `reservationxservice_add`;
DELIMITER $$
CREATE PROCEDURE reservationxservice_add (
                                            IN FK_id_reservation INT,                                
                                            IN FK_id_service INT
                                        )
BEGIN
	INSERT INTO reservationxservice (
			reservationxservice.FK_id_reservation,
            reservationxservice.FK_id_service                   
	)
    VALUES
        (FK_id_reservation, FK_id_service);
END$$


DROP procedure IF EXISTS `reservationxservice_getReservationByService`;					    
DELIMITER $$
CREATE PROCEDURE reservationxservice_getReservationByService (IN id_service INT)
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_isActive,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
           client.is_potential AS client_isPotential,
		   client.is_active AS client_isActive,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           admin.is_active AS admin_isActive,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price,
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
	FROM reservationxservice
	INNER JOIN reservation ON reservationxservice.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
	
	WHERE (reservationxservice.FK_id_service = id_service)
	GROUP BY reservation.id;
END$$


DROP procedure IF EXISTS `reservationxservice_getServiceByReservation`;					    
DELIMITER $$
CREATE PROCEDURE reservationxservice_getServiceByReservation (IN id_reservation INT)
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active          
	FROM reservationxservice
	INNER JOIN additional_service ON reservationxservice.FK_id_service = additional_service.id	
	WHERE (reservationxservice.FK_id_reservation = id_reservation);             
END$$

DROP procedure IF EXISTS `reservationxservice_getAll`;
DELIMITER $$
CREATE PROCEDURE reservationxservice_getAll ()
BEGIN
	SELECT *
    FROM `reservationxservice`;
END$$


---------------------------- PARASOL ---------------------------

CREATE TABLE parasol (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `parasol_number` INT NOT NULL UNIQUE,
    `price` FLOAT NOT NULL,
    `FK_id_service` INT NOT NULL,
    CONSTRAINT `FK_id_service_parasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`)
);


DROP procedure IF EXISTS `parasol_getById`;
DELIMITER $$
CREATE PROCEDURE parasol_getById (IN id INT)
BEGIN
	SELECT parasol.id AS parasol_id,
           parasol.parasol_number AS parasol_number,
           parasol.price AS parasol_price,
           additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.price AS service_price,
           additional_service.is_active AS service_isActive,
           reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_isActive,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_city,
           client.is_potential AS client_isPotential,
		   client.is_active AS client_isActive,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           admin.is_active AS admin_isActive,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price,
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive             
    FROM `parasol` 
    INNER JOIN additional_service ON parasol.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `parasol`.`id` = id;
END$$


DROP procedure IF EXISTS `parasol_getAll`;
DELIMITER $$
CREATE PROCEDURE parasol_getAll ()
BEGIN
	SELECT parasol.id AS parasol_id,
           parasol.parasol_number AS parasol_number,
           parasol.price AS parasol_price,
           additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.price AS service_price,
           additional_service.is_active AS service_isActive,
           reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_isActive,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_city,
           client.is_potential AS client_isPotential,
		   client.is_active AS client_isActive,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           admin.is_active AS admin_isActive,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price,
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
    FROM `parasol` 
    INNER JOIN additional_service ON parasol.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY price ASC;
END$$



---------------------------- STAFF ---------------------------

CREATE TABLE staff (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,
    `position` VARCHAR(255) NOT NULL,
    `salary` FLOAT NOT NULL,
    `date_start` DATE NOT NULL,
    `date_end` DATE NOT NULL,
    `dni` INT NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `tel` INT NOT NULL,
    `shirt_size` FLOAT NOT NULL,
    `pant_size` FLOAT NOT NULL,
    `is_active` BOOLEAN NOT NULL DEFAULT TRUE,

    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_staff_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_staff_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_staff_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_staff_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`)
);


DROP procedure IF EXISTS `staff_add`;
DELIMITER $$
CREATE PROCEDURE staff_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN position VARCHAR(255),
                                IN salary FLOAT,
                                IN date_start DATE,
                                IN date_end DATE,
                                IN dni INT,
                                IN address VARCHAR(255),
                                IN tel INT,
                                IN shirt_size FLOAT,
                                IN pant_size FLOAT,
                                IN date_register DATE,
                                IN register_by INT   
                            )                             
BEGIN
	INSERT INTO staff (
			staff.name,
			staff.lastname,
			staff.position,
            staff.salary,
            staff.date_start,
            staff.date_end,
            staff.dni,
            staff.address,
            staff.tel,
            staff.shirt_size,
			staff.pant_size,
            staff.date_register,
            staff.register_by
	)
    VALUES
        (name, lastname, position, salary, date_start, date_end, dni, address, tel, shirt_size, pant_size, date_register, register_by);
END$$


DROP procedure IF EXISTS `staff_getById`;
DELIMITER $$
CREATE PROCEDURE staff_getById (IN id INT)
BEGIN
	SELECT * FROM `staff` WHERE `staff`.`id` = id;
END$$


DROP procedure IF EXISTS `staff_getByName`;
DELIMITER $$
CREATE PROCEDURE staff_getByName (IN name VARCHAR(255))
BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname 
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`name` LIKE CONCAT('%', name , '%');
END$$


DROP procedure IF EXISTS `staff_getByDni`;
DELIMITER $$
CREATE PROCEDURE staff_getByDni (IN dni INT)
BEGIN
	SELECT * FROM `staff` WHERE `staff`.`dni` = dni;
END$$


DROP procedure IF EXISTS `staff_getAllActives`;
DELIMITER $$
CREATE PROCEDURE staff_getAllActives ()
BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`is_active` = true
    ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `staff_getAllDisables`;
DELIMITER $$
CREATE PROCEDURE staff_getAllDisables ()
BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`is_active` = false
    ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `staff_getAll`;
DELIMITER $$
CREATE PROCEDURE staff_getAll ()
BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`    
    ORDER BY name ASC;
END$$


DROP procedure IF EXISTS `staff_disableById`;
DELIMITER $$
CREATE PROCEDURE staff_disableById (
                                        IN id INT,
                                        IN date_disable DATE,
                                        IN disable_by INT
                                    )
BEGIN
	UPDATE `staff` 
    SET 
        `staff`.`is_active` = false, 
        `staff`.`date_disable` = date_disable,
        `staff`.`disable_by` = disable_by
    WHERE `staff`.`id` = id;
END$$


DROP procedure IF EXISTS `staff_enableById`;
DELIMITER $$
CREATE PROCEDURE staff_enableById (
                                        IN id INT,
                                        IN date_enable DATE,
                                        IN enable_by INT
                                    )
BEGIN
    UPDATE `staff` 
    SET 
        `staff`.`is_active` = true, 
        `staff`.`date_enable` = date_enable,
        `staff`.`enable_by` = enable_by
    WHERE `staff`.`id` = id;	
END$$


DROP procedure IF EXISTS `staff_checkDni`;
DELIMITER $$
CREATE PROCEDURE staff_checkDni (
                                    IN dni INT,
                                    IN id INT
                                )
BEGIN
    SELECT `staff`.`id` FROM `staff` WHERE `staff`.`dni` = dni AND `staff`.`id` != id;	
END$$


DROP procedure IF EXISTS `staff_update`;
DELIMITER $$
CREATE PROCEDURE staff_update (
                                    IN name VARCHAR(255),
                                    IN lastname VARCHAR(255),
                                    IN position VARCHAR(255),
                                    IN salary FLOAT,
                                    IN date_start DATE,
                                    IN date_end DATE,
                                    IN dni INT,
                                    IN address VARCHAR(255),
                                    IN tel INT,
                                    IN shirt_size FLOAT,
                                    IN pant_size FLOAT, 
                                    IN id INT,
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `staff` 
    SET 
        `staff`.`name` = name, 
        `staff`.`lastname` = lastname,
        `staff`.`position` = position,
        `staff`.`salary` = salary,
        `staff`.`date_start` = date_start,
        `staff`.`date_end` = date_end,
        `staff`.`dni` = dni,
        `staff`.`address` = address,
        `staff`.`tel` = tel,
        `staff`.`shirt_size` = shirt_size,
        `staff`.`pant_size` = pant_size,
        `staff`.`date_update` = date_update,
        `staff`.`update_by` = update_by
    WHERE 
        `staff`.`id` = id;	
END$$


DROP procedure IF EXISTS `staff_getAllActiveStaffWithLimit`;
DELIMITER $$
CREATE PROCEDURE staff_getAllActiveStaffWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `staff`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname             
    FROM `staff`    
    INNER JOIN admin ON staff.register_by = admin.id 
    WHERE `staff`.`is_active` = true
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `staff_getAllDisableStaffWithLimit`;
DELIMITER $$
CREATE PROCEDURE staff_getAllDisableStaffWithLimit (
                                                        IN start INT,
                                                        IN max_items INT
                                                    )
BEGIN
	SELECT 
        `staff`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname             
    FROM `staff`    
    INNER JOIN admin ON staff.register_by = admin.id    
    WHERE `staff`.`is_active` = false
    LIMIT start, max_items;
END$$


DROP procedure IF EXISTS `staff_getActiveCount`;
DELIMITER $$
CREATE PROCEDURE staff_getActiveCount ()
BEGIN
	SELECT count(staff.id) AS total 
    FROM `staff`
    WHERE `staff`.`is_active` = true;
END$$


DROP procedure IF EXISTS `staff_getDisableCount`;
DELIMITER $$
CREATE PROCEDURE staff_getDisableCount ()
BEGIN
	SELECT count(staff.id) AS total 
    FROM `staff`
    WHERE `staff`.`is_active` = false;
END$$


---------------------------- CHECK ---------------------------

CREATE TABLE check (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `bank` VARCHAR(255) NOT NULL,
    'account_number' INT NOT NULL,
    'check_number' INT NOT NULL,
    'FK_id_client' INT NOT NULL,
    CONSTRAINT `FK_id_client_check` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`)
);

DROP procedure IF EXISTS `check_add`;
DELIMITER $$
CREATE PROCEDURE check_add (
                                IN bank VARCHAR(255),
                                IN account_number INT,
                                IN check_number INT,
                                IN FK_id_client INT,
                                OUT lastId INT  
                            )                             
BEGIN
	INSERT INTO check (
			check.bank,
			check.account_number,
			check.check_number,
            check.FK_id_client
	)
    VALUES
        (bank,account_number,check_number,FK_id_client);
        SET lastId = LAST_INSERT_ID();	
	    SELECT lastId;
END$$


CREATE TABLE checkC (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `bank` VARCHAR(255) NOT NULL,
    `account_number` INT NOT NULL,
    `check_number` INT NOT NULL,
    `FK_id_client` INT NOT NULL,
    CONSTRAINT `FK_id_client_check` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`)
);

DROP procedure IF EXISTS `checkC_add`;
DELIMITER $$
CREATE PROCEDURE checkC_add (
                                IN bank VARCHAR(255),
                                IN account_number INT,
                                IN check_number INT,
                                IN FK_id_client INT,
                                OUT lastId INT  
                            )                             
BEGIN
	INSERT INTO checkC (
			checkC.bank,
			checkC.account_number,
			checkC.check_number,
            checkC.FK_id_client
	)
    VALUES
        (bank,account_number,check_number,FK_id_client);
        SET lastId = LAST_INSERT_ID();	
	    SELECT lastId;
END$$

DROP procedure IF EXISTS `checkC_getById`;
DELIMITER $$
CREATE PROCEDURE checkC_getById (IN id INT)
BEGIN
	SELECT checkC.id AS check_id,
           checkC.bank AS check_bank,
           checkC.account_number AS check_accountNumber,
           checkC.check_number AS check_number,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_addres,
		   client.is_active AS client_isActive
    FROM `checkC` 
    INNER JOIN client ON checkC.FK_id_client = client.id
    WHERE `checkC`.`id` = id;
END$$

DROP procedure IF EXISTS `checkC_getByClientId`;
DELIMITER $$
CREATE PROCEDURE checkC_getByClientId (IN id INT)
BEGIN
	SELECT checkC.id AS check_id,
           checkC.bank AS check_bank,
           checkC.account_number AS check_accountNumber,
           checkC.check_number AS check_number,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
		   client.is_active AS client_isActive
    FROM `checkC` 
    INNER JOIN client ON checkC.FK_id_client = client.id
    WHERE `checkC`.`FK_id_client` = id;
END$$

DROP procedure IF EXISTS `checkC_getByBank`;
DELIMITER $$
CREATE PROCEDURE checkC_getByBank (IN bank VARCHAR(255))
BEGIN
	SELECT checkC.id AS check_id,
           checkC.bank AS check_bank,
           checkC.account_number AS check_accountNumber,
           checkC.check_number AS check_number,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
		   client.is_active AS client_isActive
    FROM `checkC` 
    INNER JOIN client ON checkC.FK_id_client = client.id
    WHERE `checkC`.`bank` = bank;
END$$


DROP procedure IF EXISTS `checkC_getAll`;
DELIMITER $$
CREATE PROCEDURE checkC_getAll ()
BEGIN
	SELECT checkC.id AS check_id,
           checkC.bank AS check_bank,
           checkC.account_number AS check_accountNumber,
           checkC.check_number AS check_number,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,
		   client.is_active AS client_isActive
    FROM `checkC` 
    INNER JOIN client ON checkC.FK_id_client = client.id
    ORDER BY id ASC;
END$$

---------------------------- ACCOUTING ---------------------------

CREATE TABLE diary_balance (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `date` DATE NOT NULL,
    `type` VARCHAR(255) NOT NULL,
    `payment` VARCHAR(255) NOT NULL,
    `detail` VARCHAR(255) NOT NULL,
    `total` FLOAT NOT NULL,

    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    
    CONSTRAINT `FK_diary_balance_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`)
);


DROP procedure IF EXISTS `diary_balance_add`;
DELIMITER $$
CREATE PROCEDURE diary_balance_add (                                
                                IN date DATE,                                                                
                                IN type VARCHAR(255),
                                IN payment VARCHAR(255),
                                IN detail VARCHAR(255),
                                IN total FLOAT,
                                IN date_register DATE,
                                IN register_by INT   
                            )                             
BEGIN
	INSERT INTO diary_balance (
            diary_balance.date,
            diary_balance.type,
            diary_balance.payment,
            diary_balance.detail,
            diary_balance.total,                                                
            diary_balance.date_register,
            diary_balance.register_by
	)
    VALUES
        (date, type, payment, detail, total, date_register, register_by);
END$$


DROP procedure IF EXISTS `diary_balance_getByDate`;
DELIMITER $$
CREATE PROCEDURE diary_balance_getByDate (IN date DATE)
BEGIN
	SELECT * FROM `diary_balance` WHERE `diary_balance`.`date` = date;
END$$
