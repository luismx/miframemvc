-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2015 at 05:12 PM
-- Server version: 5.5.43
-- PHP Version: 5.4.39-0+deb7u2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cfdifacturacion`
--
CREATE DATABASE `cfdifacturacion` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `cfdifacturacion`;

-- --------------------------------------------------------

--
-- Table structure for table `control_consecutivos`
--

CREATE TABLE IF NOT EXISTS `control_consecutivos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `folio_inicio` int(11) NOT NULL,
  `serie` char(10) NOT NULL,
  `folio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `serie_UNIQUE` (`serie`),
  KEY `fk_control_consecutivos_empresas` (`id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='para controlar las series y folios' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `empresas`
--

CREATE TABLE IF NOT EXISTS `empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL COMMENT 'id del usuario que crea la empresa',
  `id_padre` int(11) DEFAULT NULL COMMENT '0=matriz, n=hijo de una matriz/padre',
  `nombre` varchar(100) NOT NULL,
  `fecha_alta` date DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `razon_social` text,
  `contacto` varchar(100) DEFAULT NULL,
  `telefono` char(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pais` int(11) DEFAULT NULL,
  `estado` char(50) DEFAULT NULL,
  `municipio` varchar(100) DEFAULT NULL,
  `colonia` text,
  `localidad` text,
  `calle` varchar(45) DEFAULT NULL,
  `numero_interior` varchar(45) DEFAULT NULL,
  `numero_exterior` varchar(45) DEFAULT NULL,
  `alta_hacienda` varchar(50) DEFAULT NULL COMMENT 'nombre y extensión del documento para comprobar la empresa (si esnueva en el sistema)',
  `status` tinyint(4) DEFAULT NULL COMMENT '0=inactivo,1=activo',
  PRIMARY KEY (`id`),
  KEY `fk_empresas_1` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `empresas`
--

INSERT INTO `empresas` (`id`, `id_usuario`, `id_padre`, `nombre`, `fecha_alta`, `rfc`, `razon_social`, `contacto`, `telefono`, `email`, `pais`, `estado`, `municipio`, `colonia`, `localidad`, `calle`, `numero_interior`, `numero_exterior`, `alta_hacienda`, `status`) VALUES
(1, 1, 0, 'ejemplo empresa 1', '1991-05-26', 'CUPU800825569', 'ejemplo de empresa', 'Luis Perera', '2147483647', 'sistemas@ariuss.net', 52, 'Quintana Roo', 'Benito Juarez', 'Región 103', 'supermanzana 103', '44', NULL, NULL, NULL, 1),
(2, 1, 0, 'ejemplo cancelada 1', '2015-04-06', 'CUPE800825569', 'ejemplo cancelación 1', 'Luis Perera', '2147483647', 'sistemas@ariuss.net', 52, 'Quintana Roo', 'Benito Juarez', 'supermanzana 204', 'cancun quintana Roo', 'av. 149', '44', '44', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_UNIQUE` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tipos`
--

INSERT INTO `tipos` (`id`, `nombre`) VALUES
(4, 'Administrador'),
(1, 'Cliente'),
(2, 'Comisionista'),
(3, 'Operador');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_tipo` int(1) NOT NULL,
  `nombre` char(50) DEFAULT NULL,
  `apellido_paterno` char(50) DEFAULT NULL,
  `apellido_materno` char(50) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `usuario` varchar(45) DEFAULT NULL,
  `clave` varchar(100) DEFAULT NULL,
  `rfc` varchar(15) DEFAULT NULL,
  `fecha_alta` date DEFAULT NULL,
  `clave_interna` varchar(45) DEFAULT NULL,
  `img` varchar(100) NOT NULL,
  `status` int(11) DEFAULT '2' COMMENT '0=inactivo,1=activo,2=registro incompleto',
  `session_id` varchar(445) DEFAULT NULL COMMENT 'id para abrir una sola sesión',
  PRIMARY KEY (`id`),
  KEY `fk_usuarios_tipos` (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_tipo`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `email`, `usuario`, `clave`, `rfc`, `fecha_alta`, `clave_interna`, `img`, `status`, `session_id`) VALUES
(1, 1, 'luis antonio', 'perera', 'uluac', '1991-04-06', 'sistemas@ariuss.net', 'testcliente', 'e2103f107ac9726a5c98391a7c007f986e600dca', 'CUPU800825569', '2015-04-03', 'CUPU0415', 'CUPU800825569testcliente1.png', 2, 'kt7cfnp2kgcbki82klsnl7hpp3'),
(2, 1, 'luis', 'perera', 'uluac', '1991-04-25', 'sistemas@ariuss.net', 'testcliente2', 'e2103f107ac9726a5c98391a7c007f986e600dca', 'CUPU800825569', '2015-04-16', 'CUPU0415', '', 2, 'ccb7lrsam8mnv22t3kq7826bm6');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios_empresas`
--

CREATE TABLE IF NOT EXISTS `usuarios_empresas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) DEFAULT NULL,
  `id_empresa` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0=inactivo para el usuario, 1= activo',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_usuario` (`id_usuario`,`id_empresa`),
  KEY `fk_usuarios_empresas_usuarios` (`id_usuario`),
  KEY `fk_usuarios_empresas_empresas` (`id_empresa`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Las empresas que los usuarios tienen permitidas seleccionar ' AUTO_INCREMENT=3 ;

--
-- Dumping data for table `usuarios_empresas`
--

INSERT INTO `usuarios_empresas` (`id`, `id_usuario`, `id_empresa`, `status`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `control_consecutivos`
--
ALTER TABLE `control_consecutivos`
  ADD CONSTRAINT `fk_control_consecutivos_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `empresas`
--
ALTER TABLE `empresas`
  ADD CONSTRAINT `fk_empresas_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_tipos` FOREIGN KEY (`id_tipo`) REFERENCES `tipos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usuarios_empresas`
--
ALTER TABLE `usuarios_empresas`
  ADD CONSTRAINT `fk_usuarios_empresas_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `empresas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuarios_empresas_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
