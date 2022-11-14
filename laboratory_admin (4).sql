-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2022 at 02:42 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `alias_analysis` varchar(255) NOT NULL,
  `standart_price` int(11) NOT NULL,
  `coa` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analysis`
--

INSERT INTO `analysis` (`id_analysis`, `name_analysis`, `alias_analysis`, `standart_price`, `coa`) VALUES
(2, 'Illumination', 'Illumination', 1500000, 1),
(3, 'Odor', 'Odor', 2000000, 1),
(4, 'Heat Stress', 'Heat Stress', 1000000, 1),
(5, 'Vibration', 'Vibration', 1300000, 1),
(6, 'Wastewater', 'Wastewater', 2300000, 1),
(7, 'Non-Stationary Source Emission', 'Non-Stationary Source Emission', 2500000, 1),
(8, 'Stationary Stack Source Emission', 'Stationary Stack Source Emission (Isokinetic)', 800000, 1),
(9, 'Noise', 'Noise (Workplace)', 500000, 1),
(10, 'Workplace Air Quality', 'Workplace Air Quality', 4500000, 1),
(11, 'Ambient Air', 'Ambient Air (Non-24 Hours)', 3200000, 1),
(12, 'Surface Water', 'Surface Water', 300000, 1),
(13, 'Clean Water', 'Clean Water', 450000, 1),
(14, 'Transportation', 'Transportation', 200000, 0),
(15, 'Air Emission (Non-Isocinetic)', 'Air Emission (Non-Isocinetic)', 100000, 1),
(16, 'Air Emission', 'Air Emission', 250000, 1),
(19, '24 HOURS NOISE', '24 Hours Noise (Ambient)', 100000, 1);

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

-- --------------------------------------------------------

--
-- Table structure for table `baps`
--

CREATE TABLE `baps` (
  `id_baps` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_sampler` int(11) DEFAULT NULL,
  `air_ambient` int(11) DEFAULT NULL,
  `chimney_emission` int(11) DEFAULT NULL,
  `lightning` int(11) DEFAULT NULL,
  `heat_stress` int(11) DEFAULT NULL,
  `workspace_air` int(11) DEFAULT NULL,
  `smell` int(11) DEFAULT NULL,
  `noise` int(11) DEFAULT NULL,
  `wastewater` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_unit` int(11) DEFAULT NULL,
  `id_method` int(11) NOT NULL,
  `params` varchar(255) DEFAULT NULL,
  `reg_standart_1` varchar(100) DEFAULT NULL,
  `reg_standart_2` varchar(100) DEFAULT NULL,
  `reg_standart_3` varchar(100) DEFAULT NULL,
  `reg_standart_4` varchar(100) DEFAULT NULL,
  `category_params` varchar(255) DEFAULT NULL,
  `sampling_time` varchar(255) DEFAULT NULL,
  `sampling_location` varchar(255) DEFAULT NULL,
  `year` varchar(100) DEFAULT NULL,
  `capacity` varchar(100) DEFAULT NULL,
  `noise` varchar(10) DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `id_analysis`, `id_unit`, `id_method`, `params`, `reg_standart_1`, `reg_standart_2`, `reg_standart_3`, `reg_standart_4`, `category_params`, `sampling_time`, `sampling_location`, `year`, `capacity`, `noise`, `time`) VALUES
(179, 2, 14, 25, NULL, '>300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(180, 2, 14, 25, NULL, '>300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(181, 2, 14, 25, NULL, '>300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(182, 2, 14, 25, NULL, '>300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(183, 2, 14, 25, NULL, '>300', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(184, 3, 16, 22, 'Methyl Ethyl Ketone (C4H8O)', '200', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(185, 3, 5, 22, 'Acelon (C2H2O)', '1187.12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(186, 3, 16, 22, 'Toluene (C7H8)', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(187, 4, NULL, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(201, 5, 12, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(202, 5, 12, 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(203, 9, 13, 51, NULL, '85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(204, 10, 17, 34, 'Sulphur Dioxide (SO2)*', '0.25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(205, 10, 16, 33, 'Nitrogen Dioxide (NO2)*', '0.2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(206, 10, 5, 37, 'Carbon Monoxide (CO)', '29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(207, 10, 5, 32, 'Ammonia (NH3)', '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(208, 10, 16, 38, 'Hydrogen Sulfide (H2S)', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(209, 10, 5, 24, 'Total Suspended Particulates (TSP)', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(210, 7, NULL, 26, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, '<2010', '<3.5 ton', NULL, NULL),
(211, 7, NULL, 26, NULL, '40', NULL, NULL, NULL, NULL, NULL, NULL, '>2010', '', NULL, NULL),
(212, 7, NULL, 26, NULL, '70', NULL, NULL, NULL, NULL, NULL, NULL, '<2010', '>3.5 ton', NULL, NULL),
(213, 7, NULL, 26, NULL, '50', NULL, NULL, NULL, NULL, NULL, NULL, '>2010', '', NULL, NULL),
(216, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L7', 'T7'),
(217, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L6', 'T6'),
(218, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L5', 'T5'),
(219, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L4', 'T4'),
(220, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L3', 'T3'),
(221, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L2', 'T2'),
(222, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'UP WIND', NULL, NULL, 'L1', 'T1'),
(223, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L1', 'T1'),
(224, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L2', 'T2'),
(225, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L3', 'T3'),
(226, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L4', 'T4'),
(227, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L5', 'T5'),
(228, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L6', 'T6'),
(229, 19, 13, 27, NULL, '50', NULL, NULL, NULL, NULL, NULL, 'DOWN WIND', NULL, NULL, 'L7', 'T7'),
(231, 16, 6, 35, 'Nitrogen Dioxide (NO2)', '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(232, 16, 6, 36, 'Sulfur Dioxide (SO2)', '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(233, 16, 6, 39, 'Carbon Monoxide (CO)', '600', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(234, 16, 6, 52, 'Particulat', '150', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(235, 16, 3, 26, 'Opacity', '20', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(236, 15, 5, 53, 'Ammonia (NH3)', '0.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(237, 15, 5, 45, 'Cholorine (CI2)', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(238, 15, 5, 54, 'Hydrogen Choloride (HCI)', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(239, 15, 5, 55, 'Hydrogen Fluoride (HF)', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(240, 15, 5, 35, 'Nitrogen Dioxide (NO2)', '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(241, 15, 3, 26, 'Opacity', '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(242, 15, 5, 26, 'Particulate', '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(243, 15, 5, 36, 'Sulfur Dioxide (SO2)*', '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(244, 15, 5, 56, 'Hydrogen Sulfide (H2S)', '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(245, 15, 5, 8, 'Mercury (Hg)', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(246, 15, 5, 8, 'Arsenic (As)', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(247, 15, 5, 8, 'Antimony (Sb)', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(248, 15, 5, 46, 'Cadnium (Cd)', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(249, 15, 5, 46, 'Zinc (Zn)', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(250, 15, 5, 46, 'Lead (Pb)', '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(251, 8, 5, 46, 'Lead (Pb)', '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(252, 8, 5, 46, 'Zinc (Zn)', '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(253, 8, 5, 46, 'Cadnium (Cd)	', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(254, 8, 5, 8, 'Antimony (Sb)	', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(255, 8, 5, 8, 'Arsenic (As)', '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(256, 8, 5, 8, 'Mercury (Hg)', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(257, 8, 5, 56, 'Hydrogen Sulfide (H2S)	', '35', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(258, 8, 5, 36, 'Sulfur Dioxide (SO2)*', '800', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(259, 8, 5, 26, 'Particulate', '350', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(260, 8, 3, 26, 'Opacity', '30', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(261, 8, 5, 35, 'Nitrogen Dioxide (NO2)', '1000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(262, 8, 5, 55, 'Hydrogen Fluoride (HF)', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(263, 8, 5, 54, 'Hydrogen Choloride (HCI)', '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(264, 8, 5, 45, 'Cholorine (CI2)', '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(265, 8, 5, 53, 'Ammonia (NH3)', '0.5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(266, 6, 2, 2, 'Temperature', '40', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(267, 6, 4, 3, 'Total Dissolved Solids (TDS)', '2000', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(268, 6, 4, 4, 'Total Suspended Solids (TSS)', '400', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(269, 6, 8, 57, 'Color', '300', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(270, 6, 18, 5, 'pH', '6.0-9.0', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(271, 6, 4, 58, 'Iron (Fe) ', '5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(272, 6, 4, 6, 'Manganese (Mn)', '2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(273, 6, 4, 58, 'Barium (Ba)', '2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(274, 6, 4, 58, 'Copper (Cu)', '2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(275, 6, 4, 58, 'Zinc (Zn)', '5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(276, 6, 4, 8, 'Chromium Hexavalent (Cr 6+)', '0.1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(277, 6, 4, 58, 'Chromium (Cr)', '0.5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(278, 6, 4, 58, 'Cadmium (Cd)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(279, 6, 4, 8, 'Mercury (Hg)', '0.002', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(280, 6, 4, 58, 'Total Lead (Pb)', '0.1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(281, 6, 4, 58, 'Stanum (Sn)', '2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(282, 6, 4, 8, 'Arsenic (As)', '0.1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(283, 6, 4, 8, 'Selenium (Se)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(284, 6, 4, 58, 'Nickel (Ni)', '0.2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(285, 6, 4, 58, 'Cobalt (Co)', '0.4', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(286, 6, 4, 59, 'Cyanide (CN)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(287, 6, 4, 45, 'Sulfide (H2S)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(288, 6, 4, 10, 'Fluoride (F)', '2', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(289, 6, 4, 11, 'Free Chlorine (Cl2)', '1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(290, 6, 4, 12, 'Free Ammonia (NH3-N)', '1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(291, 6, 4, 13, 'Nitrate (NO3-N)', '20', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(292, 6, 4, 14, 'Nitrite (NO2-N)', '1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(293, 6, 4, 15, 'Biological Oxygen Demand (BOD)', '600', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(294, 6, 4, 16, 'Chemical Oxygen Demand COD', '900', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(295, 6, 4, 17, 'Detergent (MBAS)', '5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(296, 6, 4, 18, 'Phenol', '0.5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(297, 6, 4, 19, 'Mineral Oil', '5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(298, 6, 4, 60, 'Vegetable Oil', '5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(299, 13, 7, 61, 'Turbidity', '25', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(300, 13, 8, 57, 'Color', '50', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(301, 13, 4, 3, 'Total Dissolve Solids (TDS)', '-', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(302, 13, 2, 2, 'Temperature', '-', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(303, 13, 18, 49, 'Taste', '-', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(304, 13, 18, 49, 'Odor', '-', NULL, NULL, NULL, 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(305, 13, 18, 5, 'pH', '6.5 – 8.5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(306, 13, 4, 58, 'Iron (Fe) ', '1.0', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(307, 13, 4, 10, 'Fluoride (F)', '1.5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(308, 13, 4, 62, 'Total Hardness (CaCO3)', '500', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(309, 13, 4, 58, 'Mangan (Mn)', '0.5', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(310, 13, 4, 13, 'Nitrate (NO3-N)', '10', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(311, 13, 4, 14, 'Nitrite (NO2-N)', '1.0', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(312, 13, 4, 59, 'Cyanide (CN)', '0.1', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(313, 13, 4, 17, 'MBAS', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(314, 13, 4, 8, 'Mercury (Hg)', '0.001', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(315, 13, 4, 8, 'Arsenic (As)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(316, 13, 4, 58, 'Cadmium (Cd)', '0.005', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(317, 13, 4, 8, 'Chromium Hexavalent (Cr6+)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(318, 13, 4, 8, 'Selenium (Se)', '0.01', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(319, 13, 4, 58, 'Zinc (Zn)', '15', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(320, 13, 4, 63, 'Sulfate (SO4)', '400', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(321, 13, 4, 58, 'Total Lead (Pb)', '0.05', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(322, 13, 4, 64, 'Permanganate Number (KMnO4)', '10', NULL, NULL, NULL, 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(323, 13, 9, 20, 'Total Coliform', '50', NULL, NULL, NULL, 'Microbiology', NULL, NULL, NULL, NULL, NULL, NULL),
(324, 13, 9, 65, 'E-Coliform', '0', NULL, NULL, NULL, 'Microbiology', NULL, NULL, NULL, NULL, NULL, NULL),
(325, 11, 10, 30, 'Sulphur Dioxide (SO2) *', '150', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(326, 11, 15, 30, 'Sulphur Dioxide (SO2) *', '75', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(327, 11, 10, 30, 'Sulphur Dioxide (SO2) *', '45', NULL, NULL, NULL, NULL, '1 Year', NULL, NULL, NULL, NULL, NULL),
(328, 11, 15, 29, 'Nitrogen Dioxide (NO2) *', '200', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(329, 11, 10, 29, 'Nitrogen Dioxide (NO2) *', '65', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(330, 11, 10, 29, 'Nitrogen Dioxide (NO2) *', '50', NULL, NULL, NULL, NULL, '1 Year', NULL, NULL, NULL, NULL, NULL),
(331, 11, 10, 37, 'Carbon Monoxide (CO)', '10000', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(332, 11, 10, 37, 'Carbon Monoxide (CO)', '-', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(333, 11, 11, 28, 'Ammonia (NH3) *', '2***', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(334, 11, 10, 31, 'Oxiden (Ox)* ', '150', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(335, 11, 15, 31, 'Oxiden (Ox)* ', '-', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(336, 11, 10, 31, 'Oxiden (Ox)* ', '35', NULL, NULL, NULL, NULL, '1 Year', NULL, NULL, NULL, NULL, NULL),
(337, 11, 10, 22, 'Hydrocarbon (HC)', '160', NULL, NULL, NULL, NULL, '3 Hours', NULL, NULL, NULL, NULL, NULL),
(338, 11, 10, 46, 'Lead (Pb)', '-', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(339, 11, 10, 46, 'Lead (Pb)', '2', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(340, 11, 11, 31, 'Hydrogen Sulfide (H2S', '0.02***', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(341, 11, 10, 66, 'Total Suspended Particulates (TSP)', '-', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(342, 11, 10, 66, 'Total Suspended Particulates (TSP) ', '230', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(343, 11, 10, 23, 'PM10 (Particulate Matters)', '-', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(344, 11, 15, 23, 'PM10 (Particulate Matters)', '75', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(345, 11, 10, 23, 'PM2.5 (Particulate Matters)', '-', NULL, NULL, NULL, NULL, '1 Hours', NULL, NULL, NULL, NULL, NULL),
(346, 11, 15, 23, 'PM2.5 (Particulate Matters)', '55', NULL, NULL, NULL, NULL, '24 Hours', NULL, NULL, NULL, NULL, NULL),
(347, 12, 2, 2, 'Temperature', 'Dev 3', 'Dev 3', 'Dev 3', 'Dev 3', 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(348, 12, 4, 3, 'Total Dissolved Solids (TDS)', '1000', '1000', '1000', '2000', 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(349, 12, 4, 4, 'Total Suspended Solid (TSS)', '40', '50', '100', '400', 'Physical', NULL, NULL, NULL, NULL, NULL, NULL),
(350, 12, 4, 15, 'Biological Oxygen Demand (BOD)', '2', '3', '6', '12', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(351, 12, 4, 16, 'Chemical Oxygen Demand (COD)', '10', '25', '40', '80', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(352, 12, 18, 5, 'pH ', '6-9', '6-9', '6-9', '6-9', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(353, 12, 4, 67, 'Total Phosphate (PO4) ', '0.2', '0.2', '1.0', '-', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(354, 12, 4, 63, 'Sulfate (SO4)', '300', '300', '300', '400', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(355, 12, 4, 8, 'Arsenic (As)', '0.05', '0.05', '0.05', '0.05', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(356, 12, 4, 58, 'Boron (B)', '1.0', '1.0', '1.0', '1.0', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(357, 12, 4, 68, 'Cadmium (Cd)', '0.01', '0.01', '0.01', '0.01', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(358, 12, 4, 6, 'Cobalt (Co)', '0.2', '0.2', '0.2', '0.2', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(359, 12, 4, 8, 'Chromium Hexavalent (Cr6+)', '0.05', '0.05', '0.05', '1', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(360, 12, 4, 58, 'Copper (Cu)', '0.02', '0.02', '0.02', '0.2', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(361, 12, 4, 58, 'Lead (Pb)', '0.03', '0.03', '0.03', '0.5', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(362, 12, 4, 8, 'Mercury (Hg)', '0.001', '0.002', '0.002', '0.005', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(363, 12, 4, 69, 'Oil and Grease', '1', '1', '1', '10', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(364, 12, 4, 8, 'Selenium (Se)', '0.01', '0.05', '0.05', '0.05', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(365, 12, 4, 58, 'Zinc (Zn)', '0.05', '0.05', '0.05', '2', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(366, 12, 4, 58, 'Nikel (Ni)', '  0.05', '  0.05', '  0.05', '  0.1', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(367, 12, 4, 17, 'MBAS', '0.2', '0.2', '0.2', '-', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(368, 12, 4, 58, 'Mangan (Mn)', '0.1', '-', '-', '-', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(369, 12, 22, 20, 'Total Coliform', '1000', '5000', '10.000', '10.000', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL),
(370, 12, 22, 70, 'E. coli', '100', '1000', '2000', '2000', 'Chemistry', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `director_signature` varchar(255) NOT NULL,
  `technical_person` varchar(255) NOT NULL,
  `tp_signature` varchar(255) NOT NULL,
  `img_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`id`, `name`, `address`, `phone`, `website`, `email`, `norek`, `behalf_account`, `bank`, `director`, `director_email`, `director_signature`, `technical_person`, `tp_signature`, `img_logo`) VALUES
