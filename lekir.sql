-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 05:13 PM
-- Server version: 8.0.21
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lekir`
--

-- --------------------------------------------------------

--
-- Table structure for table `secret`
--

CREATE TABLE `secret` (
  `secret_id` int NOT NULL,
  `secret_data` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `secret`
--

INSERT INTO `secret` (`secret_id`, `secret_data`) VALUES
(1, 'aSBuZWVkIHNhbGFyeSBvZiAyMGsgTVlSIHRvIGJ1eSBwb3JzY2hlIHBsZWFzZSBoaXJlIG1lISBAZmlyZGF1c2toYWlydWRkaW4=');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_role` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `user_role`) VALUES
(1, 'admin', '$2y$10$Yc5HJuJERCYmWYep7rcW1ehamW3r55/zpcYKMh4lL0clDw5qlxctC', 0),
(2, 'firdaus', 'aSBuZWVkIHNhbGFyeSBvZiAyMGsgTVlSIHRvIGJ1eSBwb3JzY2hlIHBsZWFzZSBoaXJlIG1lISBAZmlyZGF1c2toYWlydWRkaW4=   - base64? really? no!', 0),
(3, 'mrkacak', 'this_is_not_the_correct_way_to_store_password_in_plaintext', 0),
(4, 'mrhensem', '5f4dcc3b5aa765d61d8327deb882cf99 - md5 is a no!', 0),
(5, 'mrtampan', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8 - sha1 hash are not design for password storage', 0);

-- --------------------------------------------------------

--
-- Table structure for table `xss`
--

CREATE TABLE `xss` (
  `xss_id` int NOT NULL,
  `xss_name` varchar(100) NOT NULL,
  `xss_age` varchar(100) NOT NULL,
  `xss_job` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `xss`
--

INSERT INTO `xss` (`xss_id`, `xss_name`, `xss_age`, `xss_job`) VALUES
(8, 'Firdaus Khairuddin', '29', 'Vice President');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `secret`
--
ALTER TABLE `secret`
  ADD PRIMARY KEY (`secret_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `xss`
--
ALTER TABLE `xss`
  ADD PRIMARY KEY (`xss_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `secret`
--
ALTER TABLE `secret`
  MODIFY `secret_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `xss`
--
ALTER TABLE `xss`
  MODIFY `xss_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
