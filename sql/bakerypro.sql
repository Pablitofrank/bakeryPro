-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-03-2024 a las 23:22:48
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
  `IdFactura` int(3) NOT NULL,
  `CantidadInsumo` decimal(5,0) NOT NULL,
  `NumeroFactura` varchar(20) NOT NULL,
  `Fecha` date NOT NULL,
  `idInsumo` int(3) NOT NULL,
  `IdProveedor` int(3) NOT NULL,
  `IdUnidadMedida` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tblfactura`
--

INSERT INTO `tblfactura` (`IdFactura`, `CantidadInsumo`, `NumeroFactura`, `Fecha`, `idInsumo`, `IdProveedor`, `IdUnidadMedida`) VALUES
(2, 100, '12', '1222-02-12', 8, 1, 1),
(3, 100, '12', '1222-02-12', 8, 1, 1);

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
(8, 'leche', -1462, 1, 1),
(9, 'harina', -464, 1, 1),
(11, 'a', 30, 1, 1),
(12, 'Levadura', 500, 1, 1);

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
(37, 'Pan hojaldrado', 0);

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

--
-- Volcado de datos para la tabla `tblproveedores`
--

INSERT INTO `tblproveedores` (`IdProveedores`, `NIT`, `RazonSocial`, `Contacto`, `Telefono`, `Correo`, `Direccion`) VALUES
(1, 345, 'Colgate', '4534', 30000, '53453', '45345'),
(3, 0, '234234', '234234', 2342342342, '42342', '3423'),
(4, 121212, 'BIMBO', 'JUANITO EL CARTERO', 3044286371, 'BIMBO@GMAIL.COM', 'LA CASA DE SU CUCHA');

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
(12, 37, 8, 1),
(12, 37, 9, 5);

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

--
-- Volcado de datos para la tabla `tblsalidasinsumos`
--

INSERT INTO `tblsalidasinsumos` (`IdSalidaInsumo`, `fecha`, `IdInsumo`, `cantidadInsumo`) VALUES
(1, '2024-03-15', 8, 12),
(2, '2024-03-15', 9, 12),
(3, '2024-03-18', 8, 12),
(4, '2024-03-18', 9, 12),
(5, '2024-03-18', 8, 120),
(6, '2024-03-18', 9, 120),
(7, '2024-03-18', 8, 1200),
(8, '2024-03-18', 9, 1200),
(9, '2024-03-18', 8, 120),
(10, '2024-03-18', 9, 120);

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
(30, 'Andrés', 'Martínez', 1, 1000862445, '3044286371', '');

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
  ADD KEY `IdInsumo` (`IdInsumo`),
  ADD KEY `tblrecetas_ibfk_3` (`IdUnidadMedida`);

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
-- AUTO_INCREMENT de la tabla `tblfactura`
--
ALTER TABLE `tblfactura`
  MODIFY `IdFactura` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblinsumos`
--
ALTER TABLE `tblinsumos`
  MODIFY `IdInsumo` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `tblproductos`
--
ALTER TABLE `tblproductos`
  MODIFY `IdProducto` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `tblproveedores`
--
ALTER TABLE `tblproveedores`
  MODIFY `IdProveedores` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tblsalidasinsumos`
--
ALTER TABLE `tblsalidasinsumos`
  MODIFY `IdSalidaInsumo` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tblunidadesmedidas`
--
ALTER TABLE `tblunidadesmedidas`
  MODIFY `IdUnidadMedida` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tblusuario`
--
ALTER TABLE `tblusuario`
  MODIFY `IdUsuario` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