(1, 'PT. Delta Indonesia Laboratory', 'Ruko Prima Orchard No.C 2 Prima Harapan Regency Bekasi Utara, Kota Bekasi 17123, Provinsi Jawa Barat', ' 021 - 88382018', 'www.deltaindonesialab.com', 'marketing@deltaindonesialab.com', '156-00-1713846-4', 'PT. DELTA INDONESIA LABORATORY', 'MANDIRI KC HARAPAN BARU BEKASI UTARA', 'Drs. H. Soekardin Rachman, M.Si', 'azkazikna.aal@gmail.com', '', 'Fadhelun', '61e7acb75be07.png', 'logo4.png');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id_int` int(11) NOT NULL,
  `name_int` varchar(255) NOT NULL,
  `int_phone` varchar(255) DEFAULT NULL,
  `int_email` varchar(255) NOT NULL,
  `int_address` varchar(255) NOT NULL,
  `name_cp` varchar(255) NOT NULL,
  `title_cp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id_int`, `name_int`, `int_phone`, `int_email`, `int_address`, `name_cp`, `title_cp`) VALUES
(24, 'PT SYNNEX METRODATA INDONESIA', '81807239090', 'Rudy.juanda@metrodata.co.id', 'APL Tower 42nd Floor Suite 1-8, Jl. Letjen S. Parman Kav.28, Tanjung Duren Selatan Grogol Petamburan Jakarta Barat', 'Rudy Juanda', 'Mr'),
(25, 'PT. DAIWA MANUNGGAL LOGISTIK PROPERTI', '81113006559', 'roland.parulian@dln-ina.com', 'Jl. Kalimantan Blok G3, Gandamekar, Cikarang Barat, Kawasan Industri Bekasi Fajar, MM2100', 'Roland Parulian', 'Mr'),
(26, 'PT. MATSUOKA INDUSTRIES INDONESIA', '85383659335', 'mentariprimakarya@gmail.com', 'Jl. Kali Sumber KM 117 RT.16 RW.05, Desa Ciberes,\r\nKec. Patokbesi, Kab. Subang, Jawa Barat', 'John', 'Mr'),
(27, 'PT. BAYU BUANA GEMILANG', '81290207096', 'mentariprimakarya@gmail.com', 'Jl. KH. Rafei RT. 002 RW003, Desa Nagrak dan desa Wanaherang,\r\nKecamatan Gunung Putri, Kabupaten Bogor', 'Apip', 'Mr'),
(28, 'PT. MEGALOPOLIS MANUNGGAL INDUSTRIAL DEVELOPMENT (MMID)', '21898001', 'environment@mmid.co.id', 'Kawasan industri MM2100 blok C, Jl. Sumatera, Gandasari, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17520', 'Sri Suryanti', 'Mrs'),
(29, 'PT. MASSINDO KARYA PRIMA', '8561234589', 'michiko_eveline@massindo.com', 'Jl. Cikiwul No.22, Cikiwul, Bantargebang, Kota Bekasi, Jawa Barat', 'Michiko', 'Mrs'),
(30, 'PT. TSUBAKI INDONESIA TRADING', '0', 'wahyu@tsubaki.id', 'Graha Bulevar Blok GB/B17, Jl. Bulevar Ahmad Yani, RT.004/RW.011, Harapan Mulya, Kecamatan Medan Satria, Kota Bks, Jawa Barat 17143', 'Wahyu', 'Mr'),
(31, 'PT. QUANTUMPLAST INDUSTRY', '0', 'mentariprimakarya@gmail.com', 'Jl. Jayawijaya (Pangkalan II), RT 003 RW 003, Kelurahan Cikiwul,\r\nKecamatan Bantargebang, Kota Bekasi, Jawa Barat', 'Nurtarikasmalini,ST.,M.T', 'Mr'),
(32, 'PT. TUV RHEINLAND INDONESIA', '8119992974', 'Liling.Permatasari@tuv.com', 'Infinia Park Blok B-92, \r\nJl. Dr. Saharjo No. 45\r\nJakarta Selatan, DKI Jakarta 12850', 'Liling', 'Mrs'),
(33, 'PT. DALZON CHEMICALS INDONESIA', '85921341703', 'mail.hrddci@gmail.com', 'Jl. Raya Tegal Gede, Desa Bangkongreang, Wangunharja Cikarang (Belakang Pertamina)', 'Suhodo', 'Mr'),
(34, 'PT. YAMAHA MUSICAL PRODUCTS ASIA', '81585327842', 'lilis.pujiyanti@music.yamaha.com', 'Jl. Irian II Blok AC-1, KI Bekasi Fajar, MM2100 Ds. Danau Indah, Kec. Cikarang Barat Kabupaten Bekasi, Jawa Barat ', 'Lilis Pujiyanti', 'Mrs'),
(35, 'PT. MALINDO IRFAN', '83816744040', 'arrsystems@hotmail.com', 'JL. Jati 5 Blok J5 No. 1, Newton Technopark Industrial Estate Lippo Cikarang,  Kab. Bekasi, Jabar', 'Karyani', 'Mrs'),
(36, 'PT BYUNGHWA INDONESIA', '83816744040', 'arrsystems@hotmail.com', 'JL. Jababeka VI Blok J No. 4A, KI JABABEKA Desa Harjamekar, Kec. Cikarang Utara, Kab. Bekasi, Jabar', 'Karyani', 'Mrs'),
(37, 'PT. KARLITA EMAS', '83816744040', 'arrsystems@hotmail.com', 'Kp. Telajung, Kec. Cikarang Barat, Kab. Bekasi', 'Karyani', 'Mrs'),
(38, 'PT. CIPTA LESTARI IDEANUSA', '83816744040', 'arrsystems@hotmail.com', 'Jl. Karet Raya Blok H No. 4 & 5 KI Delta Silikon, Lippo Cikarang, Kab. Bekasi', 'Karyani', 'Mrs'),
(39, 'PT. SIKA INDONESIA', '8121039004', 'prastyo.budi@id.sika.com', 'Jl. Raya Cibinong - Bekasi km 20, Limus Nunggal, Kecamatan Cileungsi, Kabupaten Bogor, Provinsi Jawa Barat-16821', 'Budi Prastyo', 'Mr'),
(40, 'PT. MEGALOPOLIS MANUNGGAL INDUSTRIAL DEVELOPMENT (WATER TREATMENT PLANT)', '21898001', 'environment@mmid.co.id', 'Jl. Jawa Blok GG, MM2100 Industrial Town Cikarang Barat, Bekasi 17520, Danau Indah, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17530', 'Sri Suryanti', 'Mrs'),
(41, 'PT. MEGALOPOLIS MANUNGGAL INDUSTRIAL DEVELOPMENT (ASUKA HOTEL)', '21898001', 'environment@mmid.co.id', 'Jl. Jawa Blok GG, MM2100 Industrial Town Cikarang Barat, Bekasi 17520, Danau Indah, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17530', 'Sri Suryanti', 'Mrs'),
(42, 'PENGELOLA LOTTE GROSIR PASAR REBO', '81517093336', 'sundara@paneragroup.com', 'Jalan Lingkar Luar Selatan No. 6 Kelurahan Susukan, Kec. Ciracas Jakarta Timur, DKI Jakarta', 'Sundara', 'Mr'),
(43, 'PT. TANSRI GANI', '0', 'dian_enggar@tansrigani.com', 'Jl. Inspeksi kalimalang, RT. 002/001Desa Sukadanau, Cikarang Barat, Kabupaten Bekasi', 'Dian', 'Mrs'),
(44, 'PT. OLAH BUMI MANDIRI', '0', 'hrdobm.metrix@gmail.com', 'Jl. Pegangsaan Dua Km. 3 Jakarta 14250', 'Okki Triyadi', 'Mr'),
(45, 'BALAI PENGUJIAN MUTU DAN SERTIFIKASI PAKAN TERNAK', '8161679597', 'dinayahijau@yahoo.com', 'Gedung Perkantoran dan Laboratorium Pakan Ternak) Jl. MT. Haryono No. 98, Ciledug, Kec. Setu, Jawa Barat 17320', 'Alvi', 'Mrs'),
(46, 'PT. ELASTIS REKA AKTIF', '81517093336', 'sundara@paneragroup.com', 'Jl. Kapuk Raya No. 88 E-F-G, Kel. Kapuk Muara, Jakarta Utara', 'Sundara', 'Mr'),
(47, 'PT. MONDE MAHKOTA BISCUIT', '81280897327', 'joshua.sitompul@mondebiscuit.com', 'Jl. Tekno Raya Jababeka 3, Pasirgombong, Kec. Cikarang Utara, Kab. Bekasi', 'Joshua', 'Mr'),
(48, 'PT. KIYOKUNI INDONESIA Plant 1', '6281311619802', 'abdul.karim@kiyokuni.co.id', 'EJIP Industrial Park Plot 3K \r\nDesa Sukaresmi, Kecamatan Cikarang Selatan, Kabupaten Bekasi, Jawa Barat - 17550', 'Abdul Karim', 'Mr'),
(49, 'PT. KIYOKUNI INDONESIA Plant 2', '6281311619802', 'abdul.karim@kiyokuni.co.id', 'Jl. Kawasan Industri EJIP, JL. Citanduy 5 Plot 8\r\nDesa Sukaresmi, Kecamatan Cikarang Selatan, Kabupaten Bekasi, Jawa Barat - 17550', 'Abdul Karim', 'Mr'),
(50, 'PT. MURAMOTO ELEKTRONIKA INDONESIA', '0', 'ga@ptmei.cm', 'EJIP Industrial Park Plot 9J, Jl. Angsana Raya  Desa Sukaresmi, Kecamatan Cikarang Selatan, Kabupaten Bekasi, Provinsi Jawa Barat', 'Donal', 'Mr'),
(51, 'PT. NIPPON STEEL LOGISTICS  INDONESIA', '0', 'diah.novianti@nslog-id.com', 'Kawasan Industri MM2100, Blok HH-2 Jatiwangi, Cikarang Barat, \r\nBekasi 17848', 'Diah', 'Mrs'),
(52, 'PT. NT-PISTON RING INDONESIA', '81284561899', 'arif@nt-pistonring.co.id', 'Jl. Surya Madya, Kawasan Industri Suryacipta, Kabupaten Karawang, Jawa Barat', 'Arif', 'Mr'),
(53, 'OFFICE KEBON KACANG (YAYASAN RUMAH DOA BAGI BANGSA)', '0', 'nadi_wihardja@theparadise-group.com', 'Jl. Kebon Kacang Raya No. 10-11, Kecamatan Tanah Abang, Jakarta Pusat, Provinsi DKI Jakarta', 'Nadi', 'Mr'),
(54, 'PT INDOMATSUMOTO PRESS & DIES INDUSTRIES', '82213218899', 'ptcahayamataarjuna1@gmail.com', 'Jl. Toyogiri Sel. No. 92, Jatimulya, Kec. Tambun Sel., Bekasi, Jawa Barat 17510', 'Mumun', 'Mrs'),
(55, 'PT INDOMURAYAMA PRESS & DIES INDUSTRIES', '82213218899', 'ptcahayamataarjuna1@gmail.com', 'Jl. Toyogiri, Jatimulya, Tambun Selatan, Bekasi, West Java 17510', 'Mumun', 'Mrs'),
(56, 'PT YUSEN LOGISTICS SOLUTIONS INDONESIA ', '81213708742', 'rizal.fahmi@id.yusen-logistics.com', 'JL. Irian Blok EE4, Kawasan industri MM2100 (Lokasi 2)', 'Rizal Fahmi', 'Mr'),
(57, 'PT YUSEN LOGISTICS SOLUTIONS INDONESIA ', '81213708742', 'rizal.fahmi@id.yusen-logistics.com', 'JL. Bali Blok J10, Kawasan industri MM2100 (Lokasi 1)', 'Rizal Fahmi', 'Mr'),
(58, 'PT. KITA MANDIRI ABADI', '81310151577', 'dewi@kma.co.id', 'Jl. Cempaka Sasak Jarang Tambun, Kabupaten Bekasi, Jawa Barat', 'Dewi', 'Mrs'),
(59, 'PT. PARKER METAL TREATMENT INDONESIA', '0', 'onny@pmti.co.id', 'Kawasan Industri MM-2100 Jl Irian V Blok KK-11, Jatiwangi, Kec. Cikarang Bar., Kabupaten Bekasi, Jawa Barat 17530', 'Onny Wahyoeningtyas', 'Mrs'),
(60, 'PT ARISTA SUKSES MANDIRI', '85694944481', 'indra.ks@arista-group.co.id', 'Jl. Raya Kalimalang No.19, RT.3/RW.16, Duren Sawit, Kec. Duren Sawit, Kota Jakarta Timur, Daerah Khusus Ibukota Jakarta 13440', 'Indra', 'Mr'),
(61, 'PT MONDE MAHKOTA BISKUIT', '87881043270', 'rec.ciracas@mondebiscuit.com', 'Jl. Gotong Royong No. 25 RT 007/001 Kelurahan Ciracas, Kecamatan Ciracas, Jakarta Timur', 'Maya', 'Mrs'),
(62, 'PT. BUMI MULIA INDAH LESTARI', '8128424070', 'ptzereonkeiindonesia@gmail.com', 'Jl. Jababeka XVI Blok V No. 65 A Kawasan Industri Jababeka, Desa Pasirgombong, Kecamatan Cikarang Utara, Kabupaten Bekasi', 'Riris', 'Mrs'),
(63, 'PT. DONG SAN INDONESIA', '8568475443', 'ependi0412@gmail.com', 'Jl. Jababeka III G TOB Blok c-17AS, Cikarang, Bekasi Jawa Barat', 'Eependi', 'Mr'),
(64, 'PT. ATSUMITEC INDONESIA', '267440485', 'Esti_prasetya@atsumitec.co.id', 'Kawasan Industri Suryacipta Jl. Surya Madya Kav. 1-29 A-F, Kutanegara, Kec. Ciampel, Karawang, Jawa Barat 41361', 'Esti', 'Mrs'),
(65, 'PT. NIFCO INDONESIA', '0', 'she@id.nifco.com', 'Jl. Harapan II Kawasan Industri KIIC Blok KK No 5B Kel. Sirnabaya', 'Iqbal', 'Mr'),
(66, 'VERANDA HOTEL', '0', 'okkitriyadi92@gmail.com', 'Jl. Kyai Maja No.63, RT.6/RW.2, Kramat Pela, Kec. Kebayoran Baru, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12130', 'Okki Triyadi', 'Mr'),
(67, 'PT. SYNNEX METRODATA INDONESIA', '0', 'rudy.juanda@metrodata.co.id', 'Jl. Madura Blok I-12 MM-2100 Desa Cikedokan\r\nKab. Bekasi Jawa Barat', 'Rudy Juanda', 'Mr'),
(68, 'PT CENTRA LINGGA PERKASA', '0', 'ptmegajasa@gmail.com', 'Jl. Mega Kuningan Barat No.3, RT.5/RW.2, Kuningan, Kuningan Tim., Kecamatan Setiabudi, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 15810', 'Anita', 'Mrs'),
(69, 'PT. HOWA INDONESIA', '8128424070', 'ptzereonkeiindonesia@gmail.com', 'Jl. Cendana Raya Blok F10 No.06 Delta Silicon III, Lippo Ciakrang, Cikarang Selatan, Bekasi,17550 - Jawa Barat', 'Riris', 'Mrs'),
(70, 'PT. ETERNA PERSADA INDONESIA', '81517093336', 'sundara@paneragroup.com', 'Jl. Kopo Maja, Gabus, Kec. Kopo, Kabupaten Serang, Banten 42178', ' Sundara', 'Mr'),
(71, 'PT. SEC INDONESIA', '218937386', 'agusriyadi@sec-indonesia.co.id', 'Kawasan Industri Jababeka II Blok JJ No. 14-15 Pasir Sari, Cikarang Selatan, Bekasi, Jawa Barat 17530', 'Agus Riyadi', 'Mr'),
(72, 'PT PATEC PRESISI ENGINEERING', '0', 'allysha.alya@patec.co.id', 'Jl. Angsana Raya Block L3-01. Delta Silicon 1, Sukaresmi, Cikarang, Bekasi, Jawa Barat 17550', 'Allysha Alya Jasmine', 'Mrs'),
(73, 'PT. MULTISARANA BAHTERA MANDIRI', '81282796677', 'lebaran_selamat@yahoo.com', 'Kampung Cikedokan, RT. 002/001 Desa Sukadanau Kecamatan Cikarang Barat Kabupaten Bekasi, Provinsi Jawa Barat - Indonesia ', 'Fajri', 'Mr'),
(74, 'PT PERKASA PRIMARINDO', '81311619942', 'er14nto@gmail.com', 'Jl. Setia Mekar No.KM. 38 - 39, Setiamekar, Kec. Tambun Sel., Kabupaten Bekasi, Jawa Barat 17510', 'Erianto Tanjung', 'Mr'),
(75, 'PT. SHINTO KOGYO PLANT 1', '0', 'ga_s1@yasufuku.co.id', 'Jl. Bali Blok J.17-2 Kawasan Industri MM2100, Kabupaten Bekasi, Jawa Barat', 'Ali', 'Mr'),
(76, 'PT. SHINTO KOGYO PLANT 3', '0', 'ga_s1@yasufuku.co.id', 'Jl. Irian Blok QQ lot 9-10, Kawasan Industri MM2100, Kabupaten Bekasi, Jawa Barat', 'Ali', 'Mr'),
(77, 'PT. SHINTO KOGYO PLANT 2', '0', 'ga_s1@yasufuku.co.id', 'JL. Maligi 1 Kawasan Industri KIIC Lot A.11, Sukaluyu, Telukjambe Timur, Karawang, Jawa Barat 41361', 'Ali', 'Mr');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id_inv` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `date_inv` date NOT NULL,
  `po_date` date NOT NULL,
  `subject` varchar(255) NOT NULL,
  `amount_in_words` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(27, 'SNI 8427:2017'),
