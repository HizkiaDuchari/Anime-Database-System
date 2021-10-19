-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 07:14 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpdasar`
--

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nrp` char(9) NOT NULL,
  `position` varchar(100) NOT NULL,
  `cursedTechnique` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `name`, `nrp`, `position`, `cursedTechnique`, `image`) VALUES
(1, 'Gojo Satoru', '827363711', 'Jujutsu Sorcerer', 'Infinity', 'gojo.png'),
(2, 'Itadori Yuji', '274625142', 'Jujutsu Sorcerer', '-', 'yuji.png'),
(3, 'Kugisaki Nobara', '772648291', 'Jujutsu Sorcerer', 'Santet2an', 'nobara.png'),
(4, 'Kento Nanami', '726351220', 'Jujutsu Sorcerer', 'Weak Point', 'nanami.png'),
(5, 'Fushiguro Megumi', '728261659', 'megumi@gmail.com', 'Hukum', 'megumi.png'),
(7, 'Panda', '472711765', 'panda@gmail.com', 'Ilmu Komunikasi', 'panda.png'),
(30, 'Denji', '312412512', 'yikes@gmail.com', 'tits and boobies', '60e02a4034e58.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'denji', '$2y$10$bWMtobkiY0RIXE.NWAR.veZ9y/tgYgccvem3g2owZAURwBxl0fA76'),
(2, 'power', '$2y$10$y3N7jF1PTYM3vUS4xte/veLGoU2Nnuxm/4NmmPUZsZQ900999rJi6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
