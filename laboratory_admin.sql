-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2022 at 08:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratory_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis`
--

CREATE TABLE `analysis` (
  `id_analysis` int(11) NOT NULL,
  `name_analysis` varchar(255) NOT NULL,
  `standart_price` int(11) NOT NULL,
  `coa` tinyint(1) NOT NULL,
  `template` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id_analysis`, `name_analysis`, `standart_price`, `coa`, `template`) VALUES
(2, 'Illumination', 1500000, 1, NULL),
(3, 'Odor', 2000000, 1, NULL),
(4, 'Heat Stress', 1000000, 1, NULL),
(5, 'Vibration', 1300000, 1, NULL),
(6, 'Wastewater', 2300000, 1, NULL),
(7, 'Non-Stationary Source Emission', 2500000, 1, NULL),
(8, 'Stationary Stack Source Emission', 800000, 1, NULL),
(9, 'Noise', 500000, 1, NULL),
(10, 'Workplace Air Quality', 4500000, 1, NULL),
(11, 'Ambient Air', 3200000, 1, NULL),
(12, 'Surface Water', 300000, 1, NULL),
(13, 'Clean Water', 450000, 1, NULL),
(14, 'Transportation', 200000, 0, NULL),
(15, 'Air Emission (Non-Isocinetic)', 100000, 1, NULL),
(16, 'Air Emission', 250000, 1, NULL),
(19, '24 HOURS NOISE', 100000, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assign_sampler`
--

CREATE TABLE `assign_sampler` (
  `id_assign` int(11) NOT NULL,
  `id_sampler` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `is_sampler` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_sampler`
--

INSERT INTO `assign_sampler` (`id_assign`, `id_sampler`, `id_sk`, `is_sampler`) VALUES
(3, 1, 2, 1),
(4, 12, 2, 1),
(5, 14, 2, 1),
(8, 13, 2, 1),
(9, 11, 2, 0),
(10, 1, 10, 1),
(11, 7, 10, 1),
(12, 13, 10, 0),
(13, 14, 10, 0),
(14, 13, 13, 1),
(15, 8, 13, 0),
(16, 7, 14, 1),
(17, 9, 14, 1),
(19, 14, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `params` varchar(255) DEFAULT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `reg_standart_1` varchar(100) DEFAULT NULL,
  `reg_standart_2` varchar(100) DEFAULT NULL,
  `reg_standart_3` varchar(100) DEFAULT NULL,
  `reg_standart_4` varchar(100) DEFAULT NULL,
  `method` int(11) NOT NULL,
  `category_params` varchar(255) DEFAULT NULL,
  `sampling_time` varchar(255) DEFAULT NULL,
  `sampling_location` varchar(255) NOT NULL,
  `year` varchar(100) DEFAULT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `noise` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `id_analysis`, `params`, `unit`, `reg_standart_1`, `reg_standart_2`, `reg_standart_3`, `reg_standart_4`, `method`, `category_params`, `sampling_time`, `sampling_location`, `year`, `capacity`, `noise`, `time`) VALUES
(18, 13, 'Turbidity', 'NTU', '25', '0', '0', '0', 2, 'Physical', '', '', '', '', '', ''),
(19, 13, 'Color', 'Pt-Co', '50', '0', '0', '0', 6, 'Physical', '', '', '', '', '', ''),
(20, 13, 'Total Dissolve Solids (TDS)', 'mg/L', '1000', '0', '0', '0', 3, 'Physical', '', '', '', '', '', ''),
(21, 13, 'Temperature', '°C', '0', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(22, 13, 'Iron (Fe)', 'mg/L', '1', '0', '0', '0', 18, 'Chemistry', '', '', '', '', '0', ''),
(23, 13, 'Fluoride (F)', 'mg/L', '1.5', '0', '0', '0', 13, 'Chemistry', '', '', '', '', '0', ''),
(24, 13, 'Total Hardness (CaCO3)', 'mg/L', '500', '0', '0', '0', 6, 'Chemistry', '', '', '', '', '0', ''),
(25, 13, 'Total Coliform', 'CFU/100ml', '50', '0', '0', '0', 20, 'Microbiology', '', '', '', '', '0', ''),
(26, 13, 'E-Coliform', 'CFU/100ml', '0', '0', '0', '0', 20, 'Microbiology', '', '', '', '', '0', ''),
(27, 15, 'Ammonia (NH3)', 'mg/L', '0.5', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(28, 15, 'Chlorine (CI2)', 'mg/L', '10', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(29, 15, 'Hydrogen Chloride (HCl)', 'mg/L', '5', '0', '0', '0', 13, 'Chemistry', '', '', '', '', '0', ''),
(30, 15, 'Hydrogen Fluoride (HF)', 'mg/L', '10', '0', '0', '0', 13, 'Chemistry', '', '', '', '', '0', ''),
(31, 15, 'Nitrogen Dioxide (NO2)', 'mg/L', '1000', '0', '0', '0', 19, 'Chemistry', '', '', '', '', '0', ''),
(32, 15, 'Opacity', '%', '30', '0', '0', '0', 18, 'Physical', '', '', '', '', '0', ''),
(33, 15, 'Particulate', 'mg/L', '350', '0', '0', '0', 20, 'Chemistry', '', '', '', '', '0', ''),
(34, 15, 'Sulfur Dioxide (SO2)*', 'mg/L', '800', '0', '0', '0', 18, 'Physical', '', '', '', '', '0', ''),
(35, 15, 'Hydrogen Sulfide (H2S)', 'mg/L', '35', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(36, 15, 'Mercury (Hg)', 'mg/L', '5', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(37, 15, 'Arsenic (As)', 'mg/L', '8', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(38, 15, 'Antimony (Sb)', 'mg/L', '8', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(39, 15, 'Cadmium (Cd)', 'mg/L', '8', '0', '0', '0', 18, 'Physical', '', '', '', '', '0', ''),
(40, 15, 'Zinc (Zn)', 'mg/L', '50', '0', '0', '0', 19, 'Physical', '', '', '', '', '0', ''),
(41, 15, 'Lead (Pb)', 'mg/L', '12', '0', '0', '0', 18, 'Physical', '', '', '', '', '0', ''),
(42, 12, 'Temperature', '°C', '1000', '1000', '1000', '1000', 2, 'Physical', '', '', '', '', '0', ''),
(44, 12, 'Biological Oxygen demand (BOD)', 'mg/L', '2', '3', '6', '12', 4, 'Chemistry', '', '', '', '', '0', ''),
(45, 12, 'Total Suspens Solids (TTS)', 'mg/L', '40', '50', '100', '400', 3, 'Physical', '', '', '', '', '0', ''),
(46, 12, 'Total DOscovered Solds (TDS)', 'mg/L', '1000', '1000', '1000', '1000', 3, 'Physical', '', '', '', '', '0', ''),
(47, 12, 'Chemicial Oxygen Demand (COD)', 'mg/L', '10', '25', '40', '80', 7, 'Chemistry', '', '', '', '', '0', ''),
(48, 12, 'pH', '°C', '6', '6', '6', '6', 4, 'Chemistry', '', '', '', '', '0', ''),
(49, 12, 'Total Phospharate (PO4)', 'mg/L', '0.2', '0.2', '1', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(50, 12, 'Sulfate (s04)', 'mg/L', '300', '300', '300', '400', 3, 'Chemistry', '', '', '', '', '0', ''),
(51, 12, 'Arsenic (As)', 'mg/L', '0.05', '0.05', '0.05', '0.1', 6, 'Chemistry', '', '', '', '', '0', ''),
(52, 12, 'Boron (B)', 'mg/L', '1', '1', '1', '1', 13, 'Chemistry', '', '', '', '', '0', ''),
(53, 12, 'Cadmium (cd)', 'mg/L', '0.01', '0.01', '0.01', '0.01', 12, 'Chemistry', '', '', '', '', '0', ''),
(54, 12, 'Cobalt (Co)', 'mg/L', '0.2', '0.2', '0.2', '0.2', 10, 'Chemistry', '', '', '', '', '0', ''),
(55, 12, 'Chromium Hexavalent (Cr6+)', 'mg/L', '0.05', '0.05', '0.05', '1', 14, 'Chemistry', '', '', '', '', '0', ''),
(56, 12, 'Copper (Cu)', 'mg/L', '0.02', '0.02', '0.02', '0.2', 19, 'Chemistry', '', '', '', '', '0', ''),
(57, 12, 'Lead (pb)', 'mg/L', '0.03', '0.03', '0.03', '0.5', 18, 'Chemistry', '', '', '', '', '0', ''),
(58, 12, 'Mercury (Hg)', 'mg/L', '0.001', '0.002', '0.002', '0.005', 19, 'Chemistry', '', '', '', '', '0', ''),
(59, 12, 'Oil and Grease', 'mg/L', '1', '1', '1', '10', 12, 'Chemistry', '', '', '', '', '0', ''),
(60, 12, 'Selenium (se)', 'mg/L', '0.01', '0.05', '0.05', '0.05', 16, 'Chemistry', '', '', '', '', '0', ''),
(61, 12, 'Zinc (Zn)', 'mg/L', '0.05', '0.05', '0.05', '2', 10, 'Chemistry', '', '', '', '', '0', ''),
(62, 12, 'Nikel (Ni)', 'mg/L', '0.05', '0.05', '0.05', '0.1', 19, 'Chemistry', '', '', '', '', '0', ''),
(63, 12, 'MBAS', 'mg/L', '0.2', '0.2', '0.2', '0', 12, 'Chemistry', '', '', '', '', '0', ''),
(64, 12, 'Mangan (Mn)', 'mg/L', '0.1', '0', '0', '0', 11, 'Chemistry', '', '', '', '', '0', ''),
(65, 6, 'Temperature', '°C', '40', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(66, 6, 'Total Dissolved Solids (TDS)', 'mg/L', '4000', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(67, 6, 'Total Suspended Solids (TSS)', 'mg/L', '4000', '0', '0', '0', 17, 'Physical', '', '', '', '', '0', ''),
(68, 6, 'Ph', '°C', '5.5', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(69, 6, 'Iron (fe)', 'mg/L', '10', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(70, 6, 'Manganese (Mn)', 'mg/L', '4', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(71, 6, 'Barium (ba)', 'mg/L', '4', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(72, 6, 'Copper (Cu)', 'mg/L', '4', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(73, 6, 'Chomium Hexavalent (Cr6+)', 'mg/L', '0.2', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(74, 6, 'Zinc (Zn)', 'mg/L', '10', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(75, 6, 'Chromium (Cr)', 'mg/L', '1', '0', '0', '0', 2, 'Chemistry', '', '', '', '', '0', ''),
(76, 6, 'Cadium (cd)', 'mg/L', '0.1', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(77, 6, 'Total Lead (Pb)', 'mg/L', '0.2', '0', '0', '0', 14, 'Chemistry', '', '', '', '', '0', ''),
(78, 6, 'Stannum (Sn)', 'mg/L', '4', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(79, 6, 'Mercury (Hg)', 'mg/L', '0.004', '0', '0', '0', 13, 'Chemistry', '', '', '', '', '0', ''),
(80, 6, 'Arsenic (As)', 'mg/L', '0.2', '0', '0', '0', 13, 'Chemistry', '', '', '', '', '0', ''),
(81, 6, 'Selenium (Se)', 'mg/L', '0.1', '0', '0', '0', 16, 'Chemistry', '', '', '', '', '0', ''),
(82, 6, 'Nickel (Ni)', 'mg/L', '0.4', '0', '0', '0', 18, 'Chemistry', '', '', '', '', '0', ''),
(83, 6, 'Cobalt (Co)', 'mg/L', '0.8', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(84, 6, 'Cyanide (Cn)', 'mg/L', '0.1', '0', '0', '0', 12, 'Chemistry', '', '', '', '', '0', ''),
(85, 6, 'Hydrogen Sulfide (H2S)', 'mg/L', '0.1', '0', '0', '0', 15, 'Chemistry', '', '', '', '', '0', ''),
(86, 6, 'Fluoride (f)', 'mg/L', '4', '0', '0', '0', 12, 'Chemistry', '', '', '', '', '0', ''),
(87, 6, 'Free Chorine (Cl2)', 'mg/L', '2', '0', '0', '0', 2, 'Chemistry', '', '', '', '', '0', ''),
(88, 6, 'Ammonia (NH3N)', 'mg/L', '2', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(89, 6, 'Nitrate (NO3N)', 'mg/L', '40', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(90, 6, 'Nitrite (No2N)', 'mg/L', '40', '0', '0', '0', 14, 'Chemistry', '', '', '', '', '0', ''),
(91, 6, 'Total Nitrogen', 'mg/L', '2', '0', '0', '0', 9, 'Chemistry', '', '', '', '', '0', ''),
(92, 6, 'Biological Oxygen Demand (BOD)', 'mg/L', '200', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(93, 6, 'Chemicial Oxygen demand (COD)', 'mg/L', '400', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(94, 6, 'MBAS', 'mg/L', '10', '0', '0', '0', 10, 'Chemistry', '', '', '', '', '0', ''),
(96, 6, 'Phenol', 'mg/L', '1', '0', '0', '0', 10, 'Chemistry', '', '', '', '', '0', ''),
(97, 6, 'Oil and Grease', 'mg/L', '10', '0', '0', '0', 3, 'Chemistry', '', '', '', '', '0', ''),
(98, 6, 'Total Coliform ', 'mg/L', '0', '0', '0', '0', 4, 'Microbiology', '', '', '', '', '0', ''),
(99, 10, 'Sulphur Dioxide (S02)', 'mg/L', '0.25', '0', '0', '0', 14, 'Physical', '', '', '', '', '0', ''),
(100, 10, 'Nitrogen Dioxide (No3)', 'mg/L', '0.2', '0', '0', '0', 4, 'Chemistry', '', '', '', '', '0', ''),
(101, 10, 'Carbon Monoxide (Co)', 'mg/L', '29', '0', '0', '0', 5, 'Physical', '', '', '', '', '0', ''),
(102, 10, 'Ammonia (Nh3)', 'mg/L', '17', '0', '0', '0', 13, 'Physical', '', '', '', '', '0', ''),
(103, 10, 'Hydrogen Sulfide (H2s)', 'NTU', '1', '0', '0', '0', 14, 'Physical', '', '', '', '', '0', ''),
(104, 10, 'Total Suspended Particulates (TSP)', 'mg/L', '10', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(105, 8, 'Ammonia (Nh3)', 'mg/L', '0.5', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(106, 8, 'Chlorine (Cl2)', 'mg/L', '10', '0', '0', '0', 6, 'Physical', '', '', '', '', '0', ''),
(107, 8, 'Hydrogen Chloride (HCl)', 'mg/L', '5', '0', '0', '0', 15, 'Physical', '', '', '', '', '0', ''),
(108, 8, 'Hydrogen Fluoride (Hf)', 'mg/L', '10', '0', '0', '0', 17, 'Physical', '', '', '', '', '0', ''),
(109, 8, 'Nitrogen Dioxide (No2)', 'mg/L', '1000', '0', '0', '0', 17, 'Physical', '', '', '', '', '0', ''),
(110, 8, 'Opacity', '%', '35', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(111, 8, 'Particulate', 'mg/L', '350', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(112, 8, 'Sulfur Dioxide (S02)', 'mg/L', '800', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(113, 8, 'Hydrogen Sulfide (HS2s)', 'mg/L', '35', '0', '0', '0', 14, 'Physical', '', '', '', '', '0', ''),
(114, 8, 'Mercury (Hg)', 'mg/L', '5', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(115, 8, 'Arsenic (As)', 'mg/L', '8', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(116, 8, 'Antimony (Sb)', 'mg/L', '8', '0', '0', '0', 8, 'Physical', '', '', '', '', '0', ''),
(117, 8, 'Cadmium (Cd)', 'mg/L', '8', '0', '0', '0', 19, 'Physical', '', '', '', '', '0', ''),
(118, 8, 'Zinc (Zn)', 'mg/L', '50', '0', '0', '0', 11, 'Physical', '', '', '', '', '0', ''),
(119, 8, 'Total Lead (Pb)', 'mg/L', '12', '0', '0', '0', 11, 'Physical', '', '', '', '', '0', ''),
(122, 3, 'Methyl Ethyl Ketone (C4H8O)', 'mg/L', '200', '0', '0', '0', 15, 'Physical', '', '', '', '', '0', ''),
(123, 3, 'Acelon (C2H2O)', 'mg/L', '118.12', '0', '0', '0', 3, 'Physical', '', '', '', '', '0', ''),
(124, 3, 'Toluene (C7H8)', 'mg/L', '20', '0', '0', '0', 3, 'Physical', '', '', '', '', '0', ''),
(125, 16, 'Armonia (NH3)', 'mg/L', '0.5', '0', '0', '0', 3, 'Physical', '', '', '', '', '0', ''),
(126, 16, 'Cholrine (Cl2)', 'mg/L', '10', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(128, 16, 'Hydrogen Chloride (HCI)', 'mg/L', '5', '0', '0', '0', 3, 'Physical', '', '', '', '', '0', ''),
(129, 16, 'Hydrogen Fluoride (HF)', 'mg/L', '10', '0', '0', '0', 12, 'Physical', '', '', '', '', '0', ''),
(130, 16, 'Nitrogen Dioxide (NO2)', 'mg/L', '1000', '0', '0', '0', 17, 'Physical', '', '', '', '', '0', ''),
(131, 16, 'Opacity', 'mg/L', '35', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(132, 16, 'Particulate', 'mg/L', '350', '0', '0', '0', 3, 'Physical', '', '', '', '', '0', ''),
(133, 16, 'Sulfure Dioxide (SO2)', 'mg/L', '35', '0', '0', '0', 14, 'Physical', '', '', '', '', '0', ''),
(134, 16, 'Hydrogen Sulfide (H2S)', 'mg/L', '35', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(135, 16, 'Mercury (Hg)', 'mg/L', '5', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(136, 16, 'Arsenic (as)', 'mg/L', '8', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(137, 16, 'Antimony (Sb)', 'mg/L', '8', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(138, 16, 'Cadiuum (Cd)', 'mg/L', '8', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(139, 16, 'Zinc (Zn)', 'mg/L', '50', '0', '0', '0', 4, 'Physical', '', '', '', '', '0', ''),
(140, 16, 'Lead (Pb)', 'mg/L', '12', '0', '0', '0', 2, 'Physical', '', '', '', '', '0', ''),
(142, 11, 'Sulphur Dioxide (SO2)', 'μg/m³', '150', '0', '0', '0', 19, NULL, '1 Hours', '', '', '', '0', ''),
(143, 11, 'Sulphur Dioxide (SO2)', 'μg/m³', '75', '0', '0', '0', 4, NULL, '24 Hours', '', '', '', '0', ''),
(144, 11, 'Sulphur Dioxide (SO2)', 'μg/m³', '45', '0', '0', '0', 4, NULL, '1 Year', '', '', '', '0', ''),
(145, 11, 'Nitrogen Dioxide (NO2)', 'μg/m³', '200', '0', '0', '0', 4, NULL, '1 Hours', '', '', '', '0', ''),
(146, 11, 'Nitrogen Dioxide (NO2)', 'μg/m³', '65', NULL, NULL, NULL, 2, NULL, '24 Hours', '', '', '', '0', ''),
(147, 11, 'Nitrogen Dioxide (NO2)', 'μg/m³', '50', NULL, NULL, NULL, 14, NULL, '1 Year', '', '', '', '0', ''),
(148, 5, NULL, 'm/s²', NULL, NULL, NULL, NULL, 23, NULL, NULL, '', NULL, NULL, '0', ''),
(149, 5, NULL, 'm/s²', NULL, NULL, NULL, NULL, 23, NULL, NULL, '', NULL, NULL, '0', ''),
(150, 9, NULL, 'dBA', '85', NULL, NULL, NULL, 19, NULL, NULL, '', NULL, NULL, '0', ''),
(151, 4, NULL, NULL, NULL, NULL, NULL, NULL, 24, NULL, NULL, '', NULL, NULL, '0', ''),
(152, 2, '', 'Lux', '>300', NULL, NULL, NULL, 25, NULL, NULL, '', NULL, NULL, '0', ''),
(153, 2, NULL, 'Lux', '>300', NULL, NULL, NULL, 25, NULL, NULL, '', NULL, NULL, '0', ''),
(154, 2, NULL, 'Lux', '>300', NULL, NULL, NULL, 25, NULL, NULL, '', NULL, NULL, '0', ''),
(155, 2, NULL, 'Lux', '>300', NULL, NULL, NULL, 25, NULL, NULL, '', NULL, NULL, '0', ''),
(156, 2, NULL, 'Lux', '>300', NULL, NULL, NULL, 25, NULL, NULL, '', NULL, NULL, '0', ''),
(157, 7, NULL, NULL, '70', NULL, NULL, NULL, 26, NULL, NULL, '', '<2010', '<3.5 ton', '0', ''),
(158, 7, NULL, NULL, '40', NULL, NULL, NULL, 26, NULL, NULL, '', '>2010', '10 ton', '0', ''),
(159, 7, NULL, NULL, '70', NULL, NULL, NULL, 26, NULL, NULL, '', '<2010', '>3.5 ton', '0', ''),
(160, 7, NULL, NULL, '50', NULL, NULL, NULL, 26, NULL, NULL, '', '>2010', '5 ton', '0', ''),
(161, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L1', 'T1'),
(162, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L2', 'T2'),
(163, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L3', 'T3'),
(164, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L4', 'T4'),
(165, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L5', 'T5'),
(166, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L6', 'T6'),
(167, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'UP WIND', NULL, NULL, 'L7', 'T7'),
(168, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L1', 'T1'),
(169, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L2', 'T2'),
(170, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L3', 'T3'),
(171, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L4', 'T4'),
(172, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L5', 'T5'),
(173, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L6', 'T6'),
(174, 19, NULL, 'dBA', '50', NULL, NULL, NULL, 27, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L7', 'T7');

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `norek` varchar(255) NOT NULL,
  `behalf_account` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `director_email` varchar(255) NOT NULL,
  `director_signature` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `name`, `address`, `phone`, `website`, `email`, `norek`, `behalf_account`, `bank`, `director`, `director_email`, `director_signature`) VALUES
(1, 'PT. Delta Indonesia Laboratory', 'Ruko Prima Orchard No.C 2 Prima Harapan Regency Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat', ' 021 - 88382018', 'www.deltaindonesialab.com', 'marketing@deltaindonesialab.com', '156-00-1713846-4', 'PT. DELTA INDONESIA LABORATORY', 'MANDIRI KC HARAPAN BARU BEKASI UTARA', 'Drs. H. Soekardin Rachman, M.Si', 'azkazikna.aal@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id_int` int(11) NOT NULL,
  `name_int` varchar(255) NOT NULL,
  `int_phone` varchar(255) NOT NULL,
  `int_email` varchar(255) NOT NULL,
  `int_address` varchar(255) NOT NULL,
  `name_cp` varchar(255) NOT NULL,
  `title_cp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id_int`, `name_int`, `int_phone`, `int_email`, `int_address`, `name_cp`, `title_cp`) VALUES
(3, 'PT. Matsuoka Industries Indonesia', '08967832', 'rosaria@gmail.com', 'Jl. Kali Sumber KM 117 RT 16 RW 05, Desa Ciberes, Kecamatan Patokbesi, Kabupaten Subang, Jawa Barat', 'Nurtarikasmalini,ST.,M.T', 'Direktur PT. Mentari Prima Karya'),
(4, 'PT. JGU Merdeka', '087632121', 'jgu@jgu.ac.id', 'JL Pegangsaan Timur', '', ''),
(5, 'PT. Nusantara Indah', '081385321716', 'nusantara26@gmail.com', 'JL Marzuki barat', '', ''),
(6, 'PT.Jaya indonesia', '08137569956', 'Jayaind17@gmail.com', 'JL Penus raya', '', ''),
(7, 'PT. Bettafish Indonesia', '8567641801', 'betafishrizq@gmail.com', 'Jl.H.M Jl. Moh. Sanun, RT.03/RW.08, Harapan Jaya, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16914', 'Ananda Rizq', 'CEO of PT. Bettafish Indonesia'),
(8, 'PT. Oasis Bogor', '081376838901', 'oasisbogor@gmail.com', 'Jl Lipi selatan', '', ''),
(9, 'PT. Jali Indonesia Utama', '0856956371', 'Jaliindonesia23@gmail.com', 'Jl Topaz nasution', '', ''),
(10, 'PT. Kingbarbar', '083819588819', 'kingbarbar@gmail.com', 'Jl. H,ahmad dahlan', '', ''),
(11, 'PT. Lentera Jiwa Project', '81210805647', 'azkazikna.aal@gmail.com', 'Jl. Pesat raya no 25 bogor', 'Annaufal Arifa', 'CEO of Lentera Jiwa Group'),
(12, 'PT. Big Mouse Korean', '0858939312', 'bigmousek@gmail.com', 'Jl. Kemang 2 jakarta barat', '', ''),
(13, 'PT. Zikna Soft', '8564789651', 'azkazikna.aal@gmail.com', 'Blablablabalba Bogor', 'Azkazikna Ageung Laksana', 'Direktur PT. Zikna Soft');

-- --------------------------------------------------------

--
-- Table structure for table `method`
--

CREATE TABLE `method` (
  `id_method` int(11) NOT NULL,
  `name_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `method`
--

INSERT INTO `method` (`id_method`, `name_method`) VALUES
(2, 'SNI 06-6989.23-2005'),
(3, 'SNI 6989.27:2019'),
(4, 'SNI 6989.3:2019'),
(5, 'SNI 6989.11:2019'),
(6, 'SM 23rd 3210B - 2017'),
(7, 'SNI 6989.71:2009'),
(8, 'Atomic Fluorescence Spectrophotometry'),
(9, 'SNI 6989.77:2011'),
(10, 'SNI 06-6989.29-2005'),
(11, 'APHA 23rd-4500 2017'),
(12, 'SNI 06-6989.30-2005'),
(13, 'SNI 6989.79:2011'),
(14, 'SNI 06-6989.9-2004'),
(15, 'SNI 6989.72:2009'),
(16, 'SNI 6989.2:2019'),
(17, 'SNI 06-6989.51-2005'),
(18, 'SNI 06-6989.21-2004'),
(19, 'SNI 6989.10:2011'),
(20, 'SM 23rd 9221B-2017'),
(22, 'Gas Chromatography'),
(23, 'Direct Reading'),
(24, 'SNI 16-7063-2004'),
(25, 'Light Meter'),
(26, 'SNI 19-7117.11-2005'),
(27, 'SNI 8427:2017');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id_quotation` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `spec` text NOT NULL,
  `qty` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `add_price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`id_quotation`, `id_analysis`, `id_int`, `remarks`, `spec`, `qty`, `id_sk`, `add_price`) VALUES
(8, 2, 4, '<p>asd12</p>', '<p>asdasd</p>', 12, 4, 12312312),
(10, 14, 4, '<p>dsfsd</p>', '<p>sdfsd</p>', 12, 4, 12312),
(11, 12, 9, '<p>fdsdfsd</p>', '<p>sfddsfds</p>', 12, 5, 1423432),
(13, 2, 12, '<p>123432</p>', '<p>32432</p>', 123123, 6, 234234),
(14, 14, 12, '<p>weewrwe</p>', '<p>ewrwer</p>', 12, 6, 12421423),
(15, 14, 3, '<p>Transportasi dan akomodasi sampling (Lokasi SUBANG, Jawa Barat)</p>', '<p>Paket, 2 Teknisi</p>', 1, 2, 50000),
(16, 11, 3, '<p>Pemantauan Kualitas Udara Ambient Outdoor untuk Area:</p><ul><li>Area Upwind</li><li>Area Down wind</li></ul>', '<p>Lampiran VII Peraturan Pemerintah No. 22 Tahun 2021</p><p><b>Sesaat: </b>SO2, CO, NO2, O3, HC, TSP, Pb</p>', 2, 2, 100000),
(17, 9, 3, '<p>Udara Kualitas Kebisingan (Noise) Ambient Sesaat</p><ul><li>Area Upwind</li><li>Area Down wind</li></ul>', '<p>Keputusan Menteri Negara Lingkungan Hidup KEP-48/MENLH/11/1996</p>', 2, 2, 20000),
(18, 10, 3, '<p>Pemantauan Kualitas Udara Kerja Produksi</p><ul><li>Ruang Produksi</li></ul>', '<p>Permenaker No. 5 Tahun 2018</p><p>CO, NO2, SO2, TSP, NOISE</p>', 1, 2, 10000),
(19, 6, 3, '<p>Pemantauan Kualitas Air Limbah</p><ul><li>Biotank</li></ul>', '<p>Permenlhk No. P.68/Menlhk/Setjen/Kum.1/8/2016</p>', 1, 2, 50000),
(20, 7, 3, '<p>Pemantauan Kualitas Emisi Sumber Tidak Bergerak:</p><ul><li>Cerobong Boiler 1</li><li>Cerobong Boiler 2</li></ul>', '<p>Permenlhk No. P.15/MENLHK/SETJEN/KUM.1/4/2019 tentang Baku Mutu Emisi Pembangkit Listrik Tenaga Termal <b>(NON ISOKINETIK)</b></p><p>Total Partikulat, SO2, NO2, CO</p>', 2, 2, 50000),
(22, 4, 5, '<p>Heat stress gaming yt</p>', '<p>asdasdasdas</p>', 12, 8, 100000),
(23, 13, 3, '<p>asdas</p>', '<p>asdasd</p>', 3, 2, 100000),
(29, 13, 7, '<p>dsfsdfsdf</p>', '<p>sdfsdffds</p>', 12, 9, 50000),
(30, 15, 7, '<p>dsfsd</p>', '<p>fsdfsdfsd</p>', 3, 9, 150000),
(31, 13, 11, '<p>sdfs</p>', '<p>dfsdfsdfs</p>', 23, 10, 100000),
(32, 15, 11, '<p>sdfsdf</p>', '<p>sdfsdfsd</p>', 1, 10, 150000),
(33, 6, 11, '<p>dsfsdf</p>', '<p>sdfsdf</p>', 14, 10, 10000),
(34, 12, 11, '<p>dsfsd</p>', '<p>fsdfsd</p>', 7, 10, 50000),
(35, 8, 11, '<p>dfgfdgdf</p>', '<p>fdgfdgfd</p>', 12, 10, 80000),
(36, 10, 11, '<p>sadasd</p>', '<p>asdasdas</p>', 12, 10, 45000),
(37, 16, 11, '<p>asdasdasd</p>', '<p>asdasdas</p>', 2, 10, 10000),
(38, 3, 11, '<p>dsc</p>', '<p>sdcsdcds</p>', 12, 10, 80000),
(41, 3, 11, '<p>sasd</p>', '<p>asdas</p>', 12, 13, 130000),
(42, 13, 11, '<p>dsfds</p>', '<p>sdfsd</p>', 12, 13, 10000),
(43, 15, 11, '<p>asdas</p>', '<p>das</p>', 12, 13, 10000),
(44, 8, 11, '<p>sdfsd</p>', '<p>fsfsdfs</p>', 12, 13, 0),
(45, 3, 3, '<p>upodatean</p>', '<p>dsfdsf</p>', 10, 14, 120000),
(46, 8, 3, '<p>stationary</p>', '<p>asda</p>', 5, 14, 0),
(48, 2, 3, '<p>dfgdf</p>', '<p>fdgd</p>', 12, 15, 434),
(49, 3, 3, '<p>sdfsd</p>', '<p>sdfsdf</p>', 12, 15, 0),
(51, 14, 3, '<p>fdggddgggbgt</p>', '<p>dfgfdg</p>', 34, 15, 0),
(54, 11, 11, '<p>sadasd</p>', '<p>sadasdas</p>', 3, 13, 0),
(55, 5, 11, '<p>asd</p>', '<p>asdas</p>', 10, 13, 40000),
(56, 9, 11, '<p>asdasd</p>', '<p>das</p>', 2, 13, 0),
(57, 4, 11, '<p>dfgh</p>', '<p>dfgdfgd</p>', 4, 13, 0),
(63, 2, 11, '<p>sdfd</p>', '<p>sfsd</p>', 1, 13, 50000),
(64, 7, 11, '<p>asdas</p>', '<p>dasdas</p>', 1, 13, 0),
(65, 19, 11, '<p>sadsa</p>', '<p>dasd</p>', 1, 13, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `result_coa`
--

CREATE TABLE `result_coa` (
  `id_result` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `result` varchar(255) DEFAULT NULL,
  `vehicle_brand` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `humidity` varchar(11) DEFAULT NULL,
  `wet` varchar(11) DEFAULT NULL,
  `dew` varchar(11) DEFAULT NULL,
  `globe` varchar(11) DEFAULT NULL,
  `wbgt_index` float DEFAULT NULL,
  `sampling_location` varchar(255) DEFAULT NULL,
  `code` varchar(100) NOT NULL,
  `opacity` double DEFAULT NULL,
  `leq` varchar(25) NOT NULL,
  `ls` varchar(25) NOT NULL,
  `lm` varchar(25) NOT NULL,
  `lsm` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_coa`
--

INSERT INTO `result_coa` (`id_result`, `id_sk`, `id_coa`, `id_analysis`, `id_int`, `result`, `vehicle_brand`, `time`, `humidity`, `wet`, `dew`, `globe`, `wbgt_index`, `sampling_location`, `code`, `opacity`, `leq`, `ls`, `lm`, `lsm`) VALUES
(14, 9, 18, 13, 7, 'berhasil mantap banget gg', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(15, 9, 19, 13, 7, 'sdfsdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(16, 9, 20, 13, 7, 'hguygtuytuy', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(17, 9, 21, 13, 7, 'asdsad', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(18, 9, 22, 13, 7, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(19, 9, 23, 13, 7, 'sdfsdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(20, 9, 24, 13, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(21, 9, 25, 13, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(22, 9, 26, 13, 7, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(23, 9, 27, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(24, 9, 28, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(25, 9, 29, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(26, 9, 30, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(27, 9, 31, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(28, 9, 32, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(29, 9, 33, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(30, 9, 34, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(31, 9, 35, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(32, 9, 36, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(33, 9, 37, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(34, 9, 38, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(35, 9, 39, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(36, 9, 40, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(37, 9, 41, 15, 7, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(47, 10, 27, 15, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(48, 10, 28, 15, 11, 'sdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(49, 10, 29, 15, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(50, 10, 30, 15, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(51, 10, 31, 15, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(52, 10, 32, 15, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(53, 10, 33, 15, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(54, 10, 34, 15, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(55, 10, 35, 15, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(56, 10, 36, 15, 11, 'fsdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(57, 10, 37, 15, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(58, 10, 38, 15, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(59, 10, 39, 15, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(60, 10, 40, 15, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(61, 10, 41, 15, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(62, 10, 65, 6, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(63, 10, 66, 6, 11, 'fsdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(64, 10, 67, 6, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(65, 10, 68, 6, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(66, 10, 69, 6, 11, 'sdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(67, 10, 70, 6, 11, 'sdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(68, 10, 71, 6, 11, 'dfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(69, 10, 72, 6, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(70, 10, 73, 6, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(71, 10, 74, 6, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(72, 10, 75, 6, 11, 'fsdfsdsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(73, 10, 76, 6, 11, 'sdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(74, 10, 77, 6, 11, 'sdfsdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(75, 10, 78, 6, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(76, 10, 79, 6, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(77, 10, 80, 6, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(78, 10, 81, 6, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(79, 10, 82, 6, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(80, 10, 83, 6, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(81, 10, 84, 6, 11, 'sdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(82, 10, 85, 6, 11, 'sdfsdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(83, 10, 86, 6, 11, 'dfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(84, 10, 87, 6, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(85, 10, 88, 6, 11, 'fsdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(86, 10, 89, 6, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(87, 10, 90, 6, 11, 'sdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(88, 10, 91, 6, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(89, 10, 92, 6, 11, 'sdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(90, 10, 93, 6, 11, 'dfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(91, 10, 94, 6, 11, 'fsdfds', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(92, 10, 95, 6, 11, 'fsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(93, 10, 96, 6, 11, 'fsdfds', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(94, 10, 97, 6, 11, 'sdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(95, 10, 98, 6, 11, 'fdssdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(96, 10, 120, 6, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(97, 10, 42, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(98, 10, 44, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(99, 10, 45, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(100, 10, 46, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(101, 10, 47, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(102, 10, 48, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(103, 10, 49, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(104, 10, 50, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(105, 10, 51, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(106, 10, 52, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(107, 10, 53, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(108, 10, 54, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(109, 10, 55, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(110, 10, 56, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(111, 10, 57, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(112, 10, 58, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(113, 10, 59, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(114, 10, 60, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(115, 10, 61, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(116, 10, 62, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(117, 10, 63, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(118, 10, 64, 12, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(119, 10, 105, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(120, 10, 106, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(121, 10, 107, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(122, 10, 108, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(123, 10, 109, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(124, 10, 110, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(125, 10, 111, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(126, 10, 112, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(127, 10, 113, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(128, 10, 114, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(129, 10, 115, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(130, 10, 116, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(131, 10, 117, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(132, 10, 118, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(133, 10, 119, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(134, 10, 99, 10, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(135, 10, 100, 10, 11, 'fsdfs', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(136, 10, 101, 10, 11, 'dfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(137, 10, 102, 10, 11, 'sdfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(138, 10, 103, 10, 11, 'fsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(139, 10, 104, 10, 11, 'sdfsdf', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(140, 10, 125, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(141, 10, 126, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(142, 10, 128, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(143, 10, 129, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(144, 10, 130, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(145, 10, 131, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(146, 10, 132, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(147, 10, 133, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(148, 10, 134, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(149, 10, 135, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(150, 10, 136, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(151, 10, 137, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(152, 10, 138, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(153, 10, 139, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(154, 10, 140, 16, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(155, 10, 122, 3, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(156, 10, 123, 3, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(157, 10, 124, 3, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(167, 13, 122, 3, 11, '< 10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(168, 13, 123, 3, 11, '< 40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(169, 13, 124, 3, 11, '< 55', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(170, 13, 18, 13, 11, 'asd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(171, 13, 19, 13, 11, 'asda', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(172, 13, 20, 13, 11, 'sdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(173, 13, 21, 13, 11, 'dasd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(174, 13, 22, 13, 11, 'sadas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(175, 13, 23, 13, 11, 'sad', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(176, 13, 24, 13, 11, 'asd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(177, 13, 25, 13, 11, 'asasdd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(178, 13, 26, 13, 11, 'keren coli form', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(179, 13, 27, 15, 11, 'dfg', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(180, 13, 28, 15, 11, 'dfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(181, 13, 29, 15, 11, 'gdfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(182, 13, 30, 15, 11, 'dfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(183, 13, 31, 15, 11, 'gdfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(184, 13, 32, 15, 11, 'gdfgdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(185, 13, 33, 15, 11, 'gdf', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(186, 13, 34, 15, 11, '<10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(187, 13, 35, 15, 11, '<50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(188, 13, 36, 15, 11, '>30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(189, 13, 37, 15, 11, '<10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(190, 13, 38, 15, 11, '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(191, 13, 39, 15, 11, '>10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(192, 13, 40, 15, 11, '23', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(193, 13, 41, 15, 11, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(194, 13, 105, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(195, 13, 106, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(196, 13, 107, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(197, 13, 108, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(198, 13, 109, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(199, 13, 110, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(200, 13, 111, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(201, 13, 112, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(202, 13, 113, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(203, 13, 114, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(204, 13, 115, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(205, 13, 116, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(206, 13, 117, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(207, 13, 118, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(208, 13, 119, 8, 11, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(209, 14, 122, 3, 3, 'asdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(210, 14, 123, 3, 3, 'dasd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(211, 14, 124, 3, 3, 'asdasdsgg', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(212, 14, 105, 8, 3, 'dfg', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(213, 14, 106, 8, 3, 'dfgdfg', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(214, 14, 107, 8, 3, 'dsfsd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(215, 14, 108, 8, 3, 'gg', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(216, 14, 109, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(217, 14, 110, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(218, 14, 111, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(219, 14, 112, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(220, 14, 113, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(221, 14, 114, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(222, 14, 115, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(223, 14, 116, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(224, 14, 117, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(225, 14, 118, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(226, 14, 119, 8, 3, '', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(227, 15, 122, 3, 3, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(228, 15, 123, 3, 3, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(229, 15, 124, 3, 3, NULL, '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(245, 13, 142, 11, 11, 'asdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(246, 13, 143, 11, 11, 'dasd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(247, 13, 144, 11, 11, 'asdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(248, 13, 145, 11, 11, 'dasd', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(249, 13, 146, 11, 11, 'asdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(250, 13, 147, 11, 11, 'asdas', '', '', NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', ''),
(251, 13, 148, 5, 11, '>10', 'Suzuki Alphard', '10 Hours', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(252, 13, 149, 5, 11, '>9', 'Honda Innova', '14 Hours', NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(253, 13, 150, 9, 11, 'asd', NULL, '10 Hours', NULL, NULL, NULL, NULL, NULL, 'Dirumah Sodara', '', NULL, '', '', '', ''),
(254, 13, 151, 4, 11, NULL, NULL, '10 Hours', '50', '18', '35', '23', 28, 'Area Plant 1', '', NULL, '', '', '', ''),
(309, 13, 152, 2, 11, '>230', NULL, '10 Hours', NULL, NULL, NULL, NULL, NULL, 'Area Plant 1', '', NULL, '', '', '', ''),
(310, 13, 153, 2, 11, '<200', NULL, '5 Minutes', NULL, NULL, NULL, NULL, NULL, 'Area Plant 2', '', NULL, '', '', '', ''),
(311, 13, 154, 2, 11, '540', NULL, '7 Hours', NULL, NULL, NULL, NULL, NULL, 'Area Plant 3', '', NULL, '', '', '', ''),
(312, 13, 155, 2, 11, '<200', NULL, '7 Minutes', NULL, NULL, NULL, NULL, NULL, 'Belakang JGU', '', NULL, '', '', '', ''),
(313, 13, 156, 2, 11, '900', NULL, '1 Minutes', NULL, NULL, NULL, NULL, NULL, 'Depan JGU', '', NULL, '', '', '', ''),
(314, 13, 157, 7, 11, NULL, 'Xpander', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'XP1434', 50, '', '', '', ''),
(315, 13, 158, 7, 11, NULL, 'Honda Innova', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'HN1432', 70, '', '', '', ''),
(316, 13, 159, 7, 11, NULL, 'Lamborghini', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'LM2342', 30, '', '', '', ''),
(317, 13, 160, 7, 11, NULL, 'SUV ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'SV1242', 20, '', '', '', ''),
(318, 13, 161, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'dsf', 'sdf', 'sd', 'fsd'),
(319, 13, 162, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'fsd', 'fds', 'dfsd', 'fsdf'),
(320, 13, 163, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'sdf', 'sdf', 'fsdf', 'fsdds'),
(321, 13, 164, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'sdfsd', 'fsdfs', 'dfsd', 'fsdf'),
(322, 13, 165, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'sdf', 'sdfsdf', 'fsdf', 'sdfsd'),
(323, 13, 166, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, 'sdf', 'sdfsd', 'fsd', 'fsdf'),
(324, 13, 167, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(325, 13, 168, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(326, 13, 169, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(327, 13, 170, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(328, 13, 171, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(329, 13, 172, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(330, 13, 173, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', ''),
(331, 13, 174, 19, 11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id_sample` int(11) NOT NULL,
  `name_sample` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sample`
--

INSERT INTO `sample` (`id_sample`, `name_sample`) VALUES
(1, 'Debu'),
(2, 'SO2'),
(3, 'NO2'),
(4, 'CO'),
(5, 'NH3'),
(6, 'H2S'),
(7, 'Suhu'),
(8, 'Kelembaban'),
(9, 'NOISE'),
(10, 'ISBB/Heat Stress'),
(11, 'Benzene'),
(12, 'Toluene'),
(13, 'Xylene (BTX)'),
(14, 'Partikulat'),
(15, 'Opasitas'),
(16, 'Laju Alir'),
(17, 'Pencahayaan'),
(18, 'Air Limbah Produksi'),
(19, 'Air Limbah Domestik');

-- --------------------------------------------------------

--
-- Table structure for table `sampler`
--

CREATE TABLE `sampler` (
  `id_sampler` int(11) NOT NULL,
  `name_smp` varchar(255) NOT NULL,
  `gender_smp` tinyint(1) NOT NULL,
  `phone_smp` varchar(255) NOT NULL,
  `email_smp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampler`
--

INSERT INTO `sampler` (`id_sampler`, `name_smp`, `gender_smp`, `phone_smp`, `email_smp`) VALUES
(1, 'Azkazikna Ageung Laksana', 1, '081314697305', 'azkazikna.aal@gmail.com'),
(7, 'Akbar Maulana Febriansyah', 1, '0856973256', 'akbar@gmail.com'),
(8, 'Rezha Ikhwan Hidayat', 1, '054586325975', 'rezha@gmail.com'),
(9, 'Ananda Rizq', 1, '084569785236', 'nanda@gmail.com'),
(10, 'Atiyah Ummi Sholihat', 0, '085647521245', 'atiyah@gmail.com'),
(11, 'Deviyanti Kusumawati', 0, '085645857584', 'devi@gmail.com'),
(12, 'Pramdhanni Dwi Putra Bintang', 1, '085698741236', 'pramgebleg@gmail.com'),
(13, 'Annaufal Arifa Nasution Hidayatullah', 1, '083698755485', 'annaufal60@gmail.com'),
(14, 'Shevy Octavian', 0, '081210805647', 'shevygaming@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_det`
--

CREATE TABLE `sampling_det` (
  `id_sampling` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `sample_id` varchar(10) NOT NULL,
  `sample_desc` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampling_det`
--

INSERT INTO `sampling_det` (`id_sampling`, `id_sk`, `id_analysis`, `sample_id`, `sample_desc`, `location`, `sample_type`, `deadline`, `description`) VALUES
(8, 2, 0, '', 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Halaman Depan Plant 1</li><li>Halaman Belakang Plant 2</li><li>Halaman Belakang Plant 3</li></ul>', 'Cair', '2022-10-14', 'gg gaming'),
(9, 2, 0, '', 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Ruang Produksi Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 3</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Padat', '2022-10-13', 'mantap'),
(10, 2, 0, '', 'NOISE', '<ul><li>Batas Pabrik Sebelah Utara</li><li>Batas Pabrik Sebelah Selatan</li><li>Batas Pabrik Sebelah Timur</li><li>Batas Pabrik Sebelah Barat</li></ul>', 'Gas', '2022-10-01', 'Ini deskripsi singkat'),
(11, 2, 0, '', 'NOISE', '<ul><li>Ruang Produksi Plant 1</li><li>Area Barel Machine Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Gas', '2022-10-20', 'ini deskripsi sangat singkat.'),
(12, 2, 0, '', 'ISBB/Heat Stress', '<ul><li>Ruang Heat Treatment Plant 2</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'ghf', '2022-10-02', 'gfh'),
(13, 2, 0, '', 'Benzene, Toluene, Xylene (BTX)', '<p>Area Platting Plant 1</p>', 'asdas', '2022-10-04', 'asd'),
(14, 2, 0, '', 'SO2, NO2, CO, Partikulat, Opasitas, Laju Alir', '<ul><li>Cerobong Genset 800 kVA Plant 1</li><li>Cerobong Genset 600 kVA Plant 2</li></ul>', 'ads', '2022-10-19', 'asd'),
(15, 2, 0, '', 'Pencahayaan', '<ul><li>Ruang Hear Treatment Plant 1</li><li>Ruang Produksi Plant 1</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', '', '', ''),
(16, 2, 0, '', 'Opasitas', '<ul><li>Forklift (1 titik) Plant 1</li><li>Forklift 2,5 Ton (1 titik) Plant 2</li><li>Truck Hino Tahun 2005 (T 8102 L) Plant 3</li><li>Truck Hino Tahun 2004 (T 8228 K) Plant 3</li><li>Truck Isuzu Tahun 2002 (T 8047 FZ) Plant 3</li></ul>', '', '', ''),
(17, 2, 0, '', 'Air Limbah Produksi', '<p>Servis Manhole</p>', '', '', ''),
(18, 2, 0, '', 'Air Limbah Domestik', '<p>Servis Manhole</p>', '', '', ''),
(19, 7, 0, '', 'Debu, SO2, NO2, CO, NH3, H2S', '<ul><li>Rumah Rezha</li><li>Rumah Pram</li></ul>', NULL, NULL, NULL),
(22, 6, 0, '', 'SO2, NO2, CO', '<ul><li>GH Evos</li><li>GH RRQ</li></ul>', 'Cair', '2022-10-06', 'sedang dikerjakan'),
(23, 9, 0, '', 'Debu, SO2, NO2, CO', '<p>dsfsdf</p>', 'Gas', '2022-10-06', 'fgfdgdfgdf'),
(24, 10, 0, '', 'Debu, SO2, NO2, CO', '<p>sdfsdfsd</p>', 'dsfdsf', '2022-10-11', 'dsfsdf'),
(25, 10, 0, '', 'Partikulat, Opasitas, Laju Alir, Pencahayaan', '<p>sdfsdfsd</p>', 'dsfsd', '2022-10-12', 'sdfsdf'),
(27, 14, 0, '14.01', 'SO2, NO2, CO, NH3', '<p>xcvxc</p>', 'Cair', '2022-10-10', 'ewfsd'),
(29, 14, 0, '14.02', 'Pencahayaan, Air Limbah Produksi, Air Limbah Domestik', '<p>asdas</p>', 'Gas', '2022-10-12', 'ad'),
(31, 13, 2, '13.01', 'Debu, SO2, NO2, NH3', '<p>dfsdf</p>', 'dsfdsf', '2022-10-27', 'sedang dikerjakan'),
(32, 13, 3, '13.02', 'SO2, NO2, NH3, Pencahayaan', '<p>asxsa</p>', 'Cair', '2022-10-24', 'sedang dikerjakan'),
(33, 13, 4, '13.03', 'Laju Alir, Pencahayaan, Air Limbah Produksi, Air Limbah Domestik', '<p>asdasd</p>', 'Cair', '2022-10-25', 'sedang dikerjakan'),
(34, 13, 5, '13.04', 'Laju Alir, Pencahayaan, Air Limbah Produksi', '<p>asdasd</p>', 'Padat', '2022-10-25', 'sedang dikerjakan'),
(35, 13, 8, '13.05', 'Laju Alir, Pencahayaan, Air Limbah Produksi, Air Limbah Domestik', '<p>asdasd</p>', 'Cair', '2022-10-27', 'sedang dikerjakan'),
(36, 13, 9, '13.06', 'CO, NH3, H2S, Pencahayaan, Air Limbah Produksi', '<p>sad</p>', 'Cair', '2022-10-26', 'sedang dikerjakan'),
(37, 13, 11, '13.07', 'Partikulat, Laju Alir, Pencahayaan, Air Limbah Produksi', '<p>sadas</p>', 'Cair', '2022-10-24', 'sedang dikerjakan'),
(38, 13, 13, '13.08', 'Kelembaban, NOISE, ISBB/Heat Stress, Benzene', '<p>sadasdas</p>', 'Padat', '2022-10-23', 'sedang dikerjakan'),
(39, 13, 15, '13.09', 'SO2, NO2, CO, H2S', '<p>sadasd</p>', 'Cair', '2022-10-25', 'sedang dikerjakan'),
(42, 13, 19, '13.10', 'Debu, SO2, NO2, CO', '<p>fgdfg</p>', 'Cair', '2022-10-27', 'sedang dikerjakan');

-- --------------------------------------------------------

--
-- Table structure for table `sk_number`
--

CREATE TABLE `sk_number` (
  `id_sk` int(11) NOT NULL,
  `sk_quotation` varchar(255) NOT NULL,
  `sk_sample` varchar(255) NOT NULL,
  `sk_analysis` varchar(255) NOT NULL,
  `no_certificate` varchar(255) NOT NULL,
  `date_quotation` date NOT NULL,
  `date_sample` date DEFAULT NULL,
  `date_analysis` date DEFAULT NULL,
  `date_report` date DEFAULT NULL,
  `id_int` int(11) NOT NULL,
  `status_po` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_number`
--

INSERT INTO `sk_number` (`id_sk`, `sk_quotation`, `sk_sample`, `sk_analysis`, `no_certificate`, `date_quotation`, `date_sample`, `date_analysis`, `date_report`, `id_int`, `status_po`) VALUES
(2, '1/2022/09/27/DIL/QTN', '2/2022/09/30/DIL/STPS', '2/2022/10/04/DIL/STP', '', '2022-09-27', '2022-10-04', NULL, NULL, 3, 0),
(4, '3/2022/09/27/DIL/QTN', '', '', '', '2022-09-27', NULL, NULL, NULL, 4, 0),
(5, '5/2022/09/27/DIL/QTN', '', '', '', '2022-09-27', NULL, NULL, NULL, 9, 0),
(6, '6/2022/09/27/DIL/QTN', '6/2022/10/03/DIL/STPS', '6/2022/10/04/DIL/STP', '', '2022-09-27', NULL, NULL, NULL, 12, 0),
(7, '7/2022/09/29/DIL/QTN', '7/2022/09/30/DIL/STPS', '', '', '2022-09-29', NULL, NULL, NULL, 10, 0),
(8, '8/2022/10/03/DIL/QTN', '', '', '', '2022-10-03', NULL, NULL, NULL, 5, 0),
(9, '9/2022/10/04/DIL/QTN', '9/2022/10/04/DIL/STPS', '9/2022/10/04/DIL/STP', 'DIL-20221004COA', '2022-10-04', '2022-10-04', '2022-10-04', '2022-10-04', 7, 0),
(10, '10/2022/10/09/DIL/QTN', '10/2022/10/09/DIL/STPS', '10/2022/10/09/DIL/STP', 'DIL-20221009COA', '2022-10-09', '2022-10-09', '2022-10-09', '2022-10-09', 11, 0),
(13, '11/2022/10/10/DIL/QTN', '13/2022/10/23/DIL/STPS', '13/2022/10/23/DIL/STP', 'DIL-20221023COA', '2022-10-10', '2022-10-23', '2022-10-23', '2022-10-23', 11, 1),
(14, '14/2022/10/10/DIL/QTN', '14/2022/10/11/DIL/STPS', '14/2022/10/22/DIL/STP', 'DIL-20221013COA', '2022-10-10', '2022-10-11', '2022-10-22', '2022-10-11', 3, 1),
(15, '15/2022/10/11/DIL/QTN', '', '', '', '2022-10-11', NULL, NULL, NULL, 3, 1),
(16, '16/2022/10/14/DIL/QTN', '', '', '', '2022-10-14', NULL, NULL, NULL, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id_unit` int(11) NOT NULL,
  `name_unit` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id_unit`, `name_unit`) VALUES
(2, '°C'),
(3, '%'),
(4, 'mg/L'),
(5, 'mg/m³'),
(6, 'mg/Nm³'),
(7, 'NTU'),
(8, 'Pt-Co'),
(9, 'CFU/100ml'),
(10, 'μg/m³'),
(11, 'ppm'),
(12, 'm/s²'),
(13, 'dBA'),
(14, 'Lux');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `fullname`, `email`, `image`, `password`, `role`, `date_created`) VALUES
(1, 'Azkazikna Ageung Laksana', 'azkazikna.aal@gmail.com', 'default.jpg', '$2y$10$q7dD4pXKRtUcIhOh6sCpdeMW10DpAsarhbTUihtS9ozYDOvbtC3Q2', 'superadmin', 1665406432),
(5, 'Genius Marketer', 'marketing@gmail.com', 'default.jpg', '$2y$10$dXt/1/q1dCNOvsQsfqoZou506aoO26zr3eYcPqKqRRhi.e0MUO0b2', 'marketing', 1665792355),
(6, 'Admin DIL', 'admin@gmail.com', 'default.jpg', '$2y$10$7IfR3vyaW1KKb1kihQefKuP.EmGs/sgXNt0RBY3HuNl7nIr6R/E46', 'admin', 1665792722),
(7, 'Super Admin', 'superadmin@gmail.com', 'default.jpg', '$2y$10$hvf8g7spSoUlrNEhiV0WkelepntxOBgndSN5IVWhKEERnWpo1yrMy', 'superadmin', 1666408797);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis`
--
ALTER TABLE `analysis`
  ADD PRIMARY KEY (`id_analysis`);

--
-- Indexes for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD PRIMARY KEY (`id_assign`),
  ADD KEY `id_sample` (`id_sampler`),
  ADD KEY `id_sk` (`id_sk`);

--
-- Indexes for table `coa`
--
ALTER TABLE `coa`
  ADD PRIMARY KEY (`id_coa`),
  ADD KEY `id_analysis` (`id_analysis`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id_int`);

--
-- Indexes for table `method`
--
ALTER TABLE `method`
  ADD PRIMARY KEY (`id_method`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`id_quotation`),
  ADD KEY `id_int` (`id_int`),
  ADD KEY `id_analysis` (`id_analysis`);

--
-- Indexes for table `result_coa`
--
ALTER TABLE `result_coa`
  ADD PRIMARY KEY (`id_result`),
  ADD KEY `id_coa` (`id_coa`),
  ADD KEY `id_analysis` (`id_analysis`),
  ADD KEY `id_int` (`id_int`);

--
-- Indexes for table `sample`
--
ALTER TABLE `sample`
  ADD PRIMARY KEY (`id_sample`);

--
-- Indexes for table `sampler`
--
ALTER TABLE `sampler`
  ADD PRIMARY KEY (`id_sampler`);

--
-- Indexes for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD PRIMARY KEY (`id_sampling`),
  ADD KEY `id_sk` (`id_sk`),
  ADD KEY `id_sample` (`sample_desc`);

--
-- Indexes for table `sk_number`
--
ALTER TABLE `sk_number`
  ADD PRIMARY KEY (`id_sk`),
  ADD KEY `id_int` (`id_int`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id_unit`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=175;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `result_coa`
--
ALTER TABLE `result_coa`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=332;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sampling_det`
--
ALTER TABLE `sampling_det`
  MODIFY `id_sampling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD CONSTRAINT `assign_sampler_ibfk_1` FOREIGN KEY (`id_sampler`) REFERENCES `sampler` (`id_sampler`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assign_sampler_ibfk_2` FOREIGN KEY (`id_sk`) REFERENCES `sk_number` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coa`
--
ALTER TABLE `coa`
  ADD CONSTRAINT `coa_ibfk_1` FOREIGN KEY (`id_analysis`) REFERENCES `analysis` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `quotation`
--
ALTER TABLE `quotation`
  ADD CONSTRAINT `quotation_ibfk_2` FOREIGN KEY (`id_int`) REFERENCES `institution` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `quotation_ibfk_3` FOREIGN KEY (`id_analysis`) REFERENCES `analysis` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD CONSTRAINT `sampling_det_ibfk_2` FOREIGN KEY (`id_sk`) REFERENCES `sk_number` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sk_number`
--
ALTER TABLE `sk_number`
  ADD CONSTRAINT `sk_number_ibfk_1` FOREIGN KEY (`id_int`) REFERENCES `institution` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
