-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Dez-2021 às 20:50
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `batepapo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE `groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Geral'),
(2, 'Testes'),
(3, 'Desenvolvimento'),
(4, 'Criada via sistema'),
(5, 'Sala 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `messages`
--

CREATE TABLE `messages` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `date_msg` datetime NOT NULL,
  `msg` text NOT NULL,
  `msg_type` varchar(20) NOT NULL DEFAULT 'text'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `messages`
--

INSERT INTO `messages` (`id`, `id_user`, `id_group`, `date_msg`, `msg`, `msg_type`) VALUES
(1, 2, 4, '2021-12-03 17:07:09', 'Oi tudo bem?', 'text'),
(2, 1, 4, '2021-12-03 17:07:23', 'Belza eu estou bem!', 'text'),
(3, 2, 3, '2021-12-03 17:07:48', 'Mandando mensagem no DEV', 'text'),
(4, 2, 1, '2021-12-03 17:08:14', 'Mandando mmensagem no GERAL', 'text'),
(5, 1, 4, '2021-12-03 17:29:00', 'Opa legal?', 'text'),
(6, 1, 4, '2021-12-03 17:29:14', 'Testando novamente', 'text'),
(7, 1, 4, '2021-12-03 18:13:30', 'Mandando pra sistema', 'text'),
(8, 1, 4, '2021-12-03 18:17:25', 'Opa tudo bem?', 'text'),
(9, 1, 4, '2021-12-03 18:17:40', 'testando novamente', 'text'),
(13, 1, 4, '2021-12-03 20:34:41', 'Enviando via sistema', 'text'),
(14, 1, 4, '2021-12-03 20:34:55', 'd61dd32ca23f89df42b23be11894a9ec.jpg', 'img'),
(15, 1, 4, '2021-12-03 20:42:53', 'Opa', 'text'),
(16, 1, 4, '2021-12-03 20:43:27', 'cef3c19d3d40c2123778d4d157daca50.jpg', 'img'),
(17, 1, 5, '2021-12-03 20:45:57', '333cc3f90558ed7928eba8d4e80cceff.jpg', 'img'),
(18, 1, 1, '2021-12-03 20:46:33', '2e65e8747f2c3c34b68fd6351593cb0a.jpg', 'img'),
(19, 1, 1, '2021-12-03 20:46:45', 'Ola', 'text');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT '0',
  `pass` varchar(255) NOT NULL DEFAULT '0',
  `loginhash` varchar(32) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `username`, `pass`, `loginhash`) VALUES
(1, 'carlos', '$2y$10$8yARS6dl6.ZLaAINrFuvF.Sdp2q48lHtVN56JvmNyaBZUW3TkCf9G', '0bc9cf6abae7ec99745a8d2adbded311'),
(2, 'teste', '$2y$10$DAURtEmADYeU65KSm13DqerE42CM2fEfGy70o7s8qstQz731XM4aG', '668d114d871d4b9ebf1ac21ed2ad35c7');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
