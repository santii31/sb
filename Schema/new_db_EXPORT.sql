-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-01-2020 a las 04:52:43
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `southbeach`
--

DELIMITER $$
--
-- Procedimientos
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAll` ()  BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getEmails` ()  BEGIN
	SELECT `admin`.`email` FROM `admin`;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `stay` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `cp` INT, IN `email` VARCHAR(255), IN `tel` INT, IN `family_group` VARCHAR(255), IN `stay_address` VARCHAR(255), IN `tel_stay` INT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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
	SELECT * FROM `client` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `client` WHERE `client`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `client` WHERE `client`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_getEmails` ()  BEGIN
	SELECT `client`.`email` FROM `client`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `email` VARCHAR(255), IN `tel` INT, IN `num_tent` INT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getAll` ()  BEGIN
	SELECT * FROM `client_potential` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getByEmail` (IN `email` VARCHAR(255))  BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `client_potential` WHERE `client_potential`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_getEmails` ()  BEGIN
	SELECT `client_potential`.`email` FROM `client_potential`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_potential_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `email` VARCHAR(255), IN `tel` INT, IN `num_tent` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `stay` VARCHAR(255), IN `address` VARCHAR(255), IN `city` VARCHAR(255), IN `cp` INT, IN `email` VARCHAR(255), IN `tel` INT, IN `family_group` VARCHAR(255), IN `stay_address` VARCHAR(255), IN `tel_stay` INT, IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `locker_getAll` ()  BEGIN
	SELECT *
    FROM `locker`
    ORDER BY price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `locker_getById` (IN `id` INT)  BEGIN
	SELECT * 
    FROM `locker` 
    WHERE `locker`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getAll` ()  BEGIN
	SELECT *
    FROM `parasol` 
    ORDER BY price ASC;
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
    ORDER BY product.price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getByCategory` (IN `id_category` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getById` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_update` (IN `name` VARCHAR(255), IN `price` INT, IN `quantity` INT, IN `FK_id_category` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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
    --         providerxproduct.quantity,
    --         providerxproduct.total,
    --         providerxproduct.discount,
    --         providerxproduct.transaction_date
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `tel` INT, IN `email` VARCHAR(255), IN `dni` INT, IN `address` VARCHAR(255), IN `cuil` INT, IN `social_reason` VARCHAR(255), IN `type_billing` VARCHAR(255), IN `date_register` DATE, IN `register_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAll` ()  BEGIN
    SELECT `provider`.*,
        `admin`.`name` AS admin_name,
        `admin`.`lastname` AS admin_lastname
    FROM `provider` 
    INNER JOIN `admin` ON `provider`.`register_by` = `admin`.`id`
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `tel` INT, IN `email` VARCHAR(255), IN `dni` INT, IN `address` VARCHAR(255), IN `cuil` INT, IN `social_reason` VARCHAR(255), IN `type_billing` VARCHAR(255), IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_add` (IN `FK_id_reservation` INT, IN `FK_id_service` INT)  BEGIN
	INSERT INTO reservationxservice (
			reservationxservice.FK_id_reservation,
            reservationxservice.FK_id_service                   
	)
    VALUES
        (FK_id_reservation, FK_id_service);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservationxservice_getServiceByReservation` (IN `id_reservation` INT)  BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active          
	FROM reservationxservice
	INNER JOIN additional_service ON reservationxservice.FK_id_service = additional_service.id	
	WHERE (reservationxservice.FK_id_reservation = id_reservation);             
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_add` (IN `date_start` DATE, IN `date_end` DATE, IN `discount` FLOAT, IN `total_price` FLOAT, IN `FK_id_client` INT, IN `FK_id_tent` INT, IN `is_reserved` BOOLEAN, IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
    INSERT INTO reservation (
			reservation.date_start,
            reservation.date_end,
            reservation.discount,
            reservation.total_price,
            reservation.FK_id_client,            
            reservation.FK_id_tent,
            reservation.is_reserved,
            reservation.date_register,
            reservation.register_by
	)
    VALUES (date_start, date_end, discount, total_price, FK_id_client, FK_id_admin, FK_id_tent, is_reserved, date_register, register_by);
	SET lastId = LAST_INSERT_ID();	
	SELECT lastId;
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
        reservation.discount AS reservation_discount,
        reservation.total_price AS reservation_totalPrice,
        client.id AS client_id,
        client.name AS client_name,
        client.lastname AS client_lastName,
        client.email AS client_email,
        client.tel AS client_tel,
        client.city AS client_city,
        client.address AS client_address
    FROM reservation         
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    WHERE beach_tent.id = id;    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAll` ()  BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
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
           beach_tent AS tent_is_active,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_is_active

    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY date_start ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getById` (IN `id` INT)  BEGIN
	SELECT reservation.id AS reservation_id,
           reservation.date_start AS reservation_dateStart,
           reservation.date_end AS reservation_dateEnd,
           reservation.discount AS reservation_discount,
           reservation.total_price AS reservation_totalPrice,
           reservation.is_active AS reservation_is_active,
           reservation.is_reserved AS reservation_is_reserved,
           client.id AS client_id,
           client.name AS client_name,
		   client.lastname AS client_lastName,
		   client.email AS client_email,
           client.tel AS client_tel,
           client.city AS client_city,
           client.address AS client_address,           		   
           admin.id AS admin_id,
           admin.name AS admin_name,
		   admin.lastname AS admin_lastName,		   
           beach_tent.id AS tent_id,
           beach_tent.number AS tent_number,
           beach_tent.price AS tent_price
    FROM `reservation`
    INNER JOIN `client` ON `reservation`.`FK_id_client` = `client`.`id`
    INNER JOIN `admin` ON `reservation`.`register_by` = `admin`.`id`
    INNER JOIN `beach_tent` ON `reservation`.`FK_id_tent` = `beach_tent`.`id`
    WHERE `reservation`.`id` = id;
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
           locker.price AS locker_price
	FROM servicexlocker
	INNER JOIN locker ON servicexlocker.FK_id_locker = locker.id
	
	WHERE (servicexlocker.FK_id_service = id_service)
	GROUP BY locker.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexlocker_getServiceByLocker` (IN `id_locker` INT)  BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexlocker
	INNER JOIN additional_service ON servicexlocker.FK_id_service = additional_service.id
	
	WHERE (servicexlocker.FK_id_locker = id_locker)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `servicexparasol_add` (IN `FK_id_service` INT, IN `FK_id_parasol` INT)  BEGIN
	INSERT INTO servicexparasol (
			servicexlocker.FK_id_service,
            servicexlocker.FK_id_parasol                   
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
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
	FROM servicexparasol
	INNER JOIN additional_service ON servicexparasol.FK_id_service = additional_service.id
	
	WHERE (servicexparasol.FK_id_parasol = id_parasol)
	GROUP BY additional_service.id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_add` (IN `description` VARCHAR(255), IN `total` FLOAT, IN `date_register` DATE, IN `register_by` INT, OUT `lastId` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_checkDescription` (IN `description` VARCHAR(255), IN `id` INT)  BEGIN
    SELECT `additional_service`.`id` FROM `additional_service` WHERE `additional_service`.`description` = description AND `additional_service`.`id` != id;	
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
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active
        
    FROM `additional_service` ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getByDescription` (IN `description` VARCHAR(255))  BEGIN
	SELECT  
        additional_service.id AS service_id,
        additional_service.description AS service_description,
        additional_service.total AS service_total,
        additional_service.is_active AS service_is_active        
    FROM `additional_service`     
    WHERE `additional_service`.`description` = description;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getById` (IN `id` INT)  BEGIN
	SELECT additional_service.id AS service_id,
           additional_service.description AS service_description,
           additional_service.total AS service_total,
           additional_service.is_active AS service_is_active 
           
    FROM `additional_service` WHERE `additional_service`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_update` (IN `description` VARCHAR(255), IN `total` INT, IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getAll` ()  BEGIN
	SELECT `staff`.*,
            `admin`.`name` AS admin_name,
            `admin`.`lastname` AS admin_lastname
    FROM `staff` 
    INNER JOIN `admin` ON `staff`.`register_by` = `admin`.`id`
    ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`id` = id;
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
-- Estructura de tabla para la tabla `additional_service`
--

CREATE TABLE `additional_service` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
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
-- Volcado de datos para la tabla `additional_service`
--

INSERT INTO `additional_service` (`id`, `description`, `total`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'cofre', 1000, 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
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
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `name`, `lastname`, `dni`, `email`, `password`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'admin', 'admin', 404040, 'admin@admin.com', '$2y$10$xNd90YZ2Zcttqmt2JU9d3uWt.CgYhVAW4ylkauUaXZ8vLkHRy.X1a', 1, '2020-01-07', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Test', 'Test', 505050, 'rodrigoleon2016@hotmail.com', '$2y$10$xNd90YZ2Zcttqmt2JU9d3uWt.CgYhVAW4ylkauUaXZ8vLkHRy.X1a', 1, '2020-01-07', 1, '2020-01-08', 1, '2020-01-10', 1, NULL, NULL),
(3, 'pepe', 'admin', 707070, 'rinaldisantiago@hotmail.com', '$2y$10$t5m0VNDRsrv96z3k386mHuoo/YdnRldp.DN409hnRjEiiBRKTGDly', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-10', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beach_tent`
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
-- Volcado de datos para la tabla `beach_tent`
--

INSERT INTO `beach_tent` (`id`, `number`, `price`, `position`, `sea`, `FK_id_hall`) VALUES
(2, '16B', 100, 0, 0, 1),
(3, '16', 100, 1, 0, 1),
(4, '15', 100, 2, 0, 1),
(5, '14', 100, 3, 0, 1),
(6, '13', 100, 4, 0, 1),
(7, '12', 100, 5, 0, 1),
(8, '11', 100, 6, 0, 1),
(9, '10', 100, 7, 0, 1),
(10, '9', 100, 8, 0, 1),
(11, '8', 100, 9, 0, 1),
(12, '7', 100, 10, 0, 1),
(13, '6', 100, 11, 0, 1),
(14, '5', 100, 12, 0, 1),
(15, '4', 100, 13, 0, 1),
(16, '3', 100, 14, 0, 1),
(17, '17B', 100, 15, 0, 2),
(18, '17', 100, 16, 0, 2),
(19, '18', 100, 17, 0, 2),
(20, '19', 100, 18, 0, 2),
(21, '20', 100, 19, 0, 2),
(22, '21', 100, 20, 0, 2),
(23, '22', 100, 21, 0, 2),
(24, '23', 100, 22, 0, 2),
(25, '24', 100, 23, 0, 2),
(26, '25', 100, 24, 0, 2),
(27, '26', 100, 25, 0, 2),
(28, '27', 100, 26, 0, 2),
(29, '28', 100, 27, 0, 2),
(30, '29', 100, 28, 0, 2),
(31, '30', 100, 29, 0, 2),
(32, '30B', 100, 30, 0, 2),
(33, '49B', 100, 31, 0, 2),
(34, '49', 100, 32, 0, 2),
(35, '48', 100, 33, 0, 2),
(36, '47', 100, 34, 0, 2),
(37, '46', 100, 35, 0, 2),
(38, '45', 100, 36, 0, 2),
(39, '44', 100, 37, 0, 2),
(40, '43', 100, 38, 0, 2),
(41, '42', 100, 39, 0, 2),
(42, '41', 100, 40, 0, 2),
(43, '40', 100, 41, 0, 2),
(44, '39', 100, 42, 0, 2),
(45, '38', 100, 43, 0, 2),
(46, '37', 100, 44, 0, 2),
(47, '36', 100, 45, 0, 2),
(48, '36B', 100, 46, 0, 2),
(49, '50B', 100, 47, 0, 3),
(50, '50', 100, 48, 0, 3),
(51, '51', 100, 49, 0, 3),
(52, '52', 100, 50, 0, 3),
(53, '53', 100, 51, 0, 3),
(54, '54', 100, 52, 0, 3),
(55, '55', 100, 53, 0, 3),
(56, '56', 100, 54, 0, 3),
(57, '57', 100, 55, 0, 3),
(58, '58', 100, 56, 0, 3),
(59, '59', 100, 57, 0, 3),
(60, '60', 100, 58, 0, 3),
(61, '61', 100, 59, 0, 3),
(62, '62', 100, 60, 0, 3),
(63, '63', 100, 61, 0, 3),
(64, '63B', 100, 62, 0, 3),
(65, '82B', 100, 63, 0, 3),
(66, '82', 100, 64, 0, 3),
(67, '81', 100, 65, 0, 3),
(68, '80', 100, 66, 0, 3),
(69, '79', 100, 67, 0, 3),
(70, '78', 100, 68, 0, 3),
(71, '77', 100, 69, 0, 3),
(72, '76', 100, 70, 0, 3),
(73, '75', 100, 71, 0, 3),
(74, '74', 100, 72, 0, 3),
(75, '73', 100, 73, 0, 3),
(76, '72', 100, 74, 0, 3),
(77, '71', 100, 75, 0, 3),
(78, '70', 100, 76, 0, 3),
(79, '69', 100, 77, 0, 3),
(80, '69B', 100, 78, 0, 3),
(81, '83B', 100, 79, 0, 4),
(82, '83', 100, 80, 0, 4),
(83, '84', 100, 81, 0, 4),
(84, '85', 100, 82, 0, 4),
(85, '86', 100, 83, 0, 4),
(86, '87', 100, 84, 0, 4),
(87, '88', 100, 85, 0, 4),
(88, '89', 100, 86, 0, 4),
(89, '90', 100, 87, 0, 4),
(90, '91', 100, 88, 0, 4),
(91, '92', 100, 89, 0, 4),
(92, '93', 100, 90, 0, 4),
(93, '94', 100, 91, 0, 4),
(94, '95', 100, 92, 0, 4),
(95, '96', 100, 93, 0, 4),
(96, '96B', 100, 94, 0, 4),
(97, '115B', 100, 95, 0, 4),
(98, '115', 100, 96, 0, 4),
(99, '114', 100, 97, 0, 4),
(100, '113', 100, 98, 0, 4),
(101, '112', 100, 99, 0, 4),
(102, '111', 100, 100, 0, 4),
(103, '110', 100, 101, 0, 4),
(104, '109', 100, 102, 0, 4),
(105, '108', 100, 103, 0, 4),
(106, '107', 100, 104, 0, 4),
(107, '106', 100, 105, 0, 4),
(108, '105', 100, 106, 0, 4),
(109, '104', 100, 107, 0, 4),
(110, '103', 100, 108, 0, 4),
(111, '102', 100, 109, 0, 4),
(112, '102B', 100, 110, 0, 4),
(113, '116B', 100, 111, 0, 5),
(114, '116', 100, 112, 0, 5),
(115, '117', 100, 113, 0, 5),
(116, '118', 100, 114, 0, 5),
(117, '119', 100, 115, 0, 5),
(118, '120', 100, 116, 0, 5),
(119, '121', 100, 117, 0, 5),
(120, '122', 100, 118, 0, 5),
(121, '123', 100, 119, 0, 5),
(122, '124', 100, 120, 0, 5),
(123, '125', 100, 121, 0, 5),
(124, '126', 100, 122, 0, 5),
(125, '127', 100, 123, 0, 5),
(126, '128', 100, 124, 0, 5),
(127, '129', 100, 125, 0, 5),
(128, '129B', 100, 126, 0, 5),
(129, '148B', 100, 127, 0, 5),
(130, '148', 100, 128, 0, 5),
(131, '147', 100, 129, 0, 5),
(132, '146', 100, 130, 0, 5),
(133, '145', 100, 131, 0, 5),
(134, '144', 100, 132, 0, 5),
(135, '143', 100, 133, 0, 5),
(136, '142', 100, 134, 0, 5),
(137, '141', 100, 135, 0, 5),
(138, '140', 100, 136, 0, 5),
(139, '139', 100, 137, 0, 5),
(140, '138', 100, 138, 0, 5),
(141, '137', 100, 139, 0, 5),
(142, '136', 100, 140, 0, 5),
(143, '135', 100, 141, 0, 5),
(144, '135B', 100, 142, 0, 5),
(145, '149B', 100, 143, 0, 6),
(146, '149', 100, 144, 0, 6),
(147, '150', 100, 145, 0, 6),
(148, '151', 100, 146, 0, 6),
(149, '152', 100, 147, 0, 6),
(150, '153', 100, 148, 0, 6),
(151, '154', 100, 149, 0, 6),
(152, '155', 100, 150, 0, 6),
(153, '156', 100, 151, 0, 6),
(154, '157', 100, 152, 0, 6),
(155, '158', 100, 153, 0, 6),
(156, '159', 100, 154, 0, 6),
(157, '160', 100, 155, 0, 6),
(158, '161', 100, 156, 0, 6),
(161, '162', 100, 157, 0, 6),
(163, '162B', 100, 158, 0, 6),
(164, '181B', 100, 160, 0, 6),
(165, '181', 100, 161, 0, 6),
(166, '180', 100, 162, 0, 6),
(167, '179', 100, 163, 0, 6),
(168, '178', 100, 164, 0, 6),
(169, '177', 100, 165, 0, 6),
(170, '176', 100, 166, 0, 6),
(171, '175', 100, 167, 0, 6),
(172, '174', 100, 168, 0, 6),
(173, '173', 100, 169, 0, 6),
(174, '172', 100, 170, 0, 6),
(175, '171', 100, 171, 0, 6),
(176, '170', 100, 172, 0, 6),
(177, '169', 100, 173, 0, 6),
(178, '168', 100, 174, 0, 6),
(179, '168B', 100, 175, 0, 6),
(180, '182B', 100, 176, 0, 7),
(181, '182', 100, 177, 0, 7),
(182, '183', 100, 178, 0, 7),
(183, '184', 100, 179, 0, 7),
(184, '185', 100, 180, 0, 7),
(185, '186', 100, 181, 0, 7),
(186, '187', 100, 182, 0, 7),
(187, '188', 100, 183, 0, 7),
(188, '189', 100, 184, 0, 7),
(189, '190', 100, 185, 0, 7),
(190, '191', 100, 186, 0, 7),
(191, '192', 100, 187, 0, 7),
(192, '193', 100, 188, 0, 7),
(193, '194', 100, 189, 0, 7),
(194, '195', 100, 190, 0, 7),
(196, '1', 100, 190, 1, 1),
(197, '2', 100, 191, 1, 1),
(198, '2B', 100, 192, 1, 1),
(199, '31', 100, 193, 1, 2),
(200, '32', 100, 194, 1, 2),
(201, '33', 100, 195, 1, 2),
(202, '34', 100, 196, 1, 2),
(203, '35', 100, 197, 1, 2),
(204, '35B', 100, 198, 1, 2),
(205, '64', 100, 199, 1, 3),
(206, '65', 100, 200, 1, 3),
(207, '66', 100, 201, 1, 3),
(208, '67', 100, 202, 1, 3),
(209, '68', 100, 203, 1, 3),
(210, '68B', 100, 204, 1, 3),
(211, '97', 100, 205, 1, 4),
(212, '98', 100, 206, 1, 4),
(213, '99', 100, 207, 1, 4),
(214, '100', 100, 208, 1, 4),
(215, '101', 100, 209, 1, 4),
(216, '101B', 100, 210, 1, 4),
(217, '130', 100, 211, 1, 5),
(218, '131', 100, 212, 1, 5),
(219, '132', 100, 213, 1, 5),
(220, '133', 100, 214, 1, 5),
(221, '134', 100, 215, 1, 5),
(222, '134B', 100, 216, 1, 5),
(223, '163', 100, 217, 1, 6),
(224, '164', 100, 218, 1, 6),
(225, '165', 100, 219, 1, 6),
(226, '166', 100, 220, 1, 6),
(227, '167', 100, 221, 1, 6),
(228, '167B', 100, 222, 1, 6),
(229, '195B', 100, 223, 1, 7),
(230, '196', 100, 224, 1, 7),
(231, '197', 100, 225, 1, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `category`
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
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `stay` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `cp` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `family_group` varchar(255) COLLATE utf8_bin NOT NULL,
  `stay_address` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel_stay` int(11) NOT NULL,
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
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`id`, `name`, `lastname`, `stay`, `address`, `city`, `cp`, `email`, `tel`, `family_group`, `stay_address`, `tel_stay`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'bruce', 'wayne', 'qwe', 'colon 123', 'gotham', 100, 'bruce@wayne.com', 155121314, 'grupo1', 'puan 123', 4899999, 1, '0000-00-00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'walter', 'white', 'zxc', 'albuquerque 123', 'nuevo mexico', 200, 'walter@white.com', 154121314, 'grupo2', 'crocce 123', 4897777, 1, '0000-00-00', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'charly', 'garcia', 'uio', 'belgrano 123', 'la plata', 300, 'charly@garcia.com', 156121314, 'grupo3', 'genova 123', 4894444, 1, '0000-00-00', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client_potential`
--

CREATE TABLE `client_potential` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `num_tent` int(11) NOT NULL,
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
-- Volcado de datos para la tabla `client_potential`
--

INSERT INTO `client_potential` (`id`, `name`, `lastname`, `address`, `city`, `email`, `tel`, `num_tent`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'pepe', 'jose', 'asd', 'asd', 'clientepot@hotmail.com', 43430, 100, 0, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hall`
--

CREATE TABLE `hall` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `hall`
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
-- Estructura de tabla para la tabla `locker`
--

CREATE TABLE `locker` (
  `id` int(11) NOT NULL,
  `locker_number` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `locker`
--

INSERT INTO `locker` (`id`, `locker_number`, `price`) VALUES
(1, '1 (mujeres)', 0),
(2, '2 (mujeres)', 0),
(3, '3 (mujeres)', 0),
(4, '4 (mujeres)', 0),
(5, '5 (mujeres)', 0),
(6, '6 (mujeres)', 0),
(7, '7 (mujeres)', 0),
(8, '8 (mujeres)', 0),
(9, '9 (mujeres)', 0),
(10, '10 (mujeres)', 0),
(11, '11 (mujeres)', 0),
(12, '12 (mujeres)', 0),
(13, '13 (mujeres)', 0),
(14, '14 (mujeres)', 0),
(15, '15 (mujeres)', 0),
(16, '16 (mujeres)', 0),
(17, '17 (mujeres)', 0),
(18, '18 (mujeres)', 0),
(19, '19 (mujeres)', 0),
(20, '20 (mujeres)', 0),
(21, '21 (mujeres)', 0),
(22, '22 (mujeres)', 0),
(23, '23 (mujeres)', 0),
(24, '24 (mujeres)', 0),
(25, '25 (mujeres)', 0),
(26, '26 (mujeres)', 0),
(27, '27 (mujeres)', 0),
(28, '28 (mujeres)', 0),
(29, '29 (mujeres)', 0),
(30, '30 (mujeres)', 0),
(31, '31 (mujeres)', 0),
(32, '32 (mujeres)', 0),
(33, '33 (mujeres)', 0),
(34, '34 (mujeres)', 0),
(35, '35 (mujeres)', 0),
(36, '36 (mujeres)', 0),
(37, '37 (mujeres)', 0),
(38, '38 (mujeres)', 0),
(39, '39 (mujeres)', 0),
(40, '40 (mujeres)', 0),
(41, '41 (mujeres)', 0),
(42, '42 (mujeres)', 0),
(43, '43 (mujeres)', 0),
(44, '44 (mujeres)', 0),
(45, '45 (mujeres)', 0),
(46, '46 (mujeres)', 0),
(47, '47 (mujeres)', 0),
(48, '48 (mujeres)', 0),
(49, '49 (mujeres)', 0),
(50, '50 (mujeres)', 0),
(51, '51 (mujeres)', 0),
(52, '52 (mujeres)', 0),
(53, '53 (mujeres)', 0),
(54, '54 (mujeres)', 0),
(55, '55 (mujeres)', 0),
(56, '56 (mujeres)', 0),
(57, '57 (mujeres)', 0),
(58, '58 (mujeres)', 0),
(59, '59 (mujeres)', 0),
(60, '60 (mujeres)', 0),
(61, '61 (mujeres)', 0),
(62, '62 (mujeres)', 0),
(63, '63 (mujeres)', 0),
(64, '64 (mujeres)', 0),
(65, '65 (mujeres)', 0),
(66, '66 (mujeres)', 0),
(67, '67 (mujeres)', 0),
(68, '68 (mujeres)', 0),
(69, '69 (mujeres)', 0),
(70, '70 (mujeres)', 0),
(71, '71 (mujeres)', 0),
(72, '72 (mujeres)', 0),
(73, '73 (mujeres)', 0),
(74, '74 (mujeres)', 0),
(75, '75 (mujeres)', 0),
(76, '76 (mujeres)', 0),
(77, '77 (mujeres)', 0),
(78, '78 (mujeres)', 0),
(79, '79 (mujeres)', 0),
(80, '80 (mujeres)', 0),
(81, '81 (mujeres)', 0),
(82, '82 (mujeres)', 0),
(83, '83 (mujeres)', 0),
(84, '84 (mujeres)', 0),
(85, '85 (mujeres)', 0),
(86, '86 (mujeres)', 0),
(87, '87 (mujeres)', 0),
(88, '88 (mujeres)', 0),
(89, '89 (mujeres)', 0),
(90, '90 (mujeres)', 0),
(91, '91 (mujeres)', 0),
(92, '92 (mujeres)', 0),
(93, '93 (mujeres)', 0),
(94, '94 (mujeres)', 0),
(95, '95 (mujeres)', 0),
(96, '96 (mujeres)', 0),
(97, '97 (mujeres)', 0),
(98, '98 (mujeres)', 0),
(99, '99 (mujeres)', 0),
(100, '100 (mujeres)', 0),
(101, '101 (mujeres)', 0),
(102, '102 (mujeres)', 0),
(103, '103 (mujeres)', 0),
(104, '104 (mujeres)', 0),
(105, '105 (mujeres)', 0),
(106, '106 (mujeres)', 0),
(107, '107 (mujeres)', 0),
(108, '108 (mujeres)', 0),
(109, '109 (mujeres)', 0),
(110, '110 (mujeres)', 0),
(111, '111 (mujeres)', 0),
(112, '112 (mujeres)', 0),
(113, '113 (mujeres)', 0),
(114, '114 (mujeres)', 0),
(115, '115 (mujeres)', 0),
(116, '116 (mujeres)', 0),
(117, '117 (mujeres)', 0),
(118, '118 (mujeres)', 0),
(119, '119 (mujeres)', 0),
(120, '120 (mujeres)', 0),
(121, '121 (mujeres)', 0),
(122, '122 (mujeres)', 0),
(123, '123 (mujeres)', 0),
(124, '124 (mujeres)', 0),
(125, '125 (mujeres)', 0),
(126, '126 (mujeres)', 0),
(127, '127 (mujeres)', 0),
(128, '128 (mujeres)', 0),
(129, '129 (mujeres)', 0),
(130, '130 (mujeres)', 0),
(131, '131 (mujeres)', 0),
(132, '132 (mujeres)', 0),
(133, '133 (mujeres)', 0),
(134, '134 (mujeres)', 0),
(135, '135 (mujeres)', 0),
(136, '136 (mujeres)', 0),
(137, '1 (hombres)', 0),
(138, '2 (hombres)', 0),
(139, '3 (hombres)', 0),
(140, '4 (hombres)', 0),
(141, '5 (hombres)', 0),
(142, '6 (hombres)', 0),
(143, '7 (hombres)', 0),
(144, '8 (hombres)', 0),
(145, '9 (hombres)', 0),
(146, '10 (hombres)', 0),
(147, '11 (hombres)', 0),
(148, '12 (hombres)', 0),
(149, '13 (hombres)', 0),
(150, '14 (hombres)', 0),
(151, '15 (hombres)', 0),
(152, '16 (hombres)', 0),
(153, '17 (hombres)', 0),
(154, '18 (hombres)', 0),
(155, '19 (hombres)', 0),
(156, '20 (hombres)', 0),
(157, '21 (hombres)', 0),
(158, '22 (hombres)', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parasol`
--

CREATE TABLE `parasol` (
  `id` int(11) NOT NULL,
  `parasol_number` int(11) NOT NULL,
  `price` float NOT NULL,
  `position` int(11) NOT NULL,
  `FK_id_hall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `parasol`
--

INSERT INTO `parasol` (`id`, `parasol_number`, `price`, `position`, `FK_id_hall`) VALUES
(1, 1, 100, 1, 1),
(2, 3, 100, 2, 1),
(3, 5, 100, 3, 1),
(4, 7, 100, 4, 2),
(5, 9, 100, 5, 2),
(6, 11, 100, 6, 2),
(7, 13, 100, 7, 3),
(8, 15, 100, 8, 3),
(9, 17, 100, 9, 3),
(10, 19, 100, 10, 4),
(11, 21, 100, 11, 4),
(12, 23, 100, 12, 4),
(13, 25, 100, 13, 5),
(14, 27, 100, 14, 5),
(15, 29, 100, 15, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `number` varchar(50) COLLATE utf8_bin NOT NULL,
  `price` float DEFAULT NULL,
  `position` int(11) NOT NULL,
  `FK_id_hall` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `parking`
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
(159, '188', 100, 159, 9),
(160, '189', 100, 160, 9),
(161, '190', 100, 161, 9),
(162, '191', 100, 162, 9),
(163, '192', 100, 163, 9),
(164, '193', 100, 164, 9),
(165, '194', 100, 165, 9),
(166, '195', 100, 166, 9),
(167, '196', 100, 167, 9),
(168, '197', 100, 168, 9),
(169, '198', 100, 169, 9),
(170, '199', 100, 170, 9),
(171, '200', 100, 171, 9),
(172, '135', 100, 172, 9),
(173, '136', 100, 173, 9),
(174, '137', 100, 174, 9),
(175, '138', 100, 175, 9),
(176, '139', 100, 176, 9),
(177, '140', 100, 177, 9),
(178, '141', 100, 178, 9),
(179, '142', 100, 179, 9),
(180, '143', 100, 180, 9),
(181, '144', 100, 181, 9),
(182, '159', 100, 182, 10),
(183, '158', 100, 183, 10),
(184, '157', 100, 184, 10),
(185, '156', 100, 185, 10),
(186, '155', 100, 186, 10),
(187, '154', 100, 187, 10),
(188, '153', 100, 188, 10),
(189, '152', 100, 189, 10),
(190, '151', 100, 190, 10),
(191, '150', 100, 191, 10),
(192, '149', 100, 192, 10),
(193, '148', 100, 193, 10),
(194, '147', 100, 194, 10),
(195, '146', 100, 195, 10),
(196, '145', 100, 196, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parking_hall`
--

CREATE TABLE `parking_hall` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `parking_hall`
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
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `FK_id_category` int(11) NOT NULL,
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
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `name`, `price`, `quantity`, `FK_id_category`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(3, 'gaseosa', 100, 300, 1, 1, '2020-01-11', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
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
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`id`, `name`, `lastname`, `tel`, `email`, `dni`, `address`, `cuil`, `social_reason`, `type_billing`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'prov1', 'prov1', 4500000, 'prov1@mail.com', 101010, 'calle 1 mod', 123, 'x', 'a', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providerxproduct`
--

CREATE TABLE `providerxproduct` (
  `FK_id_provider` int(11) NOT NULL,
  `FK_id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `providerxproduct`
--

INSERT INTO `providerxproduct` (`FK_id_provider`, `FK_id_product`) VALUES
(1, 1),
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `discount` float NOT NULL,
  `total_price` float NOT NULL,
  `FK_id_client` int(11) NOT NULL,
  `FK_id_tent` int(11) NOT NULL,
  `is_reserved` tinyint(1) NOT NULL,
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
-- Volcado de datos para la tabla `reservation`
--

INSERT INTO `reservation` (`id`, `date_start`, `date_end`, `discount`, `total_price`, `FK_id_client`, `FK_id_tent`, `is_reserved`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(5, '2020-01-18', '2020-01-31', 20, 100, 1, 9, 1, 1, '2020-01-11', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2020-01-10', '2020-01-11', 20, 100, 1, 2, 0, 1, '2020-01-11', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2020-01-20', '2020-01-25', 30, 200, 2, 10, 0, 1, '2020-01-11', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservationxservice`
--

CREATE TABLE `reservationxservice` (
  `FK_id_reservation` int(11) NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicexlocker`
--

CREATE TABLE `servicexlocker` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_locker` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicexparasol`
--

CREATE TABLE `servicexparasol` (
  `FK_id_service` int(11) NOT NULL,
  `FK_id_parasol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `staff`
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
-- Volcado de datos para la tabla `staff`
--

INSERT INTO `staff` (`id`, `name`, `lastname`, `position`, `salary`, `date_start`, `date_end`, `dni`, `address`, `tel`, `shirt_size`, `pant_size`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'per1', 'per', 'cargo 1', 20000, '2020-01-08', '2020-01-30', 505052, 'calle 100 mod', 4230000, 5, 5, 1, '2020-01-08', 1, '2020-01-10', 2, '2020-01-10', 2, '2020-01-10', 2),
(2, 'x', 'x', 'x', 5000, '2020-01-17', '2020-01-31', 4040, 'cal421', 41241, 5, 5, 1, '2020-01-10', 2, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `additional_service`
--
ALTER TABLE `additional_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_additional_service_register_by` (`register_by`),
  ADD KEY `FK_additional_service_disable_by` (`disable_by`),
  ADD KEY `FK_additional_service_enable_by` (`enable_by`),
  ADD KEY `FK_additional_service_update_by` (`update_by`);

--
-- Indices de la tabla `admin`
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
-- Indices de la tabla `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_hall_beach_tent` (`FK_id_hall`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_client_register_by` (`register_by`),
  ADD KEY `FK_client_disable_by` (`disable_by`),
  ADD KEY `FK_client_enable_by` (`enable_by`),
  ADD KEY `FK_client_update_by` (`update_by`);

--
-- Indices de la tabla `client_potential`
--
ALTER TABLE `client_potential`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `FK_client_potential_register_by` (`register_by`),
  ADD KEY `FK_client_potential_disable_by` (`disable_by`),
  ADD KEY `FK_client_potential_enable_by` (`enable_by`),
  ADD KEY `FK_client_potential_update_by` (`update_by`);

--
-- Indices de la tabla `hall`
--
ALTER TABLE `hall`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locker_number` (`locker_number`);

--
-- Indices de la tabla `parasol`
--
ALTER TABLE `parasol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parasol_number` (`parasol_number`),
  ADD KEY `FK_id_hall_parasol` (`FK_id_hall`);

--
-- Indices de la tabla `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_hall_parking` (`FK_id_hall`);

--
-- Indices de la tabla `parking_hall`
--
ALTER TABLE `parking_hall`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_category_product` (`FK_id_category`),
  ADD KEY `FK_product_register_by` (`register_by`),
  ADD KEY `FK_product_disable_by` (`disable_by`),
  ADD KEY `FK_product_enable_by` (`enable_by`),
  ADD KEY `FK_product_update_by` (`update_by`);

--
-- Indices de la tabla `provider`
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
-- Indices de la tabla `providerxproduct`
--
ALTER TABLE `providerxproduct`
  ADD KEY `FK_id_provider_providerxproduct` (`FK_id_provider`),
  ADD KEY `FK_id_product_providerxproduct` (`FK_id_product`);

--
-- Indices de la tabla `reservation`
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
-- Indices de la tabla `reservationxservice`
--
ALTER TABLE `reservationxservice`
  ADD KEY `FK_id_reservation_reservationxservice` (`FK_id_reservation`),
  ADD KEY `FK_id_service_reservationxservice` (`FK_id_service`);

--
-- Indices de la tabla `servicexlocker`
--
ALTER TABLE `servicexlocker`
  ADD KEY `FK_id_service_servicexlocker` (`FK_id_service`),
  ADD KEY `FK_id_locker_servicexlocker` (`FK_id_locker`);

--
-- Indices de la tabla `servicexparasol`
--
ALTER TABLE `servicexparasol`
  ADD KEY `FK_id_service_servicexparasol` (`FK_id_service`),
  ADD KEY `FK_id_parasol_servicexparasol` (`FK_id_parasol`);

--
-- Indices de la tabla `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_staff_register_by` (`register_by`),
  ADD KEY `FK_staff_disable_by` (`disable_by`),
  ADD KEY `FK_staff_enable_by` (`enable_by`),
  ADD KEY `FK_staff_update_by` (`update_by`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `additional_service`
--
ALTER TABLE `additional_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `beach_tent`
--
ALTER TABLE `beach_tent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=232;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `client_potential`
--
ALTER TABLE `client_potential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `hall`
--
ALTER TABLE `hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `locker`
--
ALTER TABLE `locker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;

--
-- AUTO_INCREMENT de la tabla `parasol`
--
ALTER TABLE `parasol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT de la tabla `parking_hall`
--
ALTER TABLE `parking_hall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `additional_service`
--
ALTER TABLE `additional_service`
  ADD CONSTRAINT `FK_additional_service_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_additional_service_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `FK_admin_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_admin_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD CONSTRAINT `FK_id_hall_beach_tent` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`);

--
-- Filtros para la tabla `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `FK_client_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `client_potential`
--
ALTER TABLE `client_potential`
  ADD CONSTRAINT `FK_client_potential_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_client_potential_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `parasol`
--
ALTER TABLE `parasol`
  ADD CONSTRAINT `FK_id_hall_parasol` FOREIGN KEY (`FK_id_hall`) REFERENCES `hall` (`id`);

--
-- Filtros para la tabla `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `FK_id_hall_parking` FOREIGN KEY (`FK_id_hall`) REFERENCES `parking_hall` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `FK_product_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_product_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `provider`
--
ALTER TABLE `provider`
  ADD CONSTRAINT `FK_provider_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_provider_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `providerxproduct`
--
ALTER TABLE `providerxproduct`
  ADD CONSTRAINT `FK_id_product_providerxproduct` FOREIGN KEY (`FK_id_product`) REFERENCES `product` (`id`),
  ADD CONSTRAINT `FK_id_provider_providerxproduct` FOREIGN KEY (`FK_id_provider`) REFERENCES `provider` (`id`);

--
-- Filtros para la tabla `reservation`
--
ALTER TABLE `reservation`
  ADD CONSTRAINT `FK_id_client_reservation` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_id_tent_reservation` FOREIGN KEY (`FK_id_tent`) REFERENCES `beach_tent` (`id`),
  ADD CONSTRAINT `FK_reservation_disable_by` FOREIGN KEY (`disable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_enable_by` FOREIGN KEY (`enable_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_register_by` FOREIGN KEY (`register_by`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_reservation_update_by` FOREIGN KEY (`update_by`) REFERENCES `admin` (`id`);

--
-- Filtros para la tabla `reservationxservice`
--
ALTER TABLE `reservationxservice`
  ADD CONSTRAINT `FK_id_reservation_reservationxservice` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`),
  ADD CONSTRAINT `FK_id_service_reservationxservice` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Filtros para la tabla `servicexlocker`
--
ALTER TABLE `servicexlocker`
  ADD CONSTRAINT `FK_id_locker_servicexlocker` FOREIGN KEY (`FK_id_locker`) REFERENCES `locker` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexlocker` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Filtros para la tabla `servicexparasol`
--
ALTER TABLE `servicexparasol`
  ADD CONSTRAINT `FK_id_parasol_servicexparasol` FOREIGN KEY (`FK_id_parasol`) REFERENCES `parasol` (`id`),
  ADD CONSTRAINT `FK_id_service_servicexparasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Filtros para la tabla `staff`
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
