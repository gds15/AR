-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Nov-2018 às 20:03
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsystem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `id` int(11) NOT NULL,
  `data` date DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` double DEFAULT NULL,
  `valorPago` double DEFAULT NULL,
  `multaJuros` double DEFAULT NULL,
  `mes` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `data`, `descricao`, `valor`, `valorPago`, `multaJuros`, `mes`) VALUES
(2, '2018-11-29', 'agua', 120, 120, 0, '11'),
(4, '2018-11-19', 'teste', 120, 120, 0, '11'),
(5, '2018-11-19', 'luz', 60, 60, 0, '11'),
(6, '2018-11-19', 'agua', 60, 60, 0, '11'),
(7, '2018-11-19', 'aluguel', 1000, 1000, 0, '11'),
(8, '2018-11-19', 'telefone', 500, 500, 0, '11'),
(9, '2018-11-27', 'outros', 1, 1000, 0, '11'),
(10, '2018-11-27', 'encomenda', 500, 0, 0, '11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `culto`
--

CREATE TABLE `culto` (
  `id` int(11) NOT NULL,
  `responsavel` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `local` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `culto`
--

INSERT INTO `culto` (`id`, `responsavel`, `data`, `hora`, `local`, `tipo`) VALUES
(1, 3, '2018-11-07', '19:00', 'umuarama', 2),
(2, 3, '2018-11-07', '19:30', 'Perobal', 2),
(4, 3, '2018-11-09', '22:00', 'umuarama', 3),
(5, 3, '2018-11-09', '17:00', 'Perobal', 4),
(7, 3, '2018-11-14', '19:00', 'Perobal', 2),
(8, 3, '2018-11-16', '22:00', 'umuarama', 6),
(9, 3, '2018-11-16', '17:20', 'Perobal', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `dizimo`
--

CREATE TABLE `dizimo` (
  `id` int(11) NOT NULL,
  `membro` int(11) NOT NULL,
  `valor` double NOT NULL,
  `desc` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `usuariocds` int(11) NOT NULL,
  `mes` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `dizimo`
--

INSERT INTO `dizimo` (`id`, `membro`, `valor`, `desc`, `data`, `usuariocds`, `mes`) VALUES
(2, 4, 5000, 'teste', '2018-11-27', 4, '11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `foto`
--

CREATE TABLE `foto` (
  `id` int(11) NOT NULL,
  `album` varchar(100) NOT NULL,
  `data` int(11) NOT NULL,
  `imagem` varchar(20) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

CREATE TABLE `funcao` (
  `id` int(11) NOT NULL,
  `funcao` varchar(45) NOT NULL,
  `ativo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`id`, `funcao`, `ativo`) VALUES
