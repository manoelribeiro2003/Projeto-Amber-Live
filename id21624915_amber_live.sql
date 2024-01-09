-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 09/01/2024 às 02:05
-- Versão do servidor: 10.5.20-MariaDB
-- Versão do PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id21624915_amber_live`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `acompanha`
--

CREATE TABLE `acompanha` (
  `id_acompanhamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_streamer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `acompanha`
--

INSERT INTO `acompanha` (`id_acompanhamento`, `id_usuario`, `id_streamer`) VALUES
(1, 5, 2),
(2, 5, 3),
(3, 5, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id_atendimento` int(11) NOT NULL,
  `data` date NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `id_paciente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `atendimentos`
--

INSERT INTO `atendimentos` (`id_atendimento`, `data`, `tipo`, `id_paciente`) VALUES
(1, '2023-12-20', 'U', 2),
(2, '2023-12-07', 'G', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id_paciente` int(11) NOT NULL,
  `nome` varchar(110) NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Despejando dados para a tabela `pacientes`
--

INSERT INTO `pacientes` (`id_paciente`, `nome`, `sexo`, `cpf`, `data_nascimento`) VALUES
(1, 'Manoel', 'M', '12345678910', '2023-12-13'),
(2, 'Daniela', 'F', '12345678911', '2023-12-20'),
(3, 'Gabriel', 'M', '12345678912', '2023-12-03');

-- --------------------------------------------------------

--
-- Estrutura para tabela `streamers`
--

CREATE TABLE `streamers` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `imagem` varchar(220) DEFAULT NULL,
  `email` varchar(220) NOT NULL,
  `senha` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `streamers`
--

INSERT INTO `streamers` (`id`, `name`, `created`, `modified`, `status`, `imagem`, `email`, `senha`) VALUES
(1, 'Gaulês', '2023-11-27 10:54:33', '2024-01-09 01:55:28', 1, NULL, 'gaules@email.com', '1234'),
(2, 'Alanzoka', '2023-11-27 10:54:33', '2023-11-27 14:54:33', 0, NULL, 'alanzoka@email.com', '1234'),
(3, 'Quackity', '2023-11-28 10:55:34', '2024-01-09 01:56:55', 1, NULL, 'quackity@email.com', '1234'),
(4, 'Joao Gameplays', '2023-11-27 10:55:34', '2023-11-27 14:55:34', 0, NULL, 'joaogameplays@email.com', '1234'),
(5, 'EnzoCraft', '2023-11-27 10:56:13', '2023-11-27 14:56:13', 0, NULL, 'enzocraft@email.com', '1234'),
(13, 'cris', '2024-01-09 01:34:46', '2024-01-09 01:34:46', 0, NULL, 'cris@email.com', '1234'),
(14, 'manoel', '2024-01-09 02:02:23', '2024-01-09 02:03:00', 0, NULL, 'manoel@email.com', 'ci3s#TI06');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `imagem` varchar(220) DEFAULT NULL,
  `email` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `imagem`, `email`, `senha`, `created`, `modified`) VALUES
(5, 'manoel_06', NULL, 'manoel@email.com', '1234', '2023-12-20 10:06:00', '2023-12-20 14:05:40'),
(6, 'cris_05', NULL, 'cris@email.com', '1234', '2023-12-20 10:07:23', '2023-12-20 14:07:00'),
(7, 'gabriel_04', NULL, 'gabriel@email.com', '1234', '2023-12-20 10:07:51', '2023-12-20 14:07:35');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `acompanha`
--
ALTER TABLE `acompanha`
  ADD PRIMARY KEY (`id_acompanhamento`),
  ADD KEY `id_streamer` (`id_streamer`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id_atendimento`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id_paciente`);

--
-- Índices de tabela `streamers`
--
ALTER TABLE `streamers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT para tabelas despejadas
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
-- AUTO_INCREMENT de tabela `streamers`
--
ALTER TABLE `streamers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD CONSTRAINT `atendimentos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `pacientes` (`id_paciente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
