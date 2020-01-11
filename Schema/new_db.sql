DROP DATABASE southbeach;

CREATE DATABASE southbeach;

USE southbeach;

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


DROP procedure IF EXISTS `admin_getAll`;
DELIMITER $$
CREATE PROCEDURE admin_getAll ()
BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
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

DROP procedure IF EXISTS `admin_update`;
DELIMITER $$
CREATE PROCEDURE admin_update (
                                    IN name VARCHAR(255),
                                    IN lastname VARCHAR(255),
                                    IN dni VARCHAR(255),
                                    IN email VARCHAR(255),
                                    IN password VARCHAR(255),
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `admin` 
    SET 
        `admin`.`name` = name, 
        `admin`.`lastname` = lastname,
        `admin`.`dni` = dni,
        `admin`.`email` = email,
        `admin`.`password` = password,
        `admin`.`date_update` = date_update,
        `admin`.`update_by` = update_by    
    WHERE 
        `admin`.`id` = id;	
END$$



----------------------------- CLIENT -----------------------------

CREATE TABLE client (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `lastname` VARCHAR(255) NOT NULL,    
    `stay` VARCHAR(255) NOT NULL, --estadia
    `address` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `cp` INT NOT NULL,  -- cp
    `email` VARCHAR(255) NOT NULL UNIQUE,
    `tel` INT NOT NULL,
    `family_group` VARCHAR(255) NOT NULL,   -- grupo familiar
    `stay_address` VARCHAR(255) NOT NULL,      
    `tel_stay` INT NOT NULL,    -- tel estadia
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


DROP procedure IF EXISTS `client_add`;
DELIMITER $$
CREATE PROCEDURE client_add (
                                IN name VARCHAR(255),
                                IN lastname VARCHAR(255),
                                IN stay VARCHAR(255),
                                IN address VARCHAR(255),
                                IN city VARCHAR(255),
                                IN cp INT,
                                IN email VARCHAR(255),
                                IN tel INT,
                                IN family_group VARCHAR(255),
                                IN stay_address VARCHAR(255),
                                IN tel_stay INT,                                
                                IN date_register DATE,
                                IN register_by INT
                            )
BEGIN
	INSERT INTO client (
			client.name,
			client.lastname,
            client.stay,
            client.address,
            client.city,
            client.cp,
			client.email,
            client.tel,
            client.family_group,
            client.stay_address,
            client.tel_stay,            
            client.date_register,			
            client.register_by
	)
    VALUES
        (name, lastname, stay, address, city, cp, email, tel, family_group, stay_address, tel_stay, date_register, register_by);
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


DROP procedure IF EXISTS `client_getAll`;
DELIMITER $$
CREATE PROCEDURE client_getAll ()
BEGIN
	SELECT * FROM `client` ORDER BY dni ASC;
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
                                    IN stay VARCHAR(255),
                                    IN address VARCHAR(255),
                                    IN city VARCHAR(255),
                                    IN cp INT,
                                    IN email VARCHAR(255),
                                    IN tel INT,
                                    IN family_group VARCHAR(255),
                                    IN stay_address VARCHAR(255),
                                    IN tel_stay INT,  
                                    IN id INT,                              
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `client` 
    SET 
        `client`.`name` = name, 
        `client`.`lastname` = lastname,
        `client`.`stay` = stay,
        `client`.`address` = address,
        `client`.`city` = city,
        `client`.`cp` = cp,
        `client`.`email` = email,
        `client`.`tel` = tel,
        `client`.`family_group` = family_group,
        `client`.`stay_address` = stay_address,
        `client`.`tel_stay` = tel_stay,
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


DROP procedure IF EXISTS `client_potential_getByEmail`;
DELIMITER $$
CREATE PROCEDURE client_potential_getByEmail (IN email VARCHAR(255))
BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`email` = email;
END$$


DROP procedure IF EXISTS `client_potential_getAll`;
DELIMITER $$
CREATE PROCEDURE client_potential_getAll ()
BEGIN
	SELECT * FROM `client_potential` ORDER BY name ASC;
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
                                            IN update_by INT
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
    'discount' FLOAT NOT NULL,
    `total_price` FLOAT NOT NULL,
    `FK_id_client` INT NOT NULL,    
    `FK_id_tent` INT NOT NULL,
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


/*DROP procedure IF EXISTS `reservation_add`;
DELIMITER $$
CREATE PROCEDURE reservation_add (
                                    IN date_start DATE,
                                    IN date_end DATE,
                                    IN total_price FLOAT,
                                    IN FK_id_client INT,                                    
                                    IN FK_id_tent INT,
                                    IN FK_id_parking INT,
                                    IN date_register DATE,
                                    IN register_by INT
                                )
BEGIN
	INSERT INTO reservation (
			reservation.date_start,
            reservation.date_end,
            reservation.total_price,
            reservation.FK_id_client,            
            reservation.FK_id_tent,
            reservation.FK_id_parking,
            reservation.date_register,
            reservation.register_by            
	)
    VALUES
        (date_start, date_end, total_price, FK_id_client, FK_id_admin, FK_id_tent, FK_id_parking, date_register, register_by);
END$$*/


DROP PROCEDURE IF EXISTS `reservation_add`;
DELIMITER $$
CREATE PROCEDURE reservation_add(
								IN date_start DATE,
                                    IN date_end DATE,
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
            reservation.discount,
            reservation.total_price,
            reservation.FK_id_client,            
            reservation.FK_id_tent,
            reservation.date_register,
            reservation.register_by
	)
    VALUES (date_start, date_end, discount, total_price, FK_id_client, FK_id_admin, FK_id_tent, date_register, register_by);
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
           client.is_potential AS client_is_potential,
		   client.is_active AS client_is_active,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           admin.is_active AS admin_is_active,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price,
           beach_tent AS tent_is_active

    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    WHERE `reservation`.`id` = id;
END$$


DROP procedure IF EXISTS `reservation_getAll`;
DELIMITER $$
CREATE PROCEDURE reservation_getAll ()
BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_city,
           client.is_potential AS client_is_potential,
		   client.is_active AS client_is_active,
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,
		   admin.dni AS admin_dni,
		   admin.email AS admin_email,
		   admin.password AS admin_password,
           admin.is_active AS admin_is_active,
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price,
           beach_tent AS tent_is_active

    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    ORDER BY date_start ASC;
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
                                    IN discount FLOAT,
                                    IN total_price FLOAT,
                                    IN FK_id_client INT,                                    
                                    IN FK_id_tent INT,
                                    IN date_update DATE,
                                    IN update_by INT
                                )
BEGIN
    UPDATE `reservation` 
    SET 
        `reservation`.`date_start` = date_start, 
        `reservation`.`date_end` = date_end,
        'reservation'.'discount' = discount,
        `reservation`.`total_price` = total_price,
        `reservation`.`FK_id_client` = FK_id_client,
        `reservation`.`FK_id_tent` = FK_id_tent,
        `reservation`.`date_update` = date_update,
        `reservation`.`update_by` = update_by    
    WHERE 
        `reservation`.`id` = id;	
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
            provider.date_register,
            provider.register_by
	)
    VALUES
        (name, lastname, tel, email, dni, address, cuil, social_reason, type_billing, date_register, register_by);
