-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-07-2026 a las 01:23:21
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
-- Base de datos: `sisventas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` char(2) NOT NULL,
  `nomcategoria` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nomcategoria`) VALUES
('01', 'Bebidas'),
('02', 'Abarrotes'),
('03', 'Lácteos'),
('04', 'Limpieza'),
('05', 'Golosinas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` varchar(10) NOT NULL,
  `nomcliente` varchar(128) NOT NULL,
  `ruccliente` varchar(11) DEFAULT NULL,
  `dircliente` varchar(128) DEFAULT NULL,
  `telcliente` varchar(9) DEFAULT NULL,
  `emailcliente` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nomcliente`, `ruccliente`, `dircliente`, `telcliente`, `emailcliente`) VALUES
('CLI0000001', 'Tienda La Esquina S.A.C.', '20601234561', 'Av. Ejercito 123', '955111222', 'esquina@gmail.com'),
('CLI0000002', 'Supermercado El Sol', '20601234562', 'Calle Mercaderes 456', '955111223', 'elsol@gmail.com'),
('CLI0000003', 'Bodega Doña Rosa', '10456789012', 'Av. Goyeneche 789', '955111224', 'rosa@gmail.com'),
('CLI0000004', 'Bazar Central', '10456789013', 'Calle San Juan 321', '955111225', 'bazar@gmail.com'),
('CLI0000005', 'Minimarket Los Andes', '20601234565', 'Av. Dolores 654', '955111226', 'losandes@gmail.com'),
('CLI0000006', 'Comercial Santa Rosa', '10456789014', 'Calle Grau 987', '955111227', 'santarosa@gmail.com'),
('CLI0000007', 'Inversiones AQP', '20601234567', 'Av. Venezuela 150', '955111228', 'inversiones@gmail.com'),
('CLI0000008', 'Librería y Variedades', '10456789015', 'Calle Bolivar 200', '955111229', 'variedades@gmail.com'),
('CLI0000009', 'Multiservicios Sur', '20601234569', 'Av. Lambramani 500', '955111230', 'sur@gmail.com'),
('CLI0000010', 'Market San Martín', '10456789016', 'Calle Lima 110', '955111231', 'sanmartin@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condicionventa`
--

