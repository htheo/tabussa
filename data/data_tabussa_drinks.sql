-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: localhost:8889
-- Generation Time: Nov 07, 2016 at 08:41 PM
-- Server version: 5.5.42
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `tabussa`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabussa_drinks`
--

CREATE TABLE `tabussa_drinks` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `color` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tabussa_drinks`
--

INSERT INTO `tabussa_drinks` (`id`, `name`, `color`, `type`) VALUES
(81, 'Vodka', '', 'alcool'),
(82, 'Whisky', '', 'alcool'),
(83, 'Rhum', '', 'alcool'),
(84, 'Rhum ambré', '', 'alcool'),
(85, 'Rhum arrangé', '', 'alcool'),
(86, 'Bière blonde', '', 'alcool'),
(87, 'Bière brune', '', 'alcool'),
(88, 'Bière blanche', '', 'alcool'),
(89, 'Bière noir', '', 'alcool'),
(90, 'Gin', '', 'alcool'),
(91, 'Jagger', '', 'alcool'),
(92, 'Champagne', '', 'alcool'),
(93, 'Vin rouge', '', 'alcool'),
(94, 'Vin blanc', '', 'alcool'),
(95, 'Rosé', '', 'alcool'),
(96, 'Get 27', '', 'alcool'),
(97, 'Get 31', '', 'alcool'),
(98, 'Bourbon', '', 'alcool'),
(99, 'Pastis', '', 'alcool'),
(100, 'Cognac', '', 'alcool'),
(101, 'Tequila', '', 'alcool'),
(102, 'Absynthe', '', 'alcool'),
(103, 'Passoa', '', 'alcool'),
(104, 'Cidre', '', 'alcool'),
(105, 'Saké', '', 'alcool'),
(106, 'Martini', '', 'alcool'),
(107, 'Manzana', '', 'alcool'),
(108, 'Porto', '', 'alcool'),
(109, 'Lait', '', 'soft'),
(110, 'Jus d''orange', '', 'soft'),
(111, 'Jus de citron', '', 'soft'),
(112, 'Jus de pomme', '', 'soft'),
(113, 'Jus d''ananas', '', 'soft'),
(114, 'Jus de poire', '', 'soft'),
(115, 'Jus de banane', '', 'soft'),
(116, 'Jus de carotte', '', 'soft'),
(117, 'Jus de tomate', '', 'soft'),
(118, 'citron', '', 'aliment'),
(119, 'chocolat en poudre', '', 'aliment'),
(120, 'sucre de canne', '', 'aliment');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabussa_drinks`
--
ALTER TABLE `tabussa_drinks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabussa_drinks`
--
ALTER TABLE `tabussa_drinks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=121;