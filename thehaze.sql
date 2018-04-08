-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 08, 2018 at 06:16 AM
-- Server version: 5.7.21-0ubuntu0.17.10.1
-- PHP Version: 7.1.15-0ubuntu0.17.10.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thehaze`
--

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE `interest` (
  `username` varchar(64) NOT NULL,
  `post_id` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`username`, `post_id`) VALUES
('kamaln', 5),
('kamaln', 7),
('kamaln', 4);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `post_id` int(32) NOT NULL,
  `title` varchar(64) NOT NULL,
  `username` varchar(32) NOT NULL,
  `price` varchar(16) NOT NULL,
  `cond` varchar(24) NOT NULL,
  `description` varchar(600) NOT NULL,
  `tstamp` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`post_id`, `title`, `username`, `price`, `cond`, `description`, `tstamp`) VALUES
(4, 'Pillow', 'prem', '200', 'Brand New', 'Brand new pillow which is very comfortable for sleep. Pillow cover not included.', '2018-04-07 20:30:25.856920'),
(5, 'Plastic Bottle', 'prem', '30', 'Used', 'The plastic bottle is pretty sturdy, but there is no insulation though.', '2018-04-07 20:55:17.226815'),
(7, 'Induction stove', 'prem', '1200', 'Gently Used', 'The induction stove is of pigeon company and is still in warranty. need to sell urgently', '2018-04-07 22:54:54.874174'),
(8, 'Cosco Football', 'kamaln', '600', 'Almost like New', 'Almost new Cosco Football available. prices are negotiable.', '2018-04-07 23:03:31.101360'),
(9, 'Desert Cooler', 'kamaln', '1600', 'Gently Used', 'Cooler is used less than 6 months. Condition is very good. Would be as good as new after small maintianence', '2018-04-07 23:07:13.243225'),
(10, 'Object Oriented Programming with C++', 'kamaln', '350', 'Almost like New', 'Programming in C++ by E Balagurusamy condition is almost like new. Prices are negotiable.', '2018-04-07 23:10:13.461111'),
(12, 'Maggi noodles pack of 8', 'kamaln', '80', 'Brand New', 'Maggi masala noodles pack of 8 on reasonable price. ', '2018-04-07 23:17:11.467346');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `name` varchar(48) NOT NULL,
  `email` varchar(48) NOT NULL,
  `password` varchar(128) NOT NULL,
  `mobile` varchar(12) DEFAULT '0',
  `hostel` varchar(5) DEFAULT 'unset',
  `verified` varchar(3) DEFAULT 'no',
  `room` varchar(20) DEFAULT 'unset',
  `image` varchar(39) DEFAULT 'unset'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `mobile`, `hostel`, `verified`, `room`, `image`) VALUES
(1, 'kamaln', 'Kamal Narayan', 'kamaln@gmail.com', '6c6f6a1bc6bdf45ffea27961b4d3a4dc', '1234567898', 'BH-1', 'no', '120', 'set'),
(2, 'prem', 'prem', 'prmsrswt@gmail.com', '7b24afc8bc80e548d66c4e7ff72171c5', '9829145160', 'BH-2', 'no', '101', 'unset');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `post_id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
