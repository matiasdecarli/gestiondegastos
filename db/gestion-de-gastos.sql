-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 01, 2017 at 05:43 AM
-- Server version: 5.6.35
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gestion-de-gastos`
--

-- --------------------------------------------------------

--
-- Table structure for table `concepto`
--

CREATE TABLE `concepto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `tipo` int(11) NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `motivo_recordatorio`
--

CREATE TABLE `motivo_recordatorio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `movimiento`
--

CREATE TABLE `movimiento` (
  `id` int(11) NOT NULL,
  `saldo` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `comentarios` varchar(255) COLLATE utf8_bin NOT NULL,
  `importe` int(11) NOT NULL,
  `concepto` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `autor` int(11) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `recordatorio`
--

CREATE TABLE `recordatorio` (
  `id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `importe` int(11) NOT NULL,
  `motivo_recordatorio` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `saved_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_bin NOT NULL,
  `activo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `user` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `nombre` varchar(255) NOT NULL,
  `activo` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `concepto`
--
ALTER TABLE `concepto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `concepto_tipo` (`tipo`);

--
-- Indexes for table `motivo_recordatorio`
--
ALTER TABLE `motivo_recordatorio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movimiento`
--
ALTER TABLE `movimiento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movimiento_concepto` (`concepto`),
  ADD KEY `movimiento_tipo` (`tipo`),
  ADD KEY `movimiento_autor` (`autor`);

--
-- Indexes for table `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recordatorio_autor` (`autor`),
  ADD KEY `recordatorio_motivo_recordatorio` (`motivo_recordatorio`);

--
-- Indexes for table `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `concepto`
--
ALTER TABLE `concepto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `motivo_recordatorio`
--
ALTER TABLE `motivo_recordatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `movimiento`
--
ALTER TABLE `movimiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `recordatorio`
--
ALTER TABLE `recordatorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `concepto`
--
ALTER TABLE `concepto`
  ADD CONSTRAINT `concepto_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Constraints for table `movimiento`
--
ALTER TABLE `movimiento`
  ADD CONSTRAINT `movimiento_autor` FOREIGN KEY (`autor`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `movimiento_concepto` FOREIGN KEY (`concepto`) REFERENCES `concepto` (`id`),
  ADD CONSTRAINT `movimiento_tipo` FOREIGN KEY (`tipo`) REFERENCES `tipo` (`id`);

--
-- Constraints for table `recordatorio`
--
ALTER TABLE `recordatorio`
  ADD CONSTRAINT `recordatorio_autor` FOREIGN KEY (`autor`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `recordatorio_motivo_recordatorio` FOREIGN KEY (`motivo_recordatorio`) REFERENCES `motivo_recordatorio` (`id`);
