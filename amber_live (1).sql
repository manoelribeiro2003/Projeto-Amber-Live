-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Dez-2023 às 15:10
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `amber_live`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acompanha`
--

CREATE TABLE `acompanha` (
  `id_acompanhamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_streamer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `acompanha`
--

INSERT INTO `acompanha` (`id_acompanhamento`, `id_usuario`, `id_streamer`) VALUES
(1, 5, 2),
(2, 5, 3),
(3, 5, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `streamers`
--

CREATE TABLE `streamers` (
  `id_streamer` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `status` int(2) NOT NULL DEFAULT 0,
  `imagem` varchar(220) DEFAULT NULL,
  `email` varchar(220) DEFAULT NULL,
  `senha` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `streamers`
--

INSERT INTO `streamers` (`id_streamer`, `name`, `created`, `modified`, `status`, `imagem`, `email`, `senha`) VALUES
(1, 'Gaulês', '2023-11-27 10:54:33', '2023-11-27 14:54:33', 1, NULL, 'gaules@email.com', 'ci3s#TI06'),
(2, 'Alanzoka', '2023-11-27 10:54:33', '2023-11-27 14:54:33', 1, NULL, 'alanzoka@email.com', '1234'),
(3, 'Quackity', '2023-11-28 10:55:34', '2023-11-27 14:55:34', 0, NULL, 'quackity@email.com', '1234'),
(4, 'Joao Gameplays', '2023-11-27 10:55:34', '2023-11-27 14:55:34', 0, NULL, 'joaogameplays@email.com', '1234'),
(5, 'EnzoCraft', '2023-11-27 10:56:13', '2023-11-27 14:56:13', 0, NULL, 'enzocraft@email.com', '1234'),
(8, 'Manoel', '2023-12-15 14:38:21', '2023-12-15 14:38:21', 0, NULL, 'manoel@email.com', '1234'),
(9, 'Cris', '2023-12-15 14:38:21', '2023-12-15 14:38:21', 0, NULL, 'cris@email.com', '1234'),
(17, 'teste', '2023-12-19 11:03:15', '2023-12-19 15:03:03', 0, NULL, 'teste@email.com', '123');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `imagem` varchar(220) DEFAULT NULL,
  `email` varchar(220) NOT NULL,
  `senha` varchar(220) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `imagem`, `email`, `senha`, `created`, `modified`) VALUES
(5, 'manoel_06', NULL, 'manoel@email.com', '1234', '2023-12-20 10:06:00', '2023-12-20 14:05:40'),
(6, 'cris_05', NULL, 'cris@email.com', '1234', '2023-12-20 10:07:23', '2023-12-20 14:07:00'),
(7, 'gabriel_04', NULL, 'gabriel@email.com', '1234', '2023-12-20 10:07:51', '2023-12-20 14:07:35');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `acompanha`
--
ALTER TABLE `acompanha`
  ADD PRIMARY KEY (`id_acompanhamento`),
  ADD KEY `id_streamer` (`id_streamer`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `streamers`
--
ALTER TABLE `streamers`
  ADD PRIMARY KEY (`id_streamer`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `acompanha`
--
ALTER TABLE `acompanha`
  MODIFY `id_acompanhamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `streamers`
--
ALTER TABLE `streamers`
  MODIFY `id_streamer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `acompanha`
--
ALTER TABLE `acompanha`
  ADD CONSTRAINT `acompanha_ibfk_1` FOREIGN KEY (`id_streamer`) REFERENCES `streamers` (`id_streamer`),
  ADD CONSTRAINT `acompanha_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
