-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jan-2019 às 11:52
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
  `dataPagamento` date DEFAULT NULL,
  `ativo` varchar(1) DEFAULT NULL,
  `motivoEstorno` varchar(50) DEFAULT NULL,
  `quemEstornou` varchar(45) DEFAULT NULL,
  `tipo` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `data`, `descricao`, `valor`, `valorPago`, `dataPagamento`, `ativo`, `motivoEstorno`, `quemEstornou`, `tipo`) VALUES
(18, '2018-12-06', 'luz', 150, 0, '0000-00-00', 'n', NULL, NULL, NULL),
(19, '2018-12-06', 'agua', 1, 1, '2018-12-06', 's', NULL, NULL, NULL),
(20, '2018-12-14', 'aluguel', 20, 20, '2018-12-14', 's', NULL, NULL, NULL),
(21, '2018-12-19', 'transporte', 10, 10, '2018-12-15', 'n', 'conta paga 2 x', 'gds', 'e'),
(22, '2018-12-19', 'outros', 1000, 1100, '2018-12-20', 's', NULL, NULL, NULL);

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
(2, 4, 5000, 'teste', '2018-11-27', 4, '11'),
(3, 3, 5000, 'nada', '2018-12-17', 4, '12');

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
  `estado` varchar(30) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` char(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`id`, `nome`, `funcao_id`, `email`, `cpf`, `datanascimento`, `telefone`, `endereco`, `cidade`, `estado`, `bairro`, `cep`) VALUES
(3, 'robinho', 2, 'robinho2708@hotmail.com', '555.555.555-55', '1990-08-10', '(44) 4444-44444', 'avenida estação, 1801', 'umuarama', '', 'centro', '87505-090'),
(4, 'gustavo', 8, 'gugadellatorre@gmail.com', '561.561.561-51', '0000-00-00', '(65) 4156-1561_', 'dsfdfdfdfdf', 'Perobal', '', 'fbfbfb', '56565-656'),
(5, 'GUSTAVO DELLATORRE DA SILVA', 13, 'gugadellatorre@gmail.com', '622.222.222-22', '0000-00-00', '(65) 4156-1561_', 'dsfdfdfdfdf', 'Perobal', 'PR', 'fdfdfdfd', '87539-000');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conta`
--
ALTER TABLE `conta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `culto`
--
ALTER TABLE `culto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dizimo`
--
ALTER TABLE `dizimo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `funcao`
--
ALTER TABLE `funcao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `membro`
--
ALTER TABLE `membro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
