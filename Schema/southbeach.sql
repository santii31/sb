-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2020 at 10:42 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `southbeach`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `dni` VARCHAR(255), IN `email` VARCHAR(255), IN `password` VARCHAR(255), IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_checkDni` (IN `id` INT, IN `dni` INT)  BEGIN
    SELECT `admin`.`id` FROM `admin` WHERE `admin`.`dni` = dni AND `admin`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_checkEmail` (IN `id` INT, IN `email` VARCHAR(255))  BEGIN
    SELECT `admin`.`id` FROM `admin` WHERE `admin`.`email` = email AND `admin`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `admin` 
    SET 
        `admin`.`is_active` = false,
        `admin`.`date_disable` = date_disable,
        `admin`.`disable_by` = disable_by    
    WHERE `admin`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `admin` 
    SET 
        `admin`.`is_active` = true,
        `admin`.`date_enable` = date_enable,
        `admin`.`enable_by` = enable_by          
    WHERE `admin`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getActiveCount` ()  BEGIN
	SELECT count(admin.id) AS total 
    FROM `admin`
    WHERE `admin`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAll` ()  BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllActives` ()  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`is_active` = true ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllActiveWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `admin`.*         
    FROM `admin`     
    WHERE `admin`.`is_active` = true
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllCountRsvById` (IN `id` INT)  BEGIN
	SELECT count(`admin`.`id`) AS total
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    WHERE `admin`.`id` = id
    GROUP BY `admin`.`id`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllDisableWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `admin`.*         
    FROM `admin`     
    WHERE `admin`.`is_active` = false
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllRsvById` (IN `id` INT)  BEGIN
	SELECT `reservation`.`total_price` AS total
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    WHERE `admin`.`id` = id;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAllWithRsv` ()  BEGIN
	SELECT * 
    FROM `admin` 
    INNER JOIN `reservation` ON `admin`.`id` = `reservation`.`register_by`
    GROUP BY `admin`.`id`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getDisableCount` ()  BEGIN
	SELECT count(admin.id) AS total 
    FROM `admin`
    WHERE `admin`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getEmails` ()  BEGIN
	SELECT `admin`.`email` FROM `admin`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `dni` INT, IN `email` VARCHAR(255), IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `balance_add` (IN `date` DATE, IN `concept` VARCHAR(255), IN `number_receipt` VARCHAR(255), IN `total` FLOAT, IN `partial` FLOAT, IN `remainder` FLOAT, IN `FK_id_reservation` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `balance_getByReservationId` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `beach_tent_add` (IN `number` INT, IN `price` FLOAT, IN `position` INT, IN `sea` BOOLEAN, IN `FK_id_hall` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_add` (IN `name` VARCHAR(255))  BEGIN
	INSERT INTO category (
			category.name
	)
    VALUES
        (name);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_getAll` ()  BEGIN
	SELECT * FROM `category` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `category` WHERE `category`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_getByName` (IN `Name` VARCHAR(255))  BEGIN
	SELECT * FROM `category` WHERE `category`.`name` = name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkC_add` (IN `bank` VARCHAR(255), IN `account_number` INT, IN `check_number` INT, IN `FK_id_client` INT, OUT `lastId` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkC_getAll` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkC_getByBank` (IN `bank` VARCHAR(255))  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkC_getByClientId` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkC_getById` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `cp` INT, IN `email` VARCHAR(255), IN `tel` INT, IN `family_group` VARCHAR(255), IN `auxiliary_phone` INT, IN `vehicle_type` VARCHAR(255), IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_checkEmail` (IN `dni` INT, IN `email` VARCHAR(255))  BEGIN
    SELECT `client`.`id` FROM `client` WHERE `client`.`email` = email AND `client`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `client` 
    SET 
        `client`.`is_active` = false, 
        `client`.`date_disable` = date_disable,
        `client`.`disable_by` = disable_by
    WHERE `client`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `client` 
    SET 
        `client`.`is_active` = true,
        `client`.`date_enable` = date_enable,
        `client`.`enable_by` = enable_by 
    WHERE `client`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getAll` ()  BEGIN
	SELECT * FROM `client` ORDER BY id ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `client` WHERE `client`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `client` WHERE `client`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getByName` (IN `name` VARCHAR(255))  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getByTentNumber` (IN `number` VARCHAR(255))  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getEmails` ()  BEGIN
	SELECT `client`.`email` FROM `client`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `email` VARCHAR(255), IN `tel` INT, IN `num_tent` VARCHAR(255), IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_checkEmail` (IN `id` INT, IN `email` VARCHAR(255))  BEGIN
    SELECT `client_potential`.`id` FROM `client_potential` WHERE `client_potential`.`email` = email AND `client_potential`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `client_potential` 
    SET 
        `client_potential`.`is_active` = false, 
        `client_potential`.`date_disable` = date_disable,
        `client_potential`.`disable_by` = disable_by
    WHERE `client_potential`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `client_potential` 
    SET 
        `client_potential`.`is_active` = true,
        `client_potential`.`date_enable` = date_enable,
        `client_potential`.`enable_by` = enable_by 
    WHERE `client_potential`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getActiveCount` ()  BEGIN
	SELECT count(client_potential.id) AS total 
    FROM `client_potential`
    WHERE `client_potential`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getAll` ()  BEGIN
	SELECT * FROM `client_potential` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getAllActives` ()  BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`is_active` = true ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getAllActiveWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `client_potential`.*         
    FROM `client_potential`     
    WHERE `client_potential`.`is_active` = true
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getAllDisableWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `client_potential`.*         
    FROM `client_potential`     
    WHERE `client_potential`.`is_active` = false
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getByName` (IN `name` VARCHAR(255))  BEGIN
	SELECT * FROM `client_potential` 
    WHERE `client_potential`.`name` LIKE CONCAT('%', name , '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getDisableCount` ()  BEGIN
	SELECT count(client_potential.id) AS total 
    FROM `client_potential`
    WHERE `client_potential`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getEmails` ()  BEGIN
	SELECT `client_potential`.`email` FROM `client_potential`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `email` VARCHAR(255), IN `tel` INT, IN `num_tent` VARCHAR(255), IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `cp` INT, IN `email` VARCHAR(255), IN `tel` INT, IN `family_group` VARCHAR(255), IN `auxiliary_phone` INT, IN `payment_method` VARCHAR(255), IN `vehicle_type` VARCHAR(255), IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `config_get` ()  BEGIN
	SELECT * FROM `config`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `config_update` (IN `date_start_season` DATE, IN `date_end_season` DATE, IN `price_tent_season` FLOAT, IN `price_tent_january` FLOAT, IN `price_tent_january_day` FLOAT, IN `price_tent_january_fortnigh` FLOAT, IN `price_tent_february` FLOAT, IN `price_tent_february_day` FLOAT, IN `price_tent_february_first_fortnigh` FLOAT, IN `price_tent_february_second_fortnigh` FLOAT, IN `price_parasol` FLOAT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `diary_balance_add` (IN `date` DATE, IN `type` VARCHAR(255), IN `payment` VARCHAR(255), IN `detail` VARCHAR(255), IN `total` FLOAT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `diary_balance_getByDate` (IN `date` DATE)  BEGIN
	SELECT * FROM `diary_balance` WHERE `diary_balance`.`date` = date;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `locker_getAll` ()  BEGIN
	SELECT *
    FROM `locker`
    ORDER BY id ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `locker_getById` (IN `id` INT)  BEGIN
	SELECT * 
    FROM `locker` 
    WHERE `locker`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mobileParasol_getAll` ()  BEGIN
	SELECT *
    FROM `mobile_parasol`
    ORDER BY id ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `mobileParasol_getById` (IN `id` INT)  BEGIN
	SELECT * 
    FROM `mobile_parasol` 
    WHERE `mobile_parasol`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getAll` ()  BEGIN
	SELECT *
    FROM `parasol` 
    ORDER BY parasol_number ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getById` (IN `id` INT)  BEGIN
	SELECT *             
    FROM `parasol` 
    WHERE `parasol`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getN_row` (IN `start` INT)  BEGIN
	SELECT *
    FROM `parasol` 
    WHERE `parasol`.`FK_id_hall` = start
    ORDER BY `parasol`.`position` ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getAll` ()  BEGIN
	SELECT * FROM `parking` ORDER BY number ASC;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getByNumber` (IN `number` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`number` = number;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getN_row` (IN `start` INT)  BEGIN
	SELECT         
        `parking`.*, 
        `parking_hall`.`number` AS hall_number 
    FROM `parking` 
    INNER JOIN `parking_hall` ON `parking`.`FK_id_hall` = `parking_hall`.`id`
    WHERE `parking`.`FK_id_hall` = start 
    ORDER BY `parking`.`position` ASC;     
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_add` (IN `name` VARCHAR(255), IN `price` INT, IN `quantity` INT, IN `FK_id_category` INT, IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_add_quantity` (IN `quantity` INT, IN `date_add` DATE, IN `add_by` INT, IN `id` INT)  BEGIN
    UPDATE `product` 
    SET         
        `product`.`quantity` = quantity,        
        `product`.`date_add` = date_add,
        `product`.`add_by` = add_by
    WHERE 
        `product`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `product` 
    SET 
        `product`.`is_active` = false, 
        `product`.`date_disable` = date_disable,
        `product`.`disable_by` = disable_by
    WHERE `product`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `product` 
    SET 
        `product`.`is_active` = true, 
        `product`.`date_enable` = date_enable,
        `product`.`enable_by` = enable_by
    WHERE `product`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getActiveCount` ()  BEGIN
	SELECT count(product.id) AS total 
    FROM `product`
    WHERE `product`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getAll` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getAllActiveWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getAllDisableWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getByCategory` (IN `id_category` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getById` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getByName` (IN `name` VARCHAR(255))  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getDisableCount` ()  BEGIN
	SELECT count(product.id) AS total 
    FROM `product`
    WHERE `product`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_remove_quantity` (IN `quantity` INT, IN `date_remove` DATE, IN `remove_by` INT, IN `id` INT)  BEGIN
    UPDATE `product` 
    SET         
        `product`.`quantity` = quantity,        
        `product`.`date_remove` = date_remove,
        `product`.`remove_by` = remove_by
    WHERE 
        `product`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_update` (IN `name` VARCHAR(255), IN `price` INT, IN `quantity` INT, IN `FK_id_category` INT, IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `providerxproduct_add` (IN `FK_id_provider` INT, IN `FK_id_product` INT)  BEGIN
	INSERT INTO providerxproduct (
			providerxproduct.FK_id_provider,
            providerxproduct.FK_id_product
	)
    VALUES
        (FK_id_provider, FK_id_product);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `providerxproduct_getAll` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `providerxproduct_getProductByProvider` (IN `id_provider` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `providerxproduct_getProviderByProduct` (IN `id_product` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `tel` INT, IN `email` VARCHAR(255), IN `dni` INT, IN `address` VARCHAR(255), IN `cuil` INT, IN `social_reason` VARCHAR(255), IN `type_billing` VARCHAR(255), IN `item` VARCHAR(255), IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_checkDni` (IN `dni` INT, IN `id` INT)  BEGIN
    SELECT `provider`.`id` FROM `provider` WHERE `provider`.`dni` = dni AND `provider`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_checkEmail` (IN `email` VARCHAR(255), IN `id` INT)  BEGIN
    SELECT `provider`.`id` FROM `provider` WHERE `provider`.`email` = email AND `provider`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `provider` 
    SET 
        `provider`.`is_active` = false, 
        `provider`.`date_disable` = date_disable,
        `provider`.`disable_by` = disable_by
    WHERE `provider`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `provider` 
    SET 
        `provider`.`is_active` = true, 
        `provider`.`date_enable` = date_enable,
        `provider`.`enable_by` = enable_by
    WHERE `provider`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getActiveCount` ()  BEGIN
	SELECT count(provider.id) AS total 
    FROM `provider`
    WHERE `provider`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAll` ()  BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`    
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAllActives` ()  BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`
    WHERE `provider`.`is_active` = true
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAllActiveWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAllDisableWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getByItem` (IN `item` VARCHAR(255))  BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`    
    WHERE `provider`.`item` LIKE CONCAT('%', item , '%');    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getDisableCount` ()  BEGIN
	SELECT count(provider.id) AS total 
    FROM `provider`
    WHERE `provider`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `tel` INT, IN `email` VARCHAR(255), IN `dni` INT, IN `address` VARCHAR(255), IN `cuil` INT, IN `social_reason` VARCHAR(255), IN `type_billing` VARCHAR(255), IN `item` VARCHAR(255), IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxparking_add` (IN `FK_id_reservation` INT, IN `FK_id_parking` INT)  BEGIN
	INSERT INTO reservationxparking (
			reservationxparking.FK_id_reservation,
            reservationxparking.FK_id_parking
	)
    VALUES
        (FK_id_reservation, FK_id_parking);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxparking_getAll` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxparking_getByIdParking` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_add` (IN `FK_id_reservation` INT, IN `FK_id_service` INT)  BEGIN
	INSERT INTO reservationxservice (
			reservationxservice.FK_id_reservation,
            reservationxservice.FK_id_service                   
	)
    VALUES
        (FK_id_reservation, FK_id_service);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_getAll` ()  BEGIN
	SELECT *
    FROM `reservationxservice`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_getReservationByService` (IN `id_service` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_getServiceByReservation` (IN `id_reservation` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active          
	FROM reservationxservice
	INNER JOIN additional_service ON reservationxservice.FK_id_service = additional_service.id	
	WHERE (reservationxservice.FK_id_reservation = id_reservation);             
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_add` (IN `date_start` DATE, IN `date_end` DATE, IN `stay` VARCHAR(255), IN `discount` FLOAT, IN `total_price` FLOAT, IN `FK_id_client` INT, IN `FK_id_tent` INT, IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_checkDateStart` (IN `date_start` DATE, IN `id` INT)  BEGIN
    SELECT `reservation`.`id` FROM `reservation` WHERE `reservation`.`date_start` = date_start AND `reservation`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `reservation` 
    SET 
        `reservation`.`is_active` = false, 
        `reservation`.`date_disable` = date_disable,
        `reservation`.`disable_by` = disable_by
    WHERE `reservation`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `reservation` 
    SET 
        `reservation`.`is_active` = true,
        `reservation`.`date_enable` = date_enable,
        `reservation`.`enable_by` = enable_by 
    WHERE `reservation`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_geByIdTent` (IN `id` INT)  BEGIN
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
    WHERE (beach_tent.id = id) AND (reservation.is_active = true);    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getActiveCount` ()  BEGIN
	SELECT count(reservation.id) AS total 
    FROM `reservation`
    WHERE `reservation`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAll` ()  BEGIN
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
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id    
    ORDER BY date_start ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllActives` ()  BEGIN
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
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id   
    WHERE `reservation`.`is_active` = true
    ORDER BY date_start ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllActiveWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllByAdmin` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllByClientId` (IN `client_id` INT)  BEGIN
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
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    WHERE `reservation`.`FK_id_client` = client_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllDisables` ()  BEGIN
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
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id   
    WHERE `reservation`.`is_active` = false
    ORDER BY date_start ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllDisableWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllRsvWithClientsCount` ()  BEGIN
	SELECT count(reservation.id) AS total
    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.register_by = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllRsvWithClientsWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAllWithClients` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getBetweenDates` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getByDate` (IN `date` DATE)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getById` (IN `id` INT)  BEGIN
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
    WHERE `reservation`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getDisableCount` ()  BEGIN
	SELECT count(reservation.id) AS total 
    FROM `reservation`
    WHERE `reservation`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getSalesMonthly` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_update` (IN `date_start` DATE, IN `date_end` DATE, IN `stay` VARCHAR(255), IN `discount` FLOAT, IN `total_price` FLOAT, IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
    UPDATE `reservation` 
    SET 
        `reservation`.`date_start` = date_start, 
        `reservation`.`date_end` = date_end,
        `reservation`.`stay` = stay,
        `reservation`.`discount` = discount,
        `reservation`.`total_price` = total_price,
        `reservation`.`date_update` = date_update,
        `reservation`.`update_by` = update_by          
    WHERE 
        `reservation`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexlocker_add` (IN `FK_id_service` INT, IN `FK_id_locker` INT)  BEGIN
	INSERT INTO servicexlocker (
			servicexlocker.FK_id_service,
            servicexlocker.FK_id_locker                   
	)
    VALUES
        (FK_id_service, FK_id_locker);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexlocker_getLockerByService` (IN `id_service` INT)  BEGIN
	SELECT locker.id AS locker_id,
           locker.locker_number AS locker_number,
           locker.price AS locker_price,
           locker.sex AS locker_sex
	FROM servicexlocker
	INNER JOIN locker ON servicexlocker.FK_id_locker = locker.id
	
	WHERE (servicexlocker.FK_id_service = id_service)
	GROUP BY locker.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexlocker_getServiceByLocker` (IN `id_locker` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexlocker
	INNER JOIN additional_service ON servicexlocker.FK_id_service = additional_service.id
	
	WHERE (servicexlocker.FK_id_locker = id_locker)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexmobileParasol_add` (IN `FK_id_service` INT, IN `FK_id_mobileParasol` INT)  BEGIN
	INSERT INTO servicexmobileParasol (
			servicexmobileParasol.FK_id_service,
            servicexmobileParasol.FK_id_mobileParasol                   
	)
    VALUES
        (FK_id_service, FK_id_mobileParasol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexmobileParasol_getMobileParasolByService` (IN `id_service` INT)  BEGIN
	SELECT mobile_parasol.id AS mobileParasol_id,
           mobile_parasol.mobileParasol_number AS mobileParasol_number,
           mobile_parasol.price AS mobileParasol_price
	FROM servicexmobileParasol
	INNER JOIN mobile_parasol ON servicexmobileParasol.FK_id_mobileParasol = mobile_parasol.id
	
	WHERE (servicexmobileParasol.FK_id_service = id_service)
	GROUP BY mobile_parasol.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexmobileParasol_getServiceByMobileParasol` (IN `id_mobileParasol` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexmobileParasol
	INNER JOIN additional_service ON servicexmobileParasol.FK_id_service = additional_service.id
	
	WHERE (servicexmobileParasol.FK_id_mobileParasol = id_mobileParasol)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparasol_add` (IN `FK_id_service` INT, IN `FK_id_parasol` INT)  BEGIN
	INSERT INTO servicexparasol (
			servicexparasol.FK_id_service,
            servicexparasol.FK_id_parasol                   
	)
    VALUES
        (FK_id_service, FK_id_parasol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparasol_getParasolByService` (IN `id_service` INT)  BEGIN
	SELECT parasol.id AS parasol_id,
           parasol.parasol_number AS parasol_number,
           parasol.price AS parasol_price
	FROM servicexparasol
	INNER JOIN parasol ON servicexparasol.FK_id_parasol = parasol.id
	
	WHERE (servicexparasol.FK_id_service = id_service)
	GROUP BY parasol.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparasol_getServiceByParasol` (IN `id_parasol` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexparasol
	INNER JOIN additional_service ON servicexparasol.FK_id_service = additional_service.id
	
	WHERE (servicexparasol.FK_id_parasol = id_parasol)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparking_add` (IN `FK_id_service` INT, IN `FK_id_parking` INT)  BEGIN
	INSERT INTO servicexparking (
			servicexparking.FK_id_service,
            servicexparking.FK_id_parking                   
	)
    VALUES
        (FK_id_service, FK_id_parking);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparking_getParkingByService` (IN `id_service` INT)  BEGIN
	SELECT parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price
	FROM servicexparking
	INNER JOIN parking ON servicexparking.FK_id_parking = parking.id
	
	WHERE (servicexparking.FK_id_service = id_service)
	GROUP BY parking.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparking_getServiceByParking` (IN `id_parking` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexparking
	INNER JOIN additional_service ON servicexparking.FK_id_service = additional_service.id
	
	WHERE (servicexparking.FK_id_parking = id_parking)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_add` (IN `total` FLOAT, IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
    INSERT INTO additional_service (			
            additional_service.total,                   
            additional_service.date_register,
            additional_service.register_by
	)
    VALUES (total, date_register, register_by);
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
    UPDATE `additional_service` 
    SET 
        `additional_service`.`is_active` = false, 
        `additional_service`.`date_disable` = date_disable,
        `additional_service`.`disable_by` = disable_by
    WHERE `additional_service`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `additional_service` 
    SET 
        `additional_service`.`is_active` = true,
        `additional_service`.`date_enable` = date_enable,
        `additional_service`.`enable_by` = enable_by  
    WHERE `additional_service`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getAll` ()  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active        
    FROM `additional_service` 
    WHERE `additional_service`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getById` (IN `id` INT)  BEGIN
	SELECT additional_service.id AS service_id,           
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active 
           
    FROM `additional_service` WHERE `additional_service`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_update` (IN `total` FLOAT, IN `date_update` DATE, IN `update_by` INT, IN `id` INT)  BEGIN
    UPDATE `additional_service` 
    SET         
        `additional_service`.`total` = total,        
        `additional_service`.`date_update` = date_update,
        `additional_service`.`update_by` = update_by
    WHERE 
        `additional_service`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `position` VARCHAR(255), IN `salary` FLOAT, IN `date_start` DATE, IN `date_end` DATE, IN `dni` INT, IN `address` VARCHAR(255), IN `tel` INT, IN `shirt_size` FLOAT, IN `pant_size` FLOAT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_checkDni` (IN `dni` INT, IN `id` INT)  BEGIN
    SELECT `staff`.`id` FROM `staff` WHERE `staff`.`dni` = dni AND `staff`.`id` != id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_disableById` (IN `id` INT, IN `date_disable` DATE, IN `disable_by` INT)  BEGIN
	UPDATE `staff` 
    SET 
        `staff`.`is_active` = false, 
        `staff`.`date_disable` = date_disable,
        `staff`.`disable_by` = disable_by
    WHERE `staff`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_enableById` (IN `id` INT, IN `date_enable` DATE, IN `enable_by` INT)  BEGIN
    UPDATE `staff` 
    SET 
        `staff`.`is_active` = true, 
        `staff`.`date_enable` = date_enable,
        `staff`.`enable_by` = enable_by
    WHERE `staff`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getActiveCount` ()  BEGIN
	SELECT count(staff.id) AS total 
    FROM `staff`
    WHERE `staff`.`is_active` = true;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAll` ()  BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`    
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAllActives` ()  BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`is_active` = true
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAllActiveStaffWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `staff`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname             
    FROM `staff`    
    INNER JOIN admin ON staff.register_by = admin.id 
    WHERE `staff`.`is_active` = true
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAllDisables` ()  BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`is_active` = false
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAllDisableStaffWithLimit` (IN `start` INT, IN `max_items` INT)  BEGIN
	SELECT 
        `staff`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname             
    FROM `staff`    
    INNER JOIN admin ON staff.register_by = admin.id    
    WHERE `staff`.`is_active` = false
    LIMIT start, max_items;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getByName` (IN `name` VARCHAR(255))  BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname 
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    WHERE `staff`.`name` LIKE CONCAT('%', name , '%');
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getDisableCount` ()  BEGIN
	SELECT count(staff.id) AS total 
    FROM `staff`
    WHERE `staff`.`is_active` = false;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `position` VARCHAR(255), IN `salary` FLOAT, IN `date_start` DATE, IN `date_end` DATE, IN `dni` INT, IN `address` VARCHAR(255), IN `tel` INT, IN `shirt_size` FLOAT, IN `pant_size` FLOAT, IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getAll` ()  BEGIN
	SELECT * FROM `beach_tent` ORDER BY number ASC;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getAllWithActualReservation` (IN `today` DATE)  BEGIN
	SELECT count(*) AS total
    FROM `beach_tent` 
    INNER JOIN `reservation` ON `beach_tent`.`id` = `reservation`.`FK_id_tent`
    WHERE today BETWEEN `reservation`.`date_start` AND `reservation`.`date_end`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getByNumber` (IN `number` INT)  BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`number` = number;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getN_row` (IN `start` INT)  BEGIN
	SELECT         
        `beach_tent`.*, 
        `hall`.`number` AS hall_number 
    FROM `beach_tent` 
    INNER JOIN `hall` ON `beach_tent`.`FK_id_hall` = `hall`.`id`
    WHERE (`beach_tent`.`FK_id_hall` = start ) AND  (`beach_tent`.`sea` = 0)
    ORDER BY `beach_tent`.`position` ASC;     
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getSea_N_row` (IN `start` INT)  BEGIN
	SELECT         
        `beach_tent`.*, 
        `hall`.`number` AS hall_number 
    FROM `beach_tent` 
    INNER JOIN `hall` ON `beach_tent`.`FK_id_hall` = `hall`.`id`
    WHERE (`beach_tent`.`FK_id_hall` = start ) AND  (`beach_tent`.`sea` = 1)
    ORDER BY `beach_tent`.`position` ASC;     
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `additional_service`
--

CREATE TABLE `additional_service` (
  `id` int(11) NOT NULL,
  `total` float NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `additional_service`
--

INSERT INTO `additional_service` (`id`, `total`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 580, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(2, 11, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(3, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(4, 10, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(5, 21, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(6, 5005, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(7, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 500, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 500, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 500, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 20, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 50, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 6000, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 10, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 100, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(26, 10, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(27, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 0, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `dni` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) DEFAULT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `lastname`, `dni`, `email`, `password`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'admin', 'admin', 505050, 'admin@admin.com', '$2y$10$xNd90YZ2Zcttqmt2JU9d3uWt.CgYhVAW4ylkauUaXZ8vLkHRy.X1a', 1, '2020-01-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `concept` varchar(255) COLLATE utf8_bin NOT NULL,
  `number_receipt` varchar(255) COLLATE utf8_bin NOT NULL,
  `total` float NOT NULL,
  `partial` float NOT NULL,
  `remainder` float NOT NULL,
  `FK_id_reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`id`, `date`, `concept`, `number_receipt`, `total`, `partial`, `remainder`, `FK_id_reservation`) VALUES
(1, '2020-01-26', 'efectivo', '124', 251400, 50000, 201400, 4);

-- --------------------------------------------------------

--
-- Table structure for table `beach_tent`
--

CREATE TABLE `beach_tent` (
  `id` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `position` int(11) NOT NULL,
  `sea` tinyint(1) NOT NULL DEFAULT 0,
  `FK_id_hall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `beach_tent`
--

INSERT INTO `beach_tent` (`id`, `number`, `price`, `position`, `sea`, `FK_id_hall`) VALUES
(1, '16B', 100, 0, 0, 1),
(2, '16', 100, 1, 0, 1),
(3, '15', 100, 2, 0, 1),
(4, '14', 100, 3, 0, 1),
(5, '13', 100, 4, 0, 1),
(6, '12', 100, 5, 0, 1),
(7, '11', 100, 6, 0, 1),
(8, '10', 100, 7, 0, 1),
(9, '9', 100, 8, 0, 1),
(10, '8', 100, 9, 0, 1),
(11, '7', 100, 10, 0, 1),
(12, '6', 100, 11, 0, 1),
(13, '5', 100, 12, 0, 1),
(14, '4', 100, 13, 0, 1),
(15, '3', 100, 14, 0, 1),
(16, '17B', 100, 15, 0, 2),
(17, '17', 100, 16, 0, 2),
(18, '18', 100, 17, 0, 2),
(19, '19', 100, 18, 0, 2),
(20, '20', 100, 19, 0, 2),
(21, '21', 100, 20, 0, 2),
(22, '22', 100, 21, 0, 2),
(23, '23', 100, 22, 0, 2),
(24, '24', 100, 23, 0, 2),
(25, '25', 100, 24, 0, 2),
(26, '26', 100, 25, 0, 2),
(27, '27', 100, 26, 0, 2),
(28, '28', 100, 27, 0, 2),
(29, '29', 100, 28, 0, 2),
(30, '30', 100, 29, 0, 2),
(31, '30B', 100, 30, 0, 2),
(32, '49B', 100, 31, 0, 2),
(33, '49', 100, 32, 0, 2),
(34, '48', 100, 33, 0, 2),
(35, '47', 100, 34, 0, 2),
(36, '46', 100, 35, 0, 2),
(37, '45', 100, 36, 0, 2),
(38, '44', 100, 37, 0, 2),
(39, '43', 100, 38, 0, 2),
(40, '42', 100, 39, 0, 2),
(41, '41', 100, 40, 0, 2),
(42, '40', 100, 41, 0, 2),
(43, '39', 100, 42, 0, 2),
(44, '38', 100, 43, 0, 2),
(45, '37', 100, 44, 0, 2),
(46, '36', 100, 45, 0, 2),
(47, '36B', 100, 46, 0, 2),
(48, '50B', 100, 47, 0, 3),
(49, '50', 100, 48, 0, 3),
(50, '51', 100, 49, 0, 3),
(51, '52', 100, 50, 0, 3),
(52, '53', 100, 51, 0, 3),
(53, '54', 100, 52, 0, 3),
(54, '55', 100, 53, 0, 3),
(55, '56', 100, 54, 0, 3),
(56, '57', 100, 55, 0, 3),
(57, '58', 100, 56, 0, 3),
(58, '59', 100, 57, 0, 3),
(59, '60', 100, 58, 0, 3),
(60, '61', 100, 59, 0, 3),
(61, '62', 100, 60, 0, 3),
(62, '63', 100, 61, 0, 3),
(63, '63B', 100, 62, 0, 3),
(64, '82B', 100, 63, 0, 3),
(65, '82', 100, 64, 0, 3),
(66, '81', 100, 65, 0, 3),
(67, '80', 100, 66, 0, 3),
(68, '79', 100, 67, 0, 3),
(69, '78', 100, 68, 0, 3),
(70, '77', 100, 69, 0, 3),
(71, '76', 100, 70, 0, 3),
(72, '75', 100, 71, 0, 3),
(73, '74', 100, 72, 0, 3),
(74, '73', 100, 73, 0, 3),
(75, '72', 100, 74, 0, 3),
(76, '71', 100, 75, 0, 3),
(77, '70', 100, 76, 0, 3),
(78, '69', 100, 77, 0, 3),
(79, '69B', 100, 78, 0, 3),
(80, '83B', 100, 79, 0, 4),
(81, '83', 100, 80, 0, 4),
(82, '84', 100, 81, 0, 4),
(83, '85', 100, 82, 0, 4),
(84, '86', 100, 83, 0, 4),
(85, '87', 100, 84, 0, 4),
(86, '88', 100, 85, 0, 4),
(87, '89', 100, 86, 0, 4),
(88, '90', 100, 87, 0, 4),
(89, '91', 100, 88, 0, 4),
(90, '92', 100, 89, 0, 4),
(91, '93', 100, 90, 0, 4),
(92, '94', 100, 91, 0, 4),
(93, '95', 100, 92, 0, 4),
(94, '96', 100, 93, 0, 4),
(95, '96B', 100, 94, 0, 4),
(96, '115B', 100, 95, 0, 4),
(97, '115', 100, 96, 0, 4),
(98, '114', 100, 97, 0, 4),
(99, '113', 100, 98, 0, 4),
(100, '112', 100, 99, 0, 4),
(101, '111', 100, 100, 0, 4),
(102, '110', 100, 101, 0, 4),
(103, '109', 100, 102, 0, 4),
(104, '108', 100, 103, 0, 4),
(105, '107', 100, 104, 0, 4),
(106, '106', 100, 105, 0, 4),
(107, '105', 100, 106, 0, 4),
(108, '104', 100, 107, 0, 4),
(109, '103', 100, 108, 0, 4),
(110, '102', 100, 109, 0, 4),
(111, '102B', 100, 110, 0, 4),
(112, '116B', 100, 111, 0, 5),
(113, '116', 100, 112, 0, 5),
(114, '117', 100, 113, 0, 5),
(115, '118', 100, 114, 0, 5),
(116, '119', 100, 115, 0, 5),
(117, '120', 100, 116, 0, 5),
(118, '121', 100, 117, 0, 5),
(119, '122', 100, 118, 0, 5),
(120, '123', 100, 119, 0, 5),
(121, '124', 100, 120, 0, 5),
(122, '125', 100, 121, 0, 5),
(123, '126', 100, 122, 0, 5),
(124, '127', 100, 123, 0, 5),
(125, '128', 100, 124, 0, 5),
(126, '129', 100, 125, 0, 5),
(127, '129B', 100, 126, 0, 5),
(128, '148B', 100, 127, 0, 5),
(129, '148', 100, 128, 0, 5),
(130, '147', 100, 129, 0, 5),
(131, '146', 100, 130, 0, 5),
(132, '145', 100, 131, 0, 5),
(133, '144', 100, 132, 0, 5),
(134, '143', 100, 133, 0, 5),
(135, '142', 100, 134, 0, 5),
(136, '141', 100, 135, 0, 5),
(137, '140', 100, 136, 0, 5),
(138, '139', 100, 137, 0, 5),
(139, '138', 100, 138, 0, 5),
(140, '137', 100, 139, 0, 5),
(141, '136', 100, 140, 0, 5),
(142, '135', 100, 141, 0, 5),
(143, '135B', 100, 142, 0, 5),
(144, '149B', 100, 143, 0, 6),
(145, '149', 100, 144, 0, 6),
(146, '150', 100, 145, 0, 6),
(147, '151', 100, 146, 0, 6),
(148, '152', 100, 147, 0, 6),
(149, '153', 100, 148, 0, 6),
(150, '154', 100, 149, 0, 6),
(151, '155', 100, 150, 0, 6),
(152, '156', 100, 151, 0, 6),
(153, '157', 100, 152, 0, 6),
(154, '158', 100, 153, 0, 6),
(155, '159', 100, 154, 0, 6),
(156, '160', 100, 155, 0, 6),
(157, '161', 100, 156, 0, 6),
(158, '162', 100, 157, 0, 6),
(159, '162B', 100, 158, 0, 6),
(160, '181B', 100, 160, 0, 6),
(161, '181', 100, 161, 0, 6),
(162, '180', 100, 162, 0, 6),
(163, '179', 100, 163, 0, 6),
(164, '178', 100, 164, 0, 6),
(165, '177', 100, 165, 0, 6),
(166, '176', 100, 166, 0, 6),
(167, '175', 100, 167, 0, 6),
(168, '174', 100, 168, 0, 6),
(169, '173', 100, 169, 0, 6),
(170, '172', 100, 170, 0, 6),
(171, '171', 100, 171, 0, 6),
(172, '170', 100, 172, 0, 6),
(173, '169', 100, 173, 0, 6),
(174, '168', 100, 174, 0, 6),
(175, '168B', 100, 175, 0, 6),
(176, '182BB', 100, 176, 0, 7),
(177, '182B', 100, 176, 0, 7),
(178, '182', 100, 177, 0, 7),
(179, '183', 100, 178, 0, 7),
(180, '184', 100, 179, 0, 7),
(181, '185', 100, 180, 0, 7),
(182, '186', 100, 181, 0, 7),
(183, '187', 100, 182, 0, 7),
(184, '188', 100, 183, 0, 7),
(185, '189', 100, 184, 0, 7),
(186, '190', 100, 185, 0, 7),
(187, '191', 100, 186, 0, 7),
(188, '192', 100, 187, 0, 7),
(189, '193', 100, 188, 0, 7),
(190, '194', 100, 189, 0, 7),
(191, '195', 100, 190, 0, 7),
(192, '1', 100, 191, 1, 1),
(193, '2', 100, 192, 1, 1),
(194, '2B', 100, 193, 1, 1),
(195, '31', 100, 194, 1, 2),
(196, '32', 100, 195, 1, 2),
(197, '33', 100, 196, 1, 2),
(198, '34', 100, 197, 1, 2),
(199, '35', 100, 198, 1, 2),
(200, '35B', 100, 199, 1, 2),
(201, '64', 100, 200, 1, 3),
(202, '65', 100, 201, 1, 3),
(203, '66', 100, 202, 1, 3),
(204, '67', 100, 203, 1, 3),
(205, '68', 100, 204, 1, 3),
(206, '68B', 100, 205, 1, 3),
(207, '97', 100, 206, 1, 4),
(208, '98', 100, 207, 1, 4),
(209, '99', 100, 208, 1, 4),
(210, '100', 100, 209, 1, 4),
(211, '101', 100, 210, 1, 4),
(212, '101B', 100, 211, 1, 4),
(213, '130', 100, 212, 1, 5),
(214, '131', 100, 213, 1, 5),
(215, '132', 100, 214, 1, 5),
(216, '133', 100, 215, 1, 5),
(217, '134', 100, 216, 1, 5),
(218, '134B', 100, 217, 1, 5),
(219, '163', 100, 218, 1, 6),
(220, '164', 100, 219, 1, 6),
(221, '165', 100, 220, 1, 6),
(222, '166', 100, 221, 1, 6),
(223, '167', 100, 222, 1, 6),
(224, '167B', 100, 223, 1, 6),
(225, '196B', 100, 224, 1, 7),
(226, '196', 100, 225, 1, 7),
(227, '197', 100, 226, 1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'administracion'),
(2, 'herramientas'),
(3, 'recreacion'),
(4, 'playa-plasticos'),
(5, 'playa-pileta'),
(6, 'playa-carpas'),
(7, 'playa-juegos');

-- --------------------------------------------------------

--
-- Table structure for table `checkc`
--

CREATE TABLE `checkc` (
  `id` int(11) NOT NULL,
  `bank` varchar(255) COLLATE utf8_bin NOT NULL,
  `account_number` int(11) NOT NULL,
  `check_number` int(11) NOT NULL,
  `FK_id_client` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `checkc`
--

INSERT INTO `checkc` (`id`, `bank`, `account_number`, `check_number`, `FK_id_client`) VALUES
(1, 'Banco nacion', 1294124, 1, 2),
(2, 'Banco nacion', 1294124, 1, 2),
(3, 'Banco nacion', 1294124, 1, 2),
(4, 'Banco nacion', 1294124, 1, 2),
(5, 'Banco nacion', 1294124, 1, 2),
(6, 'Banco nacion', 1294124, 1, 2),
(7, 'Banco nacion', 1294124, 1, 2),
(8, 'Banco nacion', 1294124, 1, 2),
(9, 'Banco nacion', 1294124, 1, 2),
(10, 'Banco nacion', 1294124, 1, 2),
(11, 'Banco nacion', 1294124, 1, 2),
(12, 'Banco nacion', 1294124, 1, 2),
(13, 'Banco nacion', 1294124, 1, 2),
(14, 'Banco nacion', 1294124, 1, 2),
(15, 'Banco nacion', 1294124, 1, 2),
(16, '1', 1, 1, 16);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `family_group` varchar(255) COLLATE utf8_bin NOT NULL,
  `auxiliary_phone` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8_bin NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `name`, `lastname`, `address`, `city`, `cp`, `email`, `tel`, `family_group`, `auxiliary_phone`, `payment_method`, `vehicle_type`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'rodrigo', 'leon', 'calle 30', 'mar del plata', 0, 'rodrigoleon2016@hotmail.com', 4502525, '', 25131230, 'cash', 'car', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(2, 'pepe', 'pepe', 'pepe', 'pep', 0, '2pe@mail.com', 2, '', 2, 'check', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(3, 'asd', 'das', 'dasd', 'dasd', 0, 'asd@mail.com', 123, '', 12, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(4, 'ojik', 'ko', 'po', 'pko', 0, 'kpoas@ail.com', 123, '', 12, 'cash', 'car', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(5, 'asd', 'dasd', 'dsad', 'dasd', 0, 'asdasdad@mailll.com', 124, '', 2, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(6, 'sdad', 'sad', 'dad', 'dasd', 123, 'asddd@mail.com', 123, '123', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'asd', 'dsad', 'das', 'da', 12, 'asd@mmail.com', 124, '12', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'asd', 'dsa', 'das', 'ds', 12, 'as@maillll.com', 124, '12', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'asd', 'ddd', 'dd', 'd', 12, '12124sad@mail.com', 123, '12', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'ddq2', '123', 'asd12', '2', 0, '2ad@mail.com', 124, '', 1, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(11, 'asd', 'dsad', 'd123', '124', 412, '4124@mail.com', 1252, '124', 124, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'opk', 'pok', 'asd12', 'dqds', 15, 'asd@maiiiil.com', 124, '12', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'ad', 'dad', 'd', 'd', 0, '124easd2m2@mail.com', 14152, '', 12, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(14, 'asdk', 'kasokd', 'asdko', 'oas', 124, 'oaskd@mail.com', 124, '12', 12, '', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'asd', 'dad', 'dad', 'dd', 0, 'dasd@mail.com', 12, '', 12, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(16, 'asda', 'dads', 'dasd', 'dasd', 0, 'ad2ads@mail.com', 12512, '', 12, 'check', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(17, 'asd', 'dasd', 'das', 'das', 0, 'asd2@mail.com', 124, '', 124, 'cash', 'van', 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_potential`
--

CREATE TABLE `client_potential` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `num_tent` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `date_start_season` date NOT NULL,
  `date_end_season` date NOT NULL,
  `price_tent_season` float NOT NULL,
  `price_tent_january` float NOT NULL,
  `price_tent_january_day` float NOT NULL,
  `price_tent_january_fortnigh` float NOT NULL,
  `price_tent_february` float NOT NULL,
  `price_tent_february_day` float NOT NULL,
  `price_tent_february_first_fortnigh` float NOT NULL,
  `price_tent_february_second_fortnigh` float NOT NULL,
  `price_parasol` float NOT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`date_start_season`, `date_end_season`, `price_tent_season`, `price_tent_january`, `price_tent_january_day`, `price_tent_january_fortnigh`, `price_tent_february`, `price_tent_february_day`, `price_tent_february_first_fortnigh`, `price_tent_february_second_fortnigh`, `price_parasol`, `date_update`, `update_by`) VALUES
('2020-01-01', '2020-03-01', 50000, 35000, 2500, 20000, 25000, 2000, 20000, 13000, 1800, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `diary_balance`
--

CREATE TABLE `diary_balance` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(255) COLLATE utf8_bin NOT NULL,
  `payment` varchar(255) COLLATE utf8_bin NOT NULL,
  `detail` varchar(255) COLLATE utf8_bin NOT NULL,
  `total` float NOT NULL,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `hall`
--

CREATE TABLE `hall` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `hall`
--

INSERT INTO `hall` (`id`, `number`) VALUES
(1, 0),
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7);

-- --------------------------------------------------------

--
-- Table structure for table `locker`
--

CREATE TABLE `locker` (
  `id` int(11) NOT NULL,
  `locker_number` int(11) NOT NULL,
  `sex` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `locker`
--

INSERT INTO `locker` (`id`, `locker_number`, `sex`, `price`) VALUES
(1, 1, 'mujer', 0),
(2, 2, 'mujer', 0),
(3, 3, 'mujer', 0),
(4, 4, 'mujer', 0),
(5, 5, 'mujer', 0),
(6, 6, 'mujer', 0),
(7, 7, 'mujer', 0),
(8, 8, 'mujer', 0),
(9, 9, 'mujer', 0),
(10, 10, 'mujer', 0),
(11, 11, 'mujer', 0),
(12, 12, 'mujer', 0),
(13, 13, 'mujer', 0),
(14, 14, 'mujer', 0),
(15, 15, 'mujer', 0),
(16, 16, 'mujer', 0),
(17, 17, 'mujer', 0),
(18, 18, 'mujer', 0),
(19, 19, 'mujer', 0),
(20, 20, 'mujer', 0),
(21, 21, 'mujer', 0),
(22, 22, 'mujer', 0),
(23, 23, 'mujer', 0),
(24, 24, 'mujer', 0),
(25, 25, 'mujer', 0),
(26, 26, 'mujer', 0),
(27, 27, 'mujer', 0),
(28, 28, 'mujer', 0),
(29, 29, 'mujer', 0),
(30, 30, 'mujer', 0),
(31, 31, 'mujer', 0),
(32, 32, 'mujer', 0),
(33, 33, 'mujer', 0),
(34, 34, 'mujer', 0),
(35, 35, 'mujer', 0),
(36, 36, 'mujer', 0),
(37, 37, 'mujer', 0),
(38, 38, 'mujer', 0),
(39, 39, 'mujer', 0),
(40, 40, 'mujer', 0),
(41, 41, 'mujer', 0),
(42, 42, 'mujer', 0),
(43, 43, 'mujer', 0),
(44, 44, 'mujer', 0),
(45, 45, 'mujer', 0),
(46, 46, 'mujer', 0),
(47, 47, 'mujer', 0),
(48, 48, 'mujer', 0),
(49, 49, 'mujer', 0),
(50, 50, 'mujer', 0),
(51, 51, 'mujer', 0),
(52, 52, 'mujer', 0),
(53, 53, 'mujer', 0),
(54, 54, 'mujer', 0),
(55, 55, 'mujer', 0),
(56, 56, 'mujer', 0),
(57, 57, 'mujer', 0),
(58, 58, 'mujer', 0),
(59, 59, 'mujer', 0),
(60, 60, 'mujer', 0),
(61, 61, 'mujer', 0),
(62, 62, 'mujer', 0),
(63, 63, 'mujer', 0),
(64, 64, 'mujer', 0),
(65, 65, 'mujer', 0),
(66, 66, 'mujer', 0),
(67, 67, 'mujer', 0),
(68, 68, 'mujer', 0),
(69, 69, 'mujer', 0),
(70, 70, 'mujer', 0),
(71, 71, 'mujer', 0),
(72, 72, 'mujer', 0),
(73, 73, 'mujer', 0),
(74, 74, 'mujer', 0),
(75, 75, 'mujer', 0),
(76, 76, 'mujer', 0),
(77, 77, 'mujer', 0),
(78, 78, 'mujer', 0),
(79, 79, 'mujer', 0),
(80, 80, 'mujer', 0),
(81, 81, 'mujer', 0),
(82, 82, 'mujer', 0),
(83, 83, 'mujer', 0),
(84, 84, 'mujer', 0),
(85, 85, 'mujer', 0),
(86, 86, 'mujer', 0),
(87, 87, 'mujer', 0),
(88, 88, 'mujer', 0),
(89, 89, 'mujer', 0),
(90, 90, 'mujer', 0),
(91, 91, 'mujer', 0),
(92, 92, 'mujer', 0),
(93, 93, 'mujer', 0),
(94, 94, 'mujer', 0),
(95, 95, 'mujer', 0),
(96, 96, 'mujer', 0),
(97, 97, 'mujer', 0),
(98, 98, 'mujer', 0),
(99, 99, 'mujer', 0),
(100, 100, 'mujer', 0),
(101, 101, 'mujer', 0),
(102, 102, 'mujer', 0),
(103, 103, 'mujer', 0),
(104, 104, 'mujer', 0),
(105, 105, 'mujer', 0),
(106, 106, 'mujer', 0),
(107, 107, 'mujer', 0),
(108, 108, 'mujer', 0),
(109, 109, 'mujer', 0),
(110, 110, 'mujer', 0),
(111, 111, 'mujer', 0),
(112, 112, 'mujer', 0),
(113, 113, 'mujer', 0),
(114, 114, 'mujer', 0),
(115, 115, 'mujer', 0),
(116, 116, 'mujer', 0),
(117, 117, 'mujer', 0),
(118, 118, 'mujer', 0),
(119, 119, 'mujer', 0),
(120, 120, 'mujer', 0),
(121, 121, 'mujer', 0),
(122, 122, 'mujer', 0),
(123, 123, 'mujer', 0),
(124, 124, 'mujer', 0),
(125, 125, 'mujer', 0),
(126, 126, 'mujer', 0),
(127, 127, 'mujer', 0),
(128, 128, 'mujer', 0),
(129, 129, 'mujer', 0),
(130, 130, 'mujer', 0),
(131, 131, 'mujer', 0),
(132, 132, 'mujer', 0),
(133, 133, 'mujer', 0),
(134, 134, 'mujer', 0),
(135, 135, 'mujer', 0),
(136, 136, 'mujer', 0),
(137, 1, 'hombres', 0),
(138, 2, 'hombres', 0),
(139, 3, 'hombres', 0),
(140, 4, 'hombres', 0),
(141, 5, 'hombres', 0),
(142, 6, 'hombres', 0),
(143, 7, 'hombres', 0),
(144, 8, 'hombres', 0),
(145, 9, 'hombres', 0),
(146, 10, 'hombres', 0),
(147, 11, 'hombres', 0),
(148, 12, 'hombres', 0),
(149, 13, 'hombres', 0),
(150, 14, 'hombres', 0),
(151, 15, 'hombres', 0),
(152, 16, 'hombres', 0),
(153, 17, 'hombres', 0),
(154, 18, 'hombres', 0),
(155, 19, 'hombres', 0),
(156, 20, 'hombres', 0),
(157, 21, 'hombres', 0),
(158, 22, 'hombres', 0);

-- --------------------------------------------------------

--
-- Table structure for table `mobile_parasol`
--

CREATE TABLE `mobile_parasol` (
  `id` int(11) NOT NULL,
  `mobileParasol_number` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `mobile_parasol`
--

INSERT INTO `mobile_parasol` (`id`, `mobileParasol_number`, `price`) VALUES
(1, 1, 0),
(2, 2, 0),
(3, 3, 0),
(4, 4, 0),
(5, 5, 0),
(6, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parasol`
--

CREATE TABLE `parasol` (
  `id` int(11) NOT NULL,
  `parasol_number` int(11) NOT NULL,
  `price` float NOT NULL,
  `position` int(11) NOT NULL,
  `FK_id_hall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `parasol`
--

INSERT INTO `parasol` (`id`, `parasol_number`, `price`, `position`, `FK_id_hall`) VALUES
(1, 1, 100, 1, 1),
(2, 2, 100, 2, 1),
(3, 3, 100, 3, 1),
(4, 4, 100, 4, 2),
(5, 5, 100, 5, 2),
(6, 6, 100, 6, 2),
(7, 7, 100, 7, 3),
(8, 8, 100, 8, 3),
(9, 9, 100, 9, 3),
(10, 10, 100, 10, 4),
(11, 11, 100, 11, 4),
(12, 12, 100, 12, 4),
(13, 13, 100, 13, 5),
(14, 14, 100, 14, 5),
(15, 15, 100, 15, 5);

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` float DEFAULT NULL,
  `position` int(11) NOT NULL,
  `FK_id_hall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `number`, `price`, `position`, `FK_id_hall`) VALUES
(1, '168', 100, 1, 1),
(2, '169', 100, 2, 1),
(3, '170', 100, 3, 1),
(4, '171', 100, 4, 1),
(5, '172', 100, 5, 1),
(6, '173', 100, 6, 1),
(7, '174', 100, 7, 1),
(8, '175', 100, 8, 1),
(9, '176', 100, 9, 1),
(10, '177', 100, 10, 1),
(11, '178', 100, 11, 1),
(12, '179', 100, 12, 1),
(13, '180', 100, 13, 1),
(14, '181', 100, 14, 1),
(15, '182', 100, 15, 1),
(16, '183', 100, 16, 1),
(17, '184', 100, 17, 1),
(18, '185', 100, 18, 1),
(19, '186', 100, 19, 1),
(20, '187', 100, 20, 1),
(21, '160', 100, 21, 2),
(22, '161', 100, 22, 2),
(23, '162', 100, 23, 2),
(24, '163', 100, 24, 2),
(25, '164', 100, 25, 2),
(26, '165', 100, 26, 2),
(27, '45', 100, 27, 2),
(28, '46', 100, 28, 2),
(29, '47', 100, 29, 2),
(30, '48', 100, 30, 2),
(31, '49', 100, 31, 2),
(32, '50', 100, 32, 2),
(33, '166D', 100, 33, 2),
(34, '167D', 100, 34, 3),
(35, '53', 100, 35, 3),
(36, '54', 100, 36, 3),
(37, '55', 100, 37, 3),
(38, '56', 100, 38, 3),
(39, '57', 100, 39, 3),
(40, '58', 100, 40, 3),
(41, '59', 100, 41, 3),
(42, '60', 100, 42, 3),
(43, '61', 100, 43, 4),
(44, '62', 100, 44, 4),
(45, '63', 100, 45, 4),
(46, '64', 100, 46, 4),
(47, '1', 100, 47, 4),
(48, '2', 100, 48, 4),
(49, '3', 100, 49, 4),
(50, '4', 100, 50, 4),
(51, '5', 100, 51, 4),
(52, '6', 100, 52, 4),
(53, '7', 100, 53, 4),
(54, '8', 100, 54, 4),
(55, '9', 100, 55, 4),
(56, '10', 100, 56, 4),
(57, '11', 100, 57, 4),
(58, '12', 100, 58, 4),
(59, '13', 100, 59, 4),
(60, '14', 100, 60, 4),
(61, '15', 100, 61, 4),
(62, '16', 100, 62, 4),
(63, '17', 100, 63, 4),
(64, '18', 100, 64, 4),
(65, '19', 100, 65, 4),
(66, '20', 100, 66, 4),
(67, '21', 100, 67, 4),
(68, '22', 100, 68, 4),
(69, '65', 100, 69, 5),
(70, '66', 100, 70, 5),
(71, '67', 100, 71, 5),
(72, '68', 100, 72, 5),
(73, '44', 100, 73, 5),
(74, '43', 100, 74, 5),
(75, '42', 100, 75, 5),
(76, '41', 100, 76, 5),
(77, '40', 100, 77, 5),
(78, '39', 100, 78, 5),
(79, '38', 100, 79, 5),
(80, '37', 100, 80, 5),
(81, '36', 100, 81, 5),
(82, '35', 100, 82, 5),
(83, '34', 100, 83, 5),
(84, '33', 100, 84, 5),
(85, '32', 100, 85, 5),
(86, '31', 100, 86, 5),
(87, '30', 100, 87, 5),
(88, '29', 100, 88, 5),
(89, '28', 100, 89, 5),
(90, '27', 100, 90, 5),
(91, '26', 100, 91, 5),
(92, '25', 100, 92, 5),
(93, '24', 100, 93, 5),
(94, '23', 100, 94, 5),
(95, '69', 100, 95, 6),
(96, '70', 100, 96, 6),
(97, '71', 100, 97, 6),
(98, '72', 100, 98, 6),
(99, '73', 100, 99, 6),
(100, '74', 100, 100, 6),
(101, '75', 100, 101, 6),
(102, '76', 100, 102, 6),
(103, '77', 100, 103, 6),
(104, '78', 100, 104, 6),
(105, '79', 100, 105, 6),
(106, '80', 100, 106, 6),
(107, '81', 100, 107, 6),
(108, '82', 100, 108, 6),
(109, '83', 100, 109, 6),
(110, '84', 100, 110, 6),
(111, '85', 100, 111, 6),
(112, '86', 100, 112, 6),
(113, '87', 100, 113, 6),
(114, '88', 100, 114, 6),
(115, '89', 100, 115, 6),
(116, '90', 100, 116, 6),
(117, '91', 100, 117, 7),
(118, '92', 100, 118, 7),
(119, '93', 100, 119, 7),
(120, '94', 100, 120, 7),
(121, '95', 100, 121, 7),
(122, '96', 100, 122, 7),
(123, '97', 100, 123, 7),
(124, '98', 100, 124, 7),
(125, '99', 100, 125, 7),
(126, '100', 100, 126, 7),
(127, '101', 100, 127, 7),
(128, '102', 100, 128, 7),
(129, '103', 100, 129, 7),
(130, '104', 100, 130, 7),
(131, '105', 100, 131, 7),
(132, '106', 100, 132, 7),
(133, '107', 100, 133, 7),
(134, '108', 100, 134, 7),
(135, '109', 100, 135, 7),
(136, '110', 100, 136, 7),
(137, '111', 100, 137, 7),
(138, '112', 100, 138, 7),
(139, '132', 100, 139, 8),
(140, '131', 100, 140, 8),
(141, '130', 100, 141, 8),
(142, '129', 100, 142, 8),
(143, '128', 100, 143, 8),
(144, '127', 100, 144, 8),
(145, '126', 100, 145, 8),
(146, '125', 100, 146, 8),
(147, '124', 100, 147, 8),
(148, '123', 100, 148, 8),
(149, '122', 100, 149, 8),
(150, '121', 100, 150, 8),
(151, '120', 100, 151, 8),
(152, '119', 100, 152, 8),
(153, '118', 100, 153, 8),
(154, '117', 100, 154, 8),
(155, '116', 100, 155, 8),
(156, '115', 100, 156, 8),
(157, '114', 100, 157, 8),
(158, '113', 100, 158, 8),
(159, '113B', 100, 159, 8),
(160, '188', 100, 160, 9),
(161, '189', 100, 161, 9),
(162, '190', 100, 162, 9),
(163, '191', 100, 163, 9),
(164, '192', 100, 164, 9),
(165, '193', 100, 165, 9),
(166, '194', 100, 166, 9),
(167, '195', 100, 167, 9),
(168, '196', 100, 168, 9),
(169, '197', 100, 169, 9),
(170, '198', 100, 170, 9),
(171, '199', 100, 171, 9),
(172, '200', 100, 172, 9),
(173, '135', 100, 173, 9),
(174, '136', 100, 174, 9),
(175, '137', 100, 175, 9),
(176, '138', 100, 176, 9),
(177, '139', 100, 177, 9),
(178, '140', 100, 178, 9),
(179, '141', 100, 179, 9),
(180, '142', 100, 180, 9),
(181, '143', 100, 181, 9),
(182, '144', 100, 182, 9),
(183, '159', 100, 183, 10),
(184, '158', 100, 184, 10),
(185, '157', 100, 185, 10),
(186, '156', 100, 186, 10),
(187, '155', 100, 187, 10),
(188, '154', 100, 188, 10),
(189, '153', 100, 189, 10),
(190, '152', 100, 190, 10),
(191, '151', 100, 191, 10),
(192, '150', 100, 192, 10),
(193, '149', 100, 193, 10),
(194, '148', 100, 194, 10),
(195, '147', 100, 195, 10),
(196, '146', 100, 196, 10),
(197, '145', 100, 197, 10);

-- --------------------------------------------------------

--
-- Table structure for table `parking_hall`
--

CREATE TABLE `parking_hall` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `parking_hall`
--

INSERT INTO `parking_hall` (`id`, `number`) VALUES
(1, 0),
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 6),
(8, 7),
(9, 8),
(10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `FK_id_category` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_add` date DEFAULT NULL,
  `add_by` int(11) DEFAULT NULL,
  `date_remove` date DEFAULT NULL,
  `remove_by` int(11) DEFAULT NULL,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

CREATE TABLE `provider` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `dni` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `cuil` int(11) NOT NULL,
  `social_reason` varchar(255) COLLATE utf8_bin NOT NULL,
  `type_billing` varchar(255) COLLATE utf8_bin NOT NULL,
  `item` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `providerxproduct`
--

CREATE TABLE `providerxproduct` (
  `FK_id_provider` int(11) NOT NULL,
  `FK_id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `stay` varchar(255) COLLATE utf8_bin NOT NULL,
  `discount` float NOT NULL,
  `total_price` float NOT NULL,
  `FK_id_client` int(11) NOT NULL,
  `FK_id_tent` int(11) NOT NULL,
  `is_reserved` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `date_start`, `date_end`, `stay`, `discount`, `total_price`, `FK_id_client`, `FK_id_tent`, `is_reserved`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, '2020-01-01', '2020-02-29', 'temporada', 0, 52100, 1, 1, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(2, '2020-01-01', '2020-01-31', 'enero', 0, 25011, 2, 192, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(3, '2020-01-27', '2020-01-27', 'diario', 0, 9050, 3, 16, NULL, 0, '2020-01-27', 1, '2020-01-27', 1, NULL, NULL, '2020-01-27', 1),
(4, '2020-01-27', '2020-01-31', 'periodo', 0, 1260, 4, 200, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(5, '2020-02-01', '2020-02-29', 'febrero', 0, 30026, 5, 42, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(6, '2020-01-01', '2020-02-20', 'temporada', 0, 30000, 6, 49, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(7, '2020-01-01', '2020-01-31', 'enero', 0, 30000, 7, 8, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2020-01-01', '2020-01-31', 'enero', 0, 30010, 8, 78, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(9, '2020-01-01', '2020-01-31', 'enero', 0, 30000, 9, 171, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(10, '2020-01-01', '2020-01-31', 'enero', 0, 30000, 10, 117, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(11, '2020-01-01', '2020-02-28', 'temporada', 0, 50000, 11, 177, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(12, '2020-01-01', '2020-01-31', 'enero', 0, 30000, 12, 144, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(13, '2020-01-01', '2020-01-31', 'enero', 0, 30100, 13, 219, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(14, '2020-01-01', '2020-01-31', 'enero', 0, 30010, 14, 104, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(15, '2020-01-01', '2020-01-31', 'enero', 0, 30000, 15, 42, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(16, '2020-03-01', '2020-03-26', 'periodo', 0, 10000, 16, 42, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1),
(17, '2020-01-01', '2020-01-31', 'enero', 0, 123, 17, 16, NULL, 1, '2020-01-27', 1, NULL, NULL, NULL, NULL, '2020-01-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reservationxparking`
--

CREATE TABLE `reservationxparking` (
  `FK_id_reservation` int(11) NOT NULL,
  `FK_id_parking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reservationxparking`
--

INSERT INTO `reservationxparking` (`FK_id_reservation`, `FK_id_parking`) VALUES
(1, 47),
(2, 35),
(3, 21),
(4, 56),
(5, 183),
(5, 184),
(1, 48),
(1, 49),
(1, 117),
(1, 118),
(1, 119),
(1, 8),
(1, 9),
(1, 10),
(3, 1),
(3, 3),
(3, 5),
(3, 6),
(3, 16),
(6, 126),
(8, 184),
(9, 103),
(10, 172),
(11, 159),
(13, 193),
(14, 162),
(15, 183),
(16, 197),
(17, 13);

-- --------------------------------------------------------

--
-- Table structure for table `reservationxservice`
--

CREATE TABLE `reservationxservice` (
  `FK_id_reservation` int(11) NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `reservationxservice`
--

INSERT INTO `reservationxservice` (`FK_id_reservation`, `FK_id_service`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(5, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(6, 20),
(8, 21),
(9, 22),
(10, 23),
(11, 24),
(13, 25),
(14, 26),
(15, 27),
(16, 28),
(17, 29);

-- --------------------------------------------------------

--
-- Table structure for table `servicexlocker`
--

CREATE TABLE `servicexlocker` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_locker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `servicexlocker`
--

INSERT INTO `servicexlocker` (`FK_id_service`, `FK_id_locker`) VALUES
(1, 137),
(1, 1),
(1, 138),
(1, 146),
(5, 2),
(5, 139),
(4, 6),
(4, 142),
(5, 139),
(5, 2),
(5, 2),
(5, 139),
(5, 2),
(5, 139),
(5, 139),
(5, 2),
(1, 3),
(1, 139),
(2, 4),
(2, 140),
(1, 141),
(26, 10),
(26, 146);

-- --------------------------------------------------------

--
-- Table structure for table `servicexmobileparasol`
--

CREATE TABLE `servicexmobileparasol` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_mobileParasol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `servicexmobileparasol`
--

INSERT INTO `servicexmobileparasol` (`FK_id_service`, `FK_id_mobileParasol`) VALUES
(5, 1),
(6, 3),
(6, 1),
(6, 1),
(6, 1),
(6, 1),
(6, 5),
(6, 1),
(1, 1),
(2, 2),
(25, 4);

-- --------------------------------------------------------

--
-- Table structure for table `servicexparasol`
--

CREATE TABLE `servicexparasol` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_parasol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `servicexparking`
--

CREATE TABLE `servicexparking` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_parking` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `servicexparking`
--

INSERT INTO `servicexparking` (`FK_id_service`, `FK_id_parking`) VALUES
(1, 47),
(2, 35),
(3, 21),
(4, 56),
(5, 183),
(6, 184),
(10, 118),
(11, 119),
(12, 8),
(13, 9),
(18, 6),
(19, 16),
(20, 126),
(21, 184),
(22, 103),
(23, 172),
(24, 159),
(25, 193),
(26, 162),
(27, 183),
(28, 197),
(29, 13);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `position` varchar(255) COLLATE utf8_bin NOT NULL,
  `salary` float NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `dni` int(11) NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `shirt_size` float NOT NULL,
  `pant_size` float NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `date_register` date NOT NULL,
  `register_by` int(11) NOT NULL,
  `date_disable` date DEFAULT NULL,
  `disable_by` int(11) DEFAULT NULL,
  `date_enable` date DEFAULT NULL,
  `enable_by` int(11) DEFAULT NULL,
  `date_update` date DEFAULT NULL,
  `update_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_service`
--
ALTER TABLE `additional_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_additional_service_register_by` (`register_by`),
  ADD KEY `FK_additional_service_disable_by` (`disable_by`),
  ADD KEY `FK_additional_service_enable_by` (`enable_by`),
  ADD KEY `FK_additional_service_update_by` (`update_by`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_admin_register_by` (`register_by`),
  ADD KEY `FK_admin_disable_by` (`disable_by`),
  ADD KEY `FK_admin_enable_by` (`enable_by`),
  ADD KEY `FK_admin_update_by` (`update_by`);

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_reservation_balance` (`FK_id_reservation`);

--
-- Indexes for table `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_hall_beach_tent` (`FK_id_hall`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkc`
--
ALTER TABLE `checkc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_client_check` (`FK_id_client`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_client_register_by` (`register_by`),
  ADD KEY `FK_client_disable_by` (`disable_by`),
  ADD KEY `FK_client_enable_by` (`enable_by`),
  ADD KEY `FK_client_update_by` (`update_by`);

--
-- Indexes for table `client_potential`
--
ALTER TABLE `client_potential`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_client_potential_register_by` (`register_by`),
  ADD KEY `FK_client_potential_disable_by` (`disable_by`),
  ADD KEY `FK_client_potential_enable_by` (`enable_by`),
  ADD KEY `FK_client_potential_update_by` (`update_by`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD KEY `FK_config_update_by` (`update_by`);

--
-- Indexes for table `diary_balance`
--
ALTER TABLE `diary_balance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_diary_balance_register_by` (`register_by`);

--
-- Indexes for table `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mobile_parasol`
--
ALTER TABLE `mobile_parasol`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parasol`
--
ALTER TABLE `parasol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parasol_number` (`parasol_number`),
  ADD KEY `FK_id_hall_parasol` (`FK_id_hall`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_hall_parking` (`FK_id_hall`);

--
-- Indexes for table `parking_hall`
--
ALTER TABLE `parking_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_product_add_by` (`add_by`),
  ADD KEY `FK_product_remove_by` (`remove_by`),
  ADD KEY `FK_id_category_product` (`FK_id_category`),
  ADD KEY `FK_product_register_by` (`register_by`),
  ADD KEY `FK_product_disable_by` (`disable_by`),
  ADD KEY `FK_product_enable_by` (`enable_by`),
  ADD KEY `FK_product_update_by` (`update_by`);

--
-- Indexes for table `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD KEY `FK_provider_register_by` (`register_by`),
  ADD KEY `FK_provider_disable_by` (`disable_by`),
  ADD KEY `FK_provider_enable_by` (`enable_by`),
  ADD KEY `FK_provider_update_by` (`update_by`);

--
-- Indexes for table `providerxproduct`
--
ALTER TABLE `providerxproduct`
  ADD KEY `FK_id_provider_providerxproduct` (`FK_id_provider`),
  ADD KEY `FK_id_product_providerxproduct` (`FK_id_product`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_client_reservation` (`FK_id_client`),
  ADD KEY `FK_id_tent_reservation` (`FK_id_tent`),
  ADD KEY `FK_reservation_register_by` (`register_by`),
  ADD KEY `FK_reservation_disable_by` (`disable_by`),
  ADD KEY `FK_reservation_enable_by` (`enable_by`),
  ADD KEY `FK_reservation_update_by` (`update_by`);

--
-- Indexes for table `reservationxparking`
--
ALTER TABLE `reservationxparking`
  ADD KEY `FK_id_reservation_reservationxparking` (`FK_id_reservation`),
  ADD KEY `FK_id_parking_reservationxparking` (`FK_id_parking`);

--
-- Indexes for table `reservationxservice`
--
ALTER TABLE `reservationxservice`
  ADD KEY `FK_id_reservation_reservationxservice` (`FK_id_reservation`),
  ADD KEY `FK_id_service_reservationxservice` (`FK_id_service`);

--
-- Indexes for table `servicexlocker`
--
ALTER TABLE `servicexlocker`
  ADD KEY `FK_id_service_servicexlocker` (`FK_id_service`),
  ADD KEY `FK_id_locker_servicexlocker` (`FK_id_locker`);

--
-- Indexes for table `servicexmobileparasol`
--
ALTER TABLE `servicexmobileparasol`
  ADD KEY `FK_id_service_servicexmobileParasol` (`FK_id_service`),
  ADD KEY `FK_id_parasol_servicexmobileParasol` (`FK_id_mobileParasol`);

--
-- Indexes for table `servicexparasol`
--
ALTER TABLE `servicexparasol`
  ADD KEY `FK_id_service_servicexparasol` (`FK_id_service`),
  ADD KEY `FK_id_parasol_servicexparasol` (`FK_id_parasol`);

--
-- Indexes for table `servicexparking`
--
ALTER TABLE `servicexparking`
  ADD KEY `FK_id_service_servicexparking` (`FK_id_service`),
  ADD KEY `FK_id_parking_servicexparking` (`FK_id_parking`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_register_by` (`register_by`),
  ADD KEY `FK_staff_disable_by` (`disable_by`),
  ADD KEY `FK_staff_enable_by` (`enable_by`),
  ADD KEY `FK_staff_update_by` (`update_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_service`
--
ALTER TABLE `additional_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `balance`
--
ALTER TABLE `balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `beach_tent`
--
ALTER TABLE `beach_tent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checkc`
--
ALTER TABLE `checkc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `client_potential`
--
ALTER TABLE `client_potential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diary_balance`
--
ALTER TABLE `diary_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hall`
--
ALTER TABLE `hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `locker`
--
ALTER TABLE `locker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT for table `mobile_parasol`
--
ALTER TABLE `mobile_parasol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parasol`
--
ALTER TABLE `parasol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `parking_hall`
--
ALTER TABLE `parking_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `additional_service`
--
ALTER TABLE `additional_service`
  ADD CONSTRAINT `FK_additional_service_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `FK_id_reservation_balance` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`FK_id_client`);

--
-- Constraints for table `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD CONSTRAINT `FK_id_hall_beach_tent` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`);

--
-- Constraints for table `checkc`
--
ALTER TABLE `checkc`
  ADD CONSTRAINT `FK_id_client_check` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`);

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_client_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `client_potential`
--
ALTER TABLE `client_potential`
  ADD CONSTRAINT `FK_client_potential_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `FK_config_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `diary_balance`
--
ALTER TABLE `diary_balance`
  ADD CONSTRAINT `FK_diary_balance_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `parasol`
--
ALTER TABLE `parasol`
  ADD CONSTRAINT `FK_id_hall_parasol` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`);

--
-- Constraints for table `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `FK_id_hall_parking` FOREIGN KEY (`FK_id_hall`) REFERENCES `parking_hall` (`id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_product_add_by` FOREIGN KEY (`add_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_remove_by` FOREIGN KEY (`remove_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `FK_provider_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `providerxproduct`
--
ALTER TABLE `providerxproduct`
  ADD CONSTRAINT `FK_id_product_providerxproduct` FOREIGN KEY (`FK_id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_id_provider_providerxproduct` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`);

--
-- Constraints for table `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_id_client_reservation` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_id_tent_reservation` FOREIGN KEY (`FK_id_tent`) REFERENCES `beach_tent` (`id`),
  ADD CONSTRAINT `FK_reservation_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Constraints for table `reservationxparking`
--
ALTER TABLE `reservationxparking`
  ADD CONSTRAINT `FK_id_parking_reservationxparking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking` (`id`),
  ADD CONSTRAINT `FK_id_reservation_reservationxparking` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`);

--
-- Constraints for table `reservationxservice`
--
ALTER TABLE `reservationxservice`
  ADD CONSTRAINT `FK_id_reservation_reservationxservice` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `FK_id_service_reservationxservice` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Constraints for table `servicexlocker`
--
ALTER TABLE `servicexlocker`
  ADD CONSTRAINT `FK_id_locker_servicexlocker` FOREIGN KEY (`FK_id_locker`) REFERENCES `locker` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexlocker` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Constraints for table `servicexmobileparasol`
--
ALTER TABLE `servicexmobileparasol`
  ADD CONSTRAINT `FK_id_parasol_servicexmobileParasol` FOREIGN KEY (`FK_id_mobileParasol`) REFERENCES `mobile_parasol` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexmobileParasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Constraints for table `servicexparasol`
--
ALTER TABLE `servicexparasol`
  ADD CONSTRAINT `FK_id_parasol_servicexparasol` FOREIGN KEY (`FK_id_parasol`) REFERENCES `parasol` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexparasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Constraints for table `servicexparking`
--
ALTER TABLE `servicexparking`
  ADD CONSTRAINT `FK_id_parking_servicexparking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexparking` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `FK_staff_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_staff_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_staff_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_staff_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
