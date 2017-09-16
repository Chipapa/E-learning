-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2017 at 05:56 AM
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
  `answer` varchar(500) NOT NULL,
  `answeredWhen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answered_by`
--

INSERT INTO `answered_by` (`id`, `userID`, `questionID`, `answer`, `answeredWhen`) VALUES
(1, 48, 2, 'wR0n6', '2017-09-09 17:43:54'),
(2, 48, 1, 'Mali talaga to', '2017-09-09 17:44:56'),
(3, 49, 1, 'Eto yung tamang sagot', '2017-09-15 05:30:49'),
(4, 71, 1, 'Mali talaga to', '2017-09-15 05:31:18'),
(5, 48, 3, 'asdgasdg', '2017-09-15 11:17:06');

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
(1, 1, 'Mali to', 'Eto yung tamang sagot', 'Mali talaga to', 'Tanginamo mali to'),
(2, 2, 'Wrong', 'Rong', 'wR0n6', 'Correct'),
(3, 8, 'Mali', 'M4l1', 'Tama', 'm4lI');

-- --------------------------------------------------------

--
-- Table structure for table `coding`
--

CREATE TABLE `coding` (
  `id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `code` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coding`
--

INSERT INTO `coding` (`id`, `questionID`, `code`) VALUES
(1, 5, 'public function helloWorld()\r\n  {\r\n    string mamamo;\r\n    if(mamamo == "nanaymo")\r\n      {\r\n        cout("Suck me");\r\n      }\r\n  }');

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
(1, 'Adapter', 'Putangina', 'Sagutan mo to', 'Multiple Choice', '2017-09-09 17:35:03', 3, '48', 'option1'),
(2, 'Adapter', 'Testing palang to', 'Testing nga inamo', 'Multiple Choice', '2017-09-09 17:40:21', 1, '48', 'option3'),
(5, 'Adapter', 'Test ng inamo', 'Why do birds apir suddenly', 'Coding', '2017-09-15 12:50:10', 0, '48', 'public function helloWorld()\r\n  {\r\n    string mamamo;\r\n    if(mamamo == "nanaymo")\r\n      {\r\n        cout("Suck me");\r\n      }\r\n  }'),
(6, 'Adapter', 'Testingtitlemo', 'Testingmamamo', 'Identification', '2017-09-15 13:02:26', 0, '48', ''),
(7, 'Adapter', 'Test', 'Aaaaaaaaa', 'Identification', '2017-09-15 13:33:50', 0, '49', ''),
(8, 'Adapter', 'Eto ang tanong', 'Tanong?', 'Multiple Choice', '2017-09-16 04:29:36', 0, '49', 'option4');

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
(1, 'Adapter', 'adapter', 2, 6),
(2, 'Composite', 'composite', 0, 0),
(3, 'Decorator', 'decorator', 0, 0),
(4, 'Observer', 'observer', 0, 0),
(5, 'Strategy', 'strategy', 0, 0),
(6, 'Abstract-Factory', 'abstract-factory', 0, 0),
(7, 'Factory-Method', 'factory-method', 0, 0),
(8, 'Template-Method', 'template-method', 0, 0);

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
(48, 'a@a.com', '$2y$10$UgV86vHt9B4NvEEhpDKavukAoJINIPz9nTLSvYIrOs8lz4aSnF3jq', 'John', 'Doe', 'student', 13, 0),
(49, 'b@b.com', '$2y$10$wIkN7/jteb5Hfbu75JL.luqudv5Lpe4sVyrfG7QWu3cExtBJLnYLi', 'Juan', 'Doe', 'student', 5, 0),
(70, 'abdul_jakul_salsalani@example.com', '$2y$10$LI.HPtBnlpDTC3jFsgM1T.3KT2PsLE9.O3alSuWXwE7R3W7XPQvKm', 'Abdul Jakul', 'Salsalani', 'student', 1, 5),
(71, 'c@c.com', '$2y$10$8qdLeU/Lu2ogL5bIIMsdEuWB9Imb71rKD1wxy/ldCgVmF1FmOsMV6', 'cat', 'dogcat', 'student', 2, 0),
(72, 'v@v.com', '$2y$10$kK04QfoLNFJkzocjPI7EWOivO2MUXzrk19TEGQju470XRAg9/29/q', 'VIAGRANG TITAN GEL', 'viagra ', 'student', 9, 8),
(73, 'n@n.com', '$2y$10$IPxE1huKIyfR3TYcN2yuxeSCYFq/olTK4rPWaUOa0K/OZUl4Nmag2', 'nunal', 'Sa pwet', 'student', 0, 0),
(74, 'm@m.com', '$2y$10$eFu14M/UzfLZcILh//NL0.y50xpnoaANRIK6kL/fjEPiMblGTzi4K', 'malibog', 'ako', 'student', 0, 0),
(75, 'z@z.com', '$2y$10$fyHZX7E5InArYCM7w6qF6.ZZHJmfGQl4tLr9Q3c3tSE8CK8Pv5W6G', 'zha ', 'zao', 'student', 0, 0),
(76, 'w@w.com', '$2y$10$AypsZoLr60M0BSieRigbnuJDZMwdwLYx3kb/42VS9GeU3IWlnFx1e', 'wet ', 'wild', 'student', 0, 0),
(77, 'e@e.com', '$2y$10$66O0qaaXmGNYECDVAJy4BeAmUimGD1ZCTLaPSPOC8yh6Dhj6c0byq', 'ebon', 'ebony', 'student', 0, 0),
(78, 'Tina_muran@muran.com', '$2y$10$bU2O6cs/GEzc7N/lPYjPlOguC1/VfOi4T8SFMKmQZaPHv2.t3gEIy', 'Tina', 'muran', 'student', 94, 0),
(80, 'admin@admin.com', '$2y$10$MOpeJpMcwtMo9lawliracehdm5IIWcIHs2fg5xV.mB3pVUMAitGva', 'admin', 'admin', 'admin', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `status` varchar(20) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `verified_by` varchar(30) NOT NULL,
  `verified_when` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`id`, `questionID`, `status`, `comment`, `verified_by`, `verified_when`) VALUES
(1, 8, 'removed', 'Echo mo yung if 8080', '', '2017-09-16 05:08:49'),
(2, 1, 'unverified', '', '', '0000-00-00 00:00:00'),
(3, 2, 'unverified', '', '', '0000-00-00 00:00:00'),
(4, 5, 'removed', 'aaaaaaaaaaaaaaaaaaaaaa', '', '2017-09-16 05:06:11'),
(5, 6, 'removed', 'sdadfasasdffdafd', '', '2017-09-16 05:03:30'),
(6, 8, 'removed', 'Echo mo yung if 8080', '', '2017-09-16 05:08:49'),
(7, 7, 'verified', 'Your question has been verified!', '', '2017-09-16 04:59:30');

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
-- Indexes for table `coding`
--
ALTER TABLE `coding`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answered_by`
--
ALTER TABLE `answered_by`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `coding`
--
ALTER TABLE `coding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `stockmarket`
--
ALTER TABLE `stockmarket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
