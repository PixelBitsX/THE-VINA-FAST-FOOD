-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-05-2025 a las 14:43:01
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
-- Base de datos: `the-vina-fast-food`
--
CREATE DATABASE IF NOT EXISTS `the-vina-fast-food` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `the-vina-fast-food`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bancos`
--

CREATE TABLE `bancos` (
  `id_banco` int(11) NOT NULL,
  `nombre_banco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id_cargo` int(11) NOT NULL,
  `nombre_cargo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`id_cargo`, `nombre_cargo`) VALUES
(1, 'Gerente'),
(2, 'Planchero'),
(3, 'Obrero'),
(4, 'Cocinero'),
(5, 'Recepcionista'),
(6, 'Limpieza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `cedula_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(50) NOT NULL,
  `apellido_cliente` varchar(50) NOT NULL,
  `telefono_cliente` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `deliverys`
--

CREATE TABLE `deliverys` (
  `id_delivery` int(11) NOT NULL,
  `id_ruta` int(11) NOT NULL,
  `cedula_repartidor` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `direccion_envio_ddelivery` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pagos`
--

CREATE TABLE `detalles_pagos` (
  `id_detalle_pago` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_metodo_pago` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `monto_pago` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_pedidos`
--

CREATE TABLE `detalles_pedidos` (
  `id_detalle_pedido` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `cantidad_producto` int(11) NOT NULL,
  `detalle_producto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_recepcion_materia_primas`
--

CREATE TABLE `detalle_recepcion_materia_primas` (
  `id_detalle_recepcion_materia_prima` int(11) NOT NULL,
  `id_recepcion_materia_prima` int(11) NOT NULL,
  `id_materia_prima` int(11) NOT NULL,
  `cantidad_materia_prima_comprada` float NOT NULL,
  `costo_unitario_materia_prima` float NOT NULL,
  `sud_total_detalle_materia_prima` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_horario` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `id_usuario`, `id_horario`, `id_cargo`) VALUES
(1, 1, 1, 6),
(2, 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id_estado` int(11) NOT NULL,
  `nombre_estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historiales_monedas`
--

CREATE TABLE `historiales_monedas` (
  `id_historial_moneda` int(11) NOT NULL,
  `id_moneda` int(11) NOT NULL,
  `valor_moneda` float NOT NULL,
  `fecha_historial_moneda` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horarios`
--

CREATE TABLE `horarios` (
  `id_horario` int(11) NOT NULL,
  `nombre_horario` varchar(50) NOT NULL,
  `hora_entrada_horario` time NOT NULL,
  `hora_salida_horario` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `horarios`
--

INSERT INTO `horarios` (`id_horario`, `nombre_horario`, `hora_entrada_horario`, `hora_salida_horario`) VALUES
(1, 'Turno Diurno', '06:00:00', '15:00:00'),
(2, 'Turno Nocturno', '18:00:00', '23:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `id_insumo` int(11) NOT NULL,
  `nombre_insumo` varchar(50) NOT NULL,
  `precio_unitario_insumo` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`id_insumo`, `nombre_insumo`, `precio_unitario_insumo`) VALUES
(40, 'hoasshg', 1.45),
(45, 'hoa', 0.16),
(46, 'hoarer', 0.16),
(47, 'BANDEJA DE 500G12', 0.16),
(48, 'BANDEJA DE 500G13', 0.16),
(49, 'BANDEJA DE 500G14', 0.16),
(50, 'BANDEJA DE 500G15', 0.16),
(51, 'BANDEJA DE 500G16', 0.16),
(52, 'BANDEJA DE 500G17', 0.16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_pedidos`
--

CREATE TABLE `insumos_pedidos` (
  `id_insumo_pedido` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_insumo` int(11) NOT NULL,
  `cantidad_insumo` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_primas`
--

CREATE TABLE `materias_primas` (
  `id_materia_prima` int(11) NOT NULL,
  `id_unidad_medida` int(11) NOT NULL,
  `nombre_materia_prima` varchar(50) NOT NULL,
  `costo_materia_prima` float NOT NULL,
  `stock_actual_materia_prima` float NOT NULL,
  `stock_minimo_materia_prima` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materias_primas_productos`
--

CREATE TABLE `materias_primas_productos` (
  `id_materia_prima_producto` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_materia_prima` int(11) NOT NULL,
  `cantidad_materia_prima_necesaria` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodos_pagos`
--

CREATE TABLE `metodos_pagos` (
  `id_metodo_pago` int(11) NOT NULL,
  `nombre_metodo_pago` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `id_moneda` int(11) NOT NULL,
  `nombre_moneda` varchar(20) NOT NULL,
  `valor_moneda` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `id_municipio` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `nombre_municipio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id_pago` int(11) NOT NULL,
  `fecha_pago` date NOT NULL,
  `monto_total_pago` float NOT NULL,
  `estado_pago` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `parroquias`
--

CREATE TABLE `parroquias` (
  `id_parroquia` int(11) NOT NULL,
  `id_municipio` int(11) NOT NULL,
  `nombre_parroquia` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `id_pago` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `cedula_cliente` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `nombre_producto` varchar(100) NOT NULL,
  `precio_producto` float NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_promociones`
--

CREATE TABLE `productos_promociones` (
  `id_producto_promocion` int(11) NOT NULL,
  `id_promoción` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_producto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `promociones`
--

CREATE TABLE `promociones` (
  `id_promocion` int(11) NOT NULL,
  `nombre_promocion` varchar(50) NOT NULL,
  `fecha_inicio_promocion` date NOT NULL,
  `fecha_fin_promocion` date NOT NULL,
  `descuento_promocion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_proveedor` varchar(50) NOT NULL,
  `teléfono_proveedor` int(15) NOT NULL,
  `correo_proveedor` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepciones_materias_primas`
--

CREATE TABLE `recepciones_materias_primas` (
  `id_recepcion_materia_prima` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_recepcion_materia_prima` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidores`
--

CREATE TABLE `repartidores` (
  `cedula_repartidor` int(11) NOT NULL,
  `nombre_repartidor` varchar(50) NOT NULL,
  `apellido_repartidor` varchar(50) NOT NULL,
  `telefono_repartidor` int(15) NOT NULL,
  `disponibilidad_repartidor` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre_rol` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(11) NOT NULL,
  `id_parroquia` int(11) NOT NULL,
  `nombre_ruta` varchar(50) NOT NULL,
  `precio_ruta` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medidas`
--

CREATE TABLE `unidades_medidas` (
  `id_unidad_medida` int(11) NOT NULL,
  `nombre_unidad_medida` varchar(50) NOT NULL,
  `abreviacion_unidad_medida` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `cedula_usuario` varchar(10) NOT NULL,
  `nombre_usuario` varchar(50) NOT NULL,
  `apellido_usuario` varchar(50) NOT NULL,
  `correo_usuario` varchar(50) NOT NULL,
  `telefono_usuario` varchar(11) NOT NULL,
  `rol_usuario` varchar(50) NOT NULL,
  `usuario_usuario` varchar(50) NOT NULL,
  `contrasena_usuario` varchar(255) NOT NULL,
  `foto_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `cedula_usuario`, `nombre_usuario`, `apellido_usuario`, `correo_usuario`, `telefono_usuario`, `rol_usuario`, `usuario_usuario`, `contrasena_usuario`, `foto_usuario`) VALUES
(1, '30485689', 'Anderson', 'Freitez', 'andersonfreitez356@gmail.com', '04169484649', 'Administrador', 'anderson1234', '$2y$10$7/nSTOdf1vEft.xDoF1iW.w/r2KfD50UfwjhmMqgDyglG8TDCPKqu', 'Anderson_Freitez_552.jpg'),
(5, '30485684', 'Anderson', 'Freitez', 'andersonfreitez6@gmail.com', '04169484649', 'Administrador', 'Ander123', '$2y$10$qTuiReiYqvd1o8ynLlzt1uN1j5WETv4JKgSb4MbQxz8JbN9VZEECi', 'Anderson_Freitez_547.jpg'),
(7, '30485690', 'Sabrina', 'Colmenarez', 'Sabrina@gmail.com', '04160000000', 'Usuario', 'Sabri123', '$2y$10$1n..wUkXnSTQdzrXCwYM7.ZII5jG4fs1aYYngSdpORnUxs.ipTSzy', 'Sabrina_Colmenarez_158.jpg'),
(13, '304856892', 'Anyelo', 'Mendoza', 'andersonfreitez36@gmail.com', '04169484649', 'Usuario', 'Ander123334', '$2y$10$rsRL353TGIU14iw/Wo1C.O0CtkzK5x6f3hsTqijCsNroM6FdnyEHi', ''),
(14, '30485682', 'Anderson', 'Freitez', 'andersonfreitez326@gmail.com', '04169484649', 'Administrador', 'Ander1234522', '$2y$10$Ga2AFjaSUkm.M0CfM7E8SeNIZDrAbKcWGkdA01YqT5DzSyDYWLYmi', 'Anderson_Freitez_218.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `placa_vehiculo` int(11) NOT NULL,
  `cedula_repartidor` int(11) NOT NULL,
  `marca_vehiculo` varchar(50) NOT NULL,
  `color_vehiclo` varchar(20) NOT NULL,
  `modelo_vehiculo` varchar(100) NOT NULL,
  `tipo_vehiculo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bancos`
--
ALTER TABLE `bancos`
  ADD PRIMARY KEY (`id_banco`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cedula_cliente`);

--
-- Indices de la tabla `deliverys`
--
ALTER TABLE `deliverys`
  ADD PRIMARY KEY (`id_delivery`),
  ADD KEY `ruta_delivery_fk` (`id_ruta`),
  ADD KEY `repartidor_delivery_fk` (`cedula_repartidor`),
  ADD KEY `pedido_delivery` (`id_pedido`);

--
-- Indices de la tabla `detalles_pagos`
--
ALTER TABLE `detalles_pagos`
  ADD PRIMARY KEY (`id_detalle_pago`),
  ADD KEY `pago_detalle_pago_fk` (`id_pago`),
  ADD KEY `metodo_pago_detalle_pago_fk` (`id_metodo_pago`),
  ADD KEY `moneda_detalle_pago_fk` (`id_moneda`),
  ADD KEY `banco_detalle_pago_fk` (`id_banco`);

--
-- Indices de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD PRIMARY KEY (`id_detalle_pedido`),
  ADD KEY `producto_detalle_pedido` (`id_producto`),
  ADD KEY `pedido_detalle_pedido` (`id_pedido`);

--
-- Indices de la tabla `detalle_recepcion_materia_primas`
--
ALTER TABLE `detalle_recepcion_materia_primas`
  ADD PRIMARY KEY (`id_detalle_recepcion_materia_prima`),
  ADD KEY `recepcion_materia_prima_detalle_recepcion_materia_prima_fk` (`id_recepcion_materia_prima`),
  ADD KEY `materia_prima_detalle_recepcion_materia_prima_fk` (`id_materia_prima`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`),
  ADD UNIQUE KEY `cedula_usuario` (`id_usuario`),
  ADD KEY `horario_empleado_fk` (`id_horario`),
  ADD KEY `cargo_empleado_fk` (`id_cargo`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indices de la tabla `historiales_monedas`
--
ALTER TABLE `historiales_monedas`
  ADD KEY `moneda_historial_moneda` (`id_moneda`);

--
-- Indices de la tabla `horarios`
--
ALTER TABLE `horarios`
  ADD PRIMARY KEY (`id_horario`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`id_insumo`);

--
-- Indices de la tabla `insumos_pedidos`
--
ALTER TABLE `insumos_pedidos`
  ADD PRIMARY KEY (`id_insumo_pedido`),
  ADD KEY `pedido_insumo_pedido_fk` (`id_pedido`),
  ADD KEY `insumo_insumo_pedido_fk` (`id_insumo`);

--
-- Indices de la tabla `materias_primas`
--
ALTER TABLE `materias_primas`
  ADD PRIMARY KEY (`id_materia_prima`),
  ADD KEY `unidad_medida_materia_prima` (`id_unidad_medida`);

--
-- Indices de la tabla `materias_primas_productos`
--
ALTER TABLE `materias_primas_productos`
  ADD PRIMARY KEY (`id_materia_prima_producto`),
  ADD KEY `producto_materia_prima_producto_fk` (`id_producto`),
  ADD KEY `materia_prima_materia_prima_producto_fk` (`id_materia_prima`);

--
-- Indices de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  ADD PRIMARY KEY (`id_metodo_pago`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`id_moneda`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `estado_municipio` (`id_estado`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id_pago`);

--
-- Indices de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD PRIMARY KEY (`id_parroquia`),
  ADD KEY `municipio_parroquia` (`id_municipio`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `pago_pedido_fk` (`id_pago`),
  ADD KEY `usuario_pedido_fk` (`id_usuario`),
  ADD KEY `cliente_pedido_fk` (`cedula_cliente`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `categoria_producto` (`id_categoria`);

--
-- Indices de la tabla `productos_promociones`
--
ALTER TABLE `productos_promociones`
  ADD PRIMARY KEY (`id_producto_promocion`),
  ADD KEY `promocion_producto_promocion_fk` (`id_promoción`),
  ADD KEY `producto_producto_promocion_fk` (`id_producto`);

--
-- Indices de la tabla `promociones`
--
ALTER TABLE `promociones`
  ADD PRIMARY KEY (`id_promocion`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `recepciones_materias_primas`
--
ALTER TABLE `recepciones_materias_primas`
  ADD PRIMARY KEY (`id_recepcion_materia_prima`),
  ADD KEY `proveedor_recepcion_materia_prima` (`id_proveedor`);

--
-- Indices de la tabla `repartidores`
--
ALTER TABLE `repartidores`
  ADD PRIMARY KEY (`cedula_repartidor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`),
  ADD KEY `parroquia_ruta` (`id_parroquia`);

--
-- Indices de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  ADD PRIMARY KEY (`id_unidad_medida`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `cedula_usuario` (`cedula_usuario`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`placa_vehiculo`),
  ADD UNIQUE KEY `cedula_repartidor` (`cedula_repartidor`),
  ADD KEY `repartidor_vehiculo_fk` (`cedula_repartidor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bancos`
--
ALTER TABLE `bancos`
  MODIFY `id_banco` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cedula_cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `deliverys`
--
ALTER TABLE `deliverys`
  MODIFY `id_delivery` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_pagos`
--
ALTER TABLE `detalles_pagos`
  MODIFY `id_detalle_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  MODIFY `id_detalle_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_recepcion_materia_primas`
--
ALTER TABLE `detalle_recepcion_materia_primas`
  MODIFY `id_detalle_recepcion_materia_prima` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `horarios`
--
ALTER TABLE `horarios`
  MODIFY `id_horario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `id_insumo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `insumos_pedidos`
--
ALTER TABLE `insumos_pedidos`
  MODIFY `id_insumo_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias_primas`
--
ALTER TABLE `materias_primas`
  MODIFY `id_materia_prima` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `materias_primas_productos`
--
ALTER TABLE `materias_primas_productos`
  MODIFY `id_materia_prima_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `metodos_pagos`
--
ALTER TABLE `metodos_pagos`
  MODIFY `id_metodo_pago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `id_moneda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `parroquias`
--
ALTER TABLE `parroquias`
  MODIFY `id_parroquia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_promociones`
--
ALTER TABLE `productos_promociones`
  MODIFY `id_producto_promocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `promociones`
--
ALTER TABLE `promociones`
  MODIFY `id_promocion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `recepciones_materias_primas`
--
ALTER TABLE `recepciones_materias_primas`
  MODIFY `id_recepcion_materia_prima` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `unidades_medidas`
--
ALTER TABLE `unidades_medidas`
  MODIFY `id_unidad_medida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `deliverys`
--
ALTER TABLE `deliverys`
  ADD CONSTRAINT `pedido_delivery` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `repartidor_delivery_fk` FOREIGN KEY (`cedula_repartidor`) REFERENCES `repartidores` (`cedula_repartidor`),
  ADD CONSTRAINT `ruta_delivery_fk` FOREIGN KEY (`id_ruta`) REFERENCES `rutas` (`id_ruta`);

--
-- Filtros para la tabla `detalles_pagos`
--
ALTER TABLE `detalles_pagos`
  ADD CONSTRAINT `banco_detalle_pago_fk` FOREIGN KEY (`id_banco`) REFERENCES `bancos` (`id_banco`),
  ADD CONSTRAINT `metodo_pago_detalle_pago_fk` FOREIGN KEY (`id_metodo_pago`) REFERENCES `metodos_pagos` (`id_metodo_pago`),
  ADD CONSTRAINT `moneda_detalle_pago_fk` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`),
  ADD CONSTRAINT `pago_detalle_pago_fk` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id_pago`);

--
-- Filtros para la tabla `detalles_pedidos`
--
ALTER TABLE `detalles_pedidos`
  ADD CONSTRAINT `pedido_detalle_pedido` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `producto_detalle_pedido` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `detalle_recepcion_materia_primas`
--
ALTER TABLE `detalle_recepcion_materia_primas`
  ADD CONSTRAINT `materia_prima_detalle_recepcion_materia_prima_fk` FOREIGN KEY (`id_materia_prima`) REFERENCES `materias_primas` (`id_materia_prima`),
  ADD CONSTRAINT `recepcion_materia_prima_detalle_recepcion_materia_prima_fk` FOREIGN KEY (`id_recepcion_materia_prima`) REFERENCES `recepciones_materias_primas` (`id_recepcion_materia_prima`);

--
-- Filtros para la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD CONSTRAINT `cargo_empleado_fk` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id_cargo`),
  ADD CONSTRAINT `horario_empleado_fk` FOREIGN KEY (`id_horario`) REFERENCES `horarios` (`id_horario`),
  ADD CONSTRAINT `usuario_empleado` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `historiales_monedas`
--
ALTER TABLE `historiales_monedas`
  ADD CONSTRAINT `moneda_historial_moneda` FOREIGN KEY (`id_moneda`) REFERENCES `monedas` (`id_moneda`);

--
-- Filtros para la tabla `insumos_pedidos`
--
ALTER TABLE `insumos_pedidos`
  ADD CONSTRAINT `insumo_insumo_pedido_fk` FOREIGN KEY (`id_insumo`) REFERENCES `insumos` (`id_insumo`),
  ADD CONSTRAINT `pedido_insumo_pedido_fk` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);

--
-- Filtros para la tabla `materias_primas`
--
ALTER TABLE `materias_primas`
  ADD CONSTRAINT `unidad_medida_materia_prima` FOREIGN KEY (`id_unidad_medida`) REFERENCES `unidades_medidas` (`id_unidad_medida`);

--
-- Filtros para la tabla `materias_primas_productos`
--
ALTER TABLE `materias_primas_productos`
  ADD CONSTRAINT `materia_prima_materia_prima_producto_fk` FOREIGN KEY (`id_materia_prima`) REFERENCES `materias_primas` (`id_materia_prima`),
  ADD CONSTRAINT `producto_materia_prima_producto_fk` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`);

--
-- Filtros para la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD CONSTRAINT `estado_municipio` FOREIGN KEY (`id_estado`) REFERENCES `estados` (`id_estado`);

--
-- Filtros para la tabla `parroquias`
--
ALTER TABLE `parroquias`
  ADD CONSTRAINT `municipio_parroquia` FOREIGN KEY (`id_municipio`) REFERENCES `municipios` (`id_municipio`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `cliente_pedido_fk` FOREIGN KEY (`cedula_cliente`) REFERENCES `clientes` (`cedula_cliente`),
  ADD CONSTRAINT `pago_pedido_fk` FOREIGN KEY (`id_pago`) REFERENCES `pagos` (`id_pago`),
  ADD CONSTRAINT `usuario_pedido_fk` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `categoria_producto` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);

--
-- Filtros para la tabla `productos_promociones`
--
ALTER TABLE `productos_promociones`
  ADD CONSTRAINT `producto_producto_promocion_fk` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`),
  ADD CONSTRAINT `promocion_producto_promocion_fk` FOREIGN KEY (`id_promoción`) REFERENCES `promociones` (`id_promocion`);

--
-- Filtros para la tabla `recepciones_materias_primas`
--
ALTER TABLE `recepciones_materias_primas`
  ADD CONSTRAINT `proveedor_recepcion_materia_prima` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`);

--
-- Filtros para la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD CONSTRAINT `parroquia_ruta` FOREIGN KEY (`id_parroquia`) REFERENCES `parroquias` (`id_parroquia`);

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `repartidor_vehiculo_fk` FOREIGN KEY (`cedula_repartidor`) REFERENCES `repartidores` (`cedula_repartidor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
