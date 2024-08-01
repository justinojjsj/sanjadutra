-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 01/08/2024 às 01:26
-- Versão do servidor: 11.4.2-MariaDB-ubu2404
-- Versão do PHP: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_ccr`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `dados`
--

CREATE TABLE `dados` (
  `id` int(11) NOT NULL,
  `titulo` varchar(250) NOT NULL,
  `texto` varchar(250) NOT NULL,
  `data_coleta` varchar(30) NOT NULL,
  `hora_coleta` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `dados`
--

INSERT INTO `dados` (`id`, `titulo`, `texto`, `data_coleta`, `hora_coleta`) VALUES
(1, 'Do km 259 até km 265 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. Obs: Em Volta Redonda, devido obra com tráfego fluindo pela faixa da esquerda . km inicial: 259 / km final: 265', '15/05/2024', '16:39:06'),
(2, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. Obs: Em Guarulhos, obra de 24 horas com interdição da faixa da esquerda. km inicial: 219 / km final: 221', '15/05/2024', '16:39:06'),
(3, 'Do km 259 até km 265 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. Obs: Em Volta Redonda, devido obra com tráfego fluindo pela faixa da esquerda . km inicial: 259 / km final: 265', '2024-05-15', '16:49:07'),
(4, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. Obs: Em Guarulhos, obra de 24 horas com interdição da faixa da esquerda. km inicial: 219 / km final: 221', '2024-05-15', '16:49:07'),
(5, 'Do km 255 até km 265 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. Obs: Em Volta redonda, reflexo de obra. Pista liberada no local. km inicial: 255 / km final: 265', '2024-05-16', '16:08:45'),
(6, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. Obs: Em Guarulhos. km inicial: 205 / km final: 206', '2024-05-16', '16:08:45'),
(7, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. Obs: Em Guarulhos, obra de 24 horas com interdição da faixa da esquerda. km inicial: 219 / km final: 221', '2024-05-16', '16:08:45'),
(8, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-16', '16:45:27'),
(9, 'Do km 260 até km 265 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-16', '16:45:27'),
(10, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-17', '08:49:10'),
(11, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '08:49:10'),
(12, 'Do km 229 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-17', '08:49:10'),
(13, 'Do km 136 até km 139 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '08:49:10'),
(14, 'Do km 144 até km 145 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-17', '08:49:10'),
(15, 'Do km 264 até km 270 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '11:39:14'),
(16, 'Do km 218 até km 222 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '11:39:14'),
(17, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '11:39:14'),
(18, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-17', '11:39:14'),
(19, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-17', '11:39:14'),
(20, 'Do km 229 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-17', '11:39:14'),
(21, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '17:15:33'),
(22, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:15:33'),
(23, 'Do km 101 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:15:33'),
(24, 'Do km 208 até km 209 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:15:33'),
(25, 'Do km 86 até km 87 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:15:33'),
(26, 'Do km 100 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '17:30:28'),
(27, 'Do km 97 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:30:28'),
(28, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '17:30:28'),
(29, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:30:28'),
(30, 'Do km 208 até km 209 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:30:28'),
(31, 'Do km 86 até km 87 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:30:28'),
(32, 'Do km 100 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '17:45:30'),
(33, 'Do km 97 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:45:30'),
(34, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '17:45:30'),
(35, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:45:30'),
(36, 'Do km 208 até km 209 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:45:30'),
(37, 'Do km 86 até km 87 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '17:45:30'),
(38, 'Do km 100 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '18:00:28'),
(39, 'Do km 97 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:00:28'),
(40, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '18:00:28'),
(41, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:00:28'),
(42, 'Do km 208 até km 209 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:00:28'),
(43, 'Do km 86 até km 87 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:00:28'),
(44, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '18:15:26'),
(45, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:15:26'),
(46, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:15:26'),
(47, 'Do km 137 até km 139 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:15:26'),
(48, 'Do km 101 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '18:15:26'),
(49, 'Do km 96 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:15:26'),
(50, 'Do km 85 até km 86 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:15:26'),
(51, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '18:30:27'),
(52, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:30:27'),
(53, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:30:27'),
(54, 'Do km 137 até km 139 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:30:27'),
(55, 'Do km 101 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '18:30:27'),
(56, 'Do km 96 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:30:27'),
(57, 'Do km 85 até km 86 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:30:27'),
(58, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '18:45:27'),
(59, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:45:27'),
(60, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:45:27'),
(61, 'Do km 137 até km 139 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:45:27'),
(62, 'Do km 101 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '18:45:27'),
(63, 'Do km 96 até km 99 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:45:27'),
(64, 'Do km 85 até km 86 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '18:45:27'),
(65, 'Do km 135 até km 140 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego congestionado na pista Expressa. ', '2024-05-19', '19:00:27'),
(66, 'Do km 103 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '19:00:27'),
(67, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '19:00:27'),
(68, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:00:27'),
(69, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:00:27'),
(70, 'Do km 135 até km 140 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego congestionado na pista Expressa. ', '2024-05-19', '19:15:27'),
(71, 'Do km 103 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '19:15:27'),
(72, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '19:15:27'),
(73, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:15:27'),
(74, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:15:27'),
(75, 'Do km 135 até km 140 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego congestionado na pista Expressa. ', '2024-05-19', '19:30:24'),
(76, 'Do km 103 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego lento com paradas na pista Expressa. ', '2024-05-19', '19:30:24'),
(77, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-19', '19:30:24'),
(78, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:30:24'),
(79, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:30:24'),
(80, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:45:24'),
(81, 'Do km 135 até km 140 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:45:24'),
(82, 'Do km 107 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:45:24'),
(83, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '19:45:24'),
(84, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:00:32'),
(85, 'Do km 135 até km 140 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:00:32'),
(86, 'Do km 205 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:00:32'),
(87, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:15:24'),
(88, 'Do km 208 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:15:24'),
(89, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:30:23'),
(90, 'Do km 208 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:30:23'),
(91, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:45:23'),
(92, 'Do km 208 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '20:45:23'),
(93, 'Do km 151 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '21:00:24'),
(94, 'Do km 208 até km 210 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '21:00:24'),
(95, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '21:15:23'),
(96, 'Do km 152 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-19', '21:30:23'),
(97, 'Do km 146 até km 148 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:30:49'),
(98, 'Do km 138 até km 142 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:30:49'),
(99, 'Do km 106 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:30:49'),
(100, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '18:30:49'),
(101, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:30:49'),
(102, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '18:30:49'),
(103, 'Do km 219 até km 227 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '18:45:50'),
(104, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:45:50'),
(105, 'Do km 148 até km 150 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '18:45:50'),
(106, 'Do km 146 até km 148 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:45:50'),
(107, 'Do km 138 até km 142 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:45:50'),
(108, 'Do km 106 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:45:50'),
(109, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '18:45:50'),
(110, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '18:45:50'),
(111, 'Do km 219 até km 227 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:00:33'),
(112, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:00:33'),
(113, 'Do km 148 até km 150 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:00:33'),
(114, 'Do km 106 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:00:33'),
(115, 'Do km 205 até km 206 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:00:33'),
(116, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:00:33'),
(117, 'Do km 219 até km 227 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:15:47'),
(118, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:15:47'),
(119, 'Do km 148 até km 150 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:15:47'),
(120, 'Do km 106 até km 108 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:15:47'),
(121, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:15:47'),
(122, 'Do km 219 até km 227 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:30:34'),
(123, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:30:34'),
(124, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:30:34'),
(125, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:45:48'),
(126, 'Do km 219 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '19:45:48'),
(127, 'Do km 153 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '19:45:48'),
(128, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '20:00:44'),
(129, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Expressa. ', '2024-05-20', '20:00:44'),
(130, 'Do km 220 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego intenso na pista Marginal. ', '2024-05-20', '20:00:44'),
(131, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-29', '21:50:45'),
(132, 'Do km 223 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-29', '23:04:09'),
(133, 'Do km 223 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-29', '23:15:31'),
(134, 'Do km 223 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-29', '23:22:27'),
(135, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '14:29:40'),
(136, 'Do km 224 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '14:29:40'),
(137, 'Do km 219 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '14:29:40'),
(138, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '14:29:40'),
(139, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '14:45:25'),
(140, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '14:45:25'),
(141, 'Do km 219 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '14:45:25'),
(142, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '14:45:25'),
(143, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:00:21'),
(144, 'Do km 223 até km 224 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '15:00:21'),
(145, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:00:21'),
(146, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '15:00:21'),
(147, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:15:21'),
(148, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:15:21'),
(149, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '15:15:21'),
(150, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:30:28'),
(151, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:30:28'),
(152, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '15:30:28'),
(153, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:45:24'),
(154, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '15:45:24'),
(155, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '15:45:24'),
(156, 'Do km 223 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:00:22'),
(157, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:00:22'),
(158, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '16:00:22'),
(159, 'Do km 218 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:15:29'),
(160, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:15:29'),
(161, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '16:15:29'),
(162, 'Do km 218 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:30:22'),
(163, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:30:22'),
(164, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '16:30:22'),
(165, 'Do km 218 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:45:22'),
(166, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '16:45:22'),
(167, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '16:45:22'),
(168, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:00:23'),
(169, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:00:23'),
(170, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '17:00:23'),
(171, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:15:23'),
(172, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:15:23'),
(173, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '17:15:23'),
(174, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:30:21'),
(175, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:30:21'),
(176, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '17:30:21'),
(177, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:45:23'),
(178, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '17:45:23'),
(179, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '17:45:23'),
(180, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:00:22'),
(181, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:00:22'),
(182, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '18:00:22'),
(183, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:15:20'),
(184, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:15:20'),
(185, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '18:15:20'),
(186, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:30:22'),
(187, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:30:22'),
(188, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '18:30:22'),
(189, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:45:21'),
(190, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '18:45:21'),
(191, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '18:45:21'),
(192, 'Do km 147 até km 149 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:00:23'),
(193, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:00:23'),
(194, 'Do km 204 até km 205 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:00:23'),
(195, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '19:00:23'),
(196, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:15:21'),
(197, 'Do km 220 até km 226 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:15:21'),
(198, 'Do km 230 até km 231 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '19:15:21'),
(199, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '19:30:21'),
(200, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:30:21'),
(201, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '19:45:22'),
(202, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '19:45:22'),
(203, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '20:00:22'),
(204, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '20:00:22'),
(205, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '20:15:21'),
(206, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '20:15:21'),
(207, 'Do km 219 até km 221 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Marginal. ', '2024-07-31', '20:30:22'),
(208, 'Do km 154 até km 155 em São José dos Campos', 'Presidente Dutra: Pista sentido RIO - SP com tráfego Intenso na pista Expressa. ', '2024-07-31', '20:30:22');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `dados`
--
ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `dados`
--
ALTER TABLE `dados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=209;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
