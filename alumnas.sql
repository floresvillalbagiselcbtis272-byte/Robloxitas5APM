-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-10-2025 a las 13:40:15
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `5apm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnas`
--

CREATE TABLE `alumnas` (
  `ID` int(80) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Rol` varchar(100) NOT NULL,
  `Num_control` int(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnas`
--

INSERT INTO `alumnas` (`ID`, `Nombre`, `Rol`, `Num_control`, `foto`) VALUES
(1, 'Flores Villaba Gisele', 'Alumna', 23091445, 'Flores.jpeg'),
(2, 'Mendivil Santiago Ingrid Denisse', 'Alumna', 23327639, 'Denisse.jpeg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
