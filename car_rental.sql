-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2025 at 09:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `price` int(255) NOT NULL,
  `plate_number` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `availability` int(2) NOT NULL,
  `year` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `car_id`, `car_name`, `model`, `price`, `plate_number`, `image`, `availability`, `year`) VALUES
(1, 1, 'Mercedez-AMG', 'C63 S Sedan', 2000, '21231', 'C63.jpg', 1, 2020),
(2, 2, 'Toyota', 'Land Cruiser', 5000, 'ABC123', 'LC.jpg', 1, 2025),
(4, 0, 'Toyota', 'Corolla', 1500, 'QPL342', 'Corolla.jpg', 1, 1996);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `role` int(2) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `role`, `fullname`, `contact_number`, `address`, `username`, `email`, `password`) VALUES
(3, 0, 0, 'John Howard Ragas Servallos', '09389516070', 'Lumambayan', 'Hawhaw', 'Howard@gmail.com', '$2y$10$Mfc4cQxuaVq1/9.JWYxLvO84ENUU/hoBX6y3.P7nX1sEKHV5RzMn.'),
(4, 0, 0, 'John Howard Ragas Servallos', '09389516070', 'Lumambayan', 'User', 'User@gmail.com', '$2y$10$cGtB0Xt9i.7aWKoK.32aSevF8kj9/5LUkZxCNhS3bCw8NEDTo4AKS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
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
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
