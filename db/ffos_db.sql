-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/08/2023 às 02:52
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
-- Banco de dados: `ffos_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `cart_id` varchar(255) NOT NULL,
  `menvio` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL DEFAULT 'Nao especificado',
  `nome` varchar(255) DEFAULT NULL,
  `tel` varchar(255) NOT NULL DEFAULT '550000000000',
  `observacao` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL DEFAULT 'Nao especificado',
  `cidade_estado` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 = Pendente\r\n1 = Aceito\r\n2 = Entregue',
  `flag` int(10) NOT NULL DEFAULT 0,
  `status_info` varchar(120) NOT NULL DEFAULT 'Aceitar pedido' COMMENT '0 = Aceitar pedido\r\n1 = Pedido pronto\r\n2 = Entregue',
  `status_order` varchar(255) NOT NULL DEFAULT 'Aceito' COMMENT '1 = Aceito\r\n2 = Entregue',
  `queue` int(100) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `total_valor_total` varchar(255) NOT NULL,
  `taxa` varchar(120) NOT NULL DEFAULT '0.00',
  `desconto` varchar(120) NOT NULL DEFAULT '0.00',
  `quantity` varchar(120) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `category_list`
--

CREATE TABLE `category_list` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `category_list`
--

INSERT INTO `category_list` (`id`, `name`, `description`, `status`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 'Produto 1', '', 1, 0, '2023-08-03 21:41:00', '2023-08-03 21:41:00'),
(2, 'Produto 2', '', 1, 0, '2023-08-03 21:41:08', '2023-08-03 21:41:08'),
(3, 'Produto 3', '', 1, 0, '2023-08-03 21:41:15', '2023-08-03 21:41:15');

-- --------------------------------------------------------

--
-- Estrutura para tabela `config`
--

CREATE TABLE `config` (
  `id` int(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `config`
--

INSERT INTO `config` (`id`, `status`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `menu_list`
--

CREATE TABLE `menu_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `m_sabores` tinyint(1) NOT NULL DEFAULT 0,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `menu_list`
--

INSERT INTO `menu_list` (`id`, `category_id`, `code`, `name`, `description`, `price`, `status`, `m_sabores`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, '01', 'Produto 01', '', 5.00, 1, 0, 0, '2023-08-03 21:41:59', '2023-08-03 21:41:59'),
(2, 2, '02', 'Produto 02', '', 5.00, 1, 0, 0, '2023-08-03 21:42:11', '2023-08-03 21:42:11'),
(3, 3, '03', 'Produto 03', '', 8.00, 1, 0, 0, '2023-08-03 21:42:23', '2023-08-03 21:42:23');

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategory_list`
--

CREATE TABLE `subcategory_list` (
  `id` int(30) NOT NULL,
  `category_id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `code` varchar(100) NOT NULL,
  `delete_flag` tinyint(1) NOT NULL DEFAULT 0,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `subcategory_list`
--

INSERT INTO `subcategory_list` (`id`, `category_id`, `name`, `status`, `code`, `delete_flag`, `date_created`, `date_updated`) VALUES
(1, 1, 'test1', 1, '', 0, '2023-08-03 21:41:25', '2023-08-03 21:41:25'),
(2, 2, 'test2', 1, '', 0, '2023-08-03 21:41:30', '2023-08-03 21:41:30'),
(3, 3, 'test3', 1, '', 0, '2023-08-03 21:41:35', '2023-08-03 21:41:35');

-- --------------------------------------------------------

--
-- Estrutura para tabela `system_info`
--

CREATE TABLE `system_info` (
  `id` int(30) NOT NULL,
  `meta_field` text NOT NULL,
  `meta_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `system_info`
--

INSERT INTO `system_info` (`id`, `meta_field`, `meta_value`) VALUES
(1, 'name', 'Snoow'),
(6, 'short_name', 'ADM'),
(11, 'logo', 'uploads/icon/icon.ico?v=1653870746'),
(13, 'user_avatar', 'uploads/Logo2.png'),
(14, 'cover', 'uploads/bklogin.jpg?v=1653870818'),
(17, 'phone', '(41)99820-3105'),
(18, 'mobile', '(41)99820-3105'),
(19, 'email', 'Maykondiogodd32@outlook.com'),
(20, 'address', 'Rua tal 32'),
(21, 'color', '#fa3e3e');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `middlename` text DEFAULT NULL,
  `lastname` varchar(250) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `avatar` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `date_added` datetime NOT NULL DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='2';

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `firstname`, `middlename`, `lastname`, `username`, `password`, `avatar`, `last_login`, `type`, `date_added`, `date_updated`) VALUES
(1, 'Diogo', '', '', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'uploads/avatars/1.png?v=1649834664', NULL, 1, '2021-01-20 14:02:37', '2023-06-29 11:12:51');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `category_list`
--
ALTER TABLE `category_list`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `menu_list`
--
ALTER TABLE `menu_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Índices de tabela `subcategory_list`
--
ALTER TABLE `subcategory_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`) USING BTREE;

--
-- Índices de tabela `system_info`
--
ALTER TABLE `system_info`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `category_list`
--
ALTER TABLE `category_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `config`
--
ALTER TABLE `config`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `menu_list`
--
ALTER TABLE `menu_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `subcategory_list`
--
ALTER TABLE `subcategory_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `system_info`
--
ALTER TABLE `system_info`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `menu_list`
--
ALTER TABLE `menu_list`
  ADD CONSTRAINT `category_id_fk_ml` FOREIGN KEY (`category_id`) REFERENCES `subcategory_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restrições para tabelas `subcategory_list`
--
ALTER TABLE `subcategory_list`
  ADD CONSTRAINT `category_id_fk_ml_a` FOREIGN KEY (`category_id`) REFERENCES `category_list` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
