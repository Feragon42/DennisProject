-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 13-07-2016 a las 20:48:43
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `indotel`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_name` varchar(100) NOT NULL,
  `client_direction` text,
  `client_telph` varchar(15) DEFAULT NULL,
  `client_email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`client_id`, `client_name`, `client_direction`, `client_telph`, `client_email`) VALUES
(1, 'Hotel Hesperia', 'Calle 130', '029393011', 'hh@contact.com1'),
(7, 'Bonaire', 'djddj', 'jdjdjd', 'jdjd@djdj'),
(10, 'Hotel Definitivo', 'kdkdk', 'kdkkdkd', 'dkd@kdkd'),
(11, 'Hote Prueba', 'dddd', 'dddd', 'dada@dddd'),
(12, 'Hotel Lidotel', 'Valencia', '22661', 'li@di.com'),
(13, 'Otro Hotel', 'JDJD', '19299', 'dada@dddd'),
(15, 'Hotel Punto Cardon', 'jdjd', '92993', 'jdjd@djdj'),
(16, 'Jose Hotel', 'sfsfs', '444', 'feragon42@gmail.com'),
(20, 'Prueba Timeline', 'ddadada', 'ddd', 'dada@dddd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orderp`
--

CREATE TABLE IF NOT EXISTS `orderp` (
  `orderp_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`orderp_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Volcado de datos para la tabla `orderp`
--

INSERT INTO `orderp` (`orderp_id`, `client_id`, `status`) VALUES
(8, 7, 'Finalizado'),
(38, 12, 'Finalizado'),
(39, 12, 'Finalizado'),
(41, 1, 'Revisado'),
(42, 1, 'En Produccion'),
(44, 10, 'Revisado'),
(46, 16, 'Revisado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(10) NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `supplier` varchar(80) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_type`, `status`, `supplier`) VALUES
(1, 'Jabon Cuadrado', 'Liquido', 'No Disponible', ''),
(2, 'Jabon Circular', 'Liquido', 'No Disponible', 'Jaboneria Maracay'),
(4, 'Jabon de Miel', 'Solido', 'Disponible', ''),
(5, 'Jabon de Avena', 'Solido', 'Disponible', ''),
(6, 'Jabon Invernal', 'Solido', 'Disponible', ''),
(9, 'Jabon de Rosas', 'Solido', 'Disponible', ''),
(10, 'Otro Jabon', 'Solido', 'Disponible', ''),
(11, 'Las Llaves', 'Solido', 'Disponible', ''),
(12, 'Jabon de Chocolate', 'Liquido', 'No Disponible', ''),
(23, 'Jabon Flores', 'Solido', 'No Disponible', 'Jabonera Caracas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_client`
--

CREATE TABLE IF NOT EXISTS `product_client` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`client_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_client`
--

INSERT INTO `product_client` (`client_id`, `product_id`) VALUES
(1, 1),
(1, 4),
(1, 6),
(1, 10),
(7, 4),
(7, 5),
(7, 10),
(7, 11),
(10, 4),
(10, 6),
(10, 9),
(10, 10),
(11, 1),
(11, 4),
(11, 5),
(11, 9),
(12, 1),
(12, 2),
(12, 4),
(12, 5),
(12, 6),
(12, 9),
(12, 10),
(12, 11),
(13, 1),
(13, 9),
(13, 10),
(13, 11),
(15, 2),
(15, 4),
(15, 5),
(15, 10),
(15, 11),
(16, 1),
(16, 2),
(16, 5),
(16, 6),
(16, 9),
(16, 10),
(20, 5),
(20, 9),
(20, 10),
(20, 11);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_order`
--

CREATE TABLE IF NOT EXISTS `product_order` (
  `orderp_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`orderp_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `product_order`
--

INSERT INTO `product_order` (`orderp_id`, `product_id`, `quantity`) VALUES
(0, 4, 11),
(8, 4, 11111),
(8, 5, 12),
(38, 1, 8),
(38, 2, 9),
(38, 4, 14),
(38, 5, 10),
(38, 6, 10),
(38, 9, 17),
(38, 10, 3),
(38, 11, 4),
(38, 12, 4),
(39, 1, 3),
(39, 2, 10),
(39, 4, 8888888),
(39, 5, 212),
(39, 6, 12),
(39, 10, 8),
(39, 11, 12),
(41, 1, 2),
(41, 6, 4),
(41, 10, 7),
(42, 4, 9999999),
(42, 6, 225516),
(42, 10, 66213),
(44, 6, 555),
(44, 10, 6524),
(46, 5, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `timeline`
--

CREATE TABLE IF NOT EXISTS `timeline` (
  `date` datetime NOT NULL,
  `username` varchar(50) NOT NULL,
  `action` varchar(100) NOT NULL,
  `object_id` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `timeline`
--

INSERT INTO `timeline` (`date`, `username`, `action`, `object_id`) VALUES
('2016-07-11 14:21:01', 'Dennys Perez', 'eliminó el cliente', 'dddd'),
('2016-07-11 14:21:09', 'Dennys Perez', 'eliminó el cliente', 'Timeline'),
('2016-07-11 14:21:26', 'Dennys Perez', 'almacenó un nuevo cliente.', ''),
('2016-07-11 14:21:36', 'Dennys Perez', 'editó el cliente', 'Prueba Timeline'),
('2016-07-11 14:28:09', 'Dennys Perez', 'creó al usuario', 'ddd'),
('2016-07-11 14:28:24', 'Dennys Perez', 'eliminó al usuario', ''),
('2016-07-11 14:28:30', 'Dennys Perez', 'eliminó al usuario', ''),
('2016-07-11 14:44:17', 'Antonio Gutierrez', 'eliminó la orden', ''),
('2016-07-11 14:44:21', 'Antonio Gutierrez', 'mandó a producción la orden', ''),
('2016-07-11 14:45:52', 'Antonio Gutierrez', 'eliminó la orden', '45'),
('2016-07-11 14:47:33', 'Fernando Gonzalez', 'finalizó la orden', '38'),
('2016-07-11 14:47:40', 'Fernando Gonzalez', 'editó la orden', '41'),
('2016-07-11 14:47:45', 'Fernando Gonzalez', 'finalizó la orden', '39'),
('2016-07-11 15:17:03', 'Fernando', 'inició sesión', ''),
('2016-07-11 15:19:52', 'Dennys Perez', 'inició sesión', ''),
('2016-07-11 15:20:44', 'Dennys Perez', 'inició sesión', ''),
('2016-07-11 15:22:44', '', 'cerro sesión.', ''),
('2016-07-11 15:24:06', 'Fernando Gonzalez', 'inició sesión.', ''),
('2016-07-11 15:24:19', 'Fernando Gonzalez', 'cerro sesión.', ''),
('2016-07-11 15:24:36', 'Dennys Perez', 'inició sesión.', ''),
('2016-07-13 16:48:04', 'Dennys Perez', 'inició sesión.', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(40) NOT NULL,
  `userType` varchar(120) NOT NULL,
  `status` varchar(12) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `username`, `name`, `email`, `password`, `userType`, `status`) VALUES
(1, 'memberAdmin', 'Dennys Perez', 'dp@indotel.com', 'adminpassword', 'Administrador', 'Activo'),
(2, 'memberRecepcionista', 'Ana Sanchez', 'as@indotel.com', 'receppassword', 'Recepcionista', 'Activo'),
(3, 'memberJPlanta', 'Fernando Gonzalez', 'feragon42@gmail.com', 'plantapassword', 'Jefe de Planta', 'Activo'),
(4, 'memberJOperaciones', 'Antonio Gutierrez', 'ag@indotel.com', 'operapassword', 'Jefe de Operaciones', 'Activo'),
(8, 'velooooonica', 'Veronica Rivas', 'vr@indotel.com', 'vvv', 'Recepcionista', 'Activo'),
(12, 'userTest', 'Usuario Prueba', 'us@us', 'wJoRThhP', 'Recepcionista', 'Inactivo'),
(20, 'Fernando', 'Fernando Gonzalez', 'feragon42@gmail.com', 'prueba999', 'Administrador', 'Inactivo'),
(21, 'dddada', 'aaaa', 'd@ss', 'dada', 'Administrador', 'Inactivo'),
(22, 'ddd', 'ddd', 'd@ss', 'ddd', 'Administrador', 'Inactivo'),
(23, 'dddd', 'ddd', 'd@ss', 'QWqaHSDO', 'Administrador', 'Inactivo');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
