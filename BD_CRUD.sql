-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-01-2024 a las 17:19:15
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `crud1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--
CREATE DATABASE `crud1`
CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `precio` float NOT NULL,
  `marca` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `marca`, `descripcion`, `stock`) VALUES
(2, 'Alpura', 25.5, 'Alpurass', 'Ganaderos de Leche Pura, S.A.P.I. de C.V.\r\nTeléfono: 55 1328 8871\r\nCorreo: rseleccion@alpura.com', 27),
(3, 'Café en grano', 266, 'Lavazza Oro', 'HerbaKraft\r\nTeléfono: +1 732-463-1000\r\nDirección: 121 Ethel Rd W # 6, Piscataway, NJ 08854, Estados Unidos', 50),
(4, 'Café molido', 89, 'Nescafé', 'Caffenio', 4),
(5, 'Azúcar', 60, 'Zulka', 'Grupo Porres y Gam', 14),
(6, 'Té negro', 120.5, 'Stash Tea Earl Grey', '‎Kosher', 4),
(7, 'Chocolate', 85.5, 'chocolate Abuelita', 'Le Mexicain', 9),
(9, 'Pan', 40, 'Bimbo', 'Bimbo\r\n', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tabla_claves`
--

CREATE TABLE `tabla_claves` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tabla_claves`
--

INSERT INTO `tabla_claves` (`id`, `usuario_id`, `nombre`, `clave`) VALUES
(8, 15, 'Ivone', 'ilan130500');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `password`, `rol`) VALUES
(1, 'Jhoan', '$2y$10$OLZ4Kiib4.2i5M/Jyp.bjOz/.HL2Xi7JfYHte3kv82o7cC0vmxYmC', 'Gerente'),
(3, 'Rita', '$2y$10$T/sywt1KAVIp8.yh5EMTRezCB3bAWyBnsiHYxTeevu1gG5n9tRSFe', 'Gerente'),
(4, 'Edwin', '$2y$10$t/yNzSWlzOs28DpC1anICusYrZJ4HxLeUxKm3uvMxiIqzDhPpyNGK', 'Gerente'),
(15, 'Ivone', '$2y$10$D7lNFuxNpTkYalLamFHgvOSX61TpqvcUVadr.hdFEM/8t19QWcIpS', 'Administrador'),
(16, 'Ana', '$2y$10$7LKeVxa3PYxmb4N.b1FWYu5qG/T2Jk8k8uBXZhj2/oddUvL/Yds7a', 'Empleado'),
(17, 'Luis', '$2y$10$YxoIByBjg.2qyblt81SEweBrObx5XzFWbb9U1ekpp8hzjzvHHmRM.', 'Empleado'),
(20, 'Ulises', '$2y$10$mUeLdAkGna.Tp14Oz5Rh.Olejj5Va9WdjyTC7lWYRvdIzNrQAxZLK', 'Empleado'),
(21, 'Dnn', '$2y$10$42XDtRxAag8TBjsHFjflq.fgR009RCFY7YOEy/yW9HUrE9bvbYA7C', 'Gerente'),
(22, 'pepe', '$2y$10$WxG0vdDMKnhDpsrx85rJn.kIeS4GdJOqaGG7ttaObVEpbmWq7/9lS', 'Gerente'),
(23, 'Alonso', '$2y$10$TOb1IV01zecp32T7Cuy/Z.fYc8PsUhoL6i8scEe9I1R/0yK7kph5.', 'Gerente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tabla_claves`
--
ALTER TABLE `tabla_claves`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tabla_claves`
--
ALTER TABLE `tabla_claves`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
