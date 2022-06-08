-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2022 a las 18:38:26
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
-- Base de datos: `elsantuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE `actividades` (
  `id` int(11) NOT NULL,
  `tipoActividad` int(11) NOT NULL,
  `dniVoluntario` varchar(10) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `fechaActividad` date NOT NULL,
  `horaActividad` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id`, `tipoActividad`, `dniVoluntario`, `idAnimal`, `fechaActividad`, `horaActividad`) VALUES
(1, 2, '56880708Y', 5, '2022-05-18', '11:00:00'),
(2, 3, '00799446N', 6, '2022-05-27', '19:45:00'),
(3, 2, '00799446N', 8, '2022-05-27', '13:45:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopciones`
--

CREATE TABLE `adopciones` (
  `idAdopcion` int(11) NOT NULL,
  `dniAdoptante` varchar(10) NOT NULL,
  `idAnimal` int(11) NOT NULL,
  `fechaAdop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adopciones`
--

INSERT INTO `adopciones` (`idAdopcion`, `dniAdoptante`, `idAnimal`, `fechaAdop`) VALUES
(8, '94697803H', 9, '2015-10-06'),
(11, '87192769E', 5, '2022-05-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `animales`
--

CREATE TABLE `animales` (
  `idAnimal` int(11) NOT NULL,
  `aniNombre` varchar(20) NOT NULL,
  `aniFechaIngreso` date NOT NULL,
  `aniFechaAdop` date DEFAULT NULL,
  `aniEspecie` varchar(20) NOT NULL,
  `aniSexo` enum('Hembra','Macho') NOT NULL,
  `aniAdop` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `animales`
--

INSERT INTO `animales` (`idAnimal`, `aniNombre`, `aniFechaIngreso`, `aniFechaAdop`, `aniEspecie`, `aniSexo`, `aniAdop`) VALUES
(1, 'Mino', '2022-02-08', NULL, 'Gato', 'Macho', 0),
(2, 'Laski', '2020-02-20', '2021-04-07', 'Perro', 'Macho', 1),
(3, 'Desy', '2021-09-10', '2021-10-07', 'Perro', 'Hembra', 1),
(4, 'Riota', '2022-04-03', '2022-04-27', 'Gato', 'Hembra', 1),
(5, 'Chester', '2022-03-14', '2022-05-24', 'Serpiente', 'Macho', 1),
(6, 'Pepe', '2022-05-13', '2022-05-24', 'Gato', 'Macho', 0),
(7, 'Nieve', '2022-05-05', '2022-05-11', 'Gato', 'Hembra', 1),
(8, 'Leo', '2014-10-16', '2015-10-06', 'Perro', 'Macho', 1),
(9, 'Susu', '2021-04-30', NULL, 'Perro', 'Macho', 0),
(10, 'Nea', '2022-02-10', NULL, 'Perro', 'Hembra', 0),
(11, 'Kadie', '2022-05-27', NULL, 'Gato', 'Hembra', 0),
(12, 'Nea', '2022-01-03', NULL, 'Gato', 'Hembra', 0),
(13, 'Coco', '2022-05-13', NULL, 'Perro', 'Macho', 0),
(14, 'Hades', '2020-08-22', NULL, 'Perro', 'Macho', 0),
(15, 'Dory', '2021-08-26', NULL, 'Gato', 'Hembra', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `dniUsuario` varchar(10) NOT NULL,
  `usuPassword` varchar(157) NOT NULL,
  `usuTipo` enum('Gerente','Voluntario','Adoptante') NOT NULL,
  `usuNombre` varchar(50) NOT NULL,
  `usuApell` varchar(50) NOT NULL,
  `usuTel` char(10) DEFAULT NULL,
  `usuDir` varchar(50) DEFAULT NULL,
  `fechaNac` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`dniUsuario`, `usuPassword`, `usuTipo`, `usuNombre`, `usuApell`, `usuTel`, `usuDir`, `fechaNac`) VALUES
('00799446N', '6bc4333fc55be5cbb64a8c63df6ee0c3c7d1ca0cd84e82e2e388b9ec6ebb8484c7b228f9392711377398ac0d219636a71d5470663678df624f939450d6e95c1a', 'Voluntario', 'Javier', 'Fernández Pérez', '747963702', 'Calle CAMPO PEDRALBES, 92', '1989-05-03'),
('56880708Y', '98b991d219009e201fd01ed2e1456211f77513c815366f978b8fc99302fe36fea02d1128a59d5b9fdcc8c894ebc71aff0547a6e6b365c07385b45e491547b769', 'Voluntario', 'Berta', 'Egea Moya', '791395733', 'Calle PLACETA IGLESIA, 16', '1985-05-30'),
('71907370D', '8f7b7aaa435733b0de42b3c322c2a78973d80a6abb8ec5092fe48a148ca2375700190baa0753103412085e69b1746cc92ff8aa7c60cb5926e8fdf1cc67ebe031', 'Gerente', 'Nuria', 'Rodríguez Álvarez', NULL, NULL, '2001-07-21'),
('71974886C', '401ad2efeb9e9e8665e1c63d0d56fd53ff68d8e2ce1ec9345ed56c23c8230e54b3710b2c04f531ce423cc46387a3fe6e9545bfdd4ca2ee5b64ab4df13413c824', '', 'Elvis Daniel', 'Menéndez Muñiz', NULL, NULL, '2000-04-04'),
('87192769E', '20c35dfd39b7fe624023153c84a21daa0979776fba5e55a3fc5e30e133d5df7f68a043e27b65f64ccbe9ecebcf5af86e126d80446c252de5b387039f3fd6a32b', 'Adoptante', 'Miguel', 'Pinto Juarez', '701836779', 'BULEVAR CATALUNYA, 45', '1989-02-24'),
('94697803H', '1853ce75ff79c31168266625a7dbabd57cae6537c786c67f61eb2ac551443e65f54a9e9c6103423d6e936e848177cd563c7c00f5046ede028db24afbb268897b', 'Adoptante', 'Sara', 'Gómez Luque', '612340680', 'Calle Les Fuecanes,13', '2000-05-13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `actividades`
--
ALTER TABLE `actividades`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  ADD PRIMARY KEY (`idAdopcion`);

--
-- Indices de la tabla `animales`
--
ALTER TABLE `animales`
  ADD PRIMARY KEY (`idAnimal`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`dniUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `actividades`
--
ALTER TABLE `actividades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `adopciones`
--
ALTER TABLE `adopciones`
  MODIFY `idAdopcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `animales`
--
ALTER TABLE `animales`
  MODIFY `idAnimal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

ALTER TABLE `actividades`
  ADD CONSTRAINT `actividades_ibfk_1` FOREIGN KEY (`tipoActividad`) REFERENCES `tipoactividades` (`idActividad`),
  ADD CONSTRAINT `actividades_ibfk_2` FOREIGN KEY (`dniVoluntario`) REFERENCES `usuarios` (`dniUsuario`),
  ADD CONSTRAINT `actividades_ibfk_3` FOREIGN KEY (`idAnimal`) REFERENCES `animales` (`idAnimal`);

ALTER TABLE `adopciones`
  ADD CONSTRAINT `adopciones_ibfk_1` FOREIGN KEY (`dniAdoptante`) REFERENCES `usuarios` (`dniUsuario`),
  ADD CONSTRAINT `adopciones_ibfk_2` FOREIGN KEY (`idAnimal`) REFERENCES `animales` (`idAnimal`);


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
