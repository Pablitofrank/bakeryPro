-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2024 a las 16:55:29
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bakerypro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblcategorias`
--

CREATE TABLE `tblcategorias` (
  `IdCategoria` int(3) NOT NULL,
  `Categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblcategorias`
--

INSERT INTO `tblcategorias` (`IdCategoria`, `Categoria`) VALUES
(1, 'lacteos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblentradasinsumos`
--

CREATE TABLE `tblentradasinsumos` (
  `IdEntradaInsumo` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `IdInsumo` int(3) NOT NULL,
  `cantidadInsumo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblfactura`
--

CREATE TABLE `tblfactura` (
  `IdFactura` int(5) NOT NULL,
  `CantidadInsumo` decimal(5,0) NOT NULL,
  `NumeroFactura` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `IdProveedor` int(3) NOT NULL,
  `IdUnidadMedida` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinfac`
--

CREATE TABLE `tblinfac` (
  `IdFactura` int(5) NOT NULL,
  `IdInsumo` int(3) NOT NULL,
  `CantidadInsumo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblinsumos`
--

CREATE TABLE `tblinsumos` (
  `IdInsumo` int(3) NOT NULL,
  `NombreInsumo` varchar(30) NOT NULL,
  `Stock` decimal(5,0) NOT NULL,
  `IdUnidadMedida` int(3) NOT NULL,
  `IdCategoria` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblinsumos`
--

INSERT INTO `tblinsumos` (`IdInsumo`, `NombreInsumo`, `Stock`, `IdUnidadMedida`, `IdCategoria`) VALUES
(8, 'leche', 2, 1, 1),
(9, 'harina', 1000, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproductos`
--

CREATE TABLE `tblproductos` (
  `IdProducto` int(3) NOT NULL,
  `NombreProducto` varchar(20) NOT NULL,
  `Stock` decimal(5,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblproductos`
--

INSERT INTO `tblproductos` (`IdProducto`, `NombreProducto`, `Stock`) VALUES
(3, 'pan rollo', 300),
(4, 'panochon', 0),
(5, 'panochon', 0),
(6, 'panochon', 0),
(7, 'panc', 0),
(8, 'panc', 0),
(9, 'paaaaa', 0),
(10, 'q', 0),
(11, 'qq', 0),
(12, 'aaaa', 0),
(13, 'apapapa', 0),
(14, 'qw', 0),
(15, 'qqqq', 0),
(16, 'w', 0),
(17, 'qdasd', 0),
(18, 'we', 0),
(19, 'panc', 0),
(20, 'sdasd', 0),
(21, 'pancqwe', 0),
(22, 'asdasda', 0),
(23, 'asdasda', 0),
(24, 'asdasda', 0),
(25, 'weeee', 0),
(26, 'wasda', 0),
(27, 'asdasd', 0),
(28, 'qqqqq', 0),
(29, 'asdasdasdas', 0),
(30, 'pan rolloooo', 0),
(31, 'aaaaaaaa', 0),
(32, 'pon', 0),
(33, 'pon', 0),
(34, 'qqwe', 0),
(35, 'panochon', 0),
(36, 'galleta ', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblproveedores`
--

CREATE TABLE `tblproveedores` (
  `IdProveedores` int(3) NOT NULL,
  `NIT` decimal(15,0) NOT NULL,
  `RazonSocial` varchar(20) NOT NULL,
  `Contacto` varchar(40) NOT NULL,
  `Telefono` decimal(10,0) NOT NULL,
  `Correo` varchar(20) NOT NULL,
  `Direccion` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblrecetas`
--

CREATE TABLE `tblrecetas` (
  `CantidadInsumo` decimal(5,0) NOT NULL,
  `IdProducto` int(3) NOT NULL,
  `IdInsumo` int(3) NOT NULL,
  `IdUnidadMedida` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblrecetas`
--

INSERT INTO `tblrecetas` (`CantidadInsumo`, `IdProducto`, `IdInsumo`, `IdUnidadMedida`) VALUES
(1, 4, 8, 2),
(10, 12, 8, 1),
(32, 27, 9, 3),
(11, 28, 9, 2),
(21, 29, 9, 2),
(23, 30, 9, 2),
(12, 31, 9, 2),
(2, 35, 9, 1),
(23, 35, 8, 2),
(1, 36, 8, 1),
(2, 36, 9, 2),
(3, 36, 8, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblroles`
--

CREATE TABLE `tblroles` (
  `IdRol` int(3) NOT NULL,
  `Rol` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblroles`
--

INSERT INTO `tblroles` (`IdRol`, `Rol`) VALUES
(1, 'ADMINISTRADOR'),
(2, 'EMPLEADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblsalidasinsumos`
--

CREATE TABLE `tblsalidasinsumos` (
  `IdSalidaInsumo` int(5) NOT NULL,
  `fecha` date NOT NULL,
  `IdInsumo` int(3) NOT NULL,
  `cantidadInsumo` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblunidadesmedidas`
--

CREATE TABLE `tblunidadesmedidas` (
  `IdUnidadMedida` int(3) NOT NULL,
  `medida` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblunidadesmedidas`
--

INSERT INTO `tblunidadesmedidas` (`IdUnidadMedida`, `medida`) VALUES
(1, 'kg'),
(2, 'ml'),
(3, 'lt'),
(4, 'unidad'),
(5, 'docena');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tblusuario`
--

CREATE TABLE `tblusuario` (
  `IdUsuario` int(3) NOT NULL,
  `Nombres` varchar(20) NOT NULL,
  `Apellidos` varchar(20) NOT NULL,
  `IdRol` int(3) NOT NULL,
  `Cedula` decimal(10,0) NOT NULL,
  `Telefono` varchar(20) NOT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblusuario`
--

INSERT INTO `tblusuario` (`IdUsuario`, `Nombres`, `Apellidos`, `IdRol`, `Cedula`, `Telefono`, `Password`) VALUES
(25, 'kujk', 'lyyj', 1, 8752, '52741', ''),
(26, 'ege2', 'w1gwsgdgefg', 1, 0, 'fgdfgd', ''),
(27, 'wgsf', 'jhkjfbds', 2, 0, 'fhgsdjg', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tblcategorias`
--
ALTER TABLE `tblcategorias`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `tblentradasinsumos`
--
ALTER TABLE `tblentradasinsumos`
  ADD PRIMARY KEY (`IdEntradaInsumo`),
  ADD KEY `entradasIns` (`IdInsumo`);

--
-- Indices de la tabla `tblfactura`
--
ALTER TABLE `tblfactura`
  ADD PRIMARY KEY (`IdFactura`),
  ADD KEY `IdInsumo` (`IdProveedor`,`IdUnidadMedida`),
  ADD KEY `IdProveedor` (`IdProveedor`),
  ADD KEY `IdUnidadMedida` (`IdUnidadMedida`);

--
-- Indices de la tabla `tblinfac`
--
ALTER TABLE `tblinfac`
  ADD KEY `fac` (`IdFactura`),
  ADD KEY `ins` (`IdInsumo`);

--
-- Indices de la tabla `tblinsumos`
--
ALTER TABLE `tblinsumos`
  ADD PRIMARY KEY (`IdInsumo`),
  ADD KEY `IdUnidadMedida` (`IdUnidadMedida`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  ADD PRIMARY KEY (`IdProducto`);

--
-- Indices de la tabla `tblproveedores`
--
ALTER TABLE `tblproveedores`
  ADD PRIMARY KEY (`IdProveedores`);

--
-- Indices de la tabla `tblrecetas`
--
ALTER TABLE `tblrecetas`
  ADD KEY `IdProducto` (`IdProducto`,`IdInsumo`),
  ADD KEY `IdInsumo` (`IdInsumo`);

--
-- Indices de la tabla `tblroles`
--
ALTER TABLE `tblroles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `tblsalidasinsumos`
--
ALTER TABLE `tblsalidasinsumos`
  ADD PRIMARY KEY (`IdSalidaInsumo`),
  ADD KEY `salidasIns` (`IdInsumo`);

--
-- Indices de la tabla `tblunidadesmedidas`
--
ALTER TABLE `tblunidadesmedidas`
  ADD PRIMARY KEY (`IdUnidadMedida`);

--
-- Indices de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `Rol` (`IdRol`),
  ADD KEY `IdRol` (`IdRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tblcategorias`
--
ALTER TABLE `tblcategorias`
  MODIFY `IdCategoria` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tblentradasinsumos`
--
ALTER TABLE `tblentradasinsumos`
  MODIFY `IdEntradaInsumo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblinsumos`
--
ALTER TABLE `tblinsumos`
  MODIFY `IdInsumo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `IdProducto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `tblproveedores`
--
ALTER TABLE `tblproveedores`
  MODIFY `IdProveedores` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblsalidasinsumos`
--
ALTER TABLE `tblsalidasinsumos`
  MODIFY `IdSalidaInsumo` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tblunidadesmedidas`
--
ALTER TABLE `tblunidadesmedidas`
  MODIFY `IdUnidadMedida` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `IdUsuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tblentradasinsumos`
--
ALTER TABLE `tblentradasinsumos`
  ADD CONSTRAINT `entradasIns` FOREIGN KEY (`IdInsumo`) REFERENCES `tblinsumos` (`IdInsumo`);

--
-- Filtros para la tabla `tblfactura`
--
ALTER TABLE `tblfactura`
  ADD CONSTRAINT `tblfactura_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `tblproveedores` (`IdProveedores`),
  ADD CONSTRAINT `tblfactura_ibfk_3` FOREIGN KEY (`IdUnidadMedida`) REFERENCES `tblunidadesmedidas` (`IdUnidadMedida`);

--
-- Filtros para la tabla `tblinfac`
--
ALTER TABLE `tblinfac`
  ADD CONSTRAINT `fac` FOREIGN KEY (`IdFactura`) REFERENCES `tblfactura` (`IdFactura`),
  ADD CONSTRAINT `ins` FOREIGN KEY (`IdInsumo`) REFERENCES `tblinsumos` (`IdInsumo`);

--
-- Filtros para la tabla `tblinsumos`
--
ALTER TABLE `tblinsumos`
  ADD CONSTRAINT `tblinsumos_ibfk_1` FOREIGN KEY (`IdUnidadMedida`) REFERENCES `tblunidadesmedidas` (`IdUnidadMedida`),
  ADD CONSTRAINT `tblinsumos_ibfk_2` FOREIGN KEY (`IdCategoria`) REFERENCES `tblcategorias` (`IdCategoria`);

--
-- Filtros para la tabla `tblrecetas`
--
ALTER TABLE `tblrecetas`
  ADD CONSTRAINT `tblrecetas_ibfk_1` FOREIGN KEY (`IdProducto`) REFERENCES `tblproductos` (`IdProducto`),
  ADD CONSTRAINT `tblrecetas_ibfk_2` FOREIGN KEY (`IdInsumo`) REFERENCES `tblinsumos` (`IdInsumo`),
  ADD CONSTRAINT `tblrecetas_ibfk_3` FOREIGN KEY (`IdUnidadMedida`) REFERENCES `tblunidadesmedidas` (`IdUnidadMedida`);

--
-- Filtros para la tabla `tblsalidasinsumos`
--
ALTER TABLE `tblsalidasinsumos`
  ADD CONSTRAINT `salidasIns` FOREIGN KEY (`IdInsumo`) REFERENCES `tblinsumos` (`IdInsumo`);

--
-- Filtros para la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  ADD CONSTRAINT `tblusuario_ibfk_1` FOREIGN KEY (`IdRol`) REFERENCES `tblroles` (`IdRol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;