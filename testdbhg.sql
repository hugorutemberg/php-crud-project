-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27-Abr-2018 às 13:20
-- Versão do servidor: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testdbhg`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `userName` varchar(20) NOT NULL,
  `userProfession` varchar(50) NOT NULL,
  `userPic` varchar(200) NOT NULL,
  `nickName` varchar(25) NOT NULL,
  `realName` varchar(25) NOT NULL,
  `originDescription` varchar(256) NOT NULL,
  `superPowers` varchar(150) NOT NULL,
  `catchPhrase` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `userName`, `userProfession`, `userPic`, `nickName`, `realName`, `originDescription`, `superPowers`, `catchPhrase`) VALUES
(61, '', '', '405344.jpg', 'Superman', 'Clark Kent', 'He was born Kal-El on the planet Krypton, before being rocketed to\r\nEarth as an infant by his scientist father Jor-El, moments before Krypton\'s destructionâ€¦', 'Solar energy absorption and healing factor, solar flare and heat vision, solar invulnerability, flightâ€¦', 'â€œLook, up in the sky, it\'s a bird, it\'s a plane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
