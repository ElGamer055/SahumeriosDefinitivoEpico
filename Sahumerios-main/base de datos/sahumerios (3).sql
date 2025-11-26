-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-11-2025 a las 06:21:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sahumerios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `ID` int(11) NOT NULL,
  `Id_Pedido` int(11) NOT NULL,
  `Id_Producto` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` int(11) NOT NULL,
  `SubTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Id_producto` int(11) NOT NULL,
  `Comentario` varchar(200) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`ID`, `Id_Usuario`, `Id_producto`, `Comentario`, `Fecha`, `Hora`) VALUES
(1, 1, 1, 'Joseandogotyuanahsheee', '2025-11-12', '17:23:26'),
(2, 0, 1, 'dsa', '2025-11-26', '00:58:09'),
(3, 3, 1, 'das', '2025-11-26', '01:00:31'),
(4, 1, 1, 'das', '2025-11-26', '01:19:29'),
(5, 1, 1, 'idiaswi', '2025-11-26', '01:19:33'),
(6, 1, 2, 'das', '2025-11-26', '02:19:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `ID` int(11) NOT NULL,
  `Id_Proveedor` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Monto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Id_Situacion` int(11) NOT NULL,
  `Id_TipoDePago` int(11) NOT NULL,
  `MontoTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `ID` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Id_Marca` int(2) NOT NULL,
  `Id_Categoria` int(2) NOT NULL,
  `Id_Proveedor` int(2) NOT NULL,
  `Stock` int(3) NOT NULL,
  `StockMinimo` int(3) NOT NULL,
  `Costo` int(6) NOT NULL,
  `Ganancia` int(6) NOT NULL,
  `Precio` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`ID`, `Titulo`, `Descripcion`, `Id_Marca`, `Id_Categoria`, `Id_Proveedor`, `Stock`, `StockMinimo`, `Costo`, `Ganancia`, `Precio`) VALUES
(1, 'sahur', 'Supermegaepicoanashe', 1, 1, 1, 33, 1, 10, 10, 2000),
(2, 'tuntung', 'Skibidisigmapomni', 2, 1, 3, 20, 1, 200, 10, 3000),
(3, 'Incienso Solar', 'Aroma cítrico energizante para el día.', 2, 1, 2, 50, 5, 80, 20, 1000),
(4, 'Velón Lunar', 'Velón aromático para meditación nocturna.', 1, 2, 1, 25, 3, 150, 50, 2000),
(5, 'Aceite Esencial Zen', 'Aceite natural para relajación y spa.', 3, 2, 2, 40, 4, 120, 30, 1500),
(6, 'Sahumo Místico', 'Combinación de hierbas ancestrales purificadoras.', 1, 1, 3, 18, 2, 90, 10, 1000),
(7, 'Difusor Boreal', 'Difusor de fragancia con luces LED de colores.', 2, 3, 1, 10, 2, 500, 200, 700),
(8, 'Esencia Floral Aurora', 'Fragancia suave y equilibrante inspirada en flores silvestres.', 1, 2, 1, 15, 3, 120, 50, 1800),
(9, 'Sahumo de Lavanda', 'Mezcla relajante con predominio de lavanda natural.', 2, 1, 2, 20, 5, 80, 40, 1500),
(10, 'Vela Solar Dorada', 'Vela aromática con notas cítricas y cálidas.', 3, 2, 3, 25, 4, 150, 60, 2500),
(11, 'Aceite Esencial Bruma', 'Aceite esencial purificante para uso ambiental.', 1, 3, 1, 18, 3, 90, 30, 1200),
(12, 'Difusor Aromático Zen', 'Difusor con diseño minimalista para ambientes relajados.', 2, 3, 3, 12, 2, 300, 100, 900),
(13, 'Sahumerio Andino', 'Mezcla herbal tradicional con hierbas de altura.', 3, 1, 1, 40, 6, 60, 20, 800),
(14, 'Vela Estelar', 'Vela aromática inspirada en fragancias nocturnas y profundas.', 1, 2, 2, 22, 5, 200, 70, 2200),
(15, 'Aceite de Eucalipto', 'Aceite esencial descongestivo y revitalizante.', 2, 3, 3, 35, 4, 110, 40, 1600),
(16, 'Difusor Nebular', 'Difusor premium con función ultrasónica.', 3, 3, 1, 8, 2, 500, 200, 1500),
(17, 'Sahumerio Frutos Rojos', 'Fragancia dulce y frutal para aromatizar el hogar.', 1, 1, 2, 28, 5, 70, 25, 900);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `situacion`
--

CREATE TABLE `situacion` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipodepago`
--

CREATE TABLE `tipodepago` (
  `ID` int(11) NOT NULL,
  `Nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID` int(3) NOT NULL,
  `Nombre_de_usuario` varchar(80) NOT NULL,
  `Nombre` varchar(40) NOT NULL,
  `Apellido` varchar(40) NOT NULL,
  `Contrasena` varchar(40) NOT NULL,
  `Telefono` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID`, `Nombre_de_usuario`, `Nombre`, `Apellido`, `Contrasena`, `Telefono`) VALUES
(1, 'Joseandogoty', 'Jose', 'Golpe', '1234', 1198347732);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `situacion`
--
ALTER TABLE `situacion`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `tipodepago`
--
ALTER TABLE `tipodepago`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `situacion`
--
ALTER TABLE `situacion`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipodepago`
--
ALTER TABLE `tipodepago`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
