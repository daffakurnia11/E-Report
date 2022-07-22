-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 22, 2022 at 06:28 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ereport`
--

--
-- Dumping data for table `equipment_electrics`
--

INSERT INTO `equipment_electrics` (`id`, `user_id`, `name`, `volt`, `ampere`, `watt`, `power_factor`, `quantity`, `spesification`, `created_at`, `updated_at`) VALUES
(1, 7, 'Welding SMAW', '70', '20-400', '0', '0', 1, 'Weiro ARC 400', '2022-07-19 10:51:45', '2022-07-19 10:51:45'),
(2, 7, 'Welding FCAW', '400', '50-500', '0', '0.93', 1, 'Essab Mlg 500i', '2022-07-19 10:52:09', '2022-07-19 10:52:09'),
(3, 7, 'Shore Connection', '600', '40', '0', '0', 1, 'Mitsubishi nf63-cv', '2022-07-19 10:52:32', '2022-07-19 10:52:32'),
(4, 7, 'Trafo Las LCF', '220', '230', '0', '0', 1, 'ESAB', '2022-07-19 10:52:44', '2022-07-19 10:52:44'),
(5, 7, 'Trafo Mandiri RC500', '220', '60', '0', '0', 1, 'ESAB RC500', '2022-07-19 10:53:01', '2022-07-19 10:53:01');

--
-- Dumping data for table `equipment_gases`
--

INSERT INTO `equipment_gases` (`id`, `user_id`, `gas_equipment_id`, `capacity`, `unit`, `quantity`, `density`, `created_at`, `updated_at`) VALUES
(1, 7, 1, '25', 'Kg', 32, '1.1', '2022-07-22 04:24:12', '2022-07-22 04:24:12'),
(2, 7, 2, '25', 'Kg', 34, '1.98', '2022-07-22 04:25:29', '2022-07-22 04:25:29'),
(3, 7, 3, '25', 'Kg', 46, '2.47', '2022-07-22 04:26:02', '2022-07-22 04:26:02'),
(4, 7, 4, '50', 'Kg', 20, '1.30', '2022-07-22 04:26:20', '2022-07-22 04:26:20'),
(5, 7, 5, '7', 'm3', 2, '1.3', '2022-07-22 04:27:17', '2022-07-22 04:27:17'),
(6, 7, 6, '8000', 'm3', 1, '1.3', '2022-07-22 04:27:33', '2022-07-22 04:27:33'),
(7, 7, 7, '12', 'Kg', 8, '2.47', '2022-07-22 04:27:45', '2022-07-22 04:27:45');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