(1, 'Cooperador', 's'),
(2, 'Diácono', 's'),
(3, 'Presbítero', 's'),
(4, 'Evangelista', 's'),
(5, 'Pastor', 's'),
(6, 'Pastor Presidente', 's'),
(7, 'Secretário', 's'),
(8, 'Tesoureiro', 's'),
(9, 'Músico', 's'),
(11, 'nada 1', 'n'),
(12, 'membro', 's'),
(13, 'teste', 's'),
(14, 'a2', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

CREATE TABLE `membro` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `funcao_id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` char(14) NOT NULL,
  `datanascimento` date NOT NULL,
  `telefone` varchar(17) NOT NULL,
  `endereco` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` enum('Acre','Alagoas','Amapá','Amazonas','Bahia','Ceará','Distrito Federal','Espírito Santo','Goiás','Maranhão','Mato Grosso','Mato Grosso do Sul','Minas Gerais','Pará','Paraíba','Paraná','Pernambuco','Piauí','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondônia','Roraima','Santa Catarina','São Paulo','Sergipe','Tocantins') NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`id`, `nome`, `funcao_id`, `email`, `cpf`, `datanascimento`, `telefone`, `endereco`, `cidade`, `estado`, `bairro`, `cep`) VALUES
(3, 'robinho', 2, 'robinho2708@hotmail.com', '555.555.555-55', '1990-08-10', '(44) 4444-44444', 'avenida estação, 1801', 'umuarama', '', 'centro', '87505-090'),
(4, 'gustavo', 8, 'gugadellatorre@gmail.com', '561.561.561-51', '0000-00-00', '(65) 4156-1561_', 'dsfdfdfdfdf', 'Perobal', '', 'fbfbfb', '56565-656');

-- --------------------------------------------------------

--
-- Estrutura da tabela `oferta`
--

CREATE TABLE `oferta` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `oferta`
--

INSERT INTO `oferta` (`id`, `titulo`, `ativo`) VALUES
(10, 'dizimo', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoevento`
--

CREATE TABLE `tipoevento` (
  `id` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `ativo` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipoevento`
--

INSERT INTO `tipoevento` (`id`, `tipo`, `ativo`) VALUES
(1, 'festa 1', 'n'),
(2, 'culto', 's'),
(3, 'casamento', 's'),
(4, 'festa', 's'),
(5, 'evento', 's'),
(6, 'teste 3', 's'),
(7, 'casamento', 'n'),
(8, 'casamento', 'n'),
(9, 'casamento', 'n');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` enum('Sim','Nao') NOT NULL,
  `nivel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `ativo`, `nivel`) VALUES
(1, 'Robson Nascimento', 'robinho2708@hotmail.com', 'Robson', 'b49228b8fa98840355de71ec58f2d714', 'Sim', 1),
(2, 'alberson', 'alberson@gmail.com', 'alberson', '5883c3f1b26a4f0165cda8554f2e310a', 'Sim', 2),
(3, 'Gustavo', 'gustavo@gustavo', 'gustavo', '202cb962ac59075b964b07152d234b70', 'Nao', 2),
(4, 'gustavo D', 'gugadellatorre@gmail.com', 'gds', '6d2016d49f225ce67a56c52613ff73f3', 'Sim', 1),
(5, 'teste', 'teste@teste.com', 'teste', '202cb962ac59075b964b07152d234b70', 'Sim', 1),
(27, 'gustavo dellatorre', 'gugadellatorre@gmail.com', 'guga', '47bce5c74f589f4867dbd57e9ca9f808', 'Sim', 1),
(28, 'zezinho', 'zezinho@gmail.com', 'ze', '202cb962ac59075b964b07152d234b70', 'Sim', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `original` varchar(100) NOT NULL,
  `data` int(11) NOT NULL,
  `imagem` varchar(20) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `culto`
--
ALTER TABLE `culto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk5_idx` (`responsavel`),
  ADD KEY `fk6_idx` (`tipo`);

--
-- Indexes for table `dizimo`
--
ALTER TABLE `dizimo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fkk1_idx` (`membro`),
  ADD KEY `fkk2_idx` (`usuariocds`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `funcao`
--
ALTER TABLE `funcao`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria_UNIQUE` (`funcao`);

--
-- Indexes for table `membro`
--
ALTER TABLE `membro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  ADD KEY `fk_membro_funcao_idx` (`funcao_id`,`nome`);

--
-- Indexes for table `oferta`
--
ALTER TABLE `oferta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipoevento`
--
ALTER TABLE `tipoevento`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `culto`
--
ALTER TABLE `culto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dizimo`
--
ALTER TABLE `dizimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membro`
--
ALTER TABLE `membro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `oferta`
--
ALTER TABLE `oferta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tipoevento`
--
ALTER TABLE `tipoevento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `culto`
--
ALTER TABLE `culto`
  ADD CONSTRAINT `fk5` FOREIGN KEY (`responsavel`) REFERENCES `membro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk6` FOREIGN KEY (`tipo`) REFERENCES `tipoevento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `dizimo`
--
ALTER TABLE `dizimo`
  ADD CONSTRAINT `fkk1` FOREIGN KEY (`membro`) REFERENCES `membro` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fkk2` FOREIGN KEY (`usuariocds`) REFERENCES `usuario` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `membro`
--
ALTER TABLE `membro`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`funcao_id`) REFERENCES `funcao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
