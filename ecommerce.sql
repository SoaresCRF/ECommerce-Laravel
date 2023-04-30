-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30/04/2023 às 06:59
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ecommerce`
--
CREATE DATABASE IF NOT EXISTS `ecommerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ecommerce`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cod_produto` smallint(5) UNSIGNED NOT NULL,
  `quantidade` smallint(5) UNSIGNED NOT NULL,
  `total` decimal(8,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes_cadastrados`
--

CREATE TABLE `clientes_cadastrados` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome_cliente` varchar(100) NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `celular` varchar(11) NOT NULL,
  `sexo` varchar(2) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero_casa` varchar(9) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `data_cadastro` date NOT NULL,
  `cargo` varchar(7) NOT NULL DEFAULT 'cliente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `controle_venda`
--

CREATE TABLE `controle_venda` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_produto` smallint(5) UNSIGNED NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `fornecedor` varchar(50) NOT NULL,
  `valor_venda` decimal(8,2) UNSIGNED NOT NULL,
  `qtd_comprada` smallint(5) UNSIGNED NOT NULL,
  `total_venda` decimal(8,2) UNSIGNED NOT NULL,
  `data_venda` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `controle_venda`
--

INSERT INTO `controle_venda` (`id`, `cod_produto`, `nome_produto`, `fornecedor`, `valor_venda`, `qtd_comprada`, `total_venda`, `data_venda`) VALUES
(1, 11, 'core i5', 'intel', 2400.00, 1, 2400.00, '2023-04-30'),
(2, 5, 'cerverja', 'brahma', 4.00, 1, 4.00, '2023-04-30'),
(3, 6, 'café', 'nestle', 6.00, 4, 24.00, '2023-04-30');

-- --------------------------------------------------------

--
-- Estrutura para tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `senha` varchar(4) NOT NULL,
  `cargo` varchar(7) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `usuario`, `senha`, `cargo`, `ativo`) VALUES
(1, 'dono', '4546', 'dono', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(50, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(51, '2023_04_02_173030_create_funcionarios_table', 1),
(52, '2023_04_02_180414_create_carrinho_table', 1),
(53, '2023_04_02_180824_create_clientes_cadastrados_table', 1),
(54, '2023_04_02_182153_create_controle_venda_table', 1),
(55, '2023_04_02_182706_create_pedidos_concluidos_table', 1),
(56, '2023_04_02_183043_create_produtos_table', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedidos_concluidos`
--

CREATE TABLE `pedidos_concluidos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cpf` varchar(11) NOT NULL,
  `cod_produto` smallint(5) UNSIGNED NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `fornecedor` varchar(50) NOT NULL,
  `qtd_comprada` smallint(5) UNSIGNED NOT NULL,
  `total_comprado` decimal(8,2) UNSIGNED NOT NULL,
  `data_compra` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cod_produto` smallint(5) UNSIGNED NOT NULL,
  `nome_produto` varchar(50) NOT NULL,
  `fornecedor` varchar(50) NOT NULL,
  `custo_produto` decimal(8,2) UNSIGNED NOT NULL,
  `valor_venda` decimal(8,2) UNSIGNED NOT NULL,
  `estoque` smallint(5) UNSIGNED NOT NULL,
  `data_cadastro` date NOT NULL,
  `categoria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`id`, `cod_produto`, `nome_produto`, `fornecedor`, `custo_produto`, `valor_venda`, `estoque`, `data_cadastro`, `categoria`) VALUES
(1, 1, 'macarrão', 'perdigão', 5.00, 10.00, 50, '2023-04-30', 'alimento'),
(2, 2, 'pão', 'seara', 10.00, 20.00, 50, '2023-04-30', 'alimento'),
(3, 3, 'pizza', 'sadia', 15.50, 31.00, 50, '2023-04-30', 'alimento'),
(4, 4, 'vinho', 'gato negro', 40.00, 80.00, 50, '2023-04-30', 'bebida'),
(5, 5, 'cerverja', 'brahma', 2.00, 4.00, 49, '2023-04-30', 'bebida'),
(6, 6, 'café', 'nestle', 3.00, 6.00, 46, '2023-04-30', 'bebida'),
(7, 7, 'j5', 'samsung', 600.00, 1200.00, 50, '2023-04-30', 'celular'),
(8, 8, 'redmi note 7', 'xiaomi', 1000.00, 2000.00, 50, '2023-04-30', 'celular'),
(9, 9, 'z2 play', 'motorola', 1200.00, 2400.00, 50, '2023-04-30', 'celular'),
(10, 10, 'ryzen 5', 'amd', 1000.00, 2000.00, 50, '2023-04-30', 'hardware'),
(11, 11, 'core i5', 'intel', 1200.00, 2400.00, 49, '2023-04-30', 'hardware'),
(12, 12, 'core i7', 'intel', 1500.00, 3000.00, 50, '2023-04-30', 'hardware'),
(13, 13, 'league of legends', 'riot games', 40.00, 80.00, 50, '2023-04-30', 'jogo'),
(14, 14, 'fifa 23', 'ea sports', 30.00, 60.00, 50, '2023-04-30', 'jogo'),
(15, 15, 'gta v', 'rockstar games', 60.00, 120.00, 50, '2023-04-30', 'jogo');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes_cadastrados`
--
ALTER TABLE `clientes_cadastrados`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clientes_cadastrados_cpf_unique` (`cpf`),
  ADD UNIQUE KEY `clientes_cadastrados_email_unique` (`email`);

--
-- Índices de tabela `controle_venda`
--
ALTER TABLE `controle_venda`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `funcionarios_usuario_unique` (`usuario`);

--
-- Índices de tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pedidos_concluidos`
--
ALTER TABLE `pedidos_concluidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices de tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `produtos_cod_produto_unique` (`cod_produto`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `clientes_cadastrados`
--
ALTER TABLE `clientes_cadastrados`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `controle_venda`
--
ALTER TABLE `controle_venda`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de tabela `pedidos_concluidos`
--
ALTER TABLE `pedidos_concluidos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
