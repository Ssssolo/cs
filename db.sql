-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 12:41 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `auth` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `access` varchar(100) NOT NULL,
  `flags` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `auth`, `password`, `access`, `flags`) VALUES
(1, 'admin', 'admin', 'b', 'a');

-- --------------------------------------------------------

--
-- Table structure for table `anunturi`
--

CREATE TABLE `anunturi` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `general`
--

CREATE TABLE `general` (
  `accesari` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notificari`
--

CREATE TABLE `notificari` (
  `id` int(11) NOT NULL,
  `vazut` int(11) NOT NULL,
  `imagine` varchar(50) NOT NULL,
  `culoare` varchar(50) NOT NULL,
  `titlu` varchar(100) NOT NULL,
  `text` varchar(150) NOT NULL,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notificari`
--

INSERT INTO `notificari` (`id`, `vazut`, `imagine`, `culoare`, `titlu`, `text`, `data`) VALUES
(1, 1, 'fa fa-users', 'info', 'Utilizator nou!', '<i>admin</i> tocmai s-a înregistrat!', '2021-03-05 13:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `notificari_utilizator`
--

CREATE TABLE `notificari_utilizator` (
  `id` int(11) NOT NULL,
  `destinatar` varchar(32) NOT NULL,
  `vazut` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tichete`
--

CREATE TABLE `tichete` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `subiect` varchar(100) NOT NULL,
  `prioritate` int(11) NOT NULL,
  `categorie` int(11) NOT NULL,
  `text` text NOT NULL,
  `data` datetime NOT NULL DEFAULT current_timestamp(),
  `stare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tichete_raspuns`
--

CREATE TABLE `tichete_raspuns` (
  `id` int(11) NOT NULL,
  `id_tichet` int(11) NOT NULL,
  `text` text NOT NULL,
  `username` varchar(32) NOT NULL,
  `admin` varchar(32) NOT NULL,
  `vazut` tinyint(1) NOT NULL DEFAULT 0,
  `data` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori`
--

CREATE TABLE `utilizatori` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `parola` varchar(100) NOT NULL,
  `activ` tinyint(1) NOT NULL DEFAULT 0,
  `acces` int(11) NOT NULL DEFAULT 0,
  `stare` varchar(100) NOT NULL,
  `credit` int(11) NOT NULL DEFAULT 0,
  `avertizari` int(11) NOT NULL DEFAULT 0,
  `data_actualizare` datetime NOT NULL DEFAULT current_timestamp(),
  `regIP` int(11) NOT NULL,
  `logIP` text NOT NULL DEFAULT '[]',
  `cod_activare` varchar(100) NOT NULL,
  `data_inregistrare` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizatori`
--

INSERT INTO `utilizatori` (`id`, `username`, `email`, `parola`, `activ`, `acces`, `stare`, `credit`, `avertizari`, `data_actualizare`, `regIP`, `logIP`, `cod_activare`, `data_inregistrare`) VALUES
(1, 'admin', 'admin@admin.admin', 'admin', 1, 1, '', 0, 0, '2021-03-05 13:40:26', 0, '[\"::1\"]', 'ZZ601U50', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `utilizatori_online`
--

CREATE TABLE `utilizatori_online` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `timp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `utilizatori_online`
--

INSERT INTO `utilizatori_online` (`id`, `username`, `session_id`, `timp`) VALUES
(1, 'admin', 'kv2vg716gfo31ki553qshugipr', '1614944485');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anunturi`
--
ALTER TABLE `anunturi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificari`
--
ALTER TABLE `notificari`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notificari_utilizator`
--
ALTER TABLE `notificari_utilizator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tichete`
--
ALTER TABLE `tichete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tichete_raspuns`
--
ALTER TABLE `tichete_raspuns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori`
--
ALTER TABLE `utilizatori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `utilizatori_online`
--
ALTER TABLE `utilizatori_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `anunturi`
--
ALTER TABLE `anunturi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notificari`
--
ALTER TABLE `notificari`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notificari_utilizator`
--
ALTER TABLE `notificari_utilizator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tichete`
--
ALTER TABLE `tichete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tichete_raspuns`
--
ALTER TABLE `tichete_raspuns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `utilizatori`
--
ALTER TABLE `utilizatori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `utilizatori_online`
--
ALTER TABLE `utilizatori_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
