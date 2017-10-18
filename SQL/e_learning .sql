-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2017 at 03:59 PM
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
-- Table structure for table `answered_by`
--

CREATE TABLE `answered_by` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `answer` varchar(500) NOT NULL,
  `correct` tinyint(1) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `coding`
--

CREATE TABLE `coding` (
  `id` int(11) NOT NULL,
  `questionID` int(11) NOT NULL,
  `code` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Adapter', 'Test Question', 'Test Question', 'Identification', '2017-10-18 15:55:07', 0, '48', 'the answer');

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
(1, 'Adapter', 'adapter', 0, 3),
(2, 'Composite', 'composite', 0, 6),
(3, 'Decorator', 'decorator', 0, 4),
(4, 'Observer', 'observer', 0, 5),
(5, 'Strategy', 'strategy', 0, 6),
(6, 'Abstract-Factory', 'abstract-factory', 0, 4),
(7, 'Factory-Method', 'factory-method', 0, 3),
(8, 'Template-Method', 'template-method', 1, 2);

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
  `slug` text NOT NULL,
  `userType` text NOT NULL,
  `ask_points` int(11) NOT NULL,
  `answer_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `slug`, `userType`, `ask_points`, `answer_points`) VALUES
(48, 'a@a.com', '$2y$10$UgV86vHt9B4NvEEhpDKavukAoJINIPz9nTLSvYIrOs8lz4aSnF3jq', 'John', 'Doe', 'John.Doe', 'student', 27, 0),
(49, 'b@b.com', '$2y$10$wIkN7/jteb5Hfbu75JL.luqudv5Lpe4sVyrfG7QWu3cExtBJLnYLi', 'Juan', 'Doe', 'Juan.Doe', 'student', 13, 0),
(80, 'admin@admin.com', '$2y$10$MOpeJpMcwtMo9lawliracehdm5IIWcIHs2fg5xV.mB3pVUMAitGva', 'admin', 'admin', 'admin.admin', 'admin', 0, 0),
(94, 'c@c.com', '$2y$10$dTbDyMYVeIT3pbXR.CN5leAW0t43vhEOCSiGTW79K3Hdstb3wQ9Yi', 'John', 'Juan', 'John.Juan', 'student', 0, 0);

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
(1, 1, 'unverified', '', '', '0000-00-00 00:00:00');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coding`
--
ALTER TABLE `coding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stockmarket`
--
ALTER TABLE `stockmarket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `verification`
--
ALTER TABLE `verification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
