-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-01-2020 a las 18:53:24
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
CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `dni` VARCHAR(255), IN `email` VARCHAR(255), IN `password` VARCHAR(255))  BEGIN
	INSERT INTO admin (
			admin.name,
			admin.lastname,
			admin.dni,
			admin.email,
			admin.password			
	)
    VALUES
        (name, lastname, dni, email, password);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_disableById` (IN `id` INT)  BEGIN
	UPDATE `admin` SET `admin`.`is_active` = false WHERE `admin`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_enableById` (IN `id` INT)  BEGIN
    UPDATE `admin` SET `admin`.`is_active` = true WHERE `admin`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getAll` ()  BEGIN
	SELECT * FROM `admin` ORDER BY name ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getByEmail` (IN `email` INT)  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`email` = email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `admin_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `admin` WHERE `admin`.`id` = id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `chest_getAll` ()  BEGIN
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
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
    FROM `chest`
    INNER JOIN additional_service ON chest.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `chest_getById` (IN `id` INT)  BEGIN
	SELECT chest.id AS chest_id,
           chest.chest_number AS chest_number,
           chest.price AS chest_price,
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
    FROM `chest` 
    INNER JOIN additional_service ON chest.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `chest`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `client_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `email` VARCHAR(255), IN `tel` INT, IN `city` VARCHAR(255), IN `address` VARCHAR(255), IN `stay_address` VARCHAR(255), IN `is_potential` BOOLEAN, IN `is_active` BOOLEAN)  BEGIN
	INSERT INTO client (
			client.name,
			client.lastname,
			client.email,
            client.tel,
            client.city,
            client.address,
            client.stay_address,
            client.is_potential,
			client.is_active
	)
    VALUES
        (name,lastname,email,tel,city,address,stay_address,is_potential,is_active);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getAll` ()  BEGIN
	SELECT * FROM `parking` ORDER BY number ASC;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `parking_getByNumber` (IN `number` INT)  BEGIN
	SELECT * FROM `parking` WHERE `parking`.`number` = number;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_add` (IN `name` VARCHAR(255), IN `price` INT, IN `FK_id_category` INT)  BEGIN
	INSERT INTO product (
			product.name,
            product.price,
            product.FK_id_category            
	)
    VALUES
        (name,price,FK_id_category);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getAll` ()  BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    ORDER BY price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product_getById` (IN `id` INT)  BEGIN
	SELECT  product.id AS product_id,
            product.name AS product_name,
            product.price AS product_price,
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
            product.is_active AS product_isActive,
            category.id AS category_id,
            category.name AS category_name,
            category.description AS category_description
    FROM `product` 
    INNER JOIN category ON product.FK_id_category = category.id
    WHERE `product`.`name` = name;
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
        (FK_id_provider,FK_id_product,quantity,total,discount,transaction_date);
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_add` (IN `name` VARCHAR(255), IN `lastname` VARCHAR(255), IN `tel` INT, IN `email` VARCHAR(255), IN `dni` INT, IN `address` VARCHAR(255), IN `cuil` INT, IN `social_reason` VARCHAR(255), IN `type_billing` VARCHAR(255))  BEGIN
	INSERT INTO provider (
            provider.name,
            provider.lastname,
            provider.tel,
            provider.email,
            provider.dni,
            provider.address,
            provider.cuil,
            provider.social_reason,
            provider.type_billing
	)
    VALUES
        (name,lastname,tel,email,dni,address,cuil,social_reason, type_billing);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getAll` ()  BEGIN
	SELECT * FROM `provider` ORDER BY lastname ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `provider_getById` (IN `id` INT)  BEGIN
	SELECT * FROM `provider` WHERE `provider`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_add` (IN `date_start` DATE, IN `date_end` DATE, IN `total_price` INT, IN `FK_id_client` INT, IN `FK_id_admin` INT, IN `FK_id_tent` INT, IN `FK_id_parking` INT, IN `is_active` BOOLEAN)  BEGIN
	INSERT INTO reservation (
			reservation.date_start,
            reservation.date_end,
            reservation.total_price,
            reservation.FK_id_client,
            reservation.FK_id_admin,
            reservation.FK_id_tent,
            reservation.FK_id_parking,
            reservation.is_active
	)
    VALUES
        (date_start,date_end,total_price,FK_id_client,FK_id_admin, FK_id_tent, FK_id_parking, is_active);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_disableById` (IN `id` INT)  BEGIN
	UPDATE `reservation` SET `reservation`.`is_active` = false WHERE `reservation`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_enableById` (IN `id` INT)  BEGIN
    UPDATE `reservation` SET `reservation`.`is_active` = true WHERE `reservation`.`id` = id;	
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reservation_getAll` ()  BEGIN
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

    FROM `reservation`
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `reservation`.`id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getAll` ()  BEGIN
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
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
    FROM `additional_service` 
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `service_getById` (IN `id` INT)  BEGIN
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
           beach_tent AS tent_isActive,
           parking.id AS parking_id,
           parking.number AS parking_number,
           parking.price AS parking_price,
           parking.is_active AS parking_isActive
    FROM `additional_service` 
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `service`.`id` = id;
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `umbrella_getAll` ()  BEGIN
	SELECT umbrella.id AS umbrella_id,
           umbrella.umbrella_number AS umbrella_number,
           umbrella.price AS umbrella_price,
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

    FROM `umbrella` 
    INNER JOIN additional_service ON umbrella.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    ORDER BY price ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `umbrella_getById` (IN `id` INT)  BEGIN
	SELECT umbrella.id AS umbrella_id,
           umbrella.umbrella_number AS umbrella_number,
           umbrella.price AS umbrella_price,
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
             
    FROM `umbrella` 
    INNER JOIN additional_service ON umbrella.FK_id_service = additional_service.id
    INNER JOIN reservation ON additional_service.FK_id_reservation = reservation.id
    INNER JOIN client ON reservation.FK_id_client = client.id
    INNER JOIN admin ON reservation.FK_id_admin = admin.id
    INNER JOIN beach_tent ON reservation.FK_id_tent = beach_tent.id
    INNER JOIN parking ON reservation.FK_id_parking = parking.id
    WHERE `umbrella`.`id` = id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `additional_service`
