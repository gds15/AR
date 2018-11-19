-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19-Nov-2018 às 17:54
-- Versão do servidor: 5.7.19
-- PHP Version: 7.1.9

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

DROP TABLE IF EXISTS `conta`;
CREATE TABLE IF NOT EXISTS `conta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  `valorPago` varchar(45) DEFAULT NULL,
  `multaJuros` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`id`, `data`, `descricao`, `valor`, `valorPago`, `multaJuros`) VALUES
(2, '2018-11-29', 'agua', '120', '', ''),
(4, '2018-11-19', 'teste', '120', '', ''),
(5, '2018-11-19', 'luz', '60', '', ''),
(6, '2018-11-19', 'agua', '60', '', ''),
(7, '2018-11-19', 'aluguel', '1000', '', ''),
(8, '2018-11-19', 'telefone', '500', '', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `culto`
--

DROP TABLE IF EXISTS `culto`;
CREATE TABLE IF NOT EXISTS `culto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `responsavel` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora` varchar(5) NOT NULL,
  `local` varchar(45) NOT NULL,
  `tipo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk5_idx` (`responsavel`),
  KEY `fk6_idx` (`tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
-- Estrutura da tabela `foto`
--

DROP TABLE IF EXISTS `foto`;
CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album` varchar(100) NOT NULL,
  `data` int(11) NOT NULL,
  `imagem` varchar(20) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--

DROP TABLE IF EXISTS `funcao`;
CREATE TABLE IF NOT EXISTS `funcao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `funcao` varchar(45) NOT NULL,
  `ativo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `categoria_UNIQUE` (`funcao`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

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
(13, 'teste', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

DROP TABLE IF EXISTS `membro`;
CREATE TABLE IF NOT EXISTS `membro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `cep` char(9) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  KEY `fk_membro_funcao_idx` (`funcao_id`,`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`id`, `nome`, `funcao_id`, `email`, `cpf`, `datanascimento`, `telefone`, `endereco`, `cidade`, `estado`, `bairro`, `cep`) VALUES
(3, 'robinho', 2, 'robinho2708@hotmail.com', '555.555.555-55', '1990-08-10', '(44) 4444-44444', 'avenida estação, 1801', 'umuarama', '', 'centro', '87505-090');

-- --------------------------------------------------------

--
-- Estrutura da tabela `oferta`
--

DROP TABLE IF EXISTS `oferta`;
CREATE TABLE IF NOT EXISTS `oferta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `oferta`
--

INSERT INTO `oferta` (`id`, `titulo`, `ativo`) VALUES
(10, 'dizimo', 'Sim');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipoevento`
--

DROP TABLE IF EXISTS `tipoevento`;
CREATE TABLE IF NOT EXISTS `tipoevento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(45) NOT NULL,
  `ativo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

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
(9, 'casamento', 's');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `login` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `ativo` enum('Sim','Nao') NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `login`, `senha`, `ativo`, `nivel`) VALUES
(1, 'Robson Nascimento', 'robinho2708@hotmail.com', 'Robson', 'b49228b8fa98840355de71ec58f2d714', 'Sim', 1),
(2, 'alberson', 'alberson@gmail.com', 'alberson', '5883c3f1b26a4f0165cda8554f2e310a', 'Sim', 2),
(3, 'Gustavo', 'gustavo@gustavo', 'gustavo', '4c96f8324e3ba54a99e78249b95daa30', 'Nao', 2),
(4, 'gds', 'gugadellatorre@gmail.com', 'gds', 'e10adc3949ba59abbe56e057f20f883e', 'Sim', 1),
(5, 'teste', 'teste@teste.com', 'teste', '202cb962ac59075b964b07152d234b70', 'Sim', 1),
(27, 'gustavo dellatorre', 'gugadellatorre@gmail.com', 'guga', '47bce5c74f589f4867dbd57e9ca9f808', 'Sim', 1),
(28, 'zezinho', 'zezinho@gmail.com', 'ze', '202cb962ac59075b964b07152d234b70', 'Sim', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `video`
--

DROP TABLE IF EXISTS `video`;
CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `original` varchar(100) NOT NULL,
  `data` int(11) NOT NULL,
  `imagem` varchar(20) NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Limitadores para a tabela `membro`
--
ALTER TABLE `membro`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`funcao_id`) REFERENCES `funcao` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
