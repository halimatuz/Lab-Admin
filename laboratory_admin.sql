-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2022 at 05:33 AM
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
  `standart_price` int(11) NOT NULL,
  `COA` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assign_sampler`
--

CREATE TABLE `assign_sampler` (
  `id_sample` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coa`
--

CREATE TABLE `coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `params` int(11) NOT NULL,
  `unit` int(11) NOT NULL,
  `reg_standart_1` double NOT NULL,
  `reg_standart_2` double DEFAULT NULL,
  `reg_standart_3` double DEFAULT NULL,
  `reg_standart_4` double DEFAULT NULL,
  `method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id_int` int(11) NOT NULL,
  `name_int` varchar(255) NOT NULL,
  `int_phone` varchar(255) NOT NULL,
  `int_email` varchar(255) NOT NULL,
  `int_adress` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id_int`, `name_int`, `int_phone`, `int_email`, `int_adress`) VALUES
(3, 'PT.Rosaria', '08967832', 'rosaria@gmail.com', 'JL Bursama'),
(4, 'PT. Jgu merdeka', '087632121', 'jgu@jgu.ac.id', 'JL Pegangsaan Timur'),
(5, 'PT. Nusanatara Indah', '081385321716', 'nusantara26@gmail.com', 'JL Marzuki barat'),
(6, 'PT.Jaya indonesia', '08137569956', 'Jayaind17@gmail.com', 'JL Penus raya'),
(7, 'PT. Betafish rizki', '08567641801', 'betafishrizq@gmail.com', 'Jl Mandor Sanun'),
(8, 'PT. Oasis Bogor', '081376838901', 'oasisbogor@gmail.com', 'Jl Lipi selatan'),
(9, 'PT. Jali Indonesia Utama', '0856956371', 'Jaliindonesia23@gmail.com', 'Jl Topaz nasution'),
(10, 'PT. Kingbarba', '083819588819', 'kingbarbar@gmail.com', 'Jl. H,ahmad dahlan'),
(11, 'PT. Lentera Jiwa Project', '08858183202', 'Lenterajiwa@gmail.com', 'Jl. Pesat raya no 25 bogor'),
(12, 'PT. Big mouse korean', '0858939312', 'bigmousek@gmail.com', 'Jl. Kemang 2 jakarta barat');

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `remarks` text NOT NULL,
  `spec` text NOT NULL,
  `qty` int(11) NOT NULL,
  `id_sk` int(11) NOT NULL,
  `add_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `result_coa`
--

CREATE TABLE `result_coa` (
  `id_coa` int(11) NOT NULL,
  `id_analysis` int(11) NOT NULL,
  `id_int` int(11) NOT NULL,
  `result` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sample`
--

CREATE TABLE `sample` (
  `id_sample` int(11) NOT NULL,
  `name_sample` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 'Muhammad Raihan Alfaiz', 1, '081210805647', 'raihan.aal@gmail.com'),
(7, 'Akbar Maulana Febriansyah', 1, '0856973256', 'akbar@gmail.com'),
(8, 'Rezha Ikhwan Hidayat', 1, '054586325975', 'rezha@gmail.com'),
(9, 'Ananda Rizq', 1, '084569785236', 'nanda@gmail.com'),
(10, 'Atiyah Ummi Sholihat', 0, '085647521245', 'atiyah@gmail.com'),
(11, 'Deviyanti Kusumawati', 0, '085645857584', 'devi@gmail.com'),
(12, 'Pramdhanni Dwi Putra Bintang', 1, '085698741236', 'pramgebleg@gmail.com'),
(13, 'Annaufal Arifa Nasution Hidayatullah', 1, '083698755485', 'annaufal60@gmail.com'),
(14, 'Shevy Octavian', 1, '081210805647', 'shevygaming@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `sampling_det`
--

CREATE TABLE `sampling_det` (
  `id_sk` int(11) NOT NULL,
  `id_sample` int(11) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sk_number`
--

CREATE TABLE `sk_number` (
  `id_sk` int(11) NOT NULL,
  `sk_quotation` varchar(255) NOT NULL,
  `sk_sample` varchar(255) NOT NULL,
  `sk_analysis` varchar(255) NOT NULL,
  `id_int` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  ADD KEY `id_sample` (`id_sample`),
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
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD KEY `id_int` (`id_int`),
  ADD KEY `id_analysis` (`id_analysis`);

--
-- Indexes for table `result_coa`
--
ALTER TABLE `result_coa`
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
  ADD KEY `id_sk` (`id_sk`),
  ADD KEY `id_sample` (`id_sample`);

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
  MODIFY `id_analysis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coa`
--
ALTER TABLE `coa`
  MODIFY `id_coa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id_int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sample`
--
ALTER TABLE `sample`
  MODIFY `id_sample` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sampler`
--
ALTER TABLE `sampler`
  MODIFY `id_sampler` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sk_number`
--
ALTER TABLE `sk_number`
  MODIFY `id_sk` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assign_sampler`
--
ALTER TABLE `assign_sampler`
  ADD CONSTRAINT `assign_sampler_ibfk_1` FOREIGN KEY (`id_sample`) REFERENCES `sampler` (`id_sampler`) ON DELETE CASCADE ON UPDATE CASCADE,
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
-- Constraints for table `result_coa`
--
ALTER TABLE `result_coa`
  ADD CONSTRAINT `result_coa_ibfk_2` FOREIGN KEY (`id_coa`) REFERENCES `coa` (`id_coa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_coa_ibfk_3` FOREIGN KEY (`id_analysis`) REFERENCES `quotation` (`id_analysis`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `result_coa_ibfk_4` FOREIGN KEY (`id_int`) REFERENCES `quotation` (`id_int`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sampling_det`
--
ALTER TABLE `sampling_det`
  ADD CONSTRAINT `sampling_det_ibfk_1` FOREIGN KEY (`id_sample`) REFERENCES `sample` (`id_sample`) ON DELETE CASCADE ON UPDATE CASCADE,
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