--

CREATE TABLE `additional_service` (
  `id` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8_bin NOT NULL,
  `total` int(11) NOT NULL,
  `FK_id_reservation` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `name`, `lastname`, `dni`, `email`, `password`, `is_active`) VALUES
(2, 'Admin', 'Admin', 404040, 'admin@admin.com', '$2y$10$xNd90YZ2Zcttqmt2JU9d3uWt.CgYhVAW4ylkauUaXZ8vLkHRy.X1a', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `beach_tent`
--

CREATE TABLE `beach_tent` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `FK_id_reservation` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
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
-- Estructura de tabla para la tabla `chest`
--

CREATE TABLE `chest` (
  `id` int(11) NOT NULL,
  `chest_number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `tel` int(11) NOT NULL,
  `city` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_potential` tinyint(1) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parking`
--

CREATE TABLE `parking` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `price` int(11) DEFAULT NULL,
  `FK_id_reservation` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `FK_id_category` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
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
  `billing` varchar(255) COLLATE utf8_bin NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
  `total_price` int(11) NOT NULL,
  `FK_id_client` int(11) NOT NULL,
  `FK_id_admin` int(11) NOT NULL,
  `FK_id_tent` int(11) NOT NULL,
  `FK_id_parking` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `umbrella`
--

CREATE TABLE `umbrella` (
  `id` int(11) NOT NULL,
  `umbrella_number` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `FK_id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `additional_service`
--
ALTER TABLE `additional_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_reservation_service` (`FK_id_reservation`);

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_reservation_beach` (`FK_id_reservation`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `chest`
--
ALTER TABLE `chest`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `chest_number` (`chest_number`),
  ADD KEY `FK_id_service_chest` (`FK_id_service`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `number` (`number`),
  ADD KEY `FK_id_reservation_parking` (`FK_id_reservation`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_category_product` (`FK_id_category`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `dni` (`dni`);

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
  ADD KEY `FK_id_admin_reservation` (`FK_id_admin`),
  ADD KEY `FK_id_tent_reservation` (`FK_id_tent`),
  ADD KEY `FK_id_parking` (`FK_id_parking`);

--
-- Indices de la tabla `umbrella`
--
ALTER TABLE `umbrella`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `umbrella_number` (`umbrella_number`),
  ADD KEY `FK_id_service_umbrella` (`FK_id_service`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `additional_service`
--
ALTER TABLE `additional_service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de la tabla `chest`
--
ALTER TABLE `chest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `client`
--
ALTER TABLE `client`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `umbrella`
--
ALTER TABLE `umbrella`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `additional_service`
--
ALTER TABLE `additional_service`
  ADD CONSTRAINT `FK_id_reservation_service` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`);

--
-- Filtros para la tabla `beach_tent`
--
ALTER TABLE `beach_tent`
  ADD CONSTRAINT `FK_id_reservation_beach` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`);

--
-- Filtros para la tabla `chest`
--
ALTER TABLE `chest`
  ADD CONSTRAINT `FK_id_service_chest` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);

--
-- Filtros para la tabla `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `FK_id_reservation_parking` FOREIGN KEY (`FK_id_reservation`) REFERENCES `reservation` (`id`);

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_id_category_product` FOREIGN KEY (`FK_id_category`) REFERENCES `category` (`id`);

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
  ADD CONSTRAINT `FK_id_admin_reservation` FOREIGN KEY (`FK_id_admin`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `FK_id_client_reservation` FOREIGN KEY (`FK_id_client`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_id_parking` FOREIGN KEY (`FK_id_parking`) REFERENCES `parking` (`id`),
  ADD CONSTRAINT `FK_id_tent_reservation` FOREIGN KEY (`FK_id_tent`) REFERENCES `beach_tent` (`id`);

--
-- Filtros para la tabla `umbrella`
--
ALTER TABLE `umbrella`
  ADD CONSTRAINT `FK_id_service_umbrella` FOREIGN KEY (`FK_id_service`) REFERENCES `additional_service` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