CREATE TABLE `condicionventa` (
  `idcondicion` char(2) NOT NULL,
  `nomcondicion` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `condicionventa`
--

INSERT INTO `condicionventa` (`idcondicion`, `nomcondicion`) VALUES
('01', 'Contado'),
('02', 'Crédito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `iddetalle` int(11) NOT NULL,
  `idfactura` int(11) DEFAULT NULL,
  `idproducto` varchar(10) DEFAULT NULL,
  `cant` int(11) DEFAULT NULL,
  `cosuni` decimal(10,4) DEFAULT NULL,
  `preuni` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`iddetalle`, `idfactura`, `idproducto`, `cant`, `cosuni`, `preuni`) VALUES
(1, 1, 'PROD000002', 2, 7.2000, 9.8000),
(2, 1, 'PROD000008', 3, 4.0000, 5.5000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `idfactura` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `idcliente` varchar(10) DEFAULT NULL,
  `idproveedor` varchar(3) DEFAULT NULL,
  `fechareg` datetime DEFAULT current_timestamp(),
  `idcondicion` char(2) DEFAULT NULL,
  `valorventa` decimal(10,4) DEFAULT NULL,
  `igv` decimal(10,4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`idfactura`, `fecha`, `idcliente`, `idproveedor`, `fechareg`, `idcondicion`, `valorventa`, `igv`) VALUES
(1, '2026-07-26', 'CLI0000001', NULL, '2026-07-26 16:46:47', '01', 30.5932, 5.5068);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` varchar(10) NOT NULL,
  `idproveedor` varchar(3) DEFAULT NULL,
  `nomproducto` varchar(128) NOT NULL,
  `unimed` varchar(15) DEFAULT NULL,
  `stock` int(11) DEFAULT 0,
  `cosuni` decimal(10,4) DEFAULT 0.0000,
  `preuni` decimal(10,4) DEFAULT 0.0000,
  `idcategoria` char(2) DEFAULT NULL,
  `estado` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `idproveedor`, `nomproducto`, `unimed`, `stock`, `cosuni`, `preuni`, `idcategoria`, `estado`) VALUES
('PROD000001', 'P03', 'Cerveza Pilsen 620ml', 'Botella', 120, 4.5000, 7.0000, '01', '1'),
('PROD000002', 'P01', 'Aceite Primor 1L', 'Botella', 78, 7.2000, 9.8000, '02', '1'),
('PROD000003', 'P02', 'Leche Gloria Azul 400g', 'Lata', 150, 3.1000, 4.2000, '03', '1'),
('PROD000004', 'P04', 'Sublime Extrem 35g', 'Unidad', 200, 1.2000, 2.0000, '05', '1'),
('PROD000005', 'P05', 'Detergente Ace 800g', 'Bolsa', 60, 6.0000, 8.5000, '04', '1'),
('PROD000006', 'P01', 'Fideos Don Vittorio Spaghetti 500g', 'Bolsa', 120, 2.0000, 3.2000, '02', '1'),
('PROD000007', 'P02', 'Yogurt Gloria Fresa 1L', 'Botella', 40, 4.8000, 6.8000, '03', '1'),
('PROD000008', 'P03', 'Gaseosa Coca Cola 1.5L', 'Botella', 87, 4.0000, 5.5000, '01', '1'),
('PROD000009', 'P06', 'Jabón Lux 125g', 'Unidad', 110, 1.8000, 2.8000, '04', '1'),
('PROD000010', 'P04', 'Galletas Sublime 6pk', 'Paquete', 75, 3.5000, 5.0000, '05', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` varchar(3) NOT NULL,
  `nomproveedor` varchar(128) NOT NULL,
  `rucproveedor` varchar(11) DEFAULT NULL,
  `dirproveedor` varchar(128) DEFAULT NULL,
  `telproveedor` varchar(9) DEFAULT NULL,
  `emailproveedor` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`idproveedor`, `nomproveedor`, `rucproveedor`, `dirproveedor`, `telproveedor`, `emailproveedor`) VALUES
('P01', 'Alicorp S.A.A.', '20100055237', 'Av. Argentina 4793', '987654321', 'contacto@alicorp.com'),
('P02', 'Gloria S.A.', '20100190797', 'Av. República de Panamá 2461', '987654322', 'ventas@gloria.com'),
('P03', 'Backus & Johnston', '20100113610', 'Av. Nicolás de Piérola 400', '987654323', 'contacto@backus.com'),
('P04', 'Nestlé Perú', '20100166993', 'Av. Las Begonias 441', '987654324', 'ventas@nestle.com'),
('P05', 'Procter & Gamble', '20215160869', 'Av. Materiales 3049', '987654325', 'contacto@pg.com'),
('P06', 'Unilever Perú', '20100010993', 'Av. Paseo de la República 3587', '987654326', 'ventas@unilever.com'),
('P07', 'Molinera Inca', '20100543210', 'Av. Industrial 123', '987654327', 'ventas@inca.com'),
('P08', 'Distribuidora Lima', '20501234567', 'Jr. Ascope 540', '987654328', 'contacto@limadist.com'),
('P09', 'Comercial Arequipa', '20409876543', 'Av. Parra 100', '987654329', 'ventas@comarequipa.com'),
('P10', 'Agroindustrias del Sur', '20301122334', 'Via Evitamiento Km 3', '987654330', 'contacto@agrosur.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` varchar(3) NOT NULL,
  `nomusuario` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `apellidos` varchar(64) DEFAULT NULL,
  `nombres` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `estado` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nomusuario`, `password`, `apellidos`, `nombres`, `email`, `estado`) VALUES
('U01', 'admin', '123456', 'Pérez', 'Juan', 'admin@sisventas.com', '1'),
('U02', 'vendedor1', '123456', 'Gómez', 'María', 'maria@sisventas.com', '1'),
('U03', 'vendedor2', '123456', 'Quispe', 'Carlos', 'carlos@sisventas.com', '1');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Indices de la tabla `condicionventa`
--
ALTER TABLE `condicionventa`
  ADD PRIMARY KEY (`idcondicion`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `idfactura` (`idfactura`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`idfactura`),
  ADD KEY `idcliente` (`idcliente`),
  ADD KEY `idcondicion` (`idcondicion`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `idproveedor` (`idproveedor`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `idfactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD CONSTRAINT `detallefactura_ibfk_1` FOREIGN KEY (`idfactura`) REFERENCES `facturas` (`idfactura`) ON DELETE CASCADE,
  ADD CONSTRAINT `detallefactura_ibfk_2` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`idcliente`) REFERENCES `clientes` (`idcliente`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`idcondicion`) REFERENCES `condicionventa` (`idcondicion`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idproveedor`) REFERENCES `proveedores` (`idproveedor`),
  ADD CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
