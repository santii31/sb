-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2020 a las 23:39:26
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
-- Base de datos: `southbeach2`
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `beach_tent_add` (IN `number` INT, IN `price` FLOAT)  BEGIN
	INSERT INTO beach_tent (
			beach_tent.number,
            beach_tent.price          
	)
    VALUES
        (number, price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category_add` (IN `name` VARCHAR(255), IN `description` VARCHAR(255))  BEGIN
	INSERT INTO category (
			category.name,
            category.description
	)
    VALUES
        (name, description);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `locker_getById` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getAll` ()  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `parasol_getById` (IN `id` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getAll` ()  BEGIN
	SELECT * FROM `parking` ORDER BY number ASC;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getByNumber` (IN `number` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`number` = number;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_add` (IN `name` VARCHAR(255), IN `price` INT, IN `quantity` INT, IN `FK_id_category` INT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    ORDER BY price ASC;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `providerxproduct_add` (IN `FK_id_provider` INT, IN `FK_id_product` INT, IN `quantity` INT, IN `total` FLOAT, IN `discount` FLOAT, IN `transaction_date` DATE)  BEGIN
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
	SELECT * FROM `provider` ORDER BY lastname ASC;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_add` (IN `date_start` DATE, IN `date_end` DATE, IN `total_price` FLOAT, IN `FK_id_client` INT, IN `FK_id_tent` INT, IN `FK_id_parking` INT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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
    WHERE `reservation`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_add` (IN `description` VARCHAR(255), IN `total` FLOAT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
	INSERT INTO additional_service (
			additional_service.description,
            additional_service.total,                   
            additional_service.date_register,
            additional_service.register_by
	)
    VALUES
        (description, total, date_register, register_by);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `position` VARCHAR(255), IN `date_start` DATE, IN `date_end` DATE, IN `dni` INT, IN `address` VARCHAR(255), IN `tel` INT, IN `shirt_size` FLOAT, IN `pant_size` FLOAT, IN `date_register` DATE, IN `register_by` INT)  BEGIN
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
	SELECT * FROM `staff` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getByDni` (IN `dni` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`dni` = dni;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `staff` WHERE `staff`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `staff_update` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `position` VARCHAR(255), IN `date_start` DATE, IN `date_end` DATE, IN `dni` INT, IN `address` VARCHAR(255), IN `tel` INT, IN `shirt_size` FLOAT, IN `pant_size` FLOAT, IN `id` INT, IN `date_update` DATE, IN `update_by` INT)  BEGIN
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getAll` ()  BEGIN
	SELECT * FROM `beach_tent` ORDER BY number ASC;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `tent_getByNumber` (IN `number` INT)  BEGIN
	SELECT * FROM `beach_tent` WHERE `beach_tent`.`number` = number;
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
(2, 'Test', 'Test', 505050, 'test@admin.com', '$2y$10$xNd90YZ2Zcttqmt2JU9d3uWt.CgYhVAW4ylkauUaXZ8vLkHRy.X1a', 0, '2020-01-07', 1, '2020-01-08', 1, NULL, NULL, NULL, NULL),
(3, 'pepe', 'admin', 707070, 'pepeadmin@admin.com', '$2y$10$t5m0VNDRsrv96z3k386mHuoo/YdnRldp.DN409hnRjEiiBRKTGDly', 0, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beach_tent`
--

CREATE TABLE `beach_tent` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(1, 'pepe', 'jose', 'asd', 'asd', 'asd@mail.com', 43430, 100, 0, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `locker`
--

CREATE TABLE `locker` (
  `id` int(11) NOT NULL,
  `locker_number` int(11) NOT NULL,
  `price` float NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parasol`
--

CREATE TABLE `parasol` (
  `id` int(11) NOT NULL,
  `parasol_number` int(11) NOT NULL,
  `price` float NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `FK_id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` float NOT NULL,
  `discount` float NOT NULL,
  `transaction_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `total_price` float NOT NULL,
  `FK_id_client` int(11) NOT NULL,
  `FK_id_tent` int(11) NOT NULL,
  `FK_id_parking` int(11) NOT NULL,
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
-- Estructura de tabla para la tabla `reservationxservice`
--

CREATE TABLE `reservationxservice` (
  `FK_id_reservation` int(11) NOT NULL,
  `FK_id_service` int(11) NOT NULL
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

INSERT INTO `staff` (`id`, `name`, `lastname`, `position`, `date_start`, `date_end`, `dni`, `address`, `tel`, `shirt_size`, `pant_size`, `is_active`, `date_register`, `register_by`, `date_disable`, `disable_by`, `date_enable`, `enable_by`, `date_update`, `update_by`) VALUES
(1, 'per1', 'per', 'cargo 1', '2020-01-08', '2020-01-30', 505052, 'calle 100 mod', 4230000, 5, 5, 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1, '2020-01-08', 1);

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
  ADD UNIQUE KEY `number` (`number`);

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
-- Indices de la tabla `locker`
--
ALTER TABLE `locker`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `locker_number` (`locker_number`),
  ADD KEY `FK_id_service_locker` (`FK_id_service`);

--
-- Indices de la tabla `parasol`
--
ALTER TABLE `parasol`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `parasol_number` (`parasol_number`),
  ADD KEY `FK_id_service_parasol` (`FK_id_service`);

--
-- Indices de la tabla `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`);

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
  ADD KEY `FK_id_parking` (`FK_id_parking`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `client_potential`
--
ALTER TABLE `client_potential`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `locker`
--
ALTER TABLE `locker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parasol`
--
ALTER TABLE `parasol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parking`
--
ALTER TABLE `parking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `provider`
--
ALTER TABLE `provider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Filtros para la tabla `locker`
--
ALTER TABLE `locker`
  ADD CONSTRAINT `FK_id_service_locker` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Filtros para la tabla `parasol`
--
ALTER TABLE `parasol`
  ADD CONSTRAINT `FK_id_service_parasol` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

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
  ADD CONSTRAINT `FK_id_parking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking` (`id`),
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
