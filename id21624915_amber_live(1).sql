-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jan-2024 às 17:38
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id21624915_amber_live`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id_atendimento` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `atendimentos`
--

INSERT INTO `atendimentos` (`id_atendimento`, `data`, `tipo`, `id_paciente`) VALUES
(1, '2023-12-20', 'U', 2),
(2, '2023-12-07', 'G', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nome` varchar(110) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nome`, `sexo`, `cpf`, `data_nascimento`) VALUES
(1, 'Manoel', 'M', '12345678910', '2023-12-13'),
(2, 'Daniela', 'F', '12345678911', '2023-12-20'),
(3, 'Gabriel', 'M', '12345678912', '2023-12-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguidores`
--

CREATE TABLE `seguidores` (
  `id_seguidor` int(11) NOT NULL,
  `id_seguido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `seguidores`
--

INSERT INTO `seguidores` (`id_seguidor`, `id_seguido`) VALUES
(13, 1),
(14, 1),
(14, 2),
(13, 3),
(14, 3),
(14, 15),
(14, 16);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `email` varchar(220) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `imagem` varchar(220) DEFAULT NULL,
  `senha` varchar(110) NOT NULL,
  `descricao` text NOT NULL DEFAULT '<sem descrição>'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `name`, `email`, `created`, `modified`, `status`, `imagem`, `senha`, `descricao`) VALUES
(1, 'Gaulês', 'gaules@email.com', '2023-11-27 10:54:33', '2024-01-13 15:27:24', 0, 'imagens/65a2d60ca2ef4.png', '1234', ''),
(2, 'Alanzoka', 'alanzoka@email.com', '2023-11-27 10:54:33', '2024-01-13 13:25:21', 0, NULL, '1234', ''),
(3, 'Quackity', 'quackity@email.com', '2023-11-28 10:55:34', '2024-01-13 15:26:57', 1, 'imagens/65a2d5f16edd7.png', '1234', ''),
(4, 'Joao Gameplays', 'joaogameplays@email.com', '2023-11-27 10:55:34', '2023-11-27 14:55:34', 0, NULL, '1234', ''),
(5, 'EnzoCraft', 'enzocraft@email.com', '2023-11-27 10:56:13', '2023-11-27 14:56:13', 0, NULL, '1234', ''),
(13, 'cris', 'cris@email.com', '2024-01-09 01:34:46', '2024-01-13 15:33:10', 0, 'imagens/65a2d76685ed6.png', '1234', ''),
(14, 'manoel06', 'manoel@email.com', '2024-01-09 02:02:23', '2024-01-13 22:56:30', 0, 'imagens/65a33f4e5a8dc.png', '1234', 'My Description 2'),
(15, 'JessJess', 'jess@email.com', '2024-01-10 11:14:20', '2024-01-13 15:28:20', 1, 'imagens/65a2d644d0da5.png', '1234', ''),
(16, 'Dilera', 'dilera@email.com', '2024-01-11 10:09:48', '2024-01-11 21:17:22', 0, NULL, '1234', ''),
(17, 'teste', 'teste@email.com', '2024-01-11 21:48:40', '2024-01-11 21:48:40', 0, NULL, '123', ''),
(18, 'teste', 'teste2@email.com', '2024-01-11 21:59:59', '2024-01-11 21:59:59', 0, NULL, '123', ''),
(19, '', '', '2024-01-13 14:55:08', '2024-01-13 14:55:08', 0, 'teste', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id_atendimento`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Índices para tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD PRIMARY KEY (`id_seguido`,`id_seguidor`),
  ADD KEY `id_seguidor` (`id_seguidor`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id_atendimento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id_paciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `atendimentos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);

--
-- Limitadores para a tabela `seguidores`
--
ALTER TABLE `seguidores`
  ADD CONSTRAINT `seguidores_ibfk_1` FOREIGN KEY (`id_seguidor`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `seguidores_ibfk_2` FOREIGN KEY (`id_seguido`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
