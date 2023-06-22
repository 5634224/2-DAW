-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-05-2022 a las 11:30:40
-- Versión del servidor: 8.0.28-0ubuntu0.20.04.3
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `olimpiada2022`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `art_id` int NOT NULL,
  `art_nombre` varchar(50) NOT NULL,
  `art_precio_venta` decimal(10,2) NOT NULL,
  `art_genero` int NOT NULL,
  `art_precio_compra` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`art_id`, `art_nombre`, `art_precio_venta`, `art_genero`, `art_precio_compra`) VALUES
(1, 'Lápiz', '1.00', 1, '0.60'),
(2, 'Libreta', '2.00', 1, '1.20'),
(3, 'Bolígrafo', '1.50', 1, '1.00'),
(4, 'Paquete de folios', '4.00', 1, '2.80'),
(5, 'Ciencias Naturales', '25.00', 2, '20.00'),
(6, 'Matemáticas', '30.00', 2, '22.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cabeceras_ventas`
--

CREATE TABLE `cabeceras_ventas` (
  `cab_id` int NOT NULL,
  `cab_cliente` int NOT NULL,
  `cab_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cabeceras_ventas`
--

INSERT INTO `cabeceras_ventas` (`cab_id`, `cab_cliente`, `cab_fecha`) VALUES
(1, 4, '2022-05-01'),
(2, 1, '2022-05-04'),
(3, 2, '2022-05-02'),
(4, 3, '2022-05-04'),
(5, 5, '2022-05-03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carritos_compra`
--

CREATE TABLE `carritos_compra` (
  `car_id` int NOT NULL,
  `car_articulo` int NOT NULL,
  `car_cliente` int NOT NULL,
  `car_cantidad` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `carritos_compra`
--

INSERT INTO `carritos_compra` (`car_id`, `car_articulo`, `car_cliente`, `car_cantidad`) VALUES
(1, 3, 4, '5.00'),
(2, 5, 4, '1.00'),
(3, 2, 4, '1.00'),
(4, 1, 3, '4.00'),
(5, 2, 3, '2.00'),
(6, 6, 3, '1.00'),
(7, 4, 1, '1.00'),
(8, 6, 5, '1.00'),
(9, 1, 5, '10.00'),
(10, 2, 5, '4.00'),
(11, 3, 5, '8.00'),
(12, 4, 5, '3.00'),
(13, 1, 2, '3.00'),
(14, 2, 7, '4.00'),
(15, 1, 7, '8.00'),
(16, 2, 7, '1.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cli_id` int NOT NULL,
  `cli_nombre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`cli_id`, `cli_nombre`) VALUES
(1, 'Laura'),
(2, 'Bernardo'),
(3, 'Belén'),
(4, 'Alfredo'),
(5, 'Leandro'),
(6, 'Pedro'),
(7, 'Lucía');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `gen_id` int NOT NULL,
  `gen_nombre` varchar(50) NOT NULL,
  `gen_proveedor` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`gen_id`, `gen_nombre`, `gen_proveedor`) VALUES
(1, 'Papelería', 1),
(2, 'Librería', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_ventas`
--

CREATE TABLE `lineas_ventas` (
  `lin_id` int NOT NULL,
  `lin_cabecera` int NOT NULL,
  `lin_articulo` int NOT NULL,
  `lin_cantidad` decimal(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `lineas_ventas`
--

INSERT INTO `lineas_ventas` (`lin_id`, `lin_cabecera`, `lin_articulo`, `lin_cantidad`) VALUES
(1, 1, 5, '1.00'),
(2, 1, 6, '3.00'),
(3, 2, 1, '8.00'),
(4, 2, 2, '3.00'),
(5, 3, 5, '1.00'),
(6, 3, 1, '3.00'),
(7, 3, 4, '14.00'),
(8, 3, 2, '4.00'),
(9, 4, 1, '2.00'),
(10, 4, 2, '4.00'),
(11, 4, 5, '1.00'),
(12, 4, 6, '1.00'),
(13, 5, 2, '2.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `pro_id` int NOT NULL,
  `pro_nombre` varchar(50) NOT NULL,
  `pro_ciudad` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`pro_id`, `pro_nombre`, `pro_ciudad`) VALUES
(1, 'PPL Distribuidores', 'Cartagena'),
(2, 'Tus Libros S.A.', 'Murcia');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`art_id`),
  ADD KEY `fk_articulos_generos` (`art_genero`);

--
-- Indices de la tabla `cabeceras_ventas`
--
ALTER TABLE `cabeceras_ventas`
  ADD PRIMARY KEY (`cab_id`),
  ADD KEY `fk_cabeceras_clientes` (`cab_cliente`);

--
-- Indices de la tabla `carritos_compra`
--
ALTER TABLE `carritos_compra`
  ADD PRIMARY KEY (`car_id`),
  ADD KEY `fk_carritos_clientes` (`car_cliente`),
  ADD KEY `fk_carritos_articulos` (`car_articulo`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cli_id`);

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`gen_id`),
  ADD KEY `fk_generos_proveedores` (`gen_proveedor`);

--
-- Indices de la tabla `lineas_ventas`
--
ALTER TABLE `lineas_ventas`
  ADD PRIMARY KEY (`lin_id`),
  ADD KEY `fk_lineas_cabeceras` (`lin_cabecera`),
  ADD KEY `fk_lineas_articulos` (`lin_articulo`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`pro_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `art_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cabeceras_ventas`
--
ALTER TABLE `cabeceras_ventas`
  MODIFY `cab_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `carritos_compra`
--
ALTER TABLE `carritos_compra`
  MODIFY `car_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cli_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `gen_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `lineas_ventas`
--
ALTER TABLE `lineas_ventas`
  MODIFY `lin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `pro_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `fk_articulos_generos` FOREIGN KEY (`art_genero`) REFERENCES `generos` (`gen_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `cabeceras_ventas`
--
ALTER TABLE `cabeceras_ventas`
  ADD CONSTRAINT `fk_cabeceras_clientes` FOREIGN KEY (`cab_cliente`) REFERENCES `clientes` (`cli_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `carritos_compra`
--
ALTER TABLE `carritos_compra`
  ADD CONSTRAINT `fk_carritos_articulos` FOREIGN KEY (`car_articulo`) REFERENCES `articulos` (`art_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_carritos_clientes` FOREIGN KEY (`car_cliente`) REFERENCES `clientes` (`cli_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `generos`
--
ALTER TABLE `generos`
  ADD CONSTRAINT `fk_generos_proveedores` FOREIGN KEY (`gen_proveedor`) REFERENCES `proveedores` (`pro_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Filtros para la tabla `lineas_ventas`
--
ALTER TABLE `lineas_ventas`
  ADD CONSTRAINT `fk_lineas_articulos` FOREIGN KEY (`lin_articulo`) REFERENCES `articulos` (`art_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_lineas_cabeceras` FOREIGN KEY (`lin_cabecera`) REFERENCES `cabeceras_ventas` (`cab_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
