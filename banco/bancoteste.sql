-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 26-Out-2017 às 02:04
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
-- Estrutura da tabela `atividade`
--

CREATE TABLE `atividade` (
  `id_atividade` int(11) NOT NULL,
  `descricao` varchar(200) COLLATE utf8_general_mysql500_ci NOT NULL,
  `data_inicio` date NOT NULL,
  `prazo` date NOT NULL,
  `id_quadro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentacao`
--

CREATE TABLE `documentacao` (
  `id_documentacao` int(11) NOT NULL,
  `titulo` varchar(100) COLLATE utf8_general_mysql500_ci NOT NULL,
  `conteudo` longtext COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupo`
--

CREATE TABLE `grupo` (
  `id_grupo` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `grupo`
--

INSERT INTO `grupo` (`id_grupo`, `nome`, `id_usuario`) VALUES
(1, 'Teste', 1);

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
(2, 3, 1, 0),
(3, 3, 1, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id_projeto` int(11) NOT NULL,
  `nome` varchar(60) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id_projeto`, `nome`, `id_usuario`) VALUES
(3, 'Testezao', NULL),
(6, 'Testao', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_grupo`
--

CREATE TABLE `projeto_grupo` (
  `id_projeto` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `projeto_grupo`
--

INSERT INTO `projeto_grupo` (`id_projeto`, `id_grupo`) VALUES
(3, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadro_atividades`
--

CREATE TABLE `quadro_atividades` (
  `id_quadro` int(11) NOT NULL,
  `nome_quadro` varchar(60) COLLATE utf8_general_mysql500_ci NOT NULL,
  `id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis_atividade`
--

CREATE TABLE `responsaveis_atividade` (
  `id_atividade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reuniao`
--

CREATE TABLE `reuniao` (
  `id_reuniao` int(11) NOT NULL,
  `motivo` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `data` datetime NOT NULL,
  `id_grupo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(40) COLLATE utf8_general_mysql500_ci NOT NULL,
  `email` varchar(60) COLLATE utf8_general_mysql500_ci NOT NULL,
  `senha` varchar(40) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`) VALUES
(1, 'Leonardo', 'leoalopes207@gmail.com', '202cb962ac59075b964b07152d234b70'),
(2, 'João', 'joao99vkg@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'Yuri', 'becker.yr@gmail.com', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_grupo`
--

CREATE TABLE `usuarios_grupo` (
  `id_usuario` int(11) NOT NULL,
  `id_grupo` int(11) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Extraindo dados da tabela `usuarios_grupo`
--

INSERT INTO `usuarios_grupo` (`id_usuario`, `id_grupo`, `admin`) VALUES
(2, 1, 0),
(3, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `atividade`
--
ALTER TABLE `atividade`
  ADD PRIMARY KEY (`id_atividade`),
  ADD UNIQUE KEY `id_atividade` (`id_atividade`),
  ADD KEY `id_quadro` (`id_quadro`);

--
-- Indexes for table `documentacao`
--
ALTER TABLE `documentacao`
  ADD PRIMARY KEY (`id_documentacao`),
  ADD UNIQUE KEY `id_documentacao` (`id_documentacao`),
  ADD KEY `id_projeto` (`id_projeto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `grupo`
--
ALTER TABLE `grupo`
  ADD PRIMARY KEY (`id_grupo`),
  ADD UNIQUE KEY `id_grupo` (`id_grupo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `permissoes_projeto`
--
ALTER TABLE `permissoes_projeto`
  ADD PRIMARY KEY (`id_usuario`,`id_projeto`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id_projeto`),
  ADD UNIQUE KEY `id_projeto` (`id_projeto`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `projeto_grupo`
--
ALTER TABLE `projeto_grupo`
  ADD PRIMARY KEY (`id_projeto`),
  ADD UNIQUE KEY `id_projeto` (`id_projeto`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indexes for table `quadro_atividades`
--
ALTER TABLE `quadro_atividades`
  ADD PRIMARY KEY (`id_quadro`),
  ADD UNIQUE KEY `id_quadro` (`id_quadro`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- Indexes for table `responsaveis_atividade`
--
ALTER TABLE `responsaveis_atividade`
  ADD PRIMARY KEY (`id_atividade`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `reuniao`
--
ALTER TABLE `reuniao`
  ADD PRIMARY KEY (`id_reuniao`),
  ADD UNIQUE KEY `id_reuniao` (`id_reuniao`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `id_usuario` (`id_usuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD PRIMARY KEY (`id_usuario`,`id_grupo`),
  ADD KEY `id_grupo` (`id_grupo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `atividade`
--
ALTER TABLE `atividade`
  MODIFY `id_atividade` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `documentacao`
--
ALTER TABLE `documentacao`
  MODIFY `id_documentacao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grupo`
--
ALTER TABLE `grupo`
  MODIFY `id_grupo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id_projeto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `quadro_atividades`
--
ALTER TABLE `quadro_atividades`
  MODIFY `id_quadro` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `reuniao`
--
ALTER TABLE `reuniao`
  MODIFY `id_reuniao` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `atividade`
--
ALTER TABLE `atividade`
  ADD CONSTRAINT `atividade_ibfk_1` FOREIGN KEY (`id_quadro`) REFERENCES `quadro_atividades` (`id_quadro`);

--
-- Limitadores para a tabela `documentacao`
--
ALTER TABLE `documentacao`
  ADD CONSTRAINT `documentacao_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id_projeto`),
  ADD CONSTRAINT `documentacao_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `grupo`
--
ALTER TABLE `grupo`
  ADD CONSTRAINT `grupo_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `permissoes_projeto`
--
ALTER TABLE `permissoes_projeto`
  ADD CONSTRAINT `permissoes_projeto_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto_grupo` (`id_projeto`),
  ADD CONSTRAINT `permissoes_projeto_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `projeto_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `projeto_grupo`
--
ALTER TABLE `projeto_grupo`
  ADD CONSTRAINT `projeto_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `projeto_grupo_ibfk_2` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id_projeto`);

--
-- Limitadores para a tabela `quadro_atividades`
--
ALTER TABLE `quadro_atividades`
  ADD CONSTRAINT `quadro_atividades_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id_projeto`);

--
-- Limitadores para a tabela `responsaveis_atividade`
--
ALTER TABLE `responsaveis_atividade`
  ADD CONSTRAINT `responsaveis_atividade_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `atividade` (`id_atividade`),
  ADD CONSTRAINT `responsaveis_atividade_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Limitadores para a tabela `reuniao`
--
ALTER TABLE `reuniao`
  ADD CONSTRAINT `reuniao_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`);

--
-- Limitadores para a tabela `usuarios_grupo`
--
ALTER TABLE `usuarios_grupo`
  ADD CONSTRAINT `usuarios_grupo_ibfk_1` FOREIGN KEY (`id_grupo`) REFERENCES `grupo` (`id_grupo`),
  ADD CONSTRAINT `usuarios_grupo_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
