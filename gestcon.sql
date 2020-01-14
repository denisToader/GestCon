-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2020 at 09:29 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gestcon`
--

-- --------------------------------------------------------

--
-- Table structure for table `angajati`
--

CREATE TABLE `angajati` (
  `id` int(11) NOT NULL,
  `nume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenume` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nr_tel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `functie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `angajati`
--

INSERT INTO `angajati` (`id`, `nume`, `prenume`, `nr_tel`, `functie`) VALUES
(23, 'Toader', 'Denis', '0785469123', 'Programator'),
(24, 'Popescu', 'Ioan', '0789456123', 'Tester'),
(27, 'Miclea', 'Andreea', '0711123456', 'HR');

-- --------------------------------------------------------

--
-- Table structure for table `concedii`
--

CREATE TABLE `concedii` (
  `id` int(11) NOT NULL,
  `tip_concediu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_de_la` date NOT NULL,
  `data_pana_la` date NOT NULL,
  `nr_zile` int(11) NOT NULL,
  `id_angajat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `concedii`
--

INSERT INTO `concedii` (`id`, `tip_concediu`, `data_de_la`, `data_pana_la`, `nr_zile`, `id_angajat`) VALUES
(29, 'Odihna', '2020-01-13', '2020-01-14', 2, 23),
(30, 'Odihna', '2020-01-15', '2020-01-20', 4, 23),
(32, 'Odihna', '2020-01-13', '2020-01-15', 3, 24);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `angajati`
--
ALTER TABLE `angajati`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `concedii`
--
ALTER TABLE `concedii`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `angajati`
--
ALTER TABLE `angajati`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `concedii`
--
ALTER TABLE `concedii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
