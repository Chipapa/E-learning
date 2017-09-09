-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2017 at 11:31 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e_learning`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `userType` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `userType`) VALUES
(47, 'm@m.com', '$2y$10$FeE6BcctfRsIjLECl.SZUOiW2hdrV4bDZQ5T8Apu88d9B2Bmuv2Dq', 'student'),
(48, 'a@a.com', '$2y$10$UgV86vHt9B4NvEEhpDKavukAoJINIPz9nTLSvYIrOs8lz4aSnF3jq', 'student'),
(49, 'b@b.com', '$2y$10$wIkN7/jteb5Hfbu75JL.luqudv5Lpe4sVyrfG7QWu3cExtBJLnYLi', 'student'),
(50, 'c@c.com', '$2y$10$jdtkoLw6EqQu.dnfTsTnyeRTXYc31is3S9tdBxrHp34tI/bjaHAwe', 'student'),
(51, 'd@d.com', '$2y$10$//2k4IDJnK6MsqZyygxKj.R6P84PbAjAd/XbOcdKUmeugEJqOjT0C', 'student'),
(52, 'z@z.com', '123', 'student'),
(54, 'e@e.com', 'wew', ''),
(55, 'f@f.com', '$2y$10$l82FWgWo0ecvlzweLbdDw.8fXRDrNECJ0HiUjro9GPOgpaYMZc9ui', ''),
(56, 'g@g.com', '$2y$10$Opb2KIFq95tOC/YdMasxbuUbxFlza/CRF.nfgaj2MN61qI25nxHSW', 'student'),
(57, 'h@h.com', '$2y$10$C2hfsvfUvRFw.wS.SnS6u.krYOUd5iSl.ixBXK1WUx4l.Ro.0jE96', 'student'),
(58, 'i@i.com', '$2y$10$hkDe5ro3P9xp9CFC9Sf/.uF1LvJrdLtyCiGbV3sM4nsqBL0nVrRX2', 'student'),
(59, 'J@J.COM', '$2y$10$BCPhhbanu.amQ4g7K1W6ieJSv.isdcKHGzw4OOeljKAG36WqDxsSO', 'student'),
(60, 'k@k.com', '$2y$10$lO29uRY8cf8Ic/r53OAC6ebrPXqQ.V0DCCP6bGFfyS.hTloR/eqni', 'student'),
(61, 'l@l.com', '$2y$10$4o3CqPKWmibS3ns3yoyxPuEu8b5IpmwkIN8GwLSA557zhJAjDRi5a', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
