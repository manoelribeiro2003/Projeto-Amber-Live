-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07-Dez-2023 às 13:05
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
-- Estrutura da tabela `streamers`
--

CREATE TABLE `streamers` (
  `id` int(11) NOT NULL,
  `name` varchar(110) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` int(2) NOT NULL,
  `imagem` varchar(220) DEFAULT NULL,
  `email` varchar(220) DEFAULT NULL,
  `senha` varchar(110) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `streamers`
--

INSERT INTO `streamers` (`id`, `name`, `created`, `modified`, `status`, `imagem`, `email`, `senha`) VALUES
(1, 'Gaulês', '2023-11-27 10:54:33', '2023-11-27 14:54:33', 1, NULL, 'gaules@email.com', '1234'),
(2, 'Alanzoka', '2023-11-27 10:54:33', '2023-11-27 14:54:33', 1, NULL, 'alanzoka@email.com', '1234'),
(3, 'Quackity', '2023-11-28 10:55:34', '2023-11-27 14:55:34', 0, NULL, 'quackity@email.com', '1234'),
(4, 'Joao Gameplays', '2023-11-27 10:55:34', '2023-11-27 14:55:34', 0, NULL, 'joaogameplays@email.com', '1234'),
(5, 'EnzoCraft', '2023-11-27 10:56:13', '2023-11-27 14:56:13', 0, NULL, 'enzocraft@email.com', '1234');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `streamers`
--
ALTER TABLE `streamers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `streamers`
--
ALTER TABLE `streamers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
