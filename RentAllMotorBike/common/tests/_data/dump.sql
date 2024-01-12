-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Jan-2024 às 03:05
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `projetobd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `analise`
--

DROP TABLE IF EXISTS `analise`;
CREATE TABLE IF NOT EXISTS `analise` (
  `id_analise` int NOT NULL AUTO_INCREMENT,
  `comentario` varchar(250) NOT NULL,
  `classificao` varchar(50) NOT NULL,
  `data_analise` datetime NOT NULL,
  `profile_id` int NOT NULL,
  PRIMARY KEY (`id_analise`),
  KEY `uprofile_id` (`profile_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `assistencia`
--

DROP TABLE IF EXISTS `assistencia`;
CREATE TABLE IF NOT EXISTS `assistencia` (
  `id_assistencia` int NOT NULL AUTO_INCREMENT,
  `data_pedido` datetime NOT NULL,
  `mensagem` varchar(250) NOT NULL,
  `localizacao` varchar(50) NOT NULL,
  `condicao` varchar(50) NOT NULL,
  `motociclo_id_assistencia` int NOT NULL,
  `uprofile_id` int NOT NULL,
  PRIMARY KEY (`id_assistencia`),
  KEY `motociclo_id_assistencia_fk` (`motociclo_id_assistencia`),
  KEY `uprofile_id_assistencia_fk` (`uprofile_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1704762792),
('cliente', '38', 1704763610),
('gestor', '39', 1704763852);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, NULL, NULL, NULL, 1704762792, 1704762792),
('cliente', 1, NULL, NULL, NULL, 1704762792, 1704762792),
('createAnalise', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('createExtra', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('createFuncionario', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('createImagem', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('createLocalizacao', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('createReserva', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('createSeguro', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('createVeiculo', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('deleteAnalise', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('deleteExtra', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('deleteFuncionario', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('deleteImagem', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('deleteLocalizacao', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('deleteReserva', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('deleteSeguro', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('deleteVeiculo', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('gestor', 1, NULL, NULL, NULL, 1704762792, 1704762792),
('loginBackend', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('updateAnalise', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('updateExtra', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('updateFuncionario', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('updateLocalizacao', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('updateReserva', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('updateSeguro', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('updateVeiculo', 2, NULL, NULL, NULL, 1704762791, 1704762791),
('viewFuncionario', 2, NULL, NULL, NULL, 1704762792, 1704762792),
('viewReserva', 2, NULL, NULL, NULL, 1704762792, 1704762792);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('cliente', 'createAnalise'),
('gestor', 'createExtra'),
('admin', 'createFuncionario'),
('gestor', 'createImagem'),
('gestor', 'createLocalizacao'),
('cliente', 'createReserva'),
('gestor', 'createSeguro'),
('gestor', 'createVeiculo'),
('cliente', 'deleteAnalise'),
('gestor', 'deleteExtra'),
('admin', 'deleteFuncionario'),
('gestor', 'deleteImagem'),
('gestor', 'deleteLocalizacao'),
('cliente', 'deleteReserva'),
('gestor', 'deleteSeguro'),
('gestor', 'deleteVeiculo'),
('admin', 'gestor'),
('gestor', 'loginBackend'),
('cliente', 'updateAnalise'),
('gestor', 'updateExtra'),
('admin', 'updateFuncionario'),
('gestor', 'updateLocalizacao'),
('cliente', 'updateReserva'),
('gestor', 'updateSeguro'),
('gestor', 'updateVeiculo'),
('admin', 'viewFuncionario'),
('cliente', 'viewReserva'),
('gestor', 'viewReserva');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `carrinho_compras`
--

DROP TABLE IF EXISTS `carrinho_compras`;
CREATE TABLE IF NOT EXISTS `carrinho_compras` (
  `id_carrinho` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `quantidade` int NOT NULL,
  `preco_unitario` double NOT NULL,
  `total` double NOT NULL,
  `utilizador_id` int NOT NULL,
  PRIMARY KEY (`id_carrinho`),
  KEY `produto_id_fk` (`id_produto`),
  KEY `utilizador_id_fk` (`utilizador_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `detalhes_aluguer`
--

DROP TABLE IF EXISTS `detalhes_aluguer`;
CREATE TABLE IF NOT EXISTS `detalhes_aluguer` (
  `id_detalhes_aluguer` int NOT NULL AUTO_INCREMENT,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime NOT NULL,
  `motociclo_id` int NOT NULL,
  `profile_id` int NOT NULL,
  `seguro_id` int NOT NULL,
  `localizacao_levantamento_id` int NOT NULL,
  `localizacao_devolucao_id` int NOT NULL,
  PRIMARY KEY (`id_detalhes_aluguer`),
  KEY `motociclo_id` (`motociclo_id`),
  KEY `profile_id` (`profile_id`),
  KEY `seguro_id` (`seguro_id`),
  KEY `localizacao_levantamento_id` (`localizacao_levantamento_id`),
  KEY `localizacao_devolucao_id` (`localizacao_devolucao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `detalhes_aluguer`
--

INSERT INTO `detalhes_aluguer` (`id_detalhes_aluguer`, `data_inicio`, `data_fim`, `motociclo_id`, `profile_id`, `seguro_id`, `localizacao_levantamento_id`, `localizacao_devolucao_id`) VALUES
(6, '2024-01-19 01:31:00', '2024-01-31 01:31:00', 2, 26, 2, 2, 2),
(7, '2024-01-23 02:27:00', '2024-01-31 02:27:00', 3, 26, 1, 2, 2),
(8, '2024-01-10 02:45:00', '2024-01-12 02:45:00', 4, 26, 1, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extra`
--

DROP TABLE IF EXISTS `extra`;
CREATE TABLE IF NOT EXISTS `extra` (
  `id_extra` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `preco` double NOT NULL,
  PRIMARY KEY (`id_extra`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `extra`
--

INSERT INTO `extra` (`id_extra`, `descricao`, `preco`) VALUES
(1, 'Capacete', 150),
(2, 'Sidecar', 400);

-- --------------------------------------------------------

--
-- Estrutura da tabela `extra_detalhes_aluguer`
--

DROP TABLE IF EXISTS `extra_detalhes_aluguer`;
CREATE TABLE IF NOT EXISTS `extra_detalhes_aluguer` (
  `id_extra_detalhes_aluguer` int NOT NULL AUTO_INCREMENT,
  `extra_id` int NOT NULL,
  `detalhes_aluguer_id` int NOT NULL,
  PRIMARY KEY (`id_extra_detalhes_aluguer`),
  KEY `extra_id` (`extra_id`),
  KEY `detalhes_aluguer_id` (`detalhes_aluguer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `extra_detalhes_aluguer`
--

INSERT INTO `extra_detalhes_aluguer` (`id_extra_detalhes_aluguer`, `extra_id`, `detalhes_aluguer_id`) VALUES
(3, 1, 6),
(4, 2, 6),
(5, 1, 7),
(6, 2, 7),
(7, 1, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id_fatura` int NOT NULL AUTO_INCREMENT,
  `data_fatura` datetime NOT NULL,
  `preco_total` double NOT NULL,
  `detalhes_aluguer_fatura_id` int NOT NULL,
  PRIMARY KEY (`id_fatura`),
  KEY `detalhes_aluguer_fatura_id` (`detalhes_aluguer_fatura_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`id_fatura`, `data_fatura`, `preco_total`, `detalhes_aluguer_fatura_id`) VALUES
(18, '2024-01-09 02:28:05', 7325.82, 7),
(19, '2024-01-09 02:46:35', 1169.94, 8),
(20, '2024-01-09 02:57:49', 9086.74, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagem`
--

DROP TABLE IF EXISTS `imagem`;
CREATE TABLE IF NOT EXISTS `imagem` (
  `id_imagem` int NOT NULL AUTO_INCREMENT,
  `imagem` varchar(50) NOT NULL,
  `motociclo_id_imagem` int NOT NULL,
  PRIMARY KEY (`id_imagem`),
  KEY `motociclo_id_imagem_fk` (`motociclo_id_imagem`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `imagem`
--

INSERT INTO `imagem` (`id_imagem`, `imagem`, `motociclo_id_imagem`) VALUES
(1, '3175_default_1676391411', 2),
(3, '3193_default_1676396978', 3),
(4, '3197_default_1676397694', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `linha_fatura`
--

DROP TABLE IF EXISTS `linha_fatura`;
CREATE TABLE IF NOT EXISTS `linha_fatura` (
  `id_linha_fatura` int NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) NOT NULL,
  `preco` double DEFAULT NULL,
  `fatura_id` int NOT NULL,
  PRIMARY KEY (`id_linha_fatura`),
  KEY `fatura_id` (`fatura_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `linha_fatura`
--

INSERT INTO `linha_fatura` (`id_linha_fatura`, `descricao`, `preco`, `fatura_id`) VALUES
(9, 'DUCATI MULTISTRADA V2 S', 213.99, 18),
(10, 'Tranquilidade Proteção Total', 49.99, 18),
(11, 'Leiria', NULL, 18),
(12, 'Leiria', NULL, 18),
(13, 'Capacete', 150, 18),
(14, 'Sidecar', 400, 18),
(15, 'HARLEY DAVIDSON SPORT', 189.99, 19),
(16, 'Tranquilidade Proteção Total', 49.99, 19),
(17, 'Leiria', NULL, 19),
(18, 'Leiria', NULL, 19),
(19, 'Capacete', 150, 19),
(20, 'BMW  R1250 GS', 132.99, 20),
(21, 'Directo Seguro de responsabilidad', 15.99, 20),
(22, 'Leiria', NULL, 20),
(23, 'Leiria', NULL, 20),
(24, 'Capacete', 150, 20),
(25, 'Sidecar', 400, 20);

-- --------------------------------------------------------

--
-- Estrutura da tabela `localizacao`
--

DROP TABLE IF EXISTS `localizacao`;
CREATE TABLE IF NOT EXISTS `localizacao` (
  `id_localizacao` int NOT NULL AUTO_INCREMENT,
  `localizacao` varchar(50) NOT NULL,
  `morada` varchar(50) NOT NULL,
  `codigo_postal` varchar(10) NOT NULL,
  PRIMARY KEY (`id_localizacao`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `localizacao`
--

INSERT INTO `localizacao` (`id_localizacao`, `localizacao`, `morada`, `codigo_postal`) VALUES
(1, 'Lisboa', 'Avenida da Liberdade ', '1250-142'),
(2, 'Leiria', 'Av. Maques de Pombal ', '2410-152'),
(3, 'Porto', 'Rua Particular Nº 1 Castelo do Queijo', '4151-901');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1700274580),
('m130524_201442_init', 1700274583),
('m190124_110200_add_verification_token_column_to_user_table', 1700274583),
('m140506_102106_rbac_init', 1700277563),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1700277563),
('m180523_151638_rbac_updates_indexes_without_prefix', 1700277563),
('m200409_110543_rbac_update_mssql_trigger', 1700277563);

-- --------------------------------------------------------

--
-- Estrutura da tabela `motociclo`
--

DROP TABLE IF EXISTS `motociclo`;
CREATE TABLE IF NOT EXISTS `motociclo` (
  `idmotociclo` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(50) NOT NULL,
  `descricao` varchar(200) NOT NULL,
  `combustivel` varchar(20) NOT NULL,
  `preco` double NOT NULL,
  `estado` varchar(10) NOT NULL,
  `tipo_motociclo_id` int NOT NULL,
  `localizacao_id` int NOT NULL,
  `franquia` int NOT NULL,
  PRIMARY KEY (`idmotociclo`),
  KEY `tipo_motociclo_id` (`tipo_motociclo_id`),
  KEY `localizacao_id` (`localizacao_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `motociclo`
--

INSERT INTO `motociclo` (`idmotociclo`, `marca`, `modelo`, `descricao`, `combustivel`, `preco`, `estado`, `tipo_motociclo_id`, `localizacao_id`, `franquia`) VALUES
(2, 'BMW ', 'R1250 GS', 'Quer esteja a planear alcançar o Cabo Norte ou fazer uma viagem de fim de semana na melhor companhia, o seu motor potente, capacidade de carga e conectividade superior permitem desfrutar de uma experi', 'Gasolina', 132.99, 'Nova', 1, 1, 1000),
(3, 'DUCATI', 'MULTISTRADA V2 S', 'Indicada para quem procura uma condução mais relaxada, mas com a extraordinária entrega do histórico motor da Ducati. Perfeita para passeios de motocicleta em rotas alpinas e aventuras na montanha, po', 'Gasolina ', 213.99, 'Nova', 4, 3, 1000),
(4, 'HARLEY', 'DAVIDSON SPORT', 'Os modelos Sportster da Harley-Davidson são tanto menores quanto mais leves do que a maioria dos outros, com uma aparência claramente inspirada em motocicletas de corrida. Utilizando motores Evolution', 'Gasolina ', 189.99, 'Novo', 4, 1, 1000);

-- --------------------------------------------------------

--
-- Estrutura da tabela `seguro`
--

DROP TABLE IF EXISTS `seguro`;
CREATE TABLE IF NOT EXISTS `seguro` (
  `id_seguro` int NOT NULL AUTO_INCREMENT,
  `marca` varchar(25) NOT NULL,
  `cobertura` varchar(25) NOT NULL,
  `preco` double NOT NULL,
  PRIMARY KEY (`id_seguro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `seguro`
--

INSERT INTO `seguro` (`id_seguro`, `marca`, `cobertura`, `preco`) VALUES
(1, 'Tranquilidade', 'Proteção Total', 49.99),
(2, 'Directo', 'Seguro de responsabilidad', 15.99),
(3, 'Ageas', 'Contra Roubo', 19.99);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_motociclo`
--

DROP TABLE IF EXISTS `tipo_motociclo`;
CREATE TABLE IF NOT EXISTS `tipo_motociclo` (
  `id_tipo_motociclo` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_motociclo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `tipo_motociclo`
--

INSERT INTO `tipo_motociclo` (`id_tipo_motociclo`, `categoria`) VALUES
(1, 'Enduro'),
(2, 'Scooters '),
(3, 'Quads'),
(4, 'Touring');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uprofile`
--

DROP TABLE IF EXISTS `uprofile`;
CREATE TABLE IF NOT EXISTS `uprofile` (
  `id_profile` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `apelido` varchar(20) NOT NULL,
  `telemovel` int NOT NULL,
  `nif` int NOT NULL,
  `nr_cartaconducao` varchar(20) NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id_profile`),
  KEY `id_user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `uprofile`
--

INSERT INTO `uprofile` (`id_profile`, `nome`, `apelido`, `telemovel`, `nif`, `nr_cartaconducao`, `id_user`) VALUES
(20, 'Admin', 'pedro', 911234567, 2147483647, '12345667789', 1),
(26, 'Cliente', 'toni', 911234567, 123445678, '3214332432543', 38),
(27, 'Gestor', 'Frota', 911234567, 123445678, '32143324325432', 39);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb3_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'Admin', 'PP_rATmbLVOIq8eqxI072J8xAaqFWqMC', '$2y$13$e2pD22gmIG8rdW4cghzrp.IqcSNMj23GsRWBznwSfQl/wTUO3NpFC', NULL, 'Admin@gmail.com', 10, 1700610050, 1700610050, NULL),
(38, 'Cliente', '-FIyg9bcVqBBpMqV9cZdgaaDpULSJI2s', '$2y$13$ehLyYmM7nRlSL9/6fEkpEuXO2Ueqap5uR22zbuiZ2PNF3I54nokMa', NULL, 'cliente@gmail.com', 10, 1704763610, 1704763610, NULL),
(39, 'Gestor Frota', 'o8Emoz4r7-d8Xt-jxCUs0BQr3ZCDmtoF', '$2y$13$dEOZriy/mbcb8maptQl1C.m30hjErlmCn13muTjLAD8CvszuJSq1a', NULL, 'gestor@gmail.com', 10, 1704763852, 1704763852, NULL);

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `analise`
--
ALTER TABLE `analise`
  ADD CONSTRAINT `uprofile_id` FOREIGN KEY (`profile_id`) REFERENCES `uprofile` (`id_profile`);

--
-- Limitadores para a tabela `assistencia`
--
ALTER TABLE `assistencia`
  ADD CONSTRAINT `motociclo_id_assistencia_fk` FOREIGN KEY (`motociclo_id_assistencia`) REFERENCES `motociclo` (`idmotociclo`),
  ADD CONSTRAINT `uprofile_id_assistencia_fk` FOREIGN KEY (`uprofile_id`) REFERENCES `uprofile` (`id_profile`);

--
-- Limitadores para a tabela `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `carrinho_compras`
--
ALTER TABLE `carrinho_compras`
  ADD CONSTRAINT `produto_id_fk` FOREIGN KEY (`id_produto`) REFERENCES `motociclo` (`idmotociclo`),
  ADD CONSTRAINT `utilizador_id_fk` FOREIGN KEY (`utilizador_id`) REFERENCES `uprofile` (`id_profile`);

--
-- Limitadores para a tabela `detalhes_aluguer`
--
ALTER TABLE `detalhes_aluguer`
  ADD CONSTRAINT `localizacao_devolucao_id` FOREIGN KEY (`localizacao_devolucao_id`) REFERENCES `localizacao` (`id_localizacao`),
  ADD CONSTRAINT `localizacao_levantamento_id` FOREIGN KEY (`localizacao_levantamento_id`) REFERENCES `localizacao` (`id_localizacao`),
  ADD CONSTRAINT `motociclo_id` FOREIGN KEY (`motociclo_id`) REFERENCES `motociclo` (`idmotociclo`),
  ADD CONSTRAINT `profile_id` FOREIGN KEY (`profile_id`) REFERENCES `uprofile` (`id_profile`),
  ADD CONSTRAINT `seguro_id` FOREIGN KEY (`seguro_id`) REFERENCES `seguro` (`id_seguro`);

--
-- Limitadores para a tabela `extra_detalhes_aluguer`
--
ALTER TABLE `extra_detalhes_aluguer`
  ADD CONSTRAINT `detalhes_aluguer_id` FOREIGN KEY (`detalhes_aluguer_id`) REFERENCES `detalhes_aluguer` (`id_detalhes_aluguer`),
  ADD CONSTRAINT `extra_id` FOREIGN KEY (`extra_id`) REFERENCES `extra` (`id_extra`);

--
-- Limitadores para a tabela `fatura`
--
ALTER TABLE `fatura`
  ADD CONSTRAINT `detalhes_aluguer_fatura_id` FOREIGN KEY (`detalhes_aluguer_fatura_id`) REFERENCES `detalhes_aluguer` (`id_detalhes_aluguer`);

--
-- Limitadores para a tabela `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `motociclo_id_imagem_fk` FOREIGN KEY (`motociclo_id_imagem`) REFERENCES `motociclo` (`idmotociclo`);

--
-- Limitadores para a tabela `linha_fatura`
--
ALTER TABLE `linha_fatura`
  ADD CONSTRAINT `fatura_id` FOREIGN KEY (`fatura_id`) REFERENCES `fatura` (`id_fatura`);

--
-- Limitadores para a tabela `motociclo`
--
ALTER TABLE `motociclo`
  ADD CONSTRAINT `localizacao_id` FOREIGN KEY (`localizacao_id`) REFERENCES `localizacao` (`id_localizacao`),
  ADD CONSTRAINT `tipo_motociclo_id` FOREIGN KEY (`tipo_motociclo_id`) REFERENCES `tipo_motociclo` (`id_tipo_motociclo`);

--
-- Limitadores para a tabela `uprofile`
--
ALTER TABLE `uprofile`
  ADD CONSTRAINT `uprofile_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