END$$


DROP procedure IF EXISTS `provider_getById`;
DELIMITER $$
CREATE PROCEDURE provider_getById (IN id INT)
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$


DROP procedure IF EXISTS `provider_getByDni`;
DELIMITER $$
CREATE PROCEDURE provider_getByDni (IN dni INT)
BEGIN
	SELECT * FROM `provider` WHERE `provider`.`dni` = dni;
END$$


DROP procedure IF EXISTS `provider_getAll`;
DELIMITER $$
CREATE PROCEDURE provider_getAll ()
BEGIN
	SELECT * FROM `provider` ORDER BY lastname ASC;
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
        `provider`.`date_update` = date_update,
        `provider`.`update_by` = update_by    
    WHERE 
        `provider`.`id` = id;	
END$$



----------------------------- CATEGORY -----------------------------

CREATE TABLE category (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` VARCHAR(255) NOT NULL,
    `description` VARCHAR(255) NOT NULL 
);


DROP procedure IF EXISTS `category_add`;
DELIMITER $$
CREATE PROCEDURE category_add (
                                IN name VARCHAR(255),
                                IN description VARCHAR(255)
                            )
BEGIN
	INSERT INTO category (
			category.name,
            category.description
	)
    VALUES
        (name, description);
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
    
    `date_register` DATE NOT NULL,
    `register_by` INT NOT NULL, 
    `date_disable` DATE DEFAULT NULL,    
    `disable_by` INT DEFAULT NULL,
    `date_enable` DATE DEFAULT NULL,
    `enable_by` INT DEFAULT NULL,
    `date_update` DATE DEFAULT NULL, 
    `update_by` INT DEFAULT NULL,

    CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`),

    CONSTRAINT `FK_product_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
    CONSTRAINT `FK_product_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`) 
);


DROP procedure IF EXISTS `product_add`;
DELIMITER $$
CREATE PROCEDURE product_add (
                                IN name VARCHAR(255),
                                IN price INT,
                                IN quantity INT,
                                IN FK_id_category INT,
                                IN date_register DATE,
                                IN register_by INT
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
            category.name AS category_name,
            category.description AS category_description
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
            category.name AS category_name,
            category.description AS category_description
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
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
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
                                    IN update_by INT
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



------------------------- PROVIDER_X_PRODUCT ---------------------

CREATE TABLE providerxproduct (
	`FK_id_provider` INT NOT NULL,
    `FK_id_product` INT NOT NULL,
	`quantity` INT NOT NULL,
    `total` FLOAT NOT NULL,
    `discount` FLOAT NOT NULL,
    `transaction_date` DATE NOT NULL, 
    CONSTRAINT `FK_id_provider_providerxproduct` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`),
    CONSTRAINT `FK_id_product_providerxproduct` FOREIGN KEY (`FK_id_product`) REFERENCES `product` (`id`)
);


