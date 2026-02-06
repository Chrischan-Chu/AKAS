-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2026 at 09:58 AM
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
-- Database: `akas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `role` enum('user','clinic_admin') NOT NULL DEFAULT 'user',
  `name` varchar(150) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `birthdate` date DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `clinic_name` varchar(190) DEFAULT NULL,
  `specialty` varchar(120) DEFAULT NULL,
  `specialty_other` varchar(120) DEFAULT NULL,
  `logo_path` varchar(255) DEFAULT NULL,
  `license_number` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `role`, `name`, `email`, `password_hash`, `phone`, `created_at`, `birthdate`, `gender`, `clinic_name`, `specialty`, `specialty_other`, `logo_path`, `license_number`) VALUES
(1, 'user', 'Chu', 'chu@gmail.com', '$2y$10$RLdM6BOePO/m0TnvHp1LvuHOQd.5xEBmK/DsN9yMfvsuhpY8gJNrC', '9876543210', '2026-02-05 18:02:24', '2001-12-05', 'Male', NULL, NULL, NULL, NULL, NULL),
(2, 'clinic_admin', 'Chu', 'chuchu@gmail.com', '$2y$10$M/l71LJmG9b/zdGYpUe6cO7qUwebMZRFt8DMM6HKBZLrt4EWC/CU.', '9999999999', '2026-02-06 07:43:16', NULL, NULL, 'Chu', 'Dental Clinic', NULL, '/AKAS/uploads/logos/logo_984811fa2d569346.png', '1234567');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_accounts_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
