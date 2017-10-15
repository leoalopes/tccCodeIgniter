-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Out-2017 às 16:01
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bancoteste`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes_projeto`
--

CREATE TABLE `permissoes_projeto` (
  `id_usuario` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL,
  `leitura` tinyint(1) NOT NULL,
  `escrita` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `permissoes_projeto`
--

INSERT INTO `permissoes_projeto` (`id_usuario`, `id_projeto`, `leitura`, `escrita`) VALUES
(1, 5, 1, 1),
(1, 6, 1, 1),
(2, 5, 1, 0),
(3, 5, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `permissoes_projeto`
--
ALTER TABLE `permissoes_projeto`
  ADD PRIMARY KEY (`id_usuario`,`id_projeto`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `permissoes_projeto`
--
ALTER TABLE `permissoes_projeto`
  ADD CONSTRAINT `permissoes_projeto_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto_grupo` (`id_projeto`),
  ADD CONSTRAINT `permissoes_projeto_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
