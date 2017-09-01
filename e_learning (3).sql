-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2017 at 12:28 PM
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
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `title` text NOT NULL,
  `question` text NOT NULL,
  `type` text NOT NULL,
  `date_posted` datetime NOT NULL,
  `num_of_answers` int(11) NOT NULL,
  `who_posted` text NOT NULL,
  `answer` text NOT NULL,
  `choices` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category`, `title`, `question`, `type`, `date_posted`, `num_of_answers`, `who_posted`, `answer`, `choices`) VALUES
(2, 'Composite', 'Composite Title', 'Composite Question?', 'Multiple Choice', '2017-08-31 12:04:53', 0, 'b@b.com', 'option2', 'wow1'),
(3, 'Adapter', 'Test', 'test????', 'Multiple Choice', '2017-08-31 12:18:45', 0, 'a@a.com', 'option2', '4');

-- --------------------------------------------------------

--
-- Table structure for table `stockmarket`
--

CREATE TABLE `stockmarket` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `slug` text NOT NULL,
  `answered` int(11) NOT NULL,
  `unanswered` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockmarket`
--

INSERT INTO `stockmarket` (`id`, `category`, `slug`, `answered`, `unanswered`) VALUES
(1, 'Adapter', 'adapter', 0, 1),
(2, 'Composite', 'composite', 0, 1),
(3, 'Decorator', 'decorator', 0, 0);

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
(61, 'l@l.com', '$2y$10$4o3CqPKWmibS3ns3yoyxPuEu8b5IpmwkIN8GwLSA557zhJAjDRi5a', 'student'),
(62, 'n@n.com', '$2y$10$vkmRttPwcpS5p9AMjNwyu.TnguwGw473w3Qvx5S2EulI3a67A0GeK', 'student'),
(63, 'o@o.com', '$2y$10$bUol.MW9yfC3TR0dmJq7U.QVyhK3jmHmoAIji0MAYysQ6M//lnWeu', 'student'),
(64, 'p@p.com', '$2y$10$JGDIjMwzEdLFx/51ExgsB.JFj73WlSVIAiBAed/exBSbQbjVVcpIu', 'student'),
(65, 'q@q.com', '$2y$10$it7r57.R8dIJWpCv87DDwOZVuXViWD0noMBF3AduV7/R7YMQNxUVG', 'student'),
(66, 'jmrq_30@yahoo.com', '$2y$10$8z/J.ld3SqMSuFSP2v.WrOrvyiPQ3cnR9vTq4jeOIr3bvzXZHIS9u', 'student'),
(67, 'r@r.com', '$2y$10$FlN4GFRO/08vDzO2HAWJIuprqvGvb2wIEl9PPkudSQiValah/whVy', 'student'),
(68, 's@s.com', '$2y$10$HXewtW8MB2pg7bN1Os5nEeFl2VX4SqjclDYzk3l6O1C/v/YPrceke', 'student'),
(69, 't@t.com', '$2y$10$phPPkLbk4/afRiY51MKi7.y.nHYJJ1vbxBNqBUzCTPcOJttNh0OqS', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stockmarket`
--
ALTER TABLE `stockmarket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `stockmarket`
--
ALTER TABLE `stockmarket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
