-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 12:36 AM
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
(4, 'Heat Stress', 1000000, 0, NULL),
(5, 'Vibration', 1300000, 1, NULL),
(6, 'Wastewater', 2300000, 1, NULL),
(7, 'Non-Stationary Source Emission', 2500000, 1, NULL),
(8, 'Stationary Stack Source Emission', 800000, 1, NULL),
(9, 'Noise', 500000, 1, NULL),
(10, 'Workplace Air Quality', 4500000, 1, NULL),
(11, 'Ambient Outdoor Air Quality', 3200000, 1, NULL),
(12, 'Surface Water', 300000, 1, NULL),
(13, 'Clean Water', 450000, 1, NULL),
(14, 'Transportation', 200000, 0, NULL),
(15, 'Air Emission (Non-Isocinetic)', 100000, 1, NULL),
(16, 'Air Emission', 250000, 1, NULL);

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
(13, 14, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `params` varchar(255) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `reg_standart_1` double NOT NULL,
  `reg_standart_2` double DEFAULT NULL,
  `reg_standart_3` double DEFAULT NULL,
  `reg_standart_4` double DEFAULT NULL,
  `method` int(11) NOT NULL,
  `category_params` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coa`
--

INSERT INTO `coa` (`id_coa`, `id_analysis`, `params`, `unit`, `reg_standart_1`, `reg_standart_2`, `reg_standart_3`, `reg_standart_4`, `method`, `category_params`) VALUES
(18, 13, 'Turbidity', 'NTU', 25, 0, 0, 0, 2, 'Physical'),
(19, 13, 'Color', 'Pt-Co', 50, 0, 0, 0, 6, 'Physical'),
(20, 13, 'Total Dissolve Solids (TDS)', 'mg/L', 1000, 0, 0, 0, 3, 'Physical'),
(21, 13, 'Temperature', '°C', 0, 0, 0, 0, 2, 'Physical'),
(22, 13, 'Iron (Fe)', 'mg/L', 1, 0, 0, 0, 18, 'Chemistry'),
(23, 13, 'Fluoride (F)', 'mg/L', 1.5, 0, 0, 0, 13, 'Chemistry'),
(24, 13, 'Total Hardness (CaCO3)', 'mg/L', 500, 0, 0, 0, 6, 'Chemistry'),
(25, 13, 'Total Coliform', 'CFU/100ml', 50, 0, 0, 0, 20, 'Microbiology'),
(26, 13, 'E-Coliform', 'CFU/100ml', 0, 0, 0, 0, 20, 'Microbiology'),
(27, 15, 'Ammonia (NH3)', 'mg/L', 0.5, 0, 0, 0, 2, 'Physical'),
(28, 15, 'Chlorine (CI2)', 'mg/L', 10, 0, 0, 0, 4, 'Chemistry'),
(29, 15, 'Hydrogen Chloride (HCl)', 'mg/L', 5, 0, 0, 0, 13, 'Chemistry'),
(30, 15, 'Hydrogen Fluoride (HF)', 'mg/L', 10, 0, 0, 0, 13, 'Chemistry'),
(31, 15, 'Nitrogen Dioxide (NO2)', 'mg/L', 1000, 0, 0, 0, 19, 'Chemistry'),
(32, 15, 'Opacity', '%', 30, 0, 0, 0, 18, 'Physical'),
(33, 15, 'Particulate', 'mg/L', 350, 0, 0, 0, 20, 'Chemistry'),
(34, 15, 'Sulfur Dioxide (SO2)*', 'mg/L', 800, 0, 0, 0, 18, 'Physical'),
(35, 15, 'Hydrogen Sulfide (H2S)', 'mg/L', 35, 0, 0, 0, 2, 'Physical'),
(36, 15, 'Mercury (Hg)', 'mg/L', 5, 0, 0, 0, 8, 'Physical'),
(37, 15, 'Arsenic (As)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(38, 15, 'Antimony (Sb)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(39, 15, 'Cadmium (Cd)', 'mg/L', 8, 0, 0, 0, 18, 'Physical'),
(40, 15, 'Zinc (Zn)', 'mg/L', 50, 0, 0, 0, 19, 'Physical'),
(41, 15, 'Lead (Pb)', 'mg/L', 12, 0, 0, 0, 18, 'Physical'),
(42, 12, 'Temperature', '°C', 1000, 1000, 1000, 1000, 2, 'Physical'),
(44, 12, 'Biological Oxygen demand (BOD)', 'mg/L', 2, 3, 6, 12, 4, 'Chemistry'),
(45, 12, 'Total Suspens Solids (TTS)', 'mg/L', 40, 50, 100, 400, 3, 'Physical'),
(46, 12, 'Total DOscovered Solds (TDS)', 'mg/L', 1000, 1000, 1000, 1000, 3, 'Physical'),
(47, 12, 'Chemicial Oxygen Demand (COD)', 'mg/L', 10, 25, 40, 80, 7, 'Chemistry'),
(48, 12, 'pH', '°C', 6, 6, 6, 6, 4, 'Chemistry'),
(49, 12, 'Total Phospharate (PO4)', 'mg/L', 0.2, 0.2, 1, 0, 3, 'Chemistry'),
(50, 12, 'Sulfate (s04)', 'mg/L', 300, 300, 300, 400, 3, 'Chemistry'),
(51, 12, 'Arsenic (As)', 'mg/L', 0.05, 0.05, 0.05, 0.1, 6, 'Chemistry'),
(52, 12, 'Boron (B)', 'mg/L', 1, 1, 1, 1, 13, 'Chemistry'),
(53, 12, 'Cadmium (cd)', 'mg/L', 0.01, 0.01, 0.01, 0.01, 12, 'Chemistry'),
(54, 12, 'Cobalt (Co)', 'mg/L', 0.2, 0.2, 0.2, 0.2, 10, 'Chemistry'),
(55, 12, 'Chromium Hexavalent (Cr6+)', 'mg/L', 0.05, 0.05, 0.05, 1, 14, 'Chemistry'),
(56, 12, 'Copper (Cu)', 'mg/L', 0.02, 0.02, 0.02, 0.2, 19, 'Chemistry'),
(57, 12, 'Lead (pb)', 'mg/L', 0.03, 0.03, 0.03, 0.5, 18, 'Chemistry'),
(58, 12, 'Mercury (Hg)', 'mg/L', 0.001, 0.002, 0.002, 0.005, 19, 'Chemistry'),
(59, 12, 'Oil and Grease', 'mg/L', 1, 1, 1, 10, 12, 'Chemistry'),
(60, 12, 'Selenium (se)', 'mg/L', 0.01, 0.05, 0.05, 0.05, 16, 'Chemistry'),
(61, 12, 'Zinc (Zn)', 'mg/L', 0.05, 0.05, 0.05, 2, 10, 'Chemistry'),
(62, 12, 'Nikel (Ni)', 'mg/L', 0.05, 0.05, 0.05, 0.1, 19, 'Chemistry'),
(63, 12, 'MBAS', 'mg/L', 0.2, 0.2, 0.2, 0, 12, 'Chemistry'),
(64, 12, 'Mangan (Mn)', 'mg/L', 0.1, 0, 0, 0, 11, 'Chemistry'),
(65, 6, 'Temperature', '°C', 40, 0, 0, 0, 4, 'Physical'),
(66, 6, 'Total Dissolved Solids (TDS)', 'mg/L', 4000, 0, 0, 0, 12, 'Physical'),
(67, 6, 'Total Suspended Solids (TSS)', 'mg/L', 4000, 0, 0, 0, 17, 'Physical'),
(68, 6, 'Ph', '°C', 5.5, 0, 0, 0, 3, 'Chemistry'),
(69, 6, 'Iron (fe)', 'mg/L', 10, 0, 0, 0, 4, 'Chemistry'),
(70, 6, 'Manganese (Mn)', 'mg/L', 4, 0, 0, 0, 4, 'Chemistry'),
(71, 6, 'Barium (ba)', 'mg/L', 4, 0, 0, 0, 4, 'Chemistry'),
(72, 6, 'Copper (Cu)', 'mg/L', 4, 0, 0, 0, 3, 'Chemistry'),
(73, 6, 'Chomium Hexavalent (Cr6+)', 'mg/L', 0.2, 0, 0, 0, 4, 'Chemistry'),
(74, 6, 'Zinc (Zn)', 'mg/L', 10, 0, 0, 0, 3, 'Chemistry'),
(75, 6, 'Chromium (Cr)', 'mg/L', 1, 0, 0, 0, 2, 'Chemistry'),
(76, 6, 'Cadium (cd)', 'mg/L', 0.1, 0, 0, 0, 4, 'Chemistry'),
(77, 6, 'Total Lead (Pb)', 'mg/L', 0.2, 0, 0, 0, 14, 'Chemistry'),
(78, 6, 'Stannum (Sn)', 'mg/L', 4, 0, 0, 0, 4, 'Chemistry'),
(79, 6, 'Mercury (Hg)', 'mg/L', 0.004, 0, 0, 0, 13, 'Chemistry'),
(80, 6, 'Arsenic (As)', 'mg/L', 0.2, 0, 0, 0, 13, 'Chemistry'),
(81, 6, 'Selenium (Se)', 'mg/L', 0.1, 0, 0, 0, 16, 'Chemistry'),
(82, 6, 'Nickel (Ni)', 'mg/L', 0.4, 0, 0, 0, 18, 'Chemistry'),
(83, 6, 'Cobalt (Co)', 'mg/L', 0.8, 0, 0, 0, 4, 'Chemistry'),
(84, 6, 'Cyanide (Cn)', 'mg/L', 0.1, 0, 0, 0, 12, 'Chemistry'),
(85, 6, 'Hydrogen Sulfide (H2S)', 'mg/L', 0.1, 0, 0, 0, 15, 'Chemistry'),
(86, 6, 'Fluoride (f)', 'mg/L', 4, 0, 0, 0, 12, 'Chemistry'),
(87, 6, 'Free Chorine (Cl2)', 'mg/L', 2, 0, 0, 0, 2, 'Chemistry'),
(88, 6, 'Ammonia (NH3N)', 'mg/L', 2, 0, 0, 0, 3, 'Chemistry'),
(89, 6, 'Nitrate (NO3N)', 'mg/L', 40, 0, 0, 0, 3, 'Chemistry'),
(90, 6, 'Nitrite (No2N)', 'mg/L', 40, 0, 0, 0, 14, 'Chemistry'),
(91, 6, 'Total Nitrogen', 'mg/L', 2, 0, 0, 0, 9, 'Chemistry'),
(92, 6, 'Biological Oxygen Demand (BOD)', 'mg/L', 200, 0, 0, 0, 4, 'Chemistry'),
(93, 6, 'Chemicial Oxygen demand (COD)', 'mg/L', 400, 0, 0, 0, 4, 'Chemistry'),
(94, 6, 'MBAS', 'mg/L', 10, 0, 0, 0, 10, 'Chemistry'),
(96, 6, 'Phenol', 'mg/L', 1, 0, 0, 0, 10, 'Chemistry'),
(97, 6, 'Oil and Grease', 'mg/L', 10, 0, 0, 0, 3, 'Chemistry'),
(98, 6, 'Total Coliform ', 'mg/L', 0, 0, 0, 0, 4, 'Microbiology'),
(99, 10, 'Sulphur Dioxide (S02)', 'mg/L', 0.25, 0, 0, 0, 14, 'Physical'),
(100, 10, 'Nitrogen Dioxide (No3)', 'mg/L', 0.2, 0, 0, 0, 4, 'Chemistry'),
(101, 10, 'Carbon Monoxide (Co)', 'mg/L', 29, 0, 0, 0, 5, 'Physical'),
(102, 10, 'Ammonia (Nh3)', 'mg/L', 17, 0, 0, 0, 13, 'Physical'),
(103, 10, 'Hydrogen Sulfide (H2s)', 'NTU', 1, 0, 0, 0, 14, 'Physical'),
(104, 10, 'Total Suspended Particulates (TSP)', 'mg/L', 10, 0, 0, 0, 12, 'Physical'),
(105, 8, 'Ammonia (Nh3)', 'mg/L', 0.5, 0, 0, 0, 4, 'Physical'),
(106, 8, 'Chlorine (Cl2)', 'mg/L', 10, 0, 0, 0, 6, 'Physical'),
(107, 8, 'Hydrogen Chloride (HCl)', 'mg/L', 5, 0, 0, 0, 15, 'Physical'),
(108, 8, 'Hydrogen Fluoride (Hf)', 'mg/L', 10, 0, 0, 0, 17, 'Physical'),
(109, 8, 'Nitrogen Dioxide (No2)', 'mg/L', 1000, 0, 0, 0, 17, 'Physical'),
(110, 8, 'Opacity', '%', 35, 0, 0, 0, 12, 'Physical'),
(111, 8, 'Particulate', 'mg/L', 350, 0, 0, 0, 12, 'Physical'),
(112, 8, 'Sulfur Dioxide (S02)', 'mg/L', 800, 0, 0, 0, 12, 'Physical'),
(113, 8, 'Hydrogen Sulfide (HS2s)', 'mg/L', 35, 0, 0, 0, 14, 'Physical'),
(114, 8, 'Mercury (Hg)', 'mg/L', 5, 0, 0, 0, 8, 'Physical'),
(115, 8, 'Arsenic (As)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(116, 8, 'Antimony (Sb)', 'mg/L', 8, 0, 0, 0, 8, 'Physical'),
(117, 8, 'Cadmium (Cd)', 'mg/L', 8, 0, 0, 0, 19, 'Physical'),
(118, 8, 'Zinc (Zn)', 'mg/L', 50, 0, 0, 0, 11, 'Physical'),
(119, 8, 'Total Lead (Pb)', 'mg/L', 12, 0, 0, 0, 11, 'Physical'),
(122, 3, 'Methyl Ethyl Ketone (C4H8O)', 'mg/L', 200, 0, 0, 0, 15, 'Physical'),
(123, 3, 'Acelon (C2H2O)', 'mg/L', 118.12, 0, 0, 0, 3, 'Physical'),
(124, 3, 'Toluene (C7H8)', 'mg/L', 20, 0, 0, 0, 3, 'Physical'),
(125, 16, 'Armonia (NH3)', 'mg/L', 0.5, 0, 0, 0, 3, 'Physical'),
(126, 16, 'Cholrine (Cl2)', 'mg/L', 10, 0, 0, 0, 4, 'Physical'),
(128, 16, 'Hydrogen Chloride (HCI)', 'mg/L', 5, 0, 0, 0, 3, 'Physical'),
(129, 16, 'Hydrogen Fluoride (HF)', 'mg/L', 10, 0, 0, 0, 12, 'Physical'),
(130, 16, 'Nitrogen Dioxide (NO2)', 'mg/L', 1000, 0, 0, 0, 17, 'Physical'),
(131, 16, 'Opacity', 'mg/L', 35, 0, 0, 0, 2, 'Physical'),
(132, 16, 'Particulate', 'mg/L', 350, 0, 0, 0, 3, 'Physical'),
(133, 16, 'Sulfure Dioxide (SO2)', 'mg/L', 35, 0, 0, 0, 14, 'Physical'),
(134, 16, 'Hydrogen Sulfide (H2S)', 'mg/L', 35, 0, 0, 0, 2, 'Physical'),
(135, 16, 'Mercury (Hg)', 'mg/L', 5, 0, 0, 0, 4, 'Physical'),
(136, 16, 'Arsenic (as)', 'mg/L', 8, 0, 0, 0, 4, 'Physical'),
(137, 16, 'Antimony (Sb)', 'mg/L', 8, 0, 0, 0, 4, 'Physical'),
(138, 16, 'Cadiuum (Cd)', 'mg/L', 8, 0, 0, 0, 2, 'Physical'),
(139, 16, 'Zinc (Zn)', 'mg/L', 50, 0, 0, 0, 4, 'Physical'),
(140, 16, 'Lead (Pb)', 'mg/L', 12, 0, 0, 0, 2, 'Physical');

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
(11, 'PT. Lentera Jiwa Project', '08858183202', 'Lenterajiwa@gmail.com', 'Jl. Pesat raya no 25 bogor', 'Annaufal Arifa', 'CEO of Lentera Jiwa Group'),
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
(20, 'SM 23rd 9221B-2017');

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
  `add_price` int(11) NOT NULL
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
(38, 3, 11, '<p>dsc</p>', '<p>sdcsdcds</p>', 12, 10, 80000);

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
  `result` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `result_coa`
--

INSERT INTO `result_coa` (`id_result`, `id_sk`, `id_coa`, `id_analysis`, `id_int`, `result`) VALUES
(14, 9, 18, 13, 7, 'berhasil mantap banget gg'),
(15, 9, 19, 13, 7, 'sdfsdfs'),
(16, 9, 20, 13, 7, 'hguygtuytuy'),
(17, 9, 21, 13, 7, 'asdsad'),
(18, 9, 22, 13, 7, 'sdfsdf'),
(19, 9, 23, 13, 7, 'sdfsdfsd'),
(20, 9, 24, 13, 7, ''),
(21, 9, 25, 13, 7, ''),
(22, 9, 26, 13, 7, ''),
(23, 9, 27, 15, 7, NULL),
(24, 9, 28, 15, 7, NULL),
(25, 9, 29, 15, 7, NULL),
(26, 9, 30, 15, 7, NULL),
(27, 9, 31, 15, 7, NULL),
(28, 9, 32, 15, 7, NULL),
(29, 9, 33, 15, 7, NULL),
(30, 9, 34, 15, 7, NULL),
(31, 9, 35, 15, 7, NULL),
(32, 9, 36, 15, 7, NULL),
(33, 9, 37, 15, 7, NULL),
(34, 9, 38, 15, 7, NULL),
(35, 9, 39, 15, 7, NULL),
(36, 9, 40, 15, 7, NULL),
(37, 9, 41, 15, 7, NULL),
(38, 10, 18, 13, 11, 'sdf'),
(39, 10, 19, 13, 11, 'sdf'),
(40, 10, 20, 13, 11, 'sdfsdf'),
(41, 10, 21, 13, 11, 'sdfsd'),
(42, 10, 22, 13, 11, 'fsdf'),
(43, 10, 23, 13, 11, 'sdfsd'),
(44, 10, 24, 13, 11, 'fsd'),
(45, 10, 25, 13, 11, 'fsdf'),
(46, 10, 26, 13, 11, 'sdfsdf'),
(47, 10, 27, 15, 11, 'sdfsdf'),
(48, 10, 28, 15, 11, 'sdf'),
(49, 10, 29, 15, 11, 'sdfsd'),
(50, 10, 30, 15, 11, 'fsdf'),
(51, 10, 31, 15, 11, 'sdfsd'),
(52, 10, 32, 15, 11, 'fsd'),
(53, 10, 33, 15, 11, 'fsdf'),
(54, 10, 34, 15, 11, 'sdfsd'),
(55, 10, 35, 15, 11, 'fsd'),
(56, 10, 36, 15, 11, 'fsdfsd'),
(57, 10, 37, 15, 11, 'fsd'),
(58, 10, 38, 15, 11, 'sdfsd'),
(59, 10, 39, 15, 11, 'fsd'),
(60, 10, 40, 15, 11, 'fsdf'),
(61, 10, 41, 15, 11, 'sdfsdf'),
(62, 10, 65, 6, 11, 'sdfsd'),
(63, 10, 66, 6, 11, 'fsdfsd'),
(64, 10, 67, 6, 11, 'fsd'),
(65, 10, 68, 6, 11, 'fsdf'),
(66, 10, 69, 6, 11, 'sdf'),
(67, 10, 70, 6, 11, 'sdfs'),
(68, 10, 71, 6, 11, 'dfsd'),
(69, 10, 72, 6, 11, 'fsdf'),
(70, 10, 73, 6, 11, 'sdfsd'),
(71, 10, 74, 6, 11, 'fsd'),
(72, 10, 75, 6, 11, 'fsdfsdsd'),
(73, 10, 76, 6, 11, 'sdf'),
(74, 10, 77, 6, 11, 'sdfsdfsd'),
(75, 10, 78, 6, 11, 'fsd'),
(76, 10, 79, 6, 11, 'fsdf'),
(77, 10, 80, 6, 11, 'sdfsdf'),
(78, 10, 81, 6, 11, 'sdfsd'),
(79, 10, 82, 6, 11, 'fsdf'),
(80, 10, 83, 6, 11, 'sdfsd'),
(81, 10, 84, 6, 11, 'sdf'),
(82, 10, 85, 6, 11, 'sdfsdfs'),
(83, 10, 86, 6, 11, 'dfsd'),
(84, 10, 87, 6, 11, 'sdfsd'),
(85, 10, 88, 6, 11, 'fsdfsd'),
(86, 10, 89, 6, 11, 'fsdf'),
(87, 10, 90, 6, 11, 'sdfs'),
(88, 10, 91, 6, 11, 'sdfsdf'),
(89, 10, 92, 6, 11, 'sdfs'),
(90, 10, 93, 6, 11, 'dfsd'),
(91, 10, 94, 6, 11, 'fsdfds'),
(92, 10, 95, 6, 11, 'fsd'),
(93, 10, 96, 6, 11, 'fsdfds'),
(94, 10, 97, 6, 11, 'sdf'),
(95, 10, 98, 6, 11, 'fdssdf'),
(96, 10, 120, 6, 11, 'sdfsdf'),
(97, 10, 42, 12, 11, NULL),
(98, 10, 44, 12, 11, NULL),
(99, 10, 45, 12, 11, NULL),
(100, 10, 46, 12, 11, NULL),
(101, 10, 47, 12, 11, NULL),
(102, 10, 48, 12, 11, NULL),
(103, 10, 49, 12, 11, NULL),
(104, 10, 50, 12, 11, NULL),
(105, 10, 51, 12, 11, NULL),
(106, 10, 52, 12, 11, NULL),
(107, 10, 53, 12, 11, NULL),
(108, 10, 54, 12, 11, NULL),
(109, 10, 55, 12, 11, NULL),
(110, 10, 56, 12, 11, NULL),
(111, 10, 57, 12, 11, NULL),
(112, 10, 58, 12, 11, NULL),
(113, 10, 59, 12, 11, NULL),
(114, 10, 60, 12, 11, NULL),
(115, 10, 61, 12, 11, NULL),
(116, 10, 62, 12, 11, NULL),
(117, 10, 63, 12, 11, NULL),
(118, 10, 64, 12, 11, NULL),
(119, 10, 105, 8, 11, NULL),
(120, 10, 106, 8, 11, NULL),
(121, 10, 107, 8, 11, NULL),
(122, 10, 108, 8, 11, NULL),
(123, 10, 109, 8, 11, NULL),
(124, 10, 110, 8, 11, NULL),
(125, 10, 111, 8, 11, NULL),
(126, 10, 112, 8, 11, NULL),
(127, 10, 113, 8, 11, NULL),
(128, 10, 114, 8, 11, NULL),
(129, 10, 115, 8, 11, NULL),
(130, 10, 116, 8, 11, NULL),
(131, 10, 117, 8, 11, NULL),
(132, 10, 118, 8, 11, NULL),
(133, 10, 119, 8, 11, NULL),
(134, 10, 99, 10, 11, 'sdfsd'),
(135, 10, 100, 10, 11, 'fsdfs'),
(136, 10, 101, 10, 11, 'dfsdf'),
(137, 10, 102, 10, 11, 'sdfsd'),
(138, 10, 103, 10, 11, 'fsdf'),
(139, 10, 104, 10, 11, 'sdfsdf'),
(140, 10, 125, 16, 11, NULL),
(141, 10, 126, 16, 11, NULL),
(142, 10, 128, 16, 11, NULL),
(143, 10, 129, 16, 11, NULL),
(144, 10, 130, 16, 11, NULL),
(145, 10, 131, 16, 11, NULL),
(146, 10, 132, 16, 11, NULL),
(147, 10, 133, 16, 11, NULL),
(148, 10, 134, 16, 11, NULL),
(149, 10, 135, 16, 11, NULL),
(150, 10, 136, 16, 11, NULL),
(151, 10, 137, 16, 11, NULL),
(152, 10, 138, 16, 11, NULL),
(153, 10, 139, 16, 11, NULL),
(154, 10, 140, 16, 11, NULL),
(155, 10, 122, 3, 11, NULL),
(156, 10, 123, 3, 11, NULL),
(157, 10, 124, 3, 11, NULL);

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
  `sample_desc` varchar(255) NOT NULL,
  `location` text NOT NULL,
  `sample_type` varchar(255) DEFAULT NULL,
  `deadline` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sampling_det`
--

INSERT INTO `sampling_det` (`id_sampling`, `id_sk`, `sample_desc`, `location`, `sample_type`, `deadline`, `description`) VALUES
(8, 2, 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Halaman Depan Plant 1</li><li>Halaman Belakang Plant 2</li><li>Halaman Belakang Plant 3</li></ul>', 'Cair', '2022-10-14', 'gg gaming'),
(9, 2, 'Debu, SO2, NO2, CO, NH3, H2S, Suhu, Kelembaban', '<ul><li>Ruang Produksi Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 3</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Padat', '2022-10-13', 'mantap'),
(10, 2, 'NOISE', '<ul><li>Batas Pabrik Sebelah Utara</li><li>Batas Pabrik Sebelah Selatan</li><li>Batas Pabrik Sebelah Timur</li><li>Batas Pabrik Sebelah Barat</li></ul>', 'Gas', '2022-10-01', 'Ini deskripsi singkat'),
(11, 2, 'NOISE', '<ul><li>Ruang Produksi Plant 1</li><li>Area Barel Machine Plant 1</li><li>Ruang Produksi Plant 2</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'Gas', '2022-10-20', 'ini deskripsi sangat singkat.'),
(12, 2, 'ISBB/Heat Stress', '<ul><li>Ruang Heat Treatment Plant 2</li><li>Ruang Heat Treatment Plant 3</li></ul>', 'ghf', '2022-10-02', 'gfh'),
(13, 2, 'Benzene, Toluene, Xylene (BTX)', '<p>Area Platting Plant 1</p>', 'asdas', '2022-10-04', 'asd'),
(14, 2, 'SO2, NO2, CO, Partikulat, Opasitas, Laju Alir', '<ul><li>Cerobong Genset 800 kVA Plant 1</li><li>Cerobong Genset 600 kVA Plant 2</li></ul>', 'ads', '2022-10-19', 'asd'),
(15, 2, 'Pencahayaan', '<ul><li>Ruang Hear Treatment Plant 1</li><li>Ruang Produksi Plant 1</li><li>Ruang Heat Treatment Plant 2</li><li>Ruang Produksi Plant 2</li><li>Ruang Produksi Plant 3</li><li>Ruang Heat Treatment Plant 3</li></ul>', '', '', ''),
(16, 2, 'Opasitas', '<ul><li>Forklift (1 titik) Plant 1</li><li>Forklift 2,5 Ton (1 titik) Plant 2</li><li>Truck Hino Tahun 2005 (T 8102 L) Plant 3</li><li>Truck Hino Tahun 2004 (T 8228 K) Plant 3</li><li>Truck Isuzu Tahun 2002 (T 8047 FZ) Plant 3</li></ul>', '', '', ''),
(17, 2, 'Air Limbah Produksi', '<p>Servis Manhole</p>', '', '', ''),
(18, 2, 'Air Limbah Domestik', '<p>Servis Manhole</p>', '', '', ''),
(19, 7, 'Debu, SO2, NO2, CO, NH3, H2S', '<ul><li>Rumah Rezha</li><li>Rumah Pram</li></ul>', NULL, NULL, NULL),
(22, 6, 'SO2, NO2, CO', '<ul><li>GH Evos</li><li>GH RRQ</li></ul>', 'Cair', '2022-10-06', 'sedang dikerjakan'),
(23, 9, 'Debu, SO2, NO2, CO', '<p>dsfsdf</p>', 'Gas', '2022-10-06', 'fgfdgdfgdf'),
(24, 10, 'Debu, SO2, NO2, CO', '<p>sdfsdfsd</p>', 'dsfdsf', '2022-10-11', 'dsfsdf'),
(25, 10, 'Partikulat, Opasitas, Laju Alir, Pencahayaan', '<p>sdfsdfsd</p>', 'dsfsd', '2022-10-12', 'sdfsdf');

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
  `date_quotation` varchar(255) NOT NULL,
  `date_sample` varchar(255) NOT NULL,
  `date_analysis` varchar(255) NOT NULL,
  `date_report` varchar(255) NOT NULL,
  `id_int` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sk_number`
--

INSERT INTO `sk_number` (`id_sk`, `sk_quotation`, `sk_sample`, `sk_analysis`, `no_certificate`, `date_quotation`, `date_sample`, `date_analysis`, `date_report`, `id_int`) VALUES
(2, '1/2022/09/27/DIL/QTN', '2/2022/09/30/DIL/STPS', '2/2022/10/04/DIL/STP', '', '', '04/10/2022', '', '', 3),
(4, '3/2022/09/27/DIL/QTN', '', '', '', '', '', '', '', 4),
(5, '5/2022/09/27/DIL/QTN', '', '', '', '', '', '', '', 9),
(6, '6/2022/09/27/DIL/QTN', '6/2022/10/03/DIL/STPS', '6/2022/10/04/DIL/STP', '', '', '04/10/2022', '', '', 12),
(7, '7/2022/09/29/DIL/QTN', '7/2022/09/30/DIL/STPS', '', '', '', '', '', '', 10),
(8, '8/2022/10/03/DIL/QTN', '', '', '', '03/10/2022', '', '', '', 5),
(9, '9/2022/10/04/DIL/QTN', '9/2022/10/04/DIL/STPS', '9/2022/10/04/DIL/STP', 'DIL-20221004COA', '04/10/2022', '04/10/2022', '04/10/2022', '04/10/2022', 7),
(10, '10/2022/10/09/DIL/QTN', '10/2022/10/09/DIL/STPS', '10/2022/10/09/DIL/STP', 'DIL-20221009COA', '09/10/2022', '09/10/2022', '09/10/2022', '09/10/2022', 11);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis`
--
ALTER TABLE `analysis`
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  MODIFY `id_assign` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `method`
--
ALTER TABLE `method`
  MODIFY `id_method` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `id_quotation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `result_coa`
--
ALTER TABLE `result_coa`
  MODIFY `id_result` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sampling_det`
--
ALTER TABLE `sampling_det`
  MODIFY `id_sampling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
