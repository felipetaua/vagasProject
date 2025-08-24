-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23/08/2025 às 18:00
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jobs`
--
CREATE DATABASE IF NOT EXISTS `jobs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `jobs`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `cadastro`
--

CREATE TABLE `cadastro` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `sobrenome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `dtNascimento` date DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `id_profissao` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL COMMENT 'Filename for the profile picture',
  `curriculo` varchar(255) DEFAULT NULL COMMENT 'Filename of the resume'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `sobrenome`, `email`, `senha`, `cpf`, `rg`, `dtNascimento`, `endereco`, `cidade`, `celular`, `id_profissao`, `foto`, `curriculo`) VALUES
(20, 'Gabriel', 'de Oliveira', 'gabriel.bernardino@urca.br', '$2y$10$Y8.BqgL5p2A9c.N.Z.f8X.O2uI/Ea5Lz3g5Kz1H.g9j7k6Lz4O', '123.456.789-00', '12345678', '1999-08-15', 'AV manoel neres de oliveira', 'FORTALEZA', '88999963774', 3, 'foto_gabriel.png', 'curriculo_gabriel.pdf'),
(21, 'Andre', 'Silva', 'andre@teste.com', '$2y$10$A1.bC2dE3fG4hI5jK6lM7n.oP8qR9sT0uV1wX2yZ3aB4c5D6eF', '000.000.000-00', '3545346464', '2001-03-20', 'Rua Exemplo, 123', 'Crato', '(88)9.9999-9999', 1, '68a92aff6b1d4.png', 'cv_andre.pdf'),
(22, 'Jose', 'Urubu', 'ze@gmail.com', '$2y$10$B7c8D9eF0gH1iJ2kL3mN4o.pQ5rS6tU7vW8xY9z.aB1c2D3eF4', '123.456.789-01', '3545346464', '1985-11-02', 'Centro', 'Crato', '(88)9.8888-8888', 4, NULL, NULL),
(23, 'Ana', 'Souza', 'an@gmail.com', '$2y$10$C4d5E6fG7hI8jK9lM0n.oP1qR2sT3uV4wX5yZ6aB7c8D9eF0gH', '987.654.321-00', '654654654654', '2003-05-07', 'Bairro Novo', 'Juazeiro', '(88)9.7777-7777', 2, NULL, 'cv_ana.pdf');

-- --------------------------------------------------------

--
-- Estrutura para tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) NOT NULL,
  `id_cadastro` int(11) NOT NULL,
  `id_vaga` int(10) UNSIGNED NOT NULL,
  `forma_pagamento` varchar(50) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `dtPagamento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `historico`
--

INSERT INTO `historico` (`id`, `id_cadastro`, `id_vaga`, `forma_pagamento`, `valor`, `dtPagamento`) VALUES
(1, 21, 26, 'Débito', 450.00, '2023-05-17 15:09:44'),
(2, 22, 26, 'Dinheiro', 950.00, '2023-05-17 18:37:10'),
(3, 21, 26, 'PIX', 1200.00, '2023-05-17 18:37:24'),
(4, 21, 26, 'PIX', 4578.00, '2023-05-23 22:02:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `id_vaga` int(10) UNSIGNED NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data_inscricao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `profissao`
--

CREATE TABLE `profissao` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `profissao`
--

INSERT INTO `profissao` (`id`, `nome`) VALUES
(1, 'Engenheiro Civil'),
(2, 'Médico'),
(3, 'Professor'),
(4, 'Advogado'),
(5, 'Desenvolvedor Web'),
(6, 'Designer Gráfico');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(10) UNSIGNED NOT NULL,
  `empresa` varchar(30) NOT NULL,
  `cargo` varchar(30) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `requisitos` text NOT NULL,
  `usuario_responsavel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vagas`
--

INSERT INTO `vagas` (`id`, `empresa`, `cargo`, `telefone`, `email`, `cidade`, `salario`, `descricao`, `requisitos`, `usuario_responsavel`) VALUES
(24, 'Google', 'Dev Jr', '(88) 9999-9999', 'google@gmail.com', 'Crato', 3000.00, 'Desenvolvedor Front-end', 'HTML, CSS, JavaScript', 21),
(25, 'Facebook', 'Dev Senior', '(88) 9999-9999', 'face@gmail.com', 'Crato', 5000.00, 'Desenvolvedor Back-end', 'Node, PHP, SQL', 21),
(26, 'Amazon', 'Dev Pleno', '(88) 9999-9999', 'ama@gmail.com', 'Crato', 4000.00, 'Desenvolvedor Full-stack', 'HTML, CSS, JavaScript, Node, PHP, SQL', 22);

--
-- Índices para tabelas despejadas
--

ALTER TABLE `cadastro` ADD PRIMARY KEY (`id`), ADD KEY `fk_cadastro_profissao` (`id_profissao`);
ALTER TABLE `historico` ADD PRIMARY KEY (`id`), ADD KEY `fk_historico_cadastro` (`id_cadastro`), ADD KEY `fk_historico_vagas` (`id_vaga`);
ALTER TABLE `inscricoes` ADD PRIMARY KEY (`id`), ADD KEY `fk_inscricoes_vagas` (`id_vaga`), ADD KEY `fk_inscricoes_cadastro` (`id_usuario`);
ALTER TABLE `profissao` ADD PRIMARY KEY (`id`);
ALTER TABLE `vagas` ADD PRIMARY KEY (`id`), ADD KEY `fk_vagas_cadastro` (`usuario_responsavel`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

ALTER TABLE `cadastro` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
ALTER TABLE `historico` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
ALTER TABLE `inscricoes` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
ALTER TABLE `profissao` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
ALTER TABLE `vagas` MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restrições para tabelas despejadas
--

ALTER TABLE `cadastro` ADD CONSTRAINT `fk_cadastro_profissao` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `historico` ADD CONSTRAINT `fk_historico_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `fk_historico_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `inscricoes` ADD CONSTRAINT `fk_inscricoes_cadastro` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE, ADD CONSTRAINT `fk_inscricoes_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `vagas` ADD CONSTRAINT `fk_vagas_cadastro` FOREIGN KEY (`usuario_responsavel`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;