(28, 'SNI 19-7119.1-2005'),
(29, 'SNI 19-7119.2-2005'),
(30, 'SNI 7119-7:2017'),
(31, 'SNI 7119-8:2017'),
(32, 'IK-7.4.1 (Spectrophotometry)'),
(33, 'IK-7.4.2 (Spectrophotometry)'),
(34, 'IK-7.4.3 (Spectrophotometry)'),
(35, 'IK-6.4.18 (Direct Reading)'),
(36, 'IK-6.4.19 (Direct Reading)'),
(37, 'IK-7.4.19 (Direct Reading)'),
(38, 'IK-6.4.9 (Direct Reading)'),
(39, 'SNI 19.7117.10-2005'),
(40, 'SNI 7117.13:2009'),
(41, 'SNI 7117.14:2009'),
(42, 'SNI 7117.15:2009'),
(43, 'SNI 7117.16:2009'),
(44, 'SNI 7117.17:2009'),
(45, 'Spectrophotometry'),
(46, 'ICP-OES'),
(47, 'NIOSH 2542'),
(48, 'OSHA PV2210'),
(49, 'Organoleptic'),
(50, 'Gas Analizer'),
(51, 'SNI 7231:2009'),
(52, 'SNI 19-7117.12-2005'),
(53, 'SNI 19-7117.6-2005'),
(54, 'SNI 19-7117.8-2005'),
(55, 'SNI 19-7117.9-2005'),
(56, 'SNI 06-7117.7-2005'),
(57, 'SM 23rd 2120C-2017'),
(58, 'SM 23rd 3120B-2017'),
(59, 'SNI 6989.77-2011'),
(60, 'SNI 6989.10 - 2012'),
(61, 'SNI 06-6989.25-2005'),
(62, 'SM 23rd 2340B-2017'),
(63, 'SNI 6989.20-2019'),
(64, 'SNI 06-6989.22-2004'),
(65, 'SM 23rd 9221G.2 - 2017'),
(66, 'SNI 7119.3:2017'),
(67, 'SNI 06-6989.31-2005'),
(68, 'APHA 3120B Ed 23 - 2017'),
(69, 'SNI 6989.10 - 2011'),
(70, 'SM 23rd 9221E - 2017');

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
(79, 14, 24, '<p>transport</p>', '<p>transport bus jakarta mrt krt kdrt&nbsp;</p>', 1, 29, 0),
(80, 9, 24, '<p>noise</p>', '<p>noise gaming</p>', 1, 29, 0);