DROP procedure IF EXISTS `providerxproduct_add`;
DELIMITER $$
CREATE PROCEDURE providerxproduct_add (
								IN FK_id_provider INT,
								IN FK_id_product INT,
                                IN quantity INT,
                                IN total FLOAT,
                                IN discount FLOAT,
                                IN transaction_date DATE
							 )
BEGIN
	INSERT INTO providerxproduct (
			providerxproduct.FK_id_provider,
            providerxproduct.FK_id_product,
            providerxproduct.quantity,
            providerxproduct.total,
            providerxproduct.discount,
            providerxproduct.transaction_date
	)
    VALUES
        (FK_id_provider, FK_id_product, quantity, total, discount, transaction_date);
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
    `price` FLOAT NOT NULL
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
    ORDER BY price ASC;
END$$



---------------------------- LOCKER ---------------------------

CREATE TABLE locker (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `locker_number` INT NOT NULL UNIQUE,
    `price` FLOAT NOT NULL
);


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
    ORDER BY price ASC;
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
        
    FROM `additional_service` ;
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
           locker.price AS locker_price
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

---------------------------- LOCKER ---------------------------

CREATE TABLE locker (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `locker_number` INT NOT NULL UNIQUE,
    `price` FLOAT NOT NULL,
    `FK_id_service` INT NOT NULL,
    CONSTRAINT `FK_id_service_locker` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service`(`id`)
);


DROP procedure IF EXISTS `locker_getById`;
DELIMITER $$
CREATE PROCEDURE locker_getById (IN id INT)
BEGIN
	SELECT locker.id AS locker_id,
           locker.locker_number AS locker_number,
           locker.price AS locker_price,
           additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
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
    FROM `locker` 
    INNER JOIN additional_service ON locker.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `locker`.`id` = id;
END$$


DROP procedure IF EXISTS `locker_getAll`;
DELIMITER $$
CREATE PROCEDURE locker_getAll ()
BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
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
           beach_tent.is_active AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
    FROM `locker`
    INNER JOIN additional_service ON locker.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY price ASC;
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
        (name, lastname, position, date_start, date_end, dni, address, tel, shirt_size, pant_size, date_register, register_by);
END$$


DROP procedure IF EXISTS `staff_getById`;
DELIMITER $$
CREATE PROCEDURE staff_getById (IN id INT)
BEGIN
	SELECT * FROM `staff` WHERE `staff`.`id` = id;
END$$


DROP procedure IF EXISTS `staff_getByDni`;
DELIMITER $$
CREATE PROCEDURE staff_getByDni (IN dni INT)
BEGIN
	SELECT * FROM `staff` WHERE `staff`.`dni` = dni;
END$$


DROP procedure IF EXISTS `staff_getAll`;
DELIMITER $$
CREATE PROCEDURE staff_getAll ()
BEGIN
	SELECT * FROM `staff` ORDER BY name ASC;
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