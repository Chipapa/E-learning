-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2017 at 12:57 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `answered_by`
--

CREATE TABLE `answered_by` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `answeredWhen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `option1` varchar(50) NOT NULL,
  `option2` varchar(50) NOT NULL,
  `option3` varchar(50) NOT NULL,
  `option4` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `questionID`, `option1`, `option2`, `option3`, `option4`) VALUES
(1, 1, 'wow1', 'wow2', 'wow3', 'wow4'),
(2, 2, 'wow1', 'wow2', 'wow3', 'wow4'),
(6, 8, 'wow1', 'wow2', 'wow3', 'wow4'),
(7, 12, '', '', '', ''),
(8, 15, 'wew', 'wew', 'wew', 'wew'),
(9, 17, 'wow1', 'wow2', 'wow3', 'wow3'),
(10, 18, 'wow1', 'wow2', 'wow3', 'wow4'),
(11, 19, 'wew', 'wew', 'wew', 'wew');

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
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category`, `title`, `question`, `type`, `date_posted`, `num_of_answers`, `who_posted`, `answer`) VALUES
(1, 'Adapter', 'Test Title', 'Gumana kaya to?', 'Multiple Choice', '2017-09-01 10:55:03', 0, 'unknown', 'option1'),
(2, 'Adapter', 'Test2', 'wew?', 'Multiple Choice', '2017-09-01 10:55:53', 0, 'unknown', 'option3'),
(6, 'Adapter', 'Math Question', '1 + 1?', 'Identification', '2017-09-01 11:22:09', 0, 'unknown', '2'),
(7, 'Adapter', 'Maangas na tanong', 'Kabaligtaran ng kaliwa?', 'Identification', '2017-09-01 11:23:39', 0, 'a@a.com', 'awilak'),
(8, 'Observer', 'wew', 'wew', 'Multiple Choice', '2017-09-01 11:24:18', 0, 'a@a.com', 'option2'),
(9, 'Adapter', 'Code this', 'output should be like this', 'Coding', '2017-09-01 11:28:07', 0, 'a@a.com', 'echo "gago";'),
(10, 'Adapter', 'code', 'echo "test";\r\necho "maraming echo";\r\necho "test";\r\necho "maraming echo";\r\necho "test";\r\necho "maraming echo";\r\necho "test";\r\necho "maraming echo";', 'Coding', '2017-09-01 11:29:02', 0, 'a@a.com', 'echo "test";\r\nyari ka boi'),
(11, 'Adapter', 'CODING', 'iyak', 'Coding', '2017-09-01 11:29:51', 0, 'a@a.com', 'wew\r\nwew\r\nwew\r\nwew\r\nwew\r\nwew\r\nwew\r\nwew\r\nwew'),
(12, 'Adapter', 'wew', 'wew', 'Multiple Choice', '2017-09-01 11:42:21', 0, 'a@a.com', 'option1'),
(13, 'Adapter', 'wew', 'wew', 'Identification', '2017-09-01 11:42:45', 0, 'a@a.com', 'gago'),
(14, 'Adapter', 'wew', 'wew', 'Identification', '2017-09-01 11:43:48', 0, 'a@a.com', 'eto'),
(15, 'Adapter', 'wew', 'wew', 'Multiple Choice', '2017-09-01 12:48:09', 0, 'a@a.com', 'option1'),
(16, 'Adapter', 'Testing Identification', 'tanogg???', 'Identification', '2017-09-01 20:59:09', 0, 'unknown', 'etong sagot'),
(17, 'Abstract-Factory', 'Choices', 'ano kaya sagot?', 'Multiple Choice', '2017-09-01 21:03:18', 0, 'unknown', 'option4'),
(18, 'Composite', 'test', 'test', 'Multiple Choice', '2017-09-01 23:03:42', 0, 'a@a.com', 'option1'),
(19, 'Decorator', 'Dups test', 'Dups test', 'Multiple Choice', '2017-09-01 23:04:30', 0, 'a@a.com', 'option2'),
(20, 'Abstract-Factory', 'Legit Question', 'Sinong mama mo?', 'Identification', '2017-09-04 17:05:44', 0, 'a@a.com', 'di ko alam'),
(21, 'Template-Method', 'More Legit Question', 'Sinong mama mo seryoso?', 'Coding', '2017-09-04 17:06:43', 0, 'b@b.com', 'code code code'),
(22, 'Strategy', 'Munggago', 'test\r\ntest\r\ntest\r\ntest\r\ntest\r\ntest', 'Identification', '2017-09-04 17:52:06', 0, 'b@b.com', 'hehe'),
(23, 'Decorator', 'Test Long Question', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Identification', '2017-09-04 17:53:21', 0, 'b@b.com', 'lol'),
(24, 'Adapter', 'Test Long Name', 'Question ', 'Identification', '2017-09-04 18:16:46', 0, 'abdul_jakul_salsalani@example.com', 'hehe'),
(25, 'Factory-Method', 'Test Full Name', 'test', 'Coding', '2017-09-04 18:50:48', 0, 'John ', 'wew'),
(26, 'Template-Method', 'ogag', 'wew', 'Coding', '2017-09-04 18:52:25', 0, 'John_', 'wew'),
(27, 'Decorator', 'test', 'test', 'Coding', '2017-09-04 18:54:35', 0, 'John Doe', 'test'),
(28, 'Template-Method', 'Test Points', 'Test Points?', 'Identification', '2017-09-04 19:14:15', 0, 'John Doe', 'wew'),
(29, 'Factory-Method', 'Test Points 2', 'Test Points 2?', 'Coding', '2017-09-04 19:15:04', 0, 'John Doe', 'wew'),
(30, 'Abstract-Factory', 'test3', 'test', 'Coding', '2017-09-04 19:16:13', 0, 'John Doe', 'wew'),
(31, 'Strategy', 'Test 5', 'test 5', 'Coding', '2017-09-04 19:19:55', 0, 'John Doe', 'wew'),
(32, 'Decorator', 'Test 6', 'wew', 'Coding', '2017-09-04 19:20:25', 0, 'John Doe', 'wew'),
(33, 'Observer', 'test', 'test', 'Identification', '2017-09-04 19:26:33', 0, 'John Doe', 'wew'),
(34, 'Composite', 'Test', 'est', 'Identification', '2017-09-04 19:40:56', 0, 'John Doe', 'wew'),
(35, 'Observer', 'wew', 'wew', 'Identification', '2017-09-04 19:43:40', 0, 'John Doe', 'wew'),
(36, 'Strategy', 'test', 'test', 'Coding', '2017-09-04 19:46:47', 0, 'John Doe', 'wew'),
(37, 'Adapter', 'test4', 'test', 'Identification', '2017-09-04 19:47:29', 0, 'John Doe', 'wew'),
(38, 'Observer', 'test', 'test', 'Coding', '2017-09-04 19:49:13', 0, 'John Doe', 'wew'),
(39, 'Adapter', 'test', 'test', 'Coding', '2017-09-04 19:50:53', 0, 'John Doe', 'wew'),
(40, 'Adapter', 'test', 'test', 'Coding', '2017-09-04 19:57:23', 0, 'John Doe', 'wew'),
(41, 'Strategy', 'test', 'test', 'Identification', '2017-09-04 19:59:07', 0, 'John Doe', 'wew'),
(42, 'Adapter', 'test', 'test', 'Identification', '2017-09-04 20:01:10', 0, 'John Doe', 'wew'),
(43, 'Adapter', 'Test', 'test', 'Coding', '2017-09-04 20:08:18', 0, 'John Doe', 'wew'),
(44, 'Abstract-Factory', 'test', 'test', 'Coding', '2017-09-04 20:13:18', 0, 'John Doe', 'wew'),
(45, 'Factory-Method', 'wew', 'wew', 'Identification', '2017-09-04 20:15:33', 0, 'John Doe', 'wew'),
(46, 'Strategy', 'test', 'test', 'Identification', '2017-09-04 20:16:21', 0, 'John Doe', 'wew'),
(47, 'Abstract-Factory', 'wew', 'wew', 'Identification', '2017-09-04 20:19:28', 0, 'John Doe', 'wew'),
(48, 'Template-Method', 'test', 'test', 'Identification', '2017-09-04 20:20:09', 0, 'John Doe', 'wew'),
(49, 'Observer', 'Test', 'wew', 'Coding', '2017-09-04 20:22:04', 0, 'John Doe', 'wew'),
(50, 'Factory-Method', 'test', 'test', 'Coding', '2017-09-04 20:29:03', 0, 'John Doe', 'wew'),
(51, 'Template-Method', 'test', 'TEST', 'Coding', '2017-09-04 20:32:32', 0, 'John Doe', 'WEW'),
(52, 'Adapter', 'wew', 'wew', 'Coding', '2017-09-06 09:12:52', 0, 'John Doe', 'wew'),
(53, 'Adapter', 'wew', 'wew', 'Coding', '2017-09-06 09:13:28', 0, 'John Doe', 'wew'),
(54, 'Adapter', 'wew', 'wew', 'Coding', '2017-09-06 09:13:49', 0, 'John Doe', 'wew'),
(55, 'Composite', 'wwew', 'wew', 'Identification', '2017-09-06 09:15:34', 0, 'John Doe', 'wew');

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
(1, 'Adapter', 'adapter', 0, 21),
(2, 'Composite', 'composite', 0, 3),
(3, 'Decorator', 'decorator', 0, 4),
(4, 'Observer', 'observer', 0, 5),
(5, 'Strategy', 'strategy', 0, 5),
(6, 'Abstract-Factory', 'abstract-factory', 0, 5),
(7, 'Factory-Method', 'factory-method', 0, 4),
(8, 'Template-Method', 'template-method', 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `fname` text NOT NULL,
  `lname` text NOT NULL,
  `userType` text NOT NULL,
  `ask_points` int(11) NOT NULL,
  `answer_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `userType`, `ask_points`, `answer_points`) VALUES
(47, 'm@m.com', '$2y$10$FeE6BcctfRsIjLECl.SZUOiW2hdrV4bDZQ5T8Apu88d9B2Bmuv2Dq', '', '', 'student', 0, 0),
(48, 'a@a.com', '$2y$10$UgV86vHt9B4NvEEhpDKavukAoJINIPz9nTLSvYIrOs8lz4aSnF3jq', 'John', 'Doe', 'student', 50, 0),
(49, 'b@b.com', '$2y$10$wIkN7/jteb5Hfbu75JL.luqudv5Lpe4sVyrfG7QWu3cExtBJLnYLi', '', '', 'student', 0, 0),
(50, 'c@c.com', '$2y$10$jdtkoLw6EqQu.dnfTsTnyeRTXYc31is3S9tdBxrHp34tI/bjaHAwe', '', '', 'student', 0, 0),
(51, 'd@d.com', '$2y$10$//2k4IDJnK6MsqZyygxKj.R6P84PbAjAd/XbOcdKUmeugEJqOjT0C', '', '', 'student', 0, 0),
(52, 'z@z.com', '123', '', '', 'student', 0, 0),
(54, 'e@e.com', 'wew', '', '', '', 0, 0),
(55, 'f@f.com', '$2y$10$l82FWgWo0ecvlzweLbdDw.8fXRDrNECJ0HiUjro9GPOgpaYMZc9ui', '', '', '', 0, 0),
(56, 'g@g.com', '$2y$10$Opb2KIFq95tOC/YdMasxbuUbxFlza/CRF.nfgaj2MN61qI25nxHSW', '', '', 'student', 0, 0),
(57, 'h@h.com', '$2y$10$C2hfsvfUvRFw.wS.SnS6u.krYOUd5iSl.ixBXK1WUx4l.Ro.0jE96', '', '', 'student', 0, 0),
(58, 'i@i.com', '$2y$10$hkDe5ro3P9xp9CFC9Sf/.uF1LvJrdLtyCiGbV3sM4nsqBL0nVrRX2', '', '', 'student', 0, 0),
(59, 'J@J.COM', '$2y$10$BCPhhbanu.amQ4g7K1W6ieJSv.isdcKHGzw4OOeljKAG36WqDxsSO', '', '', 'student', 0, 0),
(60, 'k@k.com', '$2y$10$lO29uRY8cf8Ic/r53OAC6ebrPXqQ.V0DCCP6bGFfyS.hTloR/eqni', '', '', 'student', 0, 0),
(61, 'l@l.com', '$2y$10$4o3CqPKWmibS3ns3yoyxPuEu8b5IpmwkIN8GwLSA557zhJAjDRi5a', '', '', 'student', 0, 0),
(62, 'n@n.com', '$2y$10$vkmRttPwcpS5p9AMjNwyu.TnguwGw473w3Qvx5S2EulI3a67A0GeK', '', '', 'student', 0, 0),
(63, 'o@o.com', '$2y$10$bUol.MW9yfC3TR0dmJq7U.QVyhK3jmHmoAIji0MAYysQ6M//lnWeu', '', '', 'student', 0, 0),
(64, 'p@p.com', '$2y$10$JGDIjMwzEdLFx/51ExgsB.JFj73WlSVIAiBAed/exBSbQbjVVcpIu', '', '', 'student', 0, 0),
(65, 'q@q.com', '$2y$10$it7r57.R8dIJWpCv87DDwOZVuXViWD0noMBF3AduV7/R7YMQNxUVG', '', '', 'student', 0, 0),
(66, 'jmrq_30@yahoo.com', '$2y$10$8z/J.ld3SqMSuFSP2v.WrOrvyiPQ3cnR9vTq4jeOIr3bvzXZHIS9u', '', '', 'student', 0, 0),
(67, 'r@r.com', '$2y$10$FlN4GFRO/08vDzO2HAWJIuprqvGvb2wIEl9PPkudSQiValah/whVy', '', '', 'student', 0, 0),
(68, 's@s.com', '$2y$10$HXewtW8MB2pg7bN1Os5nEeFl2VX4SqjclDYzk3l6O1C/v/YPrceke', '', '', 'student', 0, 0),
(69, 't@t.com', '$2y$10$phPPkLbk4/afRiY51MKi7.y.nHYJJ1vbxBNqBUzCTPcOJttNh0OqS', '', '', 'student', 0, 0),
(70, 'abdul_jakul_salsalani@example.com', '$2y$10$LI.HPtBnlpDTC3jFsgM1T.3KT2PsLE9.O3alSuWXwE7R3W7XPQvKm', '', '', 'student', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answered_by`
--
ALTER TABLE `answered_by`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `questionID` (`questionID`);

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions*id` (`questionID`);

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
-- AUTO_INCREMENT for table `answered_by`
--
ALTER TABLE `answered_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `stockmarket`
--
ALTER TABLE `stockmarket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `answered_by`
--
ALTER TABLE `answered_by`
  ADD CONSTRAINT `answered_by_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `answered_by_ibfk_2` FOREIGN KEY (`questionID`) REFERENCES `questions` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