-- --------------------------------------------------------

--
-- Table structure for table `regulation`
--

CREATE TABLE `regulation` (
  `id_regulation` int(11) NOT NULL,
  `name_regulation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `regulation`
--

INSERT INTO `regulation` (`id_regulation`, `name_regulation`) VALUES
(2, 'PPRI No. 22 2021 & Kepmen LH 48 1996'),
(3, 'Permenaker No. 5 2018'),
(4, 'Kepmen LH No. 50 1996'),
(5, 'Kepmen LH No. 13 1995'),
(6, 'Permen LH No. 07 2007'),
(7, 'MM2100');

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
  `revision` int(11) NOT NULL,
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

INSERT INTO `result_coa` (`id_result`, `id_sk`, `id_coa`, `id_analysis`, `id_int`, `revision`, `result`, `vehicle_brand`, `time`, `humidity`, `wet`, `dew`, `globe`, `wbgt_index`, `sampling_location`, `code`, `opacity`, `leq`, `ls`, `lm`, `lsm`) VALUES
(476, 29, 203, 9, 24, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '');

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
(1, 'Total Solid Particulate (TSP)'),
(2, 'Sulfur Dioxide (SO₂)*'),
(3, 'Nitrogen Dioxide (NO₂)*'),
(4, 'Carbon Monoxide (CO)*'),
(5, 'Ammoniac (NH₃)*'),
(6, 'Hydrogen Sulfide (H₂S)'),
(7, 'Temperature'),
(8, 'Humidity'),
(9, 'NOISE'),
(10, 'ISBB/Heat Stress'),
(11, 'Benzene'),
(12, 'Toluene'),
(13, 'Xylene'),
(15, 'Opacity'),
(17, 'Illumination'),
(18, 'Air Limbah Produksi'),
(19, 'Air Limbah Domestik'),
(21, 'Oxidant (Ox)*'),
(22, 'Color'),
(23, 'Total Suspended Solid  (TSS)'),
(24, 'Total Dissolved Solid (TDS)'),
(25, 'Biological Oxygen Demand (BOD)'),
(26, 'Chemical Oxygen Demand (COD)'),
(27, 'pH'),
(28, 'Ammoniac (NH₃)'),
(29, 'Detergent (MBAS)'),
(30, 'Phenol'),
(31, 'Vegetable Oil'),
(32, 'Mineral Oil'),
(33, 'Nitrate (NO₃)'),
(34, 'Nitrite (NO₂)'),
(35, 'Sulfide (H₂S)'),
(36, 'Arsenic (As)'),
(37, 'Barium (Ba)'),
(38, 'Cadmium (Cd)'),
(39, 'Chromium (Cr)'),
(40, 'Chromium Hexavalent (Cr⁶+)'),
(41, 'Cyanide (CN)'),
(42, 'Cobalt (Co)'),
(43, 'Copper (Cu)'),
(44, 'Fluoride (F)'),
(45, 'Lead (Pb)'),
(46, 'Nickel (Ni)'),
(47, 'Manganese (Mn)'),
(48, 'Mercury (Hg)'),
(49, 'Zinc (Zn)'),
(50, 'Stannum (Sn)'),
(51, 'Selenium (Se)'),
(52, 'Ammoniac (NH₃-N)'),
(53, 'Nitrogen Dioxide (NO₂)'),
(54, 'Nitrogen Oxide (NOx)*'),
(55, 'Oxidant (Ox)'),
(56, 'Carbon Monoxide (CO)'),
(57, 'Oxygen (O₂)*'),
(58, 'Particulate*'),
(59, 'Particulate'),
(60, 'Oil and Grease'),
(61, 'Oil and Fat'),
(62, 'Iron (Fe)'),
(63, 'Chromium Total (Cr)'),
(64, 'Free Chlorine (Cl₂)'),
(65, 'Nitrate (NO₃-N)'),
(66, 'Nitrite (NO₂-N)'),
(67, 'Dissolved Iron (Fe)'),
(68, 'Dissolved Manganese (Mn)'),
(69, 'Total Ammoniac (NH₃-N)'),
(70, 'Total Nitrogen'),
(71, 'Total Coliform'),
(72, 'Free Ammoniac (NH₃-N)'),
(73, 'Permanganate Number (KMnO₄)'),
(74, 'Antimony (Sb)'),
(75, 'E.Coliform'),
(76, 'Hydrocarbon (HC) '),
(77, 'Turbidity'),
(78, 'Volumetric Flow Rate'),
(79, 'PM₂‚₅'),
(80, 'PM₁₀'),
(81, 'Taste'),
(82, 'Odor'),
(83, 'Sulfate (SO₄²-)'),
(84, 'Total Hardness (CaCO₃)'),
(85, 'Total Volatile Organic Compound (TVOC)'),
(86, 'Fecal Coliform'),
(87, 'Dissolved Oxygen (DO)'),
(88, 'Sodium (Na)'),
(89, 'Boron (B)'),
(90, 'Electrical Conductivity (DHL)'),
(91, 'Acetone (C₃H₆O)'),
(92, 'Methyl Ethyl Ketone (C₄H₈O)'),
(93, 'Silver (Ag)'),
(94, 'Hydrocarbon Non Methane (NMHC)'),
(95, 'Vibration'),
(96, 'Chloride (Cl)'),
(97, 'Total Phosphate (PO₄)'),
(98, 'Total Lead (Pb)'),
(99, 'Velocity'),
(101, 'Percent (%) of Isokinetic'),
(102, 'Methyl Mercaptan (CH₃SH)'),
(103, 'Methyl Sulfide ((CH₃)₂)S'),
(104, 'Styrene (C₆H₅CHCH₂)'),
(105, 'Chromium Trivalent (Cr³+)'),
(106, 'Relative Humidity (%RH)'),
(107, 'Hydrogen Chloride (HCl)'),
(108, 'Hydrogen Fluoride (HF)'),
(109, 'Flow Rate');

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
(19, 'M. Sihabudin', 1, '081218118119', 'sampling@deltaindonesialab.com'),
(20, 'Aldi Firma', 1, '0895623518565', 'sampling@deltaindonesialab.com'),
(21, 'Aji Adinata', 1, '082295044376', 'sampling@deltaindonesialab.com'),
(22, 'Rizal', 1, '085694957735', 'sampling@deltaindonesialab.com'),
(23, 'Dafa', 1, '089655913965', 'sampling@deltaindonesialab.com'),
(24, 'Riki', 1, '083879276589', 'sampling@deltaindonesialab.com'),
(25, 'Gita Putri Ariana', 0, '081315857102', 'teknis@deltaindonesialab.com');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_det`
--

CREATE TABLE `sampling_det` (
  `id_sampling` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `id_quotation` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_regulation` int(11) DEFAULT NULL,
  `sample_id` varchar(10) NOT NULL,
  `sample_desc` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `measurement_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampling_det`
--

INSERT INTO `sampling_det` (`id_sampling`, `id_sk`, `id_quotation`, `id_analysis`, `id_regulation`, `sample_id`, `sample_desc`, `location`, `sample_type`, `deadline`, `description`, `measurement_time`) VALUES
(55, 29, 80, 9, NULL, '29.01', 'Total Solid Particulate (TSP), Sulfur Dioxide (SO₂)*, Nitrogen Dioxide (NO₂)*', '<ul><li>rumah bapak</li></ul>', NULL, '2022-11-15', 'sedang dikerjakan', '');

-- --------------------------------------------------------

--
-- Table structure for table `sk_number`
--

CREATE TABLE `sk_number` (
  `id_sk` int(11) NOT NULL,
  `sk_quotation` varchar(255) NOT NULL,
  `sk_sample` varchar(255) NOT NULL,
  `sk_analysis` varchar(255) NOT NULL,
  `sk_baps` varchar(255) NOT NULL,
  `sk_inv` varchar(255) NOT NULL,
  `no_certificate` varchar(255) NOT NULL,
  `date_quotation` date NOT NULL,
  `date_sample` datetime DEFAULT NULL,
  `date_analysis` date DEFAULT NULL,
  `date_report` date DEFAULT NULL,
  `id_int` int(11) NOT NULL,
  `status_po` tinyint(1) NOT NULL,
  `status_approve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_number`
--

INSERT INTO `sk_number` (`id_sk`, `sk_quotation`, `sk_sample`, `sk_analysis`, `sk_baps`, `sk_inv`, `no_certificate`, `date_quotation`, `date_sample`, `date_analysis`, `date_report`, `id_int`, `status_po`, `status_approve`) VALUES
(27, '1/2022/11/13/DIL/QTN', '', '', '', '', '', '2022-11-13', NULL, NULL, NULL, 24, 0, 0),
(28, '28/2022/11/13/DIL/QTN', '', '', '', '', '', '2022-11-13', NULL, NULL, NULL, 25, 0, 0),
(29, '29/2022/11/13/DIL/QTN', '29/2022/11/14/DIL/STPS', '29/2022/11/14/DIL/STP', '', '', '', '2022-11-13', '2022-11-14 00:00:00', '2022-11-14', NULL, 24, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sk_number_rev`
--

CREATE TABLE `sk_number_rev` (
  `id_rev` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `no_certificate_rev` varchar(255) NOT NULL,
  `revision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_request`
--

CREATE TABLE `test_request` (
  `id_test_request` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `entry_date` date DEFAULT NULL,
  `work_package` varchar(255) NOT NULL,
  `amount` int(1) DEFAULT NULL,
  `amount_desc` varchar(255) NOT NULL,
  `condition` int(1) DEFAULT NULL,
  `condition_desc` varchar(255) NOT NULL,
  `receptacle` int(1) DEFAULT NULL,
  `receptacle_desc` varchar(255) NOT NULL,
  `note_sample` varchar(255) NOT NULL,
  `sample_receiver` varchar(255) NOT NULL,
  `hr_capabilities` int(1) DEFAULT NULL,
  `method_suitability` int(1) DEFAULT NULL,
  `equipment_capability` int(1) DEFAULT NULL,
  `conclusion` varchar(255) DEFAULT NULL,
  `max_time` int(11) DEFAULT NULL,
  `note_request` varchar(255) NOT NULL,
  `technical_respon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `test_request_det`
--

CREATE TABLE `test_request_det` (
  `id_request_det` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `params` varchar(255) NOT NULL,
  `regulation` varchar(255) NOT NULL,
  `total_example` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(14, 'Lux'),
(15, 'μg/Nm³'),
(16, 'BDS'),
(17, 'mg/m³ (PSD/KTD)'),
(18, '-'),
(19, '%RH'),
(20, 'mmHg'),
(21, 'm/s'),
(22, 'MPN/100mL'),
(23, 'm³/ton raw material');

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
(7, 'Super Admin', 'superadmin@gmail.com', 'default.jpg', '$2y$10$hvf8g7spSoUlrNEhiV0WkelepntxOBgndSN5IVWhKEERnWpo1yrMy', 'superadmin', 1666408797),
(8, 'Genius Analyst', 'analyst@gmail.com', 'default.jpg', '$2y$10$WQo5067OAeG7mkbhrKWZp.2pg4nrdUeqRrO75KyZxKCGbQQVUCtES', 'analyst', 1666698439);

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
-- Indexes for table `baps`
--
ALTER TABLE `baps`
  ADD PRIMARY KEY (`id_baps`);

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
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id_inv`);

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
-- Indexes for table `regulation`
--
ALTER TABLE `regulation`
  ADD PRIMARY KEY (`id_regulation`);

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
-- Indexes for table `sk_number_rev`
--
ALTER TABLE `sk_number_rev`
  ADD PRIMARY KEY (`id_rev`);

--
-- Indexes for table `test_request`
--
ALTER TABLE `test_request`
  ADD PRIMARY KEY (`id_test_request`);

--
-- Indexes for table `test_request_det`
--
ALTER TABLE `test_request_det`
  ADD PRIMARY KEY (`id_request_det`);

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
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `baps`
--
ALTER TABLE `baps`
  MODIFY `id_baps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=371;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id_inv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `regulation`
--
ALTER TABLE `regulation`
  MODIFY `id_regulation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `result_coa`
--
ALTER TABLE `result_coa`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=477;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sampling_det`
--
ALTER TABLE `sampling_det`
  MODIFY `id_sampling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sk_number_rev`
--
ALTER TABLE `sk_number_rev`
  MODIFY `id_rev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `test_request`
--
ALTER TABLE `test_request`
  MODIFY `id_test_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `test_request_det`
--
ALTER TABLE `test_request_det`
  MODIFY `id_request_det` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id_unit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
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
  ADD CONSTRAINT `quotation_ibfk_3` FOREIGN KEY (`id_analysis`) REFERENCES `analysis` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD CONSTRAINT `sampling_det_ibfk_2` FOREIGN KEY (`id_sk`) REFERENCES `sk_number` (`id_sk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
