-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/08/2025 às 20:28
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
  `tipo_usuario` enum('colaborador','empresa') NOT NULL DEFAULT 'colaborador' COMMENT 'Define se o usuário é um colaborador ou uma empresa',
  `foto` varchar(255) DEFAULT NULL COMMENT 'Filename for the profile picture',
  `curriculo` varchar(255) DEFAULT NULL COMMENT 'Filename of the resume'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cadastro`
--

INSERT INTO `cadastro` (`id`, `nome`, `sobrenome`, `email`, `senha`, `cpf`, `rg`, `dtNascimento`, `endereco`, `cidade`, `celular`, `id_profissao`, `tipo_usuario`, `foto`, `curriculo`) VALUES
(29, 'Tauã Felipe', 'Amaro', 'taua.felipee@gmail.com', '$2y$10$ojIdwPN2q3jl2fdvD71nO.0/cgh06buRsu3cgR5RK.uH.UU81S.4m', '080.075.209-02', NULL, '2006-08-20', NULL, NULL, '44998899322', NULL, 'colaborador', NULL, NULL),
(30, 'empresateste', 'teste', 'empresateste@gmail.com', '$2y$10$75uEzYnK8NpjvtdGfaTAeu.F8B.nFovYv6UR2OG0huspCcGCpZy8G', '537.610.543-19', NULL, '2003-09-20', NULL, NULL, '2345540303', NULL, 'empresa', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `candidatos`
--

CREATE TABLE `candidatos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_endereco` int(11) DEFAULT NULL,
  `nome_completo` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `id_profissao` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `curriculo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curriculos`
--

CREATE TABLE `curriculos` (
  `id` int(11) NOT NULL,
  `id_cadastro` int(11) NOT NULL,
  `nome_completo` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `idade` int(3) DEFAULT NULL,
  `estado_civil` varchar(50) DEFAULT NULL,
  `nacionalidade` varchar(100) DEFAULT NULL,
  `cnh` varchar(10) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `resumo` text DEFAULT NULL,
  `habilidades` text DEFAULT NULL,
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curriculo_experiencia`
--

CREATE TABLE `curriculo_experiencia` (
  `id` int(11) NOT NULL,
  `id_curriculo` int(11) NOT NULL,
  `cargo` varchar(255) DEFAULT NULL,
  `empresa` varchar(255) DEFAULT NULL,
  `periodo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curriculo_formacao`
--

CREATE TABLE `curriculo_formacao` (
  `id` int(11) NOT NULL,
  `id_curriculo` int(11) NOT NULL,
  `instituicao` varchar(255) DEFAULT NULL,
  `curso` varchar(255) DEFAULT NULL,
  `periodo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `razao_social` varchar(40) DEFAULT NULL,
  `cnpj` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id` int(11) NOT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `rua` varchar(255) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(2) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `enderecos`
--

INSERT INTO `enderecos` (`id`, `cep`, `rua`, `numero`, `bairro`, `cidade`, `estado`, `created_at`, `updated_at`) VALUES
(1, '87970-000', 'Rua Adalberto Rodrigues', '88', 'Nova Londrina 7', 'Nova Londrina', 'PR', '2025-08-30 03:55:05', '2025-08-30 03:55:05'),
(2, '87970-000', 'Rua Adalberto Rodrigues', '89', 'Nova Londrina 7', 'Nova Londrina', 'PR', '2025-08-30 16:08:07', '2025-08-30 16:08:07');

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
(6, 'Designer Gráfico'),
(7, 'Empresário'),
(8, 'Instrutor');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `tipo_usuario` enum('candidato','empresa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `celular`, `tipo_usuario`, `created_at`, `updated_at`) VALUES
(1, 'taua.felipee@gmail.com', '$2y$10$ez.YrBe3fhL/SAJhviqkcuzjOnuXMgoHH.BAswgPR74XAboGzlq7i', '(44) 99889-9322', '', '2025-08-30 03:55:05', '2025-08-30 03:55:05'),
(2, 'empresa@gmail.com', '$2y$10$w2lpdF6HbfWKnVx0mx5ueuwanjLcUB0JX9Gw0KwKIfY6N4bJW0HPK', '44998899334', '', '2025-08-30 16:08:07', '2025-08-30 16:08:07');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

CREATE TABLE `vagas` (
  `id` int(10) UNSIGNED NOT NULL,
  `empresa` varchar(30) NOT NULL,
  `descricao_empresa` text DEFAULT NULL,
  `telefone_empresa` varchar(20) DEFAULT NULL,
  `email_empresa` varchar(255) DEFAULT NULL,
  `localizacao` varchar(255) DEFAULT NULL,
  `cargo` varchar(30) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `beneficios` text DEFAULT NULL,
  `descricao` text NOT NULL,
  `carga_horaria` varchar(50) DEFAULT NULL,
  `requisitos` text NOT NULL,
  `usuario_responsavel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cadastro`
--
ALTER TABLE `cadastro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cadastro_profissao` (`id_profissao`);

--
-- Índices de tabela `candidatos`
--
ALTER TABLE `candidatos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_endereco` (`id_endereco`);

--
-- Índices de tabela `curriculos`
--
ALTER TABLE `curriculos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_cadastro` (`id_cadastro`);

--
-- Índices de tabela `curriculo_experiencia`
--
ALTER TABLE `curriculo_experiencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curriculo` (`id_curriculo`);

--
-- Índices de tabela `curriculo_formacao`
--
ALTER TABLE `curriculo_formacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_curriculo` (`id_curriculo`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_historico_cadastro` (`id_cadastro`),
  ADD KEY `fk_historico_vagas` (`id_vaga`);

--
-- Índices de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_inscricoes_vagas` (`id_vaga`),
  ADD KEY `fk_inscricoes_cadastro` (`id_usuario`);

--
-- Índices de tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vagas_cadastro` (`usuario_responsavel`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro`
--
ALTER TABLE `cadastro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `candidatos`
--
ALTER TABLE `candidatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `curriculos`
--
ALTER TABLE `curriculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `curriculo_experiencia`
--
ALTER TABLE `curriculo_experiencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `curriculo_formacao`
--
ALTER TABLE `curriculo_formacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cadastro`
--
ALTER TABLE `cadastro`
  ADD CONSTRAINT `fk_cadastro_profissao` FOREIGN KEY (`id_profissao`) REFERENCES `profissao` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Restrições para tabelas `candidatos`
--
ALTER TABLE `candidatos`
  ADD CONSTRAINT `candidatos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `candidatos_ibfk_2` FOREIGN KEY (`id_endereco`) REFERENCES `enderecos` (`id`) ON DELETE SET NULL;

--
-- Restrições para tabelas `curriculos`
--
ALTER TABLE `curriculos`
  ADD CONSTRAINT `fk_curriculo_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `curriculo_experiencia`
--
ALTER TABLE `curriculo_experiencia`
  ADD CONSTRAINT `fk_experiencia_curriculo` FOREIGN KEY (`id_curriculo`) REFERENCES `curriculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `curriculo_formacao`
--
ALTER TABLE `curriculo_formacao`
  ADD CONSTRAINT `fk_formacao_curriculo` FOREIGN KEY (`id_curriculo`) REFERENCES `curriculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `fk_historico_cadastro` FOREIGN KEY (`id_cadastro`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_historico_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD CONSTRAINT `fk_inscricoes_cadastro` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_inscricoes_vagas` FOREIGN KEY (`id_vaga`) REFERENCES `vagas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `fk_vagas_cadastro` FOREIGN KEY (`usuario_responsavel`) REFERENCES `cadastro` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
