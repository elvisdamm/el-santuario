-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2022 a las 20:07:48
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `santuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `idActividad` int(11) NOT NULL,
  `actFecha` date NOT NULL,
  `actHora` time NOT NULL,
  `actVoluntario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `actAnimal` int(11) NOT NULL,
  `actTipo` enum('Lavado','Paseo','Alimentacion') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Paseo',
  `actEstado` enum('Confirmada','Cancelada') COLLATE utf8_spanish_ci NOT NULL DEFAULT 'Confirmada',
  `actDescripcion` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

CREATE TABLE `adopciones` (
  `idAdopcion` int(11) NOT NULL,
  `adopFecha` date NOT NULL,
  `adopAdop` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `adopAnimal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adoptantes`
--

CREATE TABLE `adoptantes` (
  `dniAdo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `adoNombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adoApellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `adoFechaNacimiento` date NOT NULL,
  `adoSexo` enum('Masculino','Femenino') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animalesadop`
--

CREATE TABLE `animalesadop` (
  `idAnimal` int(11) NOT NULL,
  `aniNombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aniFechaIngreso` date NOT NULL,
  `aniEspecie` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aniSexo` enum('Hembra','Macho') COLLATE utf8_spanish_ci NOT NULL,
  `dniAdoptante` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animalesnoadop`
--

CREATE TABLE `animalesnoadop` (
  `idAnimalNo` int(11) NOT NULL,
  `aninNombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aninFechaIngreso` date NOT NULL,
  `aninEspecie` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `aninSexo` enum('Hembra','Macho') COLLATE utf8_spanish_ci NOT NULL,
  `dniVoluntario` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gerentes`
--

CREATE TABLE `gerentes` (
  `dniGer` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `gerNombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `gerApellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `gerFechaNacimiento` date NOT NULL,
  `gerFechaAlta` date NOT NULL,
  `gerSexo` enum('Masculino','Femenino') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dniUsu` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `usuLogin` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `usuPassword` varchar(157) COLLATE utf8_spanish_ci NOT NULL,
  `usuEstado` enum('Activo','Inactivo') COLLATE utf8_spanish_ci NOT NULL,
  `usutipo` enum('Administrador','Gerente','Voluntario','Adoptante') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dniUsu`, `usuLogin`, `usuPassword`, `usuEstado`, `usutipo`) VALUES
('71974886C', 'elvis', 'e8902c0668313a3d8f085ea744712022398e47f1ca08eff7658a80a8cef0b8a4bfed81ac5f2c44697af10dade44e2b6616c63bcb3904e154d5d740b63b1717f9', 'Activo', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntarios`
--

CREATE TABLE `voluntarios` (
  `dniVoluntario` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `volNombres` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `volApellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `volTelefono` char(15) COLLATE utf8_spanish_ci NOT NULL,
  `volCorreo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `volDireccion` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `actVoluntario` (`actVoluntario`),
  ADD KEY `actividades_ibfk_1` (`actAnimal`);

--
-- Indices de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD PRIMARY KEY (`idAdopcion`),
  ADD KEY `adopAdop` (`adopAdop`),
  ADD KEY `adopAnimal` (`adopAnimal`);

--
-- Indices de la tabla `adoptantes`
--
ALTER TABLE `adoptantes`
  ADD PRIMARY KEY (`dniAdo`);

--
-- Indices de la tabla `animalesadop`
--
ALTER TABLE `animalesadop`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indices de la tabla `animalesnoadop`
--
ALTER TABLE `animalesnoadop`
  ADD PRIMARY KEY (`idAnimalNo`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dniUsu`,`usuLogin`);

--
-- Indices de la tabla `voluntarios`
--
ALTER TABLE `voluntarios`
  ADD PRIMARY KEY (`dniVoluntario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `idActividad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `animalesnoadop`
--
ALTER TABLE `animalesnoadop`
  MODIFY `idAnimalNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`actAnimal`) REFERENCES `animalesnoadop` (`idAnimalNo`),
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`actVoluntario`) REFERENCES `voluntarios` (`dniVoluntario`);

--
-- Filtros para la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD CONSTRAINT `adopciones_ibfk_1` FOREIGN KEY (`adopAdop`) REFERENCES `adoptantes` (`dniAdo`),
  ADD CONSTRAINT `adopciones_ibfk_2` FOREIGN KEY (`adopAnimal`) REFERENCES `animalesnoadop` (`idAnimalNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
