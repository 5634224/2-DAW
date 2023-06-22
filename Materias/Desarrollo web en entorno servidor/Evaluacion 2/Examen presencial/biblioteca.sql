-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 23-01-2023 a las 23:20:59
-- Versión del servidor: 8.0.31-0ubuntu0.22.04.1
-- Versión de PHP: 8.1.2-1ubuntu2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `biblio2020`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `AuditoriaPrestamos`
--

CREATE TABLE `AuditoriaPrestamos` (
  `aud_id` int NOT NULL,
  `aud_usuario` varchar(40) NOT NULL,
  `aud_prestamo` int NOT NULL,
  `aud_operacion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `AuditoriaPrestamos`
--

INSERT INTO `AuditoriaPrestamos` (`aud_id`, `aud_usuario`, `aud_prestamo`, `aud_operacion`) VALUES
(1, 'super@localhost', 49, 'INSERT'),
(2, 'super@localhost', 49, 'UPDATE-OLD'),
(3, 'super@localhost', 49, 'UPDATE-NEW'),
(4, 'super@localhost', 49, 'UPDATE-OLD'),
(5, 'super@localhost', 50, 'UPDATE-NEW'),
(6, 'super@localhost', 3, 'UPDATE-OLD'),
(7, 'super@localhost', 3, 'UPDATE-NEW'),
(8, 'super@localhost', 24, 'UPDATE-OLD'),
(9, 'super@localhost', 24, 'UPDATE-NEW');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Autores`
--

CREATE TABLE `Autores` (
  `aut_id` int NOT NULL,
  `aut_nombre` varchar(40) NOT NULL,
  `aut_nacimiento` smallint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Autores`
--

INSERT INTO `Autores` (`aut_id`, `aut_nombre`, `aut_nacimiento`) VALUES
(1, 'Miguel de Cervantes', 1547),
(2, 'Pedro Calderón de la Barca', 1600),
(3, 'Lope de Vega', 1562),
(4, 'Francisco de Quevedo', 1580),
(5, 'Luis de Góngora', 1561);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Compras`
--

CREATE TABLE `Compras` (
  `com_id` int NOT NULL,
  `com_fecha` date NOT NULL,
  `com_socio` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Compras`
--

INSERT INTO `Compras` (`com_id`, `com_fecha`, `com_socio`) VALUES
(1, '2019-03-03', 1),
(2, '2019-03-03', 1),
(3, '2019-03-04', 1),
(4, '2019-03-07', 1),
(5, '2019-04-03', 1),
(6, '2019-04-04', 1),
(7, '2019-05-03', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Detalles`
--

CREATE TABLE `Detalles` (
  `det_id` int NOT NULL,
  `det_cantidad` int NOT NULL,
  `det_libro` varchar(13) NOT NULL,
  `det_compra` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Detalles`
--

INSERT INTO `Detalles` (`det_id`, `det_cantidad`, `det_libro`, `det_compra`) VALUES
(1, 3, '1234567890123', 1),
(2, 2, '1234567890126', 2),
(3, 3, '1234567890123', 2),
(4, 2, '1234567890126', 3),
(5, 3, '1234567890123', 3),
(6, 2, '1234567890126', 4),
(7, 3, '1234567890123', 5),
(8, 2, '1234567890126', 6),
(9, 3, '1234567890123', 6),
(10, 2, '1234567890126', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Ejemplares`
--

CREATE TABLE `Ejemplares` (
  `eje_libro` varchar(13) NOT NULL,
  `eje_signatura` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Ejemplares`
--

INSERT INTO `Ejemplares` (`eje_libro`, `eje_signatura`) VALUES
('1234567890123', 'N01'),
('1234567890123', 'N02'),
('1234567890123', 'N03'),
('1234567890124', 'N04'),
('1234567890124', 'N05'),
('1234567890125', 'P01'),
('1234567890125', 'P02'),
('1234567890126', 'T01'),
('1234567890126', 'T02'),
('1234567890126', 'T03'),
('1234567890126', 'T04'),
('1234567890127', 'T05'),
('1234567890127', 'T06'),
('1234567890128', 'N06'),
('1234567890128', 'N07'),
('1234567890135', 'T07'),
('1234567890135', 'T08'),
('1234567890135', 'T09'),
('1234567890136', 'N08'),
('1234567890136', 'N09'),
('1234567890137', 'T10'),
('1234567890137', 'T11'),
('1234567890145', 'P03'),
('1234567890145', 'P04'),
('1234567890165', 'P05'),
('1234567890165', 'P06'),
('1234567890225', 'P07'),
('1234567890225', 'P08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Libros`
--

CREATE TABLE `Libros` (
  `lib_titulo` varchar(50) NOT NULL,
  `lib_genero` varchar(30) NOT NULL,
  `lib_autor` int NOT NULL,
  `lib_isbn` varchar(13) NOT NULL,
  `lib_prestado` int NOT NULL DEFAULT '0',
  `lib_sindevolver` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Libros`
--

INSERT INTO `Libros` (`lib_titulo`, `lib_genero`, `lib_autor`, `lib_isbn`, `lib_prestado`, `lib_sindevolver`) VALUES
('Don Quijote de la Mancha', 'NOVELA', 1, '1234567890123', 1, 0),
('Novelas Ejemplares', 'NOVELA', 1, '1234567890124', 0, 0),
('Viaje al Parnaso', 'POESÍA', 1, '1234567890125', 0, 1),
('La vida es sueño', 'TEATRO', 2, '1234567890126', 0, 0),
('El alcalde de Zalamea', 'TEATRO', 2, '1234567890127', 0, 1),
('La Arcadia', 'NOVELA', 3, '1234567890128', 0, 0),
('Fuenteovejuna', 'TEATRO', 3, '1234567890135', 0, 0),
('El Buscón', 'NOVELA', 4, '1234567890136', 0, 0),
('Entremeses', 'TEATRO', 4, '1234567890137', 0, 0),
('Sonetos', 'POESÍA', 4, '1234567890145', 0, 0),
('El Caballero de Olmedo', 'TEATRO', 3, '1234567890146', 0, 0),
('Soledades', 'POESÍA', 5, '1234567890165', 0, 0),
('Polifemo', 'POESÍA', 5, '1234567890225', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Prestamos`
--

CREATE TABLE `Prestamos` (
  `pre_id` int NOT NULL,
  `pre_fecha` date NOT NULL,
  `pre_devolucion` date DEFAULT NULL,
  `pre_socio` int NOT NULL,
  `pre_ejemplar` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Prestamos`
--

INSERT INTO `Prestamos` (`pre_id`, `pre_fecha`, `pre_devolucion`, `pre_socio`, `pre_ejemplar`) VALUES
(1, '2018-12-01', '2018-12-05', 1, 'N01'),
(2, '2018-12-03', '2018-12-06', 1, 'T01'),
(3, '2018-12-03', NULL, 1, 'P01'),
(4, '2018-12-04', '2018-12-07', 2, 'N02'),
(5, '2018-12-04', '2018-12-09', 2, 'T02'),
(6, '2018-12-04', '2018-12-09', 2, 'T09'),
(7, '2018-12-05', '2018-12-09', 3, 'N03'),
(8, '2018-12-05', '2018-12-09', 3, 'T03'),
(9, '2018-12-05', '2018-12-09', 3, 'T08'),
(10, '2018-12-06', '2018-12-13', 4, 'P03'),
(11, '2018-12-06', '2018-12-13', 4, 'P05'),
(12, '2018-12-06', '2018-12-13', 4, 'N07'),
(13, '2018-12-07', '2018-12-11', 5, 'P06'),
(14, '2018-12-07', '2018-12-11', 5, 'P04'),
(15, '2018-12-07', '2018-12-11', 5, 'P08'),
(16, '2018-12-08', '2018-12-12', 7, 'T05'),
(17, '2018-12-08', '2018-12-12', 7, 'T04'),
(18, '2018-12-14', '2018-12-18', 1, 'T04'),
(19, '2018-12-14', '2018-12-18', 1, 'P04'),
(20, '2018-12-14', '2018-12-18', 1, 'N06'),
(21, '2018-12-15', '2018-12-20', 3, 'N01'),
(22, '2018-12-15', '2018-12-20', 3, 'N05'),
(23, '2018-12-15', '2018-12-20', 3, 'T07'),
(24, '2018-12-15', NULL, 6, 'T06'),
(25, '2018-12-15', '2018-12-21', 6, 'N02'),
(26, '2018-12-15', '2018-12-21', 6, 'N04'),
(27, '2018-12-22', '2018-12-26', 2, 'N04'),
(28, '2018-12-22', '2018-12-26', 2, 'T04'),
(29, '2018-12-22', '2018-12-26', 2, 'P04'),
(30, '2018-12-22', '2018-12-25', 7, 'N01'),
(31, '2018-12-22', '2018-12-25', 7, 'T01'),
(32, '2018-12-22', '2018-12-25', 7, 'P01'),
(33, '2018-12-22', '2018-12-25', 7, 'T08'),
(41, '2018-12-31', '2019-01-05', 7, 'N01'),
(42, '2018-12-31', '2019-01-05', 7, 'N04'),
(43, '2018-12-31', '2019-01-05', 7, 'N07'),
(44, '2018-01-03', '2019-01-08', 6, 'N02'),
(45, '2018-01-03', '2019-01-08', 6, 'N05'),
(46, '2018-01-03', '2019-01-08', 6, 'T01'),
(47, '2018-01-03', '2019-01-08', 6, 'T06'),
(50, '2021-03-02', '2021-03-02', 6, 'N01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Socios`
--

CREATE TABLE `Socios` (
  `soc_id` int NOT NULL,
  `soc_dni` varchar(9) NOT NULL,
  `soc_nombre` varchar(20) NOT NULL,
  `soc_ciudad` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Socios`
--

INSERT INTO `Socios` (`soc_id`, `soc_dni`, `soc_nombre`, `soc_ciudad`) VALUES
(1, '12345678Z', 'Pepe', 'Cartagena'),
(2, '58566178J', 'María', 'Cartagena'),
(3, '58123178Q', 'Juan', 'La Unión'),
(4, '19123178N', 'Laura', 'Torre Pacheco'),
(5, '19121234T', 'Félix', 'Cartagena'),
(6, '11121277H', 'Pepi', 'Fuente Álamo'),
(7, '15789456W', 'Verónica', 'La Unión'),
(8, '23000001R', 'Alfredo', 'Torre-Pacheco'),
(9, '23000002W', 'Lucía', 'Murcia'),
(10, '23000003A', 'Estefanía', 'Caravaca'),
(11, '', 'ofimatica cartagena', ''),
(12, '23003795T', 'Jose Antonio', 'Cartagena');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `AuditoriaPrestamos`
--
ALTER TABLE `AuditoriaPrestamos`
  ADD PRIMARY KEY (`aud_id`);

--
-- Indices de la tabla `Autores`
--
ALTER TABLE `Autores`
  ADD PRIMARY KEY (`aut_id`);

--
-- Indices de la tabla `Compras`
--
ALTER TABLE `Compras`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `fk_com_socio` (`com_socio`);

--
-- Indices de la tabla `Detalles`
--
ALTER TABLE `Detalles`
  ADD PRIMARY KEY (`det_id`),
  ADD KEY `fk_det_libro` (`det_libro`),
  ADD KEY `fk_detalle_compra` (`det_compra`);

--
-- Indices de la tabla `Ejemplares`
--
ALTER TABLE `Ejemplares`
  ADD PRIMARY KEY (`eje_signatura`),
  ADD KEY `fk_eje_libro` (`eje_libro`);

--
-- Indices de la tabla `Libros`
--
ALTER TABLE `Libros`
  ADD PRIMARY KEY (`lib_isbn`),
  ADD KEY `fk_lib_autor` (`lib_autor`);

--
-- Indices de la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD PRIMARY KEY (`pre_id`),
  ADD KEY `fk_pre_socio` (`pre_socio`),
  ADD KEY `fk_pre_ejemplar` (`pre_ejemplar`);

--
-- Indices de la tabla `Socios`
--
ALTER TABLE `Socios`
  ADD PRIMARY KEY (`soc_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `AuditoriaPrestamos`
--
ALTER TABLE `AuditoriaPrestamos`
  MODIFY `aud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `Autores`
--
ALTER TABLE `Autores`
  MODIFY `aut_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Compras`
--
ALTER TABLE `Compras`
  MODIFY `com_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `Detalles`
--
ALTER TABLE `Detalles`
  MODIFY `det_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  MODIFY `pre_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `Socios`
--
ALTER TABLE `Socios`
  MODIFY `soc_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Compras`
--
ALTER TABLE `Compras`
  ADD CONSTRAINT `fk_com_socio` FOREIGN KEY (`com_socio`) REFERENCES `Socios` (`soc_id`);

--
-- Filtros para la tabla `Detalles`
--
ALTER TABLE `Detalles`
  ADD CONSTRAINT `fk_detalle_compra` FOREIGN KEY (`det_compra`) REFERENCES `Compras` (`com_id`),
  ADD CONSTRAINT `fk_detalle_libro` FOREIGN KEY (`det_libro`) REFERENCES `Libros` (`lib_isbn`);

--
-- Filtros para la tabla `Ejemplares`
--
ALTER TABLE `Ejemplares`
  ADD CONSTRAINT `fk_ejemplar_libro` FOREIGN KEY (`eje_libro`) REFERENCES `Libros` (`lib_isbn`);

--
-- Filtros para la tabla `Libros`
--
ALTER TABLE `Libros`
  ADD CONSTRAINT `fk_lib_autor` FOREIGN KEY (`lib_autor`) REFERENCES `Autores` (`aut_id`);

--
-- Filtros para la tabla `Prestamos`
--
ALTER TABLE `Prestamos`
  ADD CONSTRAINT `fk_pre_socio` FOREIGN KEY (`pre_socio`) REFERENCES `Socios` (`soc_id`),
  ADD CONSTRAINT `fk_prestamos_ejemplares` FOREIGN KEY (`pre_ejemplar`) REFERENCES `Ejemplares` (`eje_signatura`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